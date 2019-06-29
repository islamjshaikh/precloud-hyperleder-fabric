<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>HyperLedger POC</title>
</head>
<body>
 <div class="main2">
<?php
include('config.php');
if(isset($_POST) && count($_POST))
{

	function callAPI($method, $url, $data)
        {
	   $curl = curl_init();

	   switch ($method){
	      case "POST":
		 curl_setopt($curl, CURLOPT_POST, 1);
		 if ($data)
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		 break;
	      case "PUT":
		 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		 if ($data)
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		 break;
	      default:
		 if ($data)
		    $url = sprintf("%s?%s", $url, http_build_query($data));
	   }

	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url);
	   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	      'Content-Type: application/json',
	   ));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	   // EXECUTE:
	   $result = curl_exec($curl);
	   if(!$result){die("Connection Failure");}
	   curl_close($curl);
	   $resultDecode = json_decode($result);
	   	//echo "<pre>";
		//print_r($result);
		//exit;
		if(!isset($resultDecode->error))
		{
			echo "<p align='center'> Hello ".$resultDecode->name.'</p>';
			echo "<p align='center'>Thank You for Registration</p>";
			echo "<p align='center'>Blockchain response:<br>".$result." </p>";
			echo '<br><br><p class="forgot" align="center"><a href="index.php">Login Link</p>';
			
		}
		else
		{
			$msg = 3;
			header("Location: signup.php?msg=".$msg);
			exit;

		}
		
	}

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$created_on = date('Y-m-d H:i:s');
	$res = mysqli_query($config_dbconn, "SELECT pk_user_id FROM hf_users WHERE email='$email'");
	if(!mysqli_num_rows($res))
	{
	$query = mysqli_query($config_dbconn,"INSERT INTO hf_users(name,email,password,created_on) values ('$name','$email','$password','$created_on')");

	if(mysqli_affected_rows($config_dbconn))
	{
		$pk_user_id = mysqli_insert_id($config_dbconn);

		$endpoint = "User";

		$url = $hyperledger_base_url.$endpoint;

		$arr['$class'] = $config_namespace.'.'.$endpoint;

		$arr['pk_user_id'] = $pk_user_id;
		$arr['name'] = $name;
		$arr['email'] = $email;
		$arr['password'] = $password;
		$arr['created_on'] = $created_on;
		$arr['last_login'] = $created_on;
		$request_data = json_encode($arr);
	
		$make_call = callAPI('POST', $url, $request_data);
		$response = json_decode($make_call, true);
	}
	else
	{
		$msg = 0;
		header("Location: signup.php?msg=".$msg);
		exit;

	}
     }
	else
	{
			$msg = 3;
			header("Location: signup.php?msg=".$msg);
			exit;
	}
   }
else
{
	$msg = 2;
	header("Location: signup.php?msg=".$msg);
	exit;

}
?>
    </div>
</body>
</html>




