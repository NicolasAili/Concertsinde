
<?php

function inject($input, $redirect, $regex)
{	
	if(file_exists("php/database.php")) 
	{
  		require('php/database.php');
	} 
	else 
	{
  		require('../php/database.php');
	}

    if (is_null($regex)) {
    	preg_match('#[a-zA-Z0-9\'&$ ]+[-]?[a-zA-Z0-9\'&$ ]+#', $input, $matches);
    }
    else
    {
    	preg_match($regex, $input, $matches);
    }
    
	$matches = implode($matches);
	if(strlen($matches) != strlen($input))
	{
		if (file_exists($redirect)) 
		{
		    setcookie('contentMessage', 'Erreur: un ou plusieurs caractéres renseigné(s) est/sont interdit(s) par mesure de sécurité. Réessayez ou contactez-nous', time() + 30, "/");
    		header("Location: $redirect");
    		exit("Erreur: un ou plusieurs caractéres renseigné(s) est/sont interdit(s) par mesure de sécurité. Réessayez ou contactez-nous");
		} 
		echo "Erreur: un ou plusieurs caractéres renseigné(s) est/sont interdit(s) par mesure de sécurité. Réessayez ou contactez-nous";
		echo "<a href='/'> retour à l'accueil </a>";
	}
	else
	{
		echo "pas d'injection";
		return mysqli_escape_string($con, $input);
	}
}
?>

