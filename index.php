<!DOCTYPE html>
<?php
require('connection.php');
if(session_status() == PHP_SESSION_NONE){session_start();}
?>
<html>
<head>
<title>
<?php
	if(isset($_GET['cid'])){
		$cid = $_GET['cid'];
		$sql = ("SELECT * FROM articles WHERE id = " . $cid . "");
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			$content = mysqli_fetch_array($result);
			echo "WEBSITENAME - ".$content['title'];
		}else{echo "WEBSITENAME";}
	}else{echo "WEBSITENAME";}
?>
</title>
	<!-- META TAGS -->
	<meta name="description" content="">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<!-- STYLESHEET -->
	<link rel="stylesheet" href="main.css">
</head>
	<!-- SPACE LINE -->
	<!-- <BODY> -->
<body>
	<div id="all">
		<div id="layer_darktop">
				<div id="layer0">
				<nav id="menutop"><a href="index.php">INICIO</a></nav>
				<?php
				if(isset($_SESSION['secure']) && isset($_SESSION['secureid']) && $_SESSION['secure'] == '5'){
					echo '<nav id="menutop"><a href="index.php?paneladmin">Painel do administrador</a></nav>';
				}
				elseif(isset($_SESSION['secure']) && isset($_SESSION['secureid'])){
					echo '<nav id="menutop"><a href="logoff.php">Logoff</a></nav>';
				}
				else{
					echo '<nav id="menutop"><a href="index.php?login">Login</a></nav>';
					echo '<nav id="menutop"><a href="index.php?register">Registrar</a></nav>';
				}
				?>
				</div>
		</div>
		<div id="layer_dark">
			<div id="layer0">
				<div id="layer1">
					<h1>texto1</h1>
					<nav id="menu"><a href="">texto2</a></nav>
					<nav id="menu"><a href="">texto2</a></nav>
					<nav id="menu"><a href="">texto2</a></nav>
					<nav id="menu"><a href="">texto2</a></nav>
					<nav id="menu"><a href="">texto2</a></nav>
					<nav id="menu"><a href="">texto2</a></nav>
				</div>
			</div>
		</div>
				<div id="layer3">
					<?php
						if(isset($_GET['cid'])){
							if($_GET['cid'] != NULL){
								$_SESSION['token'] = array('cid',time());
								require('contentfull.php');
								if(in_array("cid",$_SESSION['token'], true)){unset($_SESSION['token']);}
							}else{echo "<div id='center'> Oops! Essa página não existe! Existe? </div>";}
						}
						elseif(isset($_GET['paneladmin'])){
							echo "<div id='center'>";
							$_SESSION['token'] = array('paneladmin',time());
							require('paneladmin.php');
							if(in_array("paneladmin",$_SESSION['token'], true)){unset($_SESSION['token']);}
							echo "</div>";
						}
						elseif(isset($_GET['login'])){
							echo "<div id='center'>";
							$_SESSION['token'] = array('login',time());
							require('login.php');
							if(in_array("login",$_SESSION['token'], true)){unset($_SESSION['token']);}
							echo "</div>";
						}
						elseif(isset($_GET['register'])){
							echo "<div id='center'>";
							$_SESSION['token'] = array('register',time());
							require('register.php');
							if(in_array("register",$_SESSION['token'], true)){unset($_SESSION['token']);}
							echo "</div>";
						}
						else{
							echo "<div id='left'>";
							$_SESSION['token'] = array('content',time());
							require('content.php');
							if(in_array("content",$_SESSION['token'], true)){unset($_SESSION['token']);}
							echo "</div>";
						}
					?>
				</div>
		<div id="layer_darkbottom">
			<div id="layer0">
				<footer id="layer5_1">
					<h3>title</h3>
					<nav id="menufooter"><a href="">texto2</a></nav>
				</footer>
				<footer id="layer5_1">
					<h3>title</h3>
					<nav id="menufooter"><a href="">texto2</a></nav>
				</footer>
				<footer id="layer5_1">
					<h3>title</h3>
					<nav id="menufooter"><a href="">texto2</a></nav>
				</footer>
				<footer id="layer5_1">
					<h3>title</h3>
					<nav id="menufooter"><a href="">texto2</a></nav>
				</footer>
				<footer id="layer5_1">
					<h3>title</h3>
					<nav id="menufooter"><a href="">texto2</a></nav>
				</footer>
				<footer id="layer5_1">
					<h3>title</h3>
					<nav id="menufooter"><a href="">texto2</a></nav>
				</footer>
			</div>
		</div>
	</div>
</body>
</html>
<?php require('connectionclose.php'); ?>