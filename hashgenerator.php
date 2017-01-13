<!-- HASH GENERATOR V1 -->
<?php
if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure' == '5' && (time() - $_SESSION['hashtrue'] > 1800)){
	if(isset($_POST['nohash'])){
		$userinput = $_POST['nohash'];
		$pass = urlencode($userinput);
		$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
		$salt = base64_encode($salt);
		$salt = str_replace('+', '.', $salt);
		$pass_crypt = crypt($pass, '$2y$11$'.$salt.'$');

		if($pass_crypt == crypt($pass, $pass_crypt) === $pass_crypt){
			$_SESSION['hashvalue'] = $pass_crypt;
		}
		else{
			$_SESSION['nohash'] = 'nohash';
		}
	}
	elseif(isset($_SESSION['hashvalue'])){
		echo '<br/>Hash criada: ';
		echo $_SESSION['hashvalue'];
		unset($_SESSION['hashvalue']);
	}
	else{
		if(isset($_SESSION['nohash'])){
			echo '<br/>Algo deu errado ao criar sua hash, tente novamente.';
			unset($_SESSION['nohash']);
		}
	}
?>
		<br/>
		<form action="index.php?paneladmin&hash" method="POST">
		<input placeholder="Digite a senha ou nome de usuário" type="text" name="nohash" size="41" />
		<input type="submit" value="Enviar" />
		</form>
<?php
}
?>