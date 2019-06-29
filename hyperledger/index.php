<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>HyperLedger POC</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center">Sign in</p>
<?php
if(isset($_GET['msg']))
{
	echo "<p align='center'>Incorrect email or password</p>";		
}
?>
    <form class="form" method="POST" action="loginApi.php">
      <input class="un" type="text" align="center" name="email" placeholder="Email"  required="true">
      <input class="pass" type="password" align="center"  name="password"  placeholder="Password"  required="true">
      <button class="submit" align="center">Sign in</button>
</form>
      <p class="forgot" align="center"><a href="signup.php">Don't have Account?</p>        
    </div>
     
</body>

</html>


