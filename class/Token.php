<?php
require_once "Dotenv.php";
require_once "DB.php";

class Token {
  const REFRESH_EXP = 60 * 60 * 24;

  public static function auth($payload) {
    $ACCESS_KEY = Dotenv::load("ACCESS_KEY");

    // hash password
    $hashed_pw = hash('SHA256', $payload["pw"]);
    $payload["pw"] = $hashed_pw;

    $access_token = self::sign($payload, $ACCESS_KEY);
    setcookie("jwt", $access_token, time() + self::REFRESH_EXP, "/", "", true, true);
  }

  private static function sign($payload, $key) {
    // header
    $header = ["alg" => "HS256", "type" => "JWT"];
    $header_encoded = base64_encode((json_encode($header)));

    // fetch user permission
    $user = DB::fetch_row("usr_acc", "acc", $payload["acc"]);
    $perm = $user ? $user["perm"] : false;

    // payload
    $payload_meta = [
        "iat" => time(),
        "exp" => time() + self::REFRESH_EXP,
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

    $user = DB::fetch_row("usr_acc", "acc", $payload["acc"]);

    if (!$user) {
      // user does not exist
      return false;
    } else if ($user["pw"] !== $payload["pw"]) {
      // wrong password
      return false;
    }

    // refresh cookie
    setcookie("jwt", $token, time() + self::REFRESH_EXP);

    return $payload;
  }
}


