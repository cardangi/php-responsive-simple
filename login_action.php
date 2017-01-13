<?php
session_start();
$_SESSION['error'] = array();
if(!isset($_SESSION['token'])){
	$_SESSION['error'][] = 'notoken';
}
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] > 1800)){
	$_SESSION['error'][] = 'tokentime';
}
if(!isset($_POST['email']) && !isset($_POST['pass'])){
	$_SESSION['error'][] = 'userinput_notset';
}
if(empty($_POST['email']) && empty($_POST['pass'])){
	$_SESSION['error'][] = 'userinput_empty';
}
if(isset($_SESSION['error']) 
	&& in_array('notoken',$_SESSION['error'], true) 
	OR in_array('tokentime',$_SESSION['error'], true) 
	OR in_array('userinput_notset',$_SESSION['error'], true) 
	OR in_array('userinput_empty',$_SESSION['error'], true))
	{header('Location: index.php?login');}


if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800)){
	unset($_SESSION['token']);
	$_SESSION['error'] = array();
	if(isset($_POST['email']) && isset($_POST['pass'])){
		if(!empty($_POST['email']) && !empty($_POST['pass'])){
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			
			$sql = "SELECT password FROM users WHERE email = '".$email."' ";
			$sqlquery = mysqli_query($conn2,$sql);
			if(mysqli_num_rows($sqlquery) > 0){
				$password = mysqli_fetch_assoc($sqlquery);
			}else{
				$_SESSION['error'][] = 'nomatch_email';
			}
			
			if(crypt($pass, $password['password']) === $password['password']){
				$pass_cryptpw = crypt($pass, $password['password']);
			
				$sql = "SELECT id,acess FROM users WHERE email = '".$email."' AND password = '".$pass_cryptpw."' ";
				$sqlquery = mysqli_query($conn2,$sql);
				$results = mysqli_fetch_assoc($sqlquery);
				$_SESSION['secure'] = array($results['id'],$results['acess'],time());
			}else{
				$_SESSION['error'][] = 'false_pass';
			}
			header('Location: index.php?login');
		}
		
	}
}
?>