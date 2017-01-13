<?php
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800)){
	$_SESSION['token'] = array("login_action",time());
	
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		echo '<div id="center_no_height">Algo deu errado:<br/>';
		if(in_array('userinput_notset',$_SESSION['error'], true)){echo '<span class="red">- Não foi possível obter os dados inseridos no formulário;</span><br/>';}
		if(in_array('userinput_empty',$_SESSION['error'], true)){echo '<span class="red">- Um ou mais campos estavam vazios;</span><br/>';}
		if(in_array('notoken',$_SESSION['error'], true)){echo '<span class="red">- Não foi possível autenticar o formulário;</span><br/>';}
		if(in_array('tokentime',$_SESSION['error'], true)){echo '<span class="red">- O tempo de autenticação do formulário expirou;</span><br/>';}
		if(in_array('nomatch_email',$_SESSION['error'], true) OR in_array('false_pass',$_SESSION['error'], true)){echo '<span class="red">- Seus dados não conferem, tente novamente;</span><br/>';}
		echo '</div><br/>';
	}
	if(isset($_SESSION['error'])){
		unset($_SESSION['error']);
	}
?>
	<br/>
	<form action="auth.php" method="POST">
	<input placeholder="Email" type="text" name="email" size="41" required /><br/>
	<input placeholder="Senha" type="password" name="pass" size="41" required /><br/>
	<br/>
	<input type="submit" name="submit" value="Submit"/><br/>
	</form>
<?php
}
?>