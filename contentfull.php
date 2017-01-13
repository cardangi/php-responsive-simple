<?php 
if(isset($_SESSION['token']) && (time() - $_SESSION['token'][1] < 1800)){
	if($result = mysqli_query($conn,$sql)){
		if(mysqli_num_rows($result) > 0){
			$content = mysqli_fetch_array($result);
			$timestamp = strtotime($content['date']);
			$date = date('d/m/Y',$timestamp);
			$date2 = date('H:i:s',$timestamp);
			echo "<div id='ctitle'><h1>" . $content['title'] . "</h1></div>";
			echo "<div id='cdate'>" . $date . " às " . $date2 . "</div>";
			echo "<div id='cbody'>" . $content['content'] . "</div>";
		
		}else{echo "<div id='center'> Oops! Essa página não existe! Existe? </div>";}
	}else{echo "<div id='center'> Oops! Essa página não existe! Existe? </div>";}
}else{echo "<div id='center'> Oops! Essa página não existe! Existe? </div>";}
?>