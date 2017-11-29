<?php
require_once('./vendor/autoload.php');
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token = 'H01UznWoQ0ZQcnniY4SBGn+P9vXMido6CFJM8EJsYoj42OUe9Ge52sXfOqX0kk4n3/gR+kQw7LgU63yaDvfe/9ZXErHJu+X4dWUld2Mz8vRl9Fu+Ddf2kthYB9hMhCkO+Nct3yXXbeLCt+HY69Zg/wdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'ecb5892b7c1b8d11cee410475af0a310';
//Get message from Line API
$content = file_get_contents('php://input'); $events=json_decode($content, true);
if (!is_null($events['events'])) { //Loop through each event
foreach($events['events']as $event){
//Line API send a lot of event type, we interested in message only. if ($event['type'] == 'message') {
//Get replyToken
$replyToken = $event['replyToken'];
switch($event['message']['type']) {
case 'image':
$messageID = $event['message']['id']; $respMessage='Hello, your image ID is '.$messageID;
break; default:
$respMessage='Please send image only'; break;
}
$httpClient = new CurlHTTPClient($channel_token);
$bot=newLINEBot($httpClient, array('channelSecret'=> $channel_secret));
$textMessageBuilder=newTextMessageBuilder($respMessage);
$response=$bot->replyMessage($replyToken, $textMessageBuilder);
}
} }
echo "OK";
