<?php

// Affiche ou cache les erreurs (precurseur)
ini_set("display_errors", 0);
//ini_set("display_errors", 1);

// Désactiver le rapport d'erreurs
//error_reporting(0);

// Rapporte les erreurs d'exécution de script
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Rapporter les E_NOTICE peut vous aider à améliorer vos scripts
// (variables non initialisées, variables mal orthographiées..)
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Rapporte toutes les erreurs à part les E_NOTICE
// C'est la configuration par défaut de php.ini
//error_reporting(E_ALL & ~E_NOTICE);

// Rapporte toutes les erreurs PHP
error_reporting(E_ALL);

// Rapporte toutes les erreurs PHP
//error_reporting(-1);

// Même chose que error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
?>
<noscript>
		<meta http-equiv="refresh" content="0; url=nojs.php" />
</noscript>
