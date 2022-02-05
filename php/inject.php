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
				preg_match('#[a-zA-Z0-9\'&$ ]+[-]?[a-zA-Z0-9\'&$ ]+#', $value, $matches);
				$matches = implode($matches);
				if(strlen($matches) != strlen($value))
				{
					$returnarr["$i"] = $value; 
				}
				$i++;
			}
		}
		else //cas pour une regex modifié
		{
			preg_match($regex, $input, $matches);
			if(strlen($matches) != strlen($input))
			{
				$returnarr = $input;
			}
		}
		return $returnarr;
	}
?>

