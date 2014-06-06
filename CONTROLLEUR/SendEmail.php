<?php

if (isset($_SESSION['connect'])) {

//destinataire
    $to = $_POST['email'];
    
//envoyeur
    $from = $_SESSION['id_usager'];

//data
    $msg = "NOM: " . $_POST['name'] . "<br>\n";
    $msg .= "TELEPHONE: " . $_POST['phone'] . "<br>\n";
    $msg .= "MESSAGE: " . $_POST['comments'] . "<br>\n";
    $subject = "AFFINTE CONTACT";
//Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: <" . $from . ">";

//Envoie du mail
    mail($to, $subject, $msg, $headers);    
}
?>