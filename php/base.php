<?php
	echo "<meta charset='utf-8'>
		<meta name='Description' content='Arpenid est un site web communautaire permettant de recenser les concerts et événements de rappeurs français indépendants'>
		<title> Arpenid, le rap indé par le public pour le public </title>";
		$filename = 'image/favicon.png';
		if (file_exists($filename)) 
		{
			echo "<link rel='icon' type='image/x-icon' href='image/favicon.png'>";
		}
		else
		{
			echo "<link rel='icon' type='image/x-icon' href='../image/favicon.png'>";
		}
?>