<?php

require('../SERVICES/SQLfunction.php');
require('../SERVICES/Upload.php');

$id_usager = $_POST['email'];
$pwd = $_POST['password'];

function setUsager(Usager $user) {

    $user->set_nom($_POST['nom']);
    $user->set_prenom($_POST['prenom']);
    $user->set_role($_POST['role']);

    $coordo = new Coordonnees();
    $coordo->set_codePostal($_POST['codepostal']);
    $coordo->set_idUser($user->get_courriel());
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
}
$bool = SQLfunction::userExist($id_usager, $pwd);
echo 'user existe '.$bool;
if ($bool == 1) {
    
    $user = SQLfunction::extraireUsager($id_usager, $pwd);
    setUsager($user);
    SQLfunction::usagerMAJ($user);
    
} else {
    
    $user = new Usager();
    $user->set_courriel($id_usager);
    $user->set_pwd($pwd);
    setUsager($user);
    SQLfunction::inserUsager($user);
}

?>
