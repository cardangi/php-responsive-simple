<?php
if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure' == '5' && (time() - $_SESSION['ictrue'] > 1800)){
	if(isset($_SESSION['insertempty'])){
		echo '<div class="centerinsertcontent">
		Preencha todos os campos obrigatórios antes de enviar o formulário.<br/>
		Não se preocupe, os dados preenchidos foram salvos.<br/><br/></div>';
		unset($_SESSION['insertempty']);
	}
	if(isset($_SESSION['connection'])){
		echo '<div class="centerinsertcontent">Não foi possível se conectar com o servidor, tente novamente mais tarde.<br/>
		Caso o erro persista comunique o administrador do site.<br/><br/></div>';
		unset($_SESSION['connection']);
	}
	elseif(isset($_SESSION['insertfail'])){
		echo '<div class="centerinsertcontent">Não foi possível increver os dados no banco de dados, tente novamente mais tarde.<br/>
		Caso o erro persista comunique o administrador do site.<br/><br/></div>';
		unset($_SESSION['insertfail']);
	}
	elseif(isset($_SESSION['insertsucess'])){
		echo '<div class="centerinsertcontent">Dados inscritos no banco de dados com sucesso.<br/></div>';
		unset($_SESSION['insertsucess']);
	}
	elseif(isset($_SESSION['notset'])){
		echo '<div class="centerinsertcontent">Algo deu errado, tente novamente mais tarde.<br/>
		Caso o erro persista comunique o administrador do site.<br/><br/></div>';
		unset($_SESSION['notset']);
	}
	$_SESSION['icactiontrue'] = time();
?>

	<div class="centerinsertcontent">
		<br/>
		<form action="ic_action.php" method="POST">
			<label id="adminlabel" for="title">Título: <sup>*</sup></label> <input placeholder="Título" type="text" name="title" <?php if(isset($_COOKIE['miatitle'])){ echo 'value="' . $_COOKIE['miatitle'] . '"';}?> size="41" required /><br/>
			<label id="adminlabel" for="subtitle">Sub-título: <sup>*</sup></label> <input placeholder="Sub-título" type="text" name="subtitle" <?php if(isset($_COOKIE['miasubtitle'])){ echo 'value="' . $_COOKIE['miasubtitle'] . '"';}?> size="41" required /><br/>
			<label id="adminlabel" for="description">Descrição: <sup>*</sup></label> <input placeholder="Descrição" type="text" name="description" <?php if(isset($_COOKIE['miadescription'])){ echo 'value="' . $_COOKIE['miadescription'] . '"';}?> size="41" required /><br/>
			<label id="adminlabel" for="text">Texto: <sup>*</sup></label> <textarea placeholder="Conteúdo" name="content" cols="31" rows="5" required ><?php if(isset($_COOKIE['miacontent'])){ echo '' . $_COOKIE['miacontent'] . '';}?></textarea><br/>
			<br/>
			<span class="red">
				Campos marcados com * são obrigatórios.<br/>
				Todos os campos permitem no máximo 30 caractéres, com exceção da area de texto.<br/>
			</span>
			<br/>
			<input type="submit" name="submit" value="Submit"/><br/>
		</form><br/>
		<br/>

	</div>

<?php 
}
$_SESSION['placegoto'] = 'index.php?paneladmin&ic';
?>