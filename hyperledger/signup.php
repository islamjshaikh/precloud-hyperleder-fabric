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
    <p class="sign" align="center">Sign Up</p>
	<?php
	if(isset($_GET['msg']))
	{
      if($_GET['msg']=='3')
        echo "<p align='center'>Already registered.</p>";
      else
		   echo "<p align='center'> Unable to register, Please try later</p>";		
	}
	?>
    <form class="form" method="POST" action="signupApi.php">
      <input class="un" type="text" align="center" name="name" placeholder="Name" required="true">
      <input class="un" type="text" align="center" name="email" placeholder="Email"  required="true">
      <input class="pass" type="password" align="center"  name="password"  placeholder="Password"  required="true">
      <button class="submit" align="center">Sign Up</button>
</form>
      <p class="forgot" align="center"><a href="index.php">Already have account?</p>        
    </div>
     
</body>

</html>


