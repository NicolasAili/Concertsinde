<?php
	require('../php/database.php');
	$points = $_POST['points'];
	$points_session = $_POST['points_session'];
	$pseudo = $_POST['pseudo'];
	$admincheck = $_POST['admincheck'];
	$bannicheck = $_POST['bannicheck'];

	echo $points;
	echo "<br>";
	echo $points_session;
	echo "<br>";
	echo $pseudo;
	echo "<br>";
	echo $admincheck;
	echo "<br>";
	echo $bannicheck;
	echo "<br>";
?>