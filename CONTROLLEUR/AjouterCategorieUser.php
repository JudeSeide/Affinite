<?php

require('../SERVICES/SQLfunction.php');

session_start();

$id_usager = $_SESSION['id_usager'];
$pwd = $_SESSION['pwd'];

$user = SQLfunction::extraireUsager($id_usager, $pwd);

$indice = 1;

$list_categories = SQLfunction::getCategorie();

foreach ($list_categories as $type => $categorie) {

    $cat = new Categorie();
    $cat->set_titre($type);

    $mot = 'categorie';

    for ($j = 1; $j <= 3; $j++) {
        
        $cle = $mot . $indice;
        $indice++;
        
        if (isset($_POST[$cle])) {
            $cat->add_mot_cle($_POST[$cle]);
        }
    }

    $user->add_categori($cat);
}

SQLfunction::inserPreference($user);
?>