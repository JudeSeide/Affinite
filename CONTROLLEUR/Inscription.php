<?php

require('../SERVICES/SQLfunction.php');
require('../SERVICES/Upload.php');

$id_usager = $_POST['email'];
$pwd = $_POST['password'];

$user = new Usager();
$user->set_courriel($id_usager);
$user->set_pwd($pwd);


$user->set_nom($_POST['nom']);
$user->set_prenom($_POST['prenom']);

$coordo = new Coordonnees();
$coordo->set_codePostal($_POST['codepostal']);
$coordo->set_idUser($user->get_courriel());
$coordo->set_municipalite($_POST['municipalite']);
$coordo->set_pays($_POST['pays']);
$coordo->set_province($_POST['province']);
$coordo->set_rue($_POST['numerorue']);
$coordo->set_tel($_POST['telephone']);
$coordo->set_ville($_POST['ville']);

$user->set_adresse($coordo);

if (isset($_FILES['photo'])) {

    $_photo = $_FILES['photo'];
    $_fichier = Upload::upload($_photo);
    $user->set_photo($_fichier);
}

SQLfunction::inserUsager($user);
?>
