<?php
class Token {
  const EXP = 30;

  static function sign($payload, $key) {
    // header
    $header = ["alg" => "HS256", "type" => "JWT"];
    $header_encoded = base64_encode((json_encode($header)));

    // payload
    $payload_meta = [
        "iat" => $_SERVER["REQUEST_TIME"],
        "exp" => $_SERVER["REQUEST_TIME"] + self::EXP
      ];
    $cat_payload = $payload + $payload_meta;
    $payload_encoded = base64_encode(json_encode($cat_payload));

    //signature
    $signature = hash_hmac("SHA256", $header_encoded . $payload_encoded, $key);
    $signature_encoded = base64_encode($signature);

    // return the token
    return $header_encoded . "." . $payload_encoded . "." . $signature_encoded;
  }

  static function verify($token, $key) {
    // seperate string
    $token_parts = explode(".", $token);

    // hmac stuff
    $signature = base64_encode(hash_hmac("SHA256", $token_parts[0] . $token_parts[1], $key));

    // verify signature
    if ($signature != $token_parts[2]) {
      echo "Invalid Token";
      return false;
    }

    // decode payload
    $payload = json_decode(base64_decode($token_parts[1]), true);

    // check expired
    if ($payload["exp"] < time()) {
      echo "Token Expired";
      return false;
    }

    return $payload;
  }
}


