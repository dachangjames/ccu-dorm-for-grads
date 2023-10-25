<?php
require_once "Dotenv.php";
require_once "DB.php";

class Token {
  /**
   * Token will be expired after 1 day
   */
  const REFRESH_EXP = 60 * 60 * 24;

  /**
   * ### Authorize the user
   * Sign a token to the user from the payload.
   * 
   * @param array $payload
   * Contains user account and password.
   * 
   * @return void
   */
  public static function auth($payload) {
    $ACCESS_KEY = Dotenv::load("ACCESS_KEY");

    // hash password
    $hashed_pw = hash('SHA256', $payload["pw"]);
    $payload["pw"] = $hashed_pw;

    $access_token = self::sign($payload, $ACCESS_KEY);
    if (!$access_token) {
      // wrong account or password
      return;
    }
    setcookie("jwt", $access_token, time() + self::REFRESH_EXP, "/", "", true, true);
  }

  /**
   * ### Sign JWT token
   * 
   * @param array $payload
   * Contains user account and password.
   * 
   * @param string $key
   * Access key for encoding.
   * 
   * @return string
   * Returns the signed JWT token.
   */
  private static function sign($payload, $key) {
    // header
    $header = ["alg" => "HS256", "type" => "JWT"];
    $header_encoded = base64_encode((json_encode($header)));

    // fetch user permission
    $user = DB::fetch_row("usr_acc", "acc", $payload["acc"]);
    
    // check if user exists
    if (!$user) {
      // empty token
      return false;
    } else if ($user["pw"] !== $payload["pw"]) {
      // wrong password
      return false;
    } else {
      $perm = $user["perm"];
    }

    // payload
    $payload_meta = [
        "iat" => time(),
        "perm" => $perm
      ];
    $cat_payload = $payload + $payload_meta;
    $payload_encoded = base64_encode(json_encode($cat_payload));

    //signature
    $signature = hash_hmac("SHA256", $header_encoded . $payload_encoded, $key);
    $signature_encoded = base64_encode($signature);

    // return the token
    return $header_encoded . "." . $payload_encoded . "." . $signature_encoded;
  }

  /**
   * ### Verify JWT token
   * Check if the user has a valid JWT token.
   * 
   * @param string $token
   * The JWT token stored in the user's cookie.
   * 
   * @return array|false
   * Returns the payload if the token is valid, if not, return false.
   */
  public static function verify($token) {
    $ACCESS_KEY = Dotenv::load("ACCESS_KEY");

    // seperate string
    $token_parts = explode(".", $token);

    // hmac stuff
    $signature = base64_encode(hash_hmac("SHA256", $token_parts[0] . $token_parts[1], $ACCESS_KEY));

    // verify signature
    if ($signature != $token_parts[2]) {
      // Invalid token
      return false;
    }
    
    // decode payload
    $payload = json_decode(base64_decode($token_parts[1]), true);

    if (isset($_SESSION["account"]) && $payload["pw"] !== $_SESSION["account"]) {
      return false;
    }
    
    // refresh cookie
    setcookie("jwt", $token, time() + self::REFRESH_EXP);

    return $payload;
  }
}


