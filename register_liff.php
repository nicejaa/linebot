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
  <title>LIFF REGISTER</title>
  <style>
    #pictureUrl { display: block; margin: 0 auto }
  </style>
</head>
<body>
  <h3>ยืนยันสมาชิก</h3>
<div class="container">
  <form action="#" method="post">
    <div class="form-group">
      <label for="emp_id">รหัสพนักงาน:</label>
      <input type="text" class="form-control" id="emp_id" placeholder="โปรดกรอกรหัสพนักงาน" name="emp_id">
    </div>
       <input type="hidden" class="form-control" id="Token" readonly="" placeholder="โปรดกรอกรหัสพนักงาน" name="Token">
    <button type="submit" name="btn-submit" class="btn btn-primary">Submit</button>
  </form>
</div>
  
  <script src="https://static.line-scdn.net/liff/edge/versions/2.7.1/sdk.js"></script>
  <script>
    function runApp() {
      liff.getProfile().then(profile => {
         document.getElementById("Token").value = liff.getAccessToken();
      }).catch(err => console.error(err));
    }
    liff.init({ liffId: "1655742895-1gkV7XQB" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));
  </script>
</body>
</html>
<?php 
if(isset($_POST['btn-submit'])){
include 'connectdb.php';
$emp_id = $_POST['emp_id'];
$token_id = $_POST['Token'];

 $sql = "UPDATE user SET User_Token='".$token_id."' WHERE User_id='".$emp_id."'";

if ($con->query($sql) === TRUE) {
  echo '<script type="text/javascript">';
  echo '  $(document).ready(function() {
swal({ 
  icon: "success",
  title: "ยืนยันสำเร็จ",
   text: "ดำเนินการสำเร็จ",
  }).then(function() {
    // Redirect the user
   liff.closeWindow();
    })});</script>';
    liff.closeWindow();
} else {
   echo '<script type="text/javascript">';
  echo '  $(document).ready(function() {
swal({ 
  icon: "error",
  title: "ดำเนินการไม่สำเร็จ",
   text: "โปรดตรวจสอบรหัสผ่านให้ถูกต้อง",
  }).then(function() {
    // Redirect the user
   liff.closeWindow();
    })});</script>';
  echo "Error updating record: " . $con->error;
}

$con->close();
  
}
?>
