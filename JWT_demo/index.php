<?php
require "token.php";

const KEY = "da key";

$payload = [
  "sid" => "410410026",
  "pw" => "bruh"
];

$token = Token::sign($payload, KEY);

echo $token . "<br>";

print_r(Token::verify($token, KEY))
?>
