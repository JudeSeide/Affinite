<?php

require('../SERVICES/SQLfunction.php');

$cat = new Categorie();
$cat->set_titre($_POST['type']);

 if (SQLfunction::categoriExist($cat->get_titre())) {
        SQLfunction::supprimerCategori($cat);
 }

?>