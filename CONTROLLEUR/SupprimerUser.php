<?php

require('../SERVICES/SQLfunction.php');


$id_usager = $_POST['email'];

if (SQLfunction::userExist2($id_usager)) {
   $user = new Usager();
   $user->set_courriel($id_usager);
   SQLfunction::supprimerUsager($user);
}

?>