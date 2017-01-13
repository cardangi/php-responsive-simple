<?php
if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure'] == '5' && isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800)){
	if(isset($_GET['ic'])){
		$_SESSION['ictrue'] = time();
		require('ic.php');
		unset($_SESSION['ictrue']);
	}
	elseif(isset($_GET['ed'])){
		$_SESSION['edtrue'] = time();
		require('ed.php');
		unset($_SESSION['edtrue']);
	}
	elseif(isset($_GET['hash'])){
		$_SESSION['hashtrue'] = time();
		require('hashgenerator.php');
		unset($_SESSION['hashtrue']);
	}
	else{
		echo "<div id='left'>
		<br/>
		<a href='index.php?paneladmin&ic'>Criar novo artigo</a><br/>
		<a href='index.php?paneladmin&ed'>Editar artigo existente</a><br/>
		<a href='index.php?paneladmin&hash'>Criar hash</a><br/>
		<a href='index.php?paneladmin&decrypthash'>Decriptografar um Hash</a></br> // Função de hashdecrypt
		<a href='logoff.php'>Logoff</a><br/>
		</div>";
	}
}
else{
	if(isset($_SESSION['nologin'])){
		echo '<br/><div class="red" id="center_no_height">Informações de login não conferem.<br/><br/></div>';
		unset($_SESSION['nologin']);
	}
	if(isset($_SESSION['retrytime'])){
		$tempcalc = 4200 - $_SESSION['retrytime'];
		$tempo = date("i",$tempcalc);
		
		echo '<br/><div class="red" id="center_no_height">Você errou suas informações de login três vezes, você pode tentar se conectar novamente em '.$tempo.' minutos <br/><br/></div>';
		unset($_SESSION['retrytime']);
	}
	$_SESSION['login'] = time();
	require('login.php');
	unset($_SESSION['login']);
}
$_SESSION['placegoto'] = 'index.php?paneladmin';
?>
