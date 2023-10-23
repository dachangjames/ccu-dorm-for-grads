<?php
require "Dotenv.php";

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
    $access_token = self::sign($payload, $ACCESS_KEY);

    // create the cookie for auth checks
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

    // payload
    $payload_meta = [
        "perm" => "adm"
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
      return false;
    }

    // decode payload
    $payload = json_decode(base64_decode($token_parts[1]), true);

    // refresh cookie
    setcookie("jwt", $token, time() + self::REFRESH_EXP);

    return $payload;
  }
}


