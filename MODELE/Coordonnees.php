<?php

class Coordonnees {

    private $_idUser;
    private $_tel;
    private $_numeroCivic;
    private $_rue;
    private $_municipalite;
    private $_ville;
    private $_codePostal;
    private $_province;
    private $_pays;
    private $_continent;

    function __construct() {
        $this->_idUser = "inconnu";
        $this->_tel = "inconnu";
        $this->_numeroCivic = "inconnu";
        $this->_rue = "inconnu";
        $this->_municipalite = "inconnu";
        $this->_ville = "inconnu";
        $this->_codePostal = "inconnu";
        $this->_province = "inconnu";
        $this->_pays = "inconnu";
        $this->_continent = "inconnu";
    }

    public function get_idUser() {
        return $this->_idUser;
    }

    public function get_tel() {
        return $this->_tel;
    }

    public function get_numeroCivic() {
        return $this->_numeroCivic;
    }

    public function get_rue() {
        return $this->_rue;
    }

    public function get_municipalite() {
        return $this->_municipalite;
    }

    public function get_ville() {
        return $this->_ville;
    }

    public function get_codePostal() {
        return $this->_codePostal;
    }

    public function get_province() {
        return $this->_province;
    }

    public function get_pays() {
        return $this->_pays;
    }

    public function get_continent() {
        return $this->_continent;
    }

    public function set_idUser($_idUser) {
        $this->_idUser = $_idUser;
    }

    public function set_tel($_tel) {
        $this->_tel = $_tel;
    }

    public function set_numeroCivic($_numeroCivic) {
        $this->_numeroCivic = $_numeroCivic;
    }

    public function set_rue($_rue) {
        $this->_rue = $_rue;
    }

    public function set_municipalite($_municipalite) {
        $this->_municipalite = $_municipalite;
    }

    public function set_ville($_ville) {
        $this->_ville = $_ville;
    }

    public function set_codePostal($_codePostal) {
        $this->_codePostal = $_codePostal;
    }

    public function set_province($_province) {
        $this->_province = $_province;
    }

    public function set_pays($_pays) {
        $this->_pays = $_pays;
    }

    public function calculAffinieGeo(Coordonnees $crd, Coordonnees $param) {
        $affinity = 0;

        $crd = strtoupper($crd->_codePostal);
        $param = strtoupper($param->_codePostal);

        if ($crd === $param) {
            $affinity += 30;
        }

        $crd = strtoupper($crd->_pays);
        $param = strtoupper($param->_pays);

        if ($crd === $param) {
            $affinity+= 10;

            $crd = strtoupper($crd->_province);
            $param = strtoupper($param->_province);

            if ($crd === $param) {
                $affinity+= 10;


                $crd = strtoupper($crd->_ville);
                $param = strtoupper($param->_ville);

                if ($crd === $param) {
                    $affinity+= 15;

                    $crd = strtoupper($crd->_municipalite);
                    $param = strtoupper($param->_municipalite);

                    if ($crd === $param) {
                        $affinity += 15;


                        $crd = strtoupper($crd->_rue);
                        $param = strtoupper($param->_rue);

                        if ($crd === $param) {
                            $affinity+= 20;
                        }
                    }
                }
            }
        }

        return $affinity;
    }

}

?>