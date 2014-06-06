<?php

require 'Coordonnees.php';
require 'Categorie.php';

class Usager {

    protected $_nom;
    protected $_prenom;
    protected $_courriel;
    protected $_pwd;
    protected $_idUser;
    protected $_role;
    protected $_photo;
    protected $_afin;
    private $_categori;
    private $_adresse;

    function __construct() {
        $this->_nom = "inconnu";
        $this->_prenom = "inconnu";
        $this->_courriel = "inconnu";
        $this->_pwd = "inconnu";
        $this->_idUser = "inconnu";
        $this->_role = "user";
        $this->_photo= "default.jpg";
        $this->_categori = array();
        $this->_adresse = new Coordonnees();
    }
    
    public function getAfin() {
        return $this->_afin;
    }
    
    public function setAfin($_afin){
        $this->_afin = $_afin;
    }

    public function get_nom() {
        return $this->_nom;
    }

    public function get_prenom() {
        return $this->_prenom;
    }

    public function get_courriel() {
        return $this->_courriel;
    }

    public function get_pwd() {
        return $this->_pwd;
    }

    public function get_idUser() {
        return $this->_idUser;
    }

    public function set_nom($_nom) {
        $this->_nom = $_nom;
    }

    public function set_prenom($_prenom) {
        $this->_prenom = $_prenom;
    }

    public function set_courriel($_courriel) {
        $this->_courriel = $_courriel;
    }

    public function set_pwd($_pwd) {
        $this->_pwd = $_pwd;
    }

    public function set_idUser($_idUser) {
        $this->_idUser = $_idUser;
    }

    public function set_role($_role) {
        $this->_role = $_role;
    }

    public function get_role() {
        return $this->_role;
    }

    public function get_categori() {
        return $this->_categori;
    }

    public function get_adresse() {
        return $this->_adresse;
    }

    public function set_adresse(Coordonnees $_adresse) {
        $this->_adresse = $_adresse;
    }

    public function add_categori(Categorie $_cat) {
        $this->_categori[] = $_cat;
    }

    public function supprimer_cat(Categorie $_cat) {

        $this->_categori = array_diff($this->_categori, $_cat);
    }

    public function get_photo() {
        return $this->_photo;
    }

    public function set_photo($_photo) {
        $this->_photo = $_photo;
    }

    public function affinity(Usager $user) {
        
        $pourentageCate = Categorie::affinity_mot_cle($this->get_categori(), $user->get_categori());
        $pourentageCate = $pourentageCate / 2;
        
        $pourentageCoord = Coordonnees::calculAffinieGeo($this->get_adresse(), $user->get_adresse());
        $pourentageCoord = $pourentageCoord / 2;

        $afin = $pourentageCate + $pourentageCoord;
        
        $user->setAfin($afin);
        return $user;
    }

}

?>