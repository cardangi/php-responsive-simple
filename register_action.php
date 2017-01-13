<?php
session_start();
$_SESSION['error'] = array();
if(!isset($_SESSION['token'])){
	$_SESSION['error'][] = 'notoken';
}
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] > 1800)){
	$_SESSION['error'][] = 'tokentime';
}
if(!isset($_POST['name']) && !isset($_POST['email']) && !isset($_POST['password']) && !isset($_POST['password2'])){
	$_SESSION['error'][] = 'userinput_notset';
}
if(empty($_POST['name']) && empty($_POST['email']) && empty($_POST['password'])&& empty($_POST['password2'])){
	$_SESSION['error'][] = 'userinput_empty';
}
if($_POST['password'] != $_POST['password2']){
	$_SESSION['error'][] = 'nomatch_password';
}
if(isset($_SESSION['error'])
	&& in_array('notoken',$_SESSION['error'], true) 
	OR in_array('tokentime',$_SESSION['error'], true) 
	OR in_array('userinput_notset',$_SESSION['error'], true) 
	OR in_array('userinput_empty',$_SESSION['error'], true))
	OR in_array('nomatch_password',$_SESSION['error'], true))
	{header('Location: index.php?register');}

if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
	require('connection.php');
	unset($_SESSION['token']);
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if(preg_match("(@)",$email)){
		$emailvalid = 'false';
	}else{
		$_SESSION['error'][] = 'invalid_email';
	}
	
	require('connection.php');
	$sql = "SELECT email FROM users WHERE email = '".$email."' ";
	$sqlquery = mysqli_query($conn2,$sql);
	if(mysqli_num_rows($sqlquery) > 0){
		$_SESSION['error'][] = 'inuse_email';
	}
	
	$passpw = $password;
	$saltpw = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
	$saltpw = base64_encode($saltpw);
	$saltpw = str_replace('+', '.', $saltpw);
	$pass_cryptpw = crypt($passpw, '$2y$11$'.$saltpw.'$');
	
	if($emailvalid == 'false' && in_array('inuse_email',$_SESSION['error'], false)){
		$insert = "INSERT INTO users (name, email, password, access) VALUES ('".$name."','".$email."','".$pass_cryptpw."','0')";
		if(!mysqli_query($conn2,$insert)){
			$_SESSION['error'][] = 'connection';
		}
	}
	require('connectionclose.php');
	header('Location: index.php?login');
}
?>