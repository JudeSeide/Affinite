<?php

// On appelle la session
session_start();

// On écrase le tableau de session
$_SESSION = array();

// On détruit la session
session_destroy();

// On prévient l'utilisateur
 header('Location: ../deconnexion.html');
?> 