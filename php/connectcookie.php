<?php
session_start();

if (isset($_COOKIE['login']) && !isset($_SESSION['pseudo'])) 
{
    $_SESSION['pseudo'] = $_COOKIE['login'];
	$_SESSION['password'] = $_COOKIE['passwd'];
}
setcookie('contentMessage', '', 1, "/");
setcookie('contentMessage', '', 1);
?>