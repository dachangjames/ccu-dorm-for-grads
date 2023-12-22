<?php
require_once "Dotenv.php";
require_once "DB.php";

class Token
{
  /**
   * Token will be expired after 1 day
   */
  const ACCESS_EXP = 30 * 60;
  const REFRESH_EXP = 60 * 60 * 24;

  /**
   * ### Authorize the user
   * Sign both refresh and access token to the user from the payload.
   * 
   * @param array $payload
   * Contains user account and password.
   * 
   * @return string|int
   * Return the access token if the payload is valid, if not, return 401 or 403.
   */
  public static function auth($payload)
  {
    $ACCESS_KEY = Dotenv::load("ACCESS_KEY");
    $REFRESH_KEY = Dotenv::load("REFRESH_KEY");

    // hash password
    $hashed_pw = hash('SHA256', $payload["pw"]);
    $payload["pw"] = $hashed_pw;

    $tokens = self::sign($payload, $ACCESS_KEY, $REFRESH_KEY, self::ACCESS_EXP, self::REFRESH_EXP);
    if ($tokens === 401 || $tokens === 403) {
      // wrong account or password
      return $tokens;
    }

    [$access_token, $refresh_token] = $tokens;

    // set the cookie
    setcookie("jwt", $refresh_token, time() + self::REFRESH_EXP, "/", "", true, true);

    return $access_token;
  }

  /**
   * ### Sign JWT token
   * 
   * @param array $payload
   * Contains user data.
   * 
   * @param string $access_key
   * Access key for encoding.
   * 
   * @param string $refresh_key
   * Refresh key for encoding.
   * 
   * @param int $access_expired
   * The expired time of access token.
   * 
   * @param int $refresh_expired
   * The expired time of refresh token.
   * 
   * @return array|int
   * Returns the signed JWT tokens, return 401 or 403 if the payload is invalid.
   */
  private static function sign($payload, $access_key, $refresh_key, $access_expired, $refresh_expired)
  {
    // header
    $header = ["alg" => "HS256", "type" => "JWT"];
    $header_encoded = base64_encode((json_encode($header)));

    // fetch user permission
    if (!isset($payload["perm"])) {
      $user = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $payload["acc"]);
      // check if user exists
      if (!$user) {
        // wrong account
        return 401;
      } else if ($user["pw"] !== $payload["pw"]) {
        // wrong password
        return 403;
      } else {
        $sex = $user["sex"];
        $perm = $user["permit_cd"];
      }
    } else {
      $perm = $payload["perm"];
      $sex = $payload["sex"];
    }

    // additional payload data
    $payload_meta = [
      "iat" => time(),
      "perm" => $perm,
      "sex" => $sex,
    ];

    // encode payload
    $access_payload = $payload + $payload_meta + ["exp" => time() + $access_expired];
    $access_payload_encoded = base64_encode(json_encode($access_payload));

    $refresh_payload = $payload + $payload_meta + ["exp" => time() + $refresh_expired];
    $refresh_payload_encoded = base64_encode(json_encode($refresh_payload));

    // encode signature
    $access_signature = hash_hmac("SHA256", $header_encoded . $access_payload_encoded, $access_key);
    $access_signature_encoded = base64_encode($access_signature);

    $refresh_signature = hash_hmac("SHA256", $header_encoded . $refresh_payload_encoded, $refresh_key);
    $refresh_signature_encoded = base64_encode($refresh_signature);

    // return both tokens
    $access_token = $header_encoded . "." . $access_payload_encoded . "." . $access_signature_encoded;
    $refresh_token = $header_encoded . "." . $refresh_payload_encoded . "." . $refresh_signature_encoded;

    return [$access_token, $refresh_token];
  }

  /**
   * ### Verify JWT token
   * Check if the user have valid JWT tokens.
   * 
   * @param string $access_token
   * The JWT token stored in the user's session.
   * 
   * @param string $refresh_token
   * The JWT token for refresh user cookie.
   * 
   * @return array
   * Return the payload of the refresh token and the access token,
   * if the verification failed, return false with the previous access token
   */
  public static function verify($access_token, $refresh_token)
  {
    $ACCESS_KEY = Dotenv::load("ACCESS_KEY");
    $REFRESH_KEY = Dotenv::load("REFRESH_KEY");

    // seperate strings
    $access_token_parts = explode(".", $access_token);
    $refresh_token_parts = explode(".", $refresh_token);

    // hmac stuff
    $access_signature = base64_encode(hash_hmac("SHA256", $access_token_parts[0] . $access_token_parts[1], $ACCESS_KEY));
    $refresh_signature = base64_encode(hash_hmac("SHA256", $refresh_token_parts[0] . $refresh_token_parts[1], $REFRESH_KEY));

    // verify signatures
    if ($access_signature != $access_token_parts[2] || $refresh_signature != $refresh_token_parts[2]) {
      // Invalid token
      return [false, $access_token];
    }

    // decode payloads
    $access_payload = json_decode(base64_decode($access_token_parts[1]), true);
    $refresh_payload = json_decode(base64_decode($refresh_token_parts[1]), true);

    // check if access token is expired
    if ($access_payload["exp"] > time()) {
      return [$refresh_payload, $access_token];
    } else if ($refresh_payload["exp"] > time()) {
      // resign both tokens if refresh token is not expired
      [$access_token, $refresh_token] = self::sign($refresh_payload, $ACCESS_KEY, $REFRESH_KEY, self::ACCESS_EXP, self::REFRESH_EXP);
    } else {
      // both tokens are expired
      return [false, $access_token];
    }

    // refresh cookie
    setcookie("jwt", $refresh_token, time() + self::REFRESH_EXP, "/", "", true, true);

    // refresh payload
    $refresh_payload["exp"] = time() + self::REFRESH_EXP;

    return [$refresh_payload, $access_token];
  }
}
