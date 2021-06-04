<?php
if(isset($_GET['dir'])){
	$get_dir = $_GET['dir'];
	if(isset($_GET['open'])){
		 $contents = file_get_contents($get_dir."/".$_GET['open']);
	}else if(isset($_GET['del'])){
	 system("rm \"".$_GET['dir']."/".$_GET['del']."\"");
	}else if(isset($_GET['dels'])){
	 system("rm \"".$_GET['dir']."/".$_GET['dels']."\"");
	}
}else{
	$get_dir = "/";
}
$scanned_directory = scandir($get_dir);
if(exif_imagetype($get_dir."/".$_GET['open']) and isset($_GET['open']) and isset($_GET['dir'])){
	header('Content-Type: image/jpeg');
	echo($contents);		 
}else if(isset($_GET['open']) and isset($_GET['dir'])){
	header('Content-Type: text/plain');
	echo($contents);	
}else{


?>
<html>
	<head>
		<title>Termux-men</title>
		<style>
			.del{color:red;}
			.div{margin: 3px;padding:5px; border:1px solid #333; background:#333;}
			body{background: #666;}
			a{color: #eee}
		</style>
	</head>
	<body>
	<form>
		<input name="dir" style="width:100%;" value="<?php echo($get_dir); ?>"><input type="submit">  
	</form>
	<?php
	
	if(isset($_GET['open'])){
		echo("<textarea>".$contents."</textarea>");
	}
	else{
		foreach($scanned_directory as $sd){
			if(is_file($get_dir."/".$sd)){
				if($sd[0] != '.'){
					echo("<div class=\"div\"><a href=\"?dir=". $get_dir . "&open=" . $sd ."\">".$sd." </a> | <a class=\"del\" href=\"?dir=". $get_dir . "&del=" . $sd ."\"> Delete </a></div>");
				}
			}else{
				echo("<div class=\"div\"><a href=\"?dir=". $get_dir . "/" . $sd ."\">".$sd."</a> | <a class=\"del\" href=\"?dir=". $get_dir . "&dels=" . $sd ."\">Delete</a></div>");
			}	
		}
	}
	?>
	</body>
</html>
<?php
}
