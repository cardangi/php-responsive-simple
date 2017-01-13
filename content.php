<?php
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800)){
	$sql = ("SELECT id,title,description,date FROM articles ORDER BY date DESC LIMIT 10");
	if($result = mysqli_query($conn,$sql)){
		if(mysqli_num_rows($result) > 0){
			while($content = mysqli_fetch_array($result)){
				$timestamp = strtotime($content['date']);
				$date = date('d/m/Y',$timestamp);
				echo "<div id='cdate_left'>" . $date . " - </div> ";
				echo " <div id='ctitle_left'><a href='index.php?&cid=" . $content['id'] . "'><h2>" . $content['title'] . "</h2></a></div>";
				echo "<div id='cbody_left'>" . $content['description'] . "</div>";
			}
		}
	}
}
?>