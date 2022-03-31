<?php
	function inject($input, $regex)
	{	
		$i = 0;
		$returnarr = array();
		
		if(file_exists("php/database.php")) 
		{
			require('php/database.php');
		} 
		else 
		{
			require('../php/database.php');
		}

		if (is_null($regex)) //cas où on a notre regex par défaut
		{
			foreach ($input as $key => $value) 
			{
				preg_match('#[a-zA-Z0-9\'&$ ôê]+[-]?[a-zA-Z0-9\'&$ ôê]+[-]?[a-zA-Z0-9\'&$ ôê]+[-]?#', $value, $matches);
				$matches = implode($matches);
				if(strlen($matches) != strlen($value))
				{
					$returnarr["$i"] = $value;
				}
				$i++;
			}
			return $returnarr;
		}
		else //cas pour une regex modifiée
		{
			switch ($regex) 
			{
				case 'num':
					$regex = '#[0-9 ]+#';
					break;
				case 'text':
					$regex = '#([a-zA-Z0-9\',\.() ç?!éêèàù;\-]+[\r\n]*)*#';
					break;
				case 'url':
					$regex = '#(https?:\/\/)?[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,4}(\/\S*)?#';
					break;
				case 'identifier':
					$regex = '#[0-9]{1,4}#';
					break;
				case 'date':
					$regex = '#[0-9]{4}-[0-9]{2}-[0-9]{2}#';
					break;
				case 'heure':
					$regex = '#[0-9]{2}:[0-9]{2}#';
					break;
				case 'mail':
					$regex = '#^[a-zA-Z-0-9]+\.{0,1}[a-zA-Z-0-9]+@[a-zA-Z-0-9]+\.[a-zA-Z0-9]{2,6}$#';
					break;
				default:
					$regex = '#[a-zA-Z0-9\'&$ ]+[-]?[a-zA-Z0-9\'&$ ]+#';
					break;
			}
			preg_match($regex, $input, $matches);

			if(strlen($matches[0]) != strlen($input))
			{
				$returnarr = $input;
			}
			else
			{
				$input = NULL;
			}
			return $input;
		}
		
	}

	function validate($inject, $redirect)
	{
		if (count($inject)>0) 
		{	
			$names = implode(", ", $inject);
			if (count($inject)>1)
			{
				if(strlen($names)>1)
				{
				    setcookie('contentMessage', 'Erreur: un ou plusieurs caractére(s) renseigné(s) est/sont interdit(s) par mesure de sécurité sur les expressions suivantes : <strong>' . $names . '</strong>.<br>Réessayez ou contactez-nous', time()+20, "/");
		    		header("Location: $redirect");
		    		exit("Erreur: un ou plusieurs caractéres renseigné(s) est/sont interdit(s) par mesure de sécurité sur les expressions suivantes : " . $names . ".Réessayez ou contactez-nous");
		    	}
		    	else
		    	{
		    		return 0;
		    	}
			}
			else
			{
				if(strlen($names)>1)
				{
					setcookie('contentMessage', 'Erreur: un ou plusieurs caractère(s) renseigné(s) est/sont interdit(s) par mesure de sécurité sur l\'expression suivante : <strong>' . $names . '</strong><br>Réessayez ou contactez-nous', time()+20, "/");
		    		header("Location: $redirect");
		    		exit("Erreur: un ou plusieurs caractéres renseigné(s) est/sont interdit(s) par mesure de sécurité sur l\'expression suivante : " . $names . ".Réessayez ou contactez-nous");
	    		}
	    		else //notre bug bizarre
	    		{
	    			return 0;
	    		}
			}
		}
		else
		{
			return 0; //pas d'injection
		}
	}
?>

