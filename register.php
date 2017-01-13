<?php
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800)){
	$_SESSION['token'] = time();
	
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		echo '<div id="center_no_height">Algo deu errado:<br/>';
		if(in_array('userinput_notset',$_SESSION['error'], true)){echo '<span class="red">- Não foi possível obter os dados inseridos no formulário;</span><br/>';}
		if(in_array('userinput_empty',$_SESSION['error'], true)){echo '<span class="red">- Um ou mais campos estavam vazios;</span><br/>';}
		if(in_array('notoken',$_SESSION['error'], true)){echo '<span class="red">- Não foi possível autenticar o formulário;</span><br/>';}
		if(in_array('tokentime',$_SESSION['error'], true)){echo '<span class="red">- O tempo de autenticação do formulário expirou;</span><br/>';}
		if(in_array('invalid_email',$_SESSION['error'], true)){echo '<span class="red">- Email inválido, sem um email válido não será possível recuperar sua senha caso necessário;</span><br/>';}
		if(in_array('inuse_email',$_SESSION['error'], true)){echo '<span class="red">- Este email já foi utilizado por outro usuário;</span><br/>';}
		if(in_array('connection',$_SESSION['error'], true)){echo '<span class="red">- Falha de conexão com o banco de dados;</span><br/>';}
		if(in_array('nomatch_password',$_SESSION['error'], true)){echo '<span class="red">- As senhas não conferem;</span><br/>';}
		echo '</div><br/>';
	}
	if(isset($_SESSION['error'])){
		unset($_SESSION['error']);
	}
?>
	<br/>
	<div id="center">
	<form action="register_action.php" method="POST">
	<input placeholder="Nome" type="text" name="name" size="41" required /><br/>
	<input placeholder="Email" type="email" name="email" size="41" required /><br/>
	<input placeholder="Senha" type="password" name="password" size="41" required /><br/>
	<input placeholder="Senha" type="password" name="password2" size="41" required /><br/>
	<br/>
	<input type="submit" name="submit" value="Enviar"/><br/>
	</form>
	</div>
<?php
}
?>