<?php

class Categorie {

    private $_titre;
    private $_motCle;

    function __construct() {
        $this->_titre = "inconnu";
        $this->_motCle = array();
    }

    public function get_titre() {
        return $this->_titre;
    }

    public function get_motCle() {
        return $this->_motCle;
    }

    public function set_titre($_titre) {
        $this->_titre = $_titre;
    }

    public function set_motCle($_motCle) {
        $this->_motCle = $_motCle;
    }

    public function add_mot_cle($motCle) {
        $this->_motCle[] = $motCle;
    }

    public function suppime_mot_cle($_valeur) {

        $this->_motCle = array_diff($this->_motCle, $_valeur);
    }

    public function affinity_mot_cle($user_cat_list, $other_cat_list) {
        $affinity = 0;

        foreach ($user_cat_list as $user_cat) {

            foreach ($other_cat_list as $other_cat) {

                if ($user_cat->_titre == $other_cat->_titre) {

                    foreach ($user_cat->_motCle as $value) {
                        $nbr += 1;
                        if (in_array($value, $other_cat->_motCle)) {
                            $commun+=1;
                        }

                    }
                }
            }
        }

        $affinity = ($commun / $nbr) * 100;
        return $affinity;
    }

}

?>                                                                                                                                                                                                                                                                                                                                                                                                   