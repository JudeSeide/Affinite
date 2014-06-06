<?php

require('../SERVICES/SQLfunction.php');

if (isset($_POST['type'])) {

    $cat = new Categorie();
    $cat->set_titre($_POST['type']);

    for ($i = 1; $i <= 10; $i++) {
        $mot = "mot" . $i;
        if (isset($_POST[$mot])) {
            $cat->add_mot_cle($_POST[$mot]);
        }
    }

    if (SQLfunction::categoriExist($cat->get_titre())) {
        SQLfunction::supprimerCategori($cat);
        SQLfunction::inserCategorie($cat);
    } else {
        SQLfunction::inserCategorie($cat);
    }
}
?>