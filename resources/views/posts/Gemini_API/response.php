<?php

require "vendor/autolode.php";
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$data = json_decode(file_get_contents("php://input"));
$text = $data->text;
$client = new Client ("AIzaSyCJ4YHOKyTbYqsy8pKvhFDNz9yKXo8WRpU")
$respose = $client->geminiPro()->generateContent(
    new TextPart($text),
    );
    
echo $respose->text();
