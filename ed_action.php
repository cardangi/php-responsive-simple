<?php
session_start();
require('connection.php');
if(isset($_SESSION['secure']) && !empty($_SESSION['secure']) && $_SESSION['secure'][1] == '5' && (time() - $_SESSION['token'] > 1800)){
	unset($_SESSION['token']);
	$pwhash = '1234';
	$userhash = '1234';
	if(isset($_POST['search']) && !empty($_POST['search'])){
		$searchword = $_POST['search'];
		$findsql = "SELECT * FROM articles WHERE title LIKE '%$searchword%' ORDER BY date DESC";
		if($sqlresult = mysqli_query($conn,$findsql)){
			if(mysqli_num_rows($sqlresult) > 0){
				$numrows = mysqli_num_rows($sqlresult);
				
				$_SESSION['ed_numrows'] = $numrows;
				$_SESSION['search'] = $_POST['search'];
				
				$numrow = 1;					
				while($print = mysqli_fetch_assoc($sqlresult)){
					$_SESSION['ed_id'.$numrow.''] = $print['id'];
					$_SESSION['ed_title'.$numrow.''] = $print['title'];
					$_SESSION['ed_subtitle'.$numrow.''] = $print['subtitle'];
					$_SESSION['ed_description'.$numrow.''] = $print['description'];
					$_SESSION['ed_content'.$numrow.''] = $print['content'];
					$_SESSION['ed_date'.$numrow.''] = $print['date'];
					$numrow++;
				}
			}else{$_SESSION['searchnoresults'] = 'searchnoresults'; header('Location: index.php?paneladmin&ed');}
			$_SESSION['searchsucess'] = 'searchsucess'; header('Location: index.php?paneladmin&ed');
		}else{$_SESSION['noconn'] = 'noconn'; header('Location: index.php?paneladmin&ed');}
	}
	elseif(isset($_GET['edit_action']) && !empty($_GET['edit_action']) && isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['description']) && isset($_POST['content'])){
		if(!empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_POST['description']) && !empty($_POST['content'])){
			$updatesql = "UPDATE articles SET title='".$_POST['title']."', subtitle='".$_POST['subtitle']."', description='".$_POST['description']."', content='".$_POST['content']."' WHERE id='".$_GET['edit_action']."'";
			if(mysqli_query($conn,$updatesql)){
				$_SESSION['updatesucess'] = 'updatesucess'; header('Location: index.php?paneladmin&ed');
			}else{$_SESSION['updatefail'] = 'updatefail'; header('Location: index.php?paneladmin&ed');}
		}else{$_SESSION['empty'] = 'empty'; header('Location: index.php?paneladmin&ed');}
	}
	elseif(isset($_GET['del']) && !empty($_GET['del']) && is_numeric($_GET['del']) && isset($_POST['del']) && !empty($_POST['del']) && is_numeric($_POST['del'])){
		$sqldelete = "DELETE FROM articles WHERE id = '".$_POST['del']."'";
		if(mysqli_query($conn,$sqldelete)){
			$_SESSION['deletesucess'] = 'deletesucess'; header('Location: index.php?paneladmin&ed');
		}else{$_SESSION['deletefail'] = 'deletefail'; header('Location: index.php?paneladmin&ed');}
	}else{$_SESSION['notset'] = 'notset'; header('Location: index.php?paneladmin&ed');}
}	
?>