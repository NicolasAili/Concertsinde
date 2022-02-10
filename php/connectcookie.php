<?php
//session_start();

if (isset($_COOKIE['login'])) 
{
	echo "OKOK";
    $_SESSION['pseudo'] = $_COOKIE['login'];
	$_SESSION['password'] = $_COOKIE['passwd'];
	echo $_COOKIE['login'];
}
else
{
	echo "ERREUR";
}
?>