<html>
<head>
  <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>My LIFF v2</title>
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
       <input type="text" class="form-control" id="Token" readonly="" placeholder="โปรดกรอกรหัสพนักงาน" name="token_id">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
  
  <script src="https://static.line-scdn.net/liff/edge/versions/2.7.1/sdk.js"></script>
  <script>
    function runApp() {
      liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
        document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
        document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
        document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
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
include 'connectdb.php';


?>
