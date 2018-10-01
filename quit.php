<?php
// Appel de la session
session_start();

// On vide le tableau de session
$_SESSION = array();

// Destruction de la session
session_destroy();

header('location: index.php');
?>
