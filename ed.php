<?php
if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure' == '5' && (time() - $_SESSION['ictrue'] > 1800)){
	echo "<br/>";
	if(isset($_SESSION['notset'])){
		echo '<br/><div id="center_no_height">
		Algo deu errado, tente de novo.<br/><br/></div>';
		unset($_SESSION['notset']);
	}
	elseif(isset($_SESSION['empty'])){
		echo '<br/><div id="center_no_height">
		O campo BUSCAR não pode estar vázio ao fazer a busca.<br/><br/></div>';
		unset($_SESSION['empty']);
	}
	elseif(isset($_SESSION['noconn'])){
		echo '<br/><div id="center_no_height">Não foi possível se conectar com o servidor, tente novamente mais tarde.<br/>
		Caso o erro persista comunique o administrador do site.<br/><br/></div>';
		unset($_SESSION['noconn']);
	}
	elseif(isset($_SESSION['searchsucess']) && isset($_SESSION['ed_numrows'])){
		echo '<br/><div id="center_no_height">Busca realizada com sucesso, veja o resultado abaixo.<br/></div>';
		unset($_SESSION['searchsucess']);
	}
	elseif(isset($_SESSION['deletesucess'])){
		echo '<br/><div id="center_no_height">Dados deletados com sucesso.<br/></div>';
		unset($_SESSION['deletesucess']);
	}
	elseif(isset($_SESSION['deletefail'])){
		echo '<br/><div id="center_no_height">Não foi possível deletar os danos, tente novamente mais tarde.<br/>
		Caso o erro persista comunique o administrador do site.<br/><br/></div>';
		unset($_SESSION['deletefail']);
	}
	elseif(isset($_SESSION['updatesucess'])){
		echo '<br/><div id="center_no_height">Dados atualizados com sucesso.<br/></div>';
		unset($_SESSION['updatesucess']);
	}
	elseif(isset($_SESSION['updatefail'])){
		echo '<br/><div id="center_no_height">Erro ao atulizar os dados, tente novamente mais tarde.<br/>
		Caso o erro persista comunique o administrador do site.<br/><br/></div>';
		unset($_SESSION['updatefail']);
	}
	if(isset($_SESSION['ed_numrows']) && $_SESSION['ed_numrows'] != 0){
		$numrow = 0;
		while($_SESSION['ed_numrows'] > $numrow){
			$numrow++;
			if(isset($_SESSION['ed_title'.$numrow.''])){
				echo "<div id='center'>";
?>
				<div id='ctitle_left'>
				<form id="inline_table" action="index.php?paneladmin&ed&edit=<?php echo $_SESSION['ed_id'.$numrow.'']; ?>" method="post">
					<select name="option">
						<option value="edit" selected>Editar</option>
						<option value="delete">Deletar</option>
					</select> 
					<input id="mini_button" type="submit" value="Ok"/>
				</form>
				
<?php
				echo $_SESSION['ed_title'.$numrow.'']."</div><div id='cdate_left'>".$_SESSION['ed_date'.$numrow.'']."</div>";
			}
		}
		$numrow = 0;
		while($_SESSION['ed_numrows'] > $numrow){
			$numrow++;
			unset($_SESSION['ed_id'.$numrow.'']);
			unset($_SESSION['ed_title'.$numrow.'']);
			unset($_SESSION['ed_subtitle'.$numrow.'']);
			unset($_SESSION['ed_description'.$numrow.'']);
			unset($_SESSION['ed_content'.$numrow.'']);
			unset($_SESSION['ed_date'.$numrow.'']);
			unset($_SESSION['ed_numrows'.$numrow.'']);
		}
	}
	elseif(isset($_GET['searchnoresults'])){
		echo "<br/><div id='centerinsertcontent'>Nada foi encontrado no banco de dados, tente pesquisar outro título.</div><br/>";
	}
	if(isset($_POST['option']) && $_POST['option'] == 'edit' && isset($_GET['edit']) && !empty($_GET['edit']) && isset($_SESSION['search'])){
		$numrow_sql = "SELECT * FROM articles WHERE id = ".$_GET['edit']."";
		if($numrow_query = mysqli_query($conn,$numrow_sql)){
			$_SESSION['ed_numrows'] = $_GET['edit'];
			$numrow_print = mysqli_fetch_assoc($numrow_query);
			$_SESSION['edactiontrue'] = time();
?>
			<div id="center_no_height">
				<br/>
				<form action="ed_action.php?edit_action=<?php echo $numrow_print['id']; ?>" method="POST">
					<label id="adminlabel" for="title">Título: <sup>*</sup></label> <input placeholder="Título do texto" type="text" name="title" value="<?php echo $numrow_print['title']; ?>" size="41" required /><br/>
					<label id="adminlabel" for="subtitle">Sub-título: <sup>*</sup></label> <input placeholder="Sub-título do texto" type="text" name="subtitle" value="<?php echo $numrow_print['subtitle']; ?>" size="41" required /><br/>
					<label id="adminlabel" for="description">Descrição: <sup>*</sup></label> <input placeholder="Descrição do texto" type="text" name="description" value="<?php echo $numrow_print['description']; ?>" size="41" required /><br/>
					<label id="adminlabel" for="text">Texto: <sup>*</sup></label> <textarea placeholder="Conteúdo do texto" name="content" cols="31" rows="5" required ><?php echo $numrow_print['content']; ?></textarea><br/>
					<br/>
					<span class="red">
						Campos marcados com * são obrigatórios.<br/>
						Todos os campos permitem no máximo 30 caractéres, com exceção da area de texto.<br/>
					</span>
					<br/>
					<input type="submit" name="submit" value="Editar"/><br/>
				</form><br/>
				<br/>
			</div>
<?php
		}
	}
	elseif(isset($_POST['option']) && $_POST['option'] == 'delete' && isset($_GET['edit']) && !empty($_GET['edit']) && isset($_SESSION['search'])){
		$numrow_sql = "SELECT * FROM articles WHERE id = ".$_GET['edit']."";
		if($numrow_query = mysqli_query($conn,$numrow_sql)){
			$numrow_print = mysqli_fetch_assoc($numrow_query);
			$_SESSION['edactiontrue'] = time();
?>
			<div id="center_no_height">
				<form action="ed_action.php?del=<?php echo $numrow_print['id']; ?>" method="POST">
					<br/>
					Você está prestes a deletar o conteúdo de título:<br/>
					<br/>
					<b><?php echo $numrow_print['title']; ?></b><br/>
					<br/>
					<span class="red">Tem certeza que deseja continuar?</span>
					<br/>
					<input type="hidden" value="<?php echo $numrow_print['id']; ?>" name="del"/>
					<input type="submit"  name="submit" value="Sim, deletar!"/>
				</form>
			</div>
<?php
		}
	}
$_SESSION['edactiontrue'] = time();
?>

	<div id="center_no_height">
		<br/>
		<form action="ed_action.php" method="POST">
			<input placeholder="Buscar..." type="text" name="search" size="41" required /><br/>
			<br/>
			<span class="red" id="smalltext">
				A busca é feita pelo título do conteúdo.<br/>
			</span>
			<br/>
			<input type="submit" name="submit" value="Buscar..."/><br/>
		</form><br/>
		<br/>
	</div>
<?php 
}
$_SESSION['placegoto'] = 'index.php?paneladmin&ed';
?>