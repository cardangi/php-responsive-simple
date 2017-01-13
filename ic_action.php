<?php

session_start();
require('connection.php');
if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure' == '5' && (time() - $_SESSION['icactiontrue'] > 1800)){
	unset($_SESSION['icactiontrue']);
	if(isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['description']) && isset($_POST['content'])){
		if(!empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_POST['description']) && !empty($_POST['content'])){
			if($conn === false){
				$_SESSION['miatitle'] = $_POST['title'];
				$_SESSION['miasubtitle'] = $_POST['subtitle'];
				$_SESSION['miadescription'] = $_POST['description'];
				$_SESSION['miacontent'] = $_POST['content'];
				$_SESSION['connection'] = 'connection';
				header('Location: index.php?ic');
			}
			
			$insert_sql = "INSERT INTO articles (title,subtitle,description,content) VALUES ('".$_POST['title']."','".$_POST['subtitle']."','".$_POST['description']."','".$_POST['content']."')";
			if(mysqli_query($conn,$insert_sql)){
				unset($_SESSION['miatitle']);
				unset($_SESSION['miasubtitle']);
				unset($_SESSION['miadescription']);
				unset($_SESSION['miacontent']);
				$_SESSION['insertsucess'] = 'insertsucess';
				header('Location: index.php?ic');
			}
			else{
				$_SESSION['miatitle'] = $_POST['title'];
				$_SESSION['miasubtitle'] = $_POST['subtitle'];
				$_SESSION['miadescription'] = $_POST['description'];
				$_SESSION['miacontent'] = $_POST['content'];
				$_SESSION['insertfail'] = 'insertfail';
				header('Location: index.php?ic');
			}
		}
		else{
			$_SESSION['miatitle'] = $_POST['title'];
			$_SESSION['miasubtitle'] = $_POST['subtitle'];
			$_SESSION['miadescription'] = $_POST['description'];
			$_SESSION['miacontent'] = $_POST['content'];
			$_SESSION['insertempty'] = 'insertempty';
			header('Location: index.php?ic');
		}
	}else{$_SESSION['insertnotset'] = 'insertnotset'; header('Location: index.php?ic');}
}else{header('Location: index.php?ic');}
?>