<?php
require_once('./vendor/autoload.php');
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token = '1v2OUa9tuMIiDhEg57ANbsRaBDbBGP9nlCC+Dpvt5HrsQ+LqcrImWPUBkH8re/pwqxv56d15kZeMoU/vQ0zuzPFlbhFM7AhRMZwLr SkLdcjbFurwXGOyHLt8MdgzLfAe7r0BsQV5cATlUanW3OgJewdB04t89/1O/w1cDnyilFU=';
$channel_secret = '9b2c7349ea939ef723a3cb453d774c86';
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
