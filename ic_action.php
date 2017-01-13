<?php
session_start();
$_SESSION['error'] = array();
if(!isset($_SESSION['token'])){
	$_SESSION['error'][] = 'notoken';
}
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] > 1800)){
	$_SESSION['error'][] = 'tokentime';
}
if(!isset($_POST['title']) && !isset($_POST['subtitle']) && !isset($_POST['description']) && !isset($_POST['content'])){
	$_SESSION['error'][] = 'userinput_notset';
}
if(empty($_POST['title']) && empty($_POST['subtitle']) && empty($_POST['description']) && empty($_POST['content'])){
	$_SESSION['error'][] = 'userinput_empty';
}
if(isset($_SESSION['error']) 
	&& in_array('notoken',$_SESSION['error'], true) 
	OR in_array('tokentime',$_SESSION['error'], true) 
	OR in_array('userinput_notset',$_SESSION['error'], true) 
	OR in_array('userinput_empty',$_SESSION['error'], true))
	{header('Location: index.php?ic');}

if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure'][1] == '5' && (time() - $_SESSION['token'] > 1800)){
	unset($_SESSION['token']);
	if(isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['description']) && isset($_POST['content'])){
		if(!empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_POST['description']) && !empty($_POST['content'])){
			if($conn === false){
				$_SESSION['miatitle'] = $_POST['title'];
				$_SESSION['miasubtitle'] = $_POST['subtitle'];
				$_SESSION['miadescription'] = $_POST['description'];
				$_SESSION['miacontent'] = $_POST['content'];
				$_SESSION['error'][] = 'connection';
			}
			require('connection.php');
			$insert_sql = "INSERT INTO articles (title,subtitle,description,content) VALUES ('".$_POST['title']."','".$_POST['subtitle']."','".$_POST['description']."','".$_POST['content']."')";
			if(mysqli_query($conn,$insert_sql)){
				unset($_SESSION['miatitle']);
				unset($_SESSION['miasubtitle']);
				unset($_SESSION['miadescription']);
				unset($_SESSION['miacontent']);
				$_SESSION['error'][] = 'noerror';
			}
			else{
				$_SESSION['miatitle'] = $_POST['title'];
				$_SESSION['miasubtitle'] = $_POST['subtitle'];
				$_SESSION['miadescription'] = $_POST['description'];
				$_SESSION['miacontent'] = $_POST['content'];
				$_SESSION['error'][] = 'connection';
			}
		}
		else{
			$_SESSION['miatitle'] = $_POST['title'];
			$_SESSION['miasubtitle'] = $_POST['subtitle'];
			$_SESSION['miadescription'] = $_POST['description'];
			$_SESSION['miacontent'] = $_POST['content'];
		}
	}
	header('Location: index.php?ic');
}
?>