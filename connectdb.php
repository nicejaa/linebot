<?php
$con = new mysqli("us-cdbr-east-03.cleardb.com","b53b313730e59d","0ba0f852","heroku_83338a4509757d6");
if($con->connect_error){
    die("connect Fail :".$con->connect_error);
}
  $con->query("SET NAMES UTF8");
 ?>
