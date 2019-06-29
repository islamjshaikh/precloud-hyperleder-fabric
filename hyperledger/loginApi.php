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

		switch ($method)
		{
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
		// 'Authorization: Token 9487c038bb041e00acfa333d1c9abf5c83d088e7',
		'Content-Type: application/json',
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		// EXECUTE:
		$result = curl_exec($curl);
		if(!$result){die("Connection Failure");}
		curl_close($curl);
		$resultDecode = json_decode($result);
		echo "<pre>";
		print_r($result);
		exit;
		if(!isset($resultDecode->error))
		{
			echo "<p align='center'> Hello ".$resultDecode->name.'</p>';
			echo "<p align='center'>You are logged In</p><br>";
			echo "<p align='center'>Blockchain response:<br><br>".$result." </p>";
			echo '<br><br><p class="forgot" align="center"><a href="signup.php">Registration link</p>';
		}
		else
		{
			$msg = 3;
			header("Location: index.php?msg=".$msg);
			exit;

		}

	}
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$res = mysqli_query($config_dbconn, "SELECT * FROM hf_users WHERE email='$email'AND password='$password'");
	$row = mysqli_fetch_array($res);
	if(is_array($row) && count($row))
	{
		$user_id = $row['pk_user_id'];
    	$_SESSION['user_id'] = $row['pk_user_id'];
			
		$endpoint = "User/".$user_id;
		$url = $hyperledger_base_url.$endpoint;

		$request_data = "";
		$make_call = callAPI('GET', $url, $request_data);
		$response = json_decode($make_call, true);
		
	}

	else
	{
		
		$msg = 0;
		header("Location: index.php?msg=".$msg);
		exit;
		

	}
	
   }
    else
	{
		$msg = 2;
		header("Location: index.php?msg=".$msg);
		exit;

	}
?>    
  
    </div>
</body>

</html>


