
<?php
include 'connectdb.php';

$sql = "SELECT * FROM user Where User_Token = ";
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'gMEkhBcxQF0jT72jVrQZfZ8N3hU3gKmS1F3rjRZmeUuVn5ccNfh4AJQxzQ0L1nFJyOSLgc1vBCxX/Sk7r8cAJtEts0vTaK9Z7MA8Xff4Kgx1JoEj+KtyR+kn1j80SZFMus8th1QNI4vMSKHI5vRGbwdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'aa92cfff7cdb8b56bdb472b9102bba32';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $result = '';
        $reply_token = $event['replyToken'];
        $message = $events['events'][0]['message']['text'];
        $text = $event['message']['text'];
        
        if($text == "ฉันคือใคร")
           {
            $result = $event['source']['userId'];  
            
             $data = [
            'replyToken' => $reply_token,
                 'messages' => [['type' => 'text', 'text' => $result ]]
//             'messages' => [['type' => 'text', 'text' => $result]] 
                    ];
        
             $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
             $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
            
           }
           else{
            $result = "ฉันไม่เข้าใจ";   
               
             $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => $result]] 
                    ];
        
             $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
             $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
               
           }
      
  

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
