<?php 
include 'connectdb.php';
$sql = "select * from user";
$query = mysqli_query($con,$sql);
?>
<html>
<head>
  <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <title>Send MESSAGE TOKEN</title>
  <style>
    #pictureUrl { display: block; margin: 0 auto }
  </style>
</head>
<body>
<div class="container">
  <br>
  <hr>
  <form action="#" method="post">
       <div class="form-group">
      <label for="emp_id">ข้อความ:</label>
      <input type="text" class="form-control" id="txt_id" placeholder="พิมพ์ข้อความ" name="txt_id">
    </div>
    <div class="form-group">
      <label for="emp_id">User ID:</label>
      <input type="text" class="form-control" id="token_id" placeholder="โปรดกรอกรหัส UserID" name="token_id">
    </div>
    <button type="submit" name="btn-submit" class="btn btn-primary">Submit</button>
  </form>
 
 <table class="table table-striped">
    <thead>
      <tr>
        <th>รหัสพนักงาน</th>
        <th>ชื่อ-สกุล</th>
        <th>Token</th>
      </tr>
    </thead>
    <?php
  if (mysqli_num_rows($query) > 0) {
    while($row = mysqli_fetch_assoc($query)) {
  ?>
    <tbody>
      <tr>
        <td><?=$row['User_id'];?></td>
        <td><?=$row['User_name'];?></td>
        <td><?=$row['User_token'];?></td>
      </tr>
    </tbody>
   <?php } } ?>
  </table>
  
</div>
</body>
</html>

<?php

   $accessToken = "gMEkhBcxQF0jT72jVrQZfZ8N3hU3gKmS1F3rjRZmeUuVn5ccNfh4AJQxzQ0L1nFJyOSLgc1vBCxX/Sk7r8cAJtEts0vTaK9Z7MA8Xff4Kgx1JoEj+KtyR+kn1j80SZFMus8th1QNI4vMSKHI5vRGbwdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   //รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];
   //รับ id ของผู้ใช้
   $id = $_POST['token_id'];
   $txt = $_POST['txt_id'];
      
   #ตัวอย่าง Message Type "Text + Sticker"
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = $txt;
//       $arrayPostData['messages'][1]['type'] = "sticker";
//       $arrayPostData['messages'][1]['packageId'] = "2";
//       $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
      
      
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
   
?>
