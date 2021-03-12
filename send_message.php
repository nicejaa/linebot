<?php
require "vendor/autoload.php";
$access_token = 'gMEkhBcxQF0jT72jVrQZfZ8N3hU3gKmS1F3rjRZmeUuVn5ccNfh4AJQxzQ0L1nFJyOSLgc1vBCxX/Sk7r8cAJtEts0vTaK9Z7MA8Xff4Kgx1JoEj+KtyR+kn1j80SZFMus8th1QNI4vMSKHI5vRGbwdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'aa92cfff7cdb8b56bdb472b9102bba32';
$idPush = 'U306d5bcfb4110b6ca721033437ad55a7';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

?>
