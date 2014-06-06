<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require ('../PDO/ConnecteBd.php');
require ('../MODELE/Usager.php');

class SQLfunction {

    private static $_connexion;

    function __construct() {
        
    }

    private static function getUserPreferences($_courriel, Usager $nouv) {
        $bdd = ConnecteBd::getInstance();
        $query = ('SELECT * FROM PREFERENCE WHERE PREFERENCE.COURRIEL = "' . $_courriel . '" ' );
        $reponse = $bdd->prepare($query);
        $reponse->execute();

        if ($reponse != NULL) {

            $donnees = $reponse->fetch();

            $cat = new Categorie();
            $cat->set_titre($donnees["NOM_CATEGO"]);
            $cat->add_mot_cle($donnees["MOT_CLE"]);
            $nouv->add_categori($cat);

            while ($donnees = $reponse->fetch()) {

                if (array_key_exists($donnees["NOM_CATEGO"], $nouv->get_categori())) {

                    $nouv->get_categori()[$donnees["NOM_CATEGO"]]->add_mot_cle($donnees["MOT_CLE"]);
                } else {

                    $cat = new Categorie();
                    $cat->set_titre($donnees["NOM_CATEGO"]);
                    $cat->add_mot_cle($donnees["MOT_CLE"]);
                    $nouv->add_categori($cat);
                }
            }
        }
    }

    public static function getCategorie() {
        $bdd = ConnecteBd::getInstance();
        $query = ('SELECT * FROM CATEGORIE');
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $listCat = array();
        if ($reponse != NULL) {

            $donnees = $reponse->fetch();

            $cat = new Categorie();
            $cat->set_titre($donnees["NOM_CATEGO"]);
            $cat->add_mot_cle($donnees["MOT_CLE"]);
            $listCat[$donnees["NOM_CATEGO"]] = $cat;


            while ($donnees = $reponse->fetch()) {

                if (array_key_exists($donnees["NOM_CATEGO"], $listCat)) {

                    $listCat[$donnees["NOM_CATEGO"]]->add_mot_cle($donnees["MOT_CLE"]);
                } else {

                    $cate = new Categorie();
                    $cate->set_titre($donnees["NOM_CATEGO"]);
                    $cate->add_mot_cle($donnees["MOT_CLE"]);
                    $listCat[$donnees["NOM_CATEGO"]] = $cate;
                }
            }
        }

        return $listCat;
    }

    public static function extraireUsager($_courriel, $_pwd) {
        $bdd = ConnecteBd::getInstance();
        $query = ('SELECT * FROM USERS '
                . ', ADRESSE '
                . 'WHERE USERS.COURRIEL = "' . $_courriel . '" '
                . 'AND USERS.PWD = "' . $_pwd . '" '
                . 'AND USERS.ID_ADR = ADRESSE.ID_ADR');
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $nouv = new Usager();

        if ($reponse != NULL) {

            $donnees = $reponse->fetch();

            $nouv->set_nom($donnees['NOM']);
            $nouv->set_prenom($donnees['PRENOM']);
            $nouv->set_courriel($donnees['COURRIEL']);
            $nouv->set_photo($donnees['PHOTO']);
            $nouv->set_role($donnees['ROLE']);
            $nouv->set_pwd($donnees['PWD']);
            $nouv->set_idUser($nouv->get_courriel());

            $coor = new Coordonnees();
            $coor->set_codePostal($donnees["CODE_POS"]);
            $coor->set_municipalite($donnees["MUNICI"]);
            $coor->set_pays($donnees["PAYS"]);
            $coor->set_province($donnees["PROVINCE"]);
            $coor->set_rue($donnees["RUE"]);
            $coor->set_tel($donnees["TEL"]);
            $coor->set_ville($donnees["VILLE"]);
            $nouv->set_adresse($coor);

            SQLfunction::getUserPreferences($_courriel, $nouv);
        }

        $reponse->closeCursor();
        return $nouv;
    }

    public static function extrairePreference($_courriel) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare('SELECT * FROM PREFERNCE WHERE COURRIEL = "' . $_courriel . '"');
        $reponse->execute();
        $_list_pref = array();
        while ($donnees = $reponse->fetch()) {

            if (array_key_exists($donnees['NOM_CATEGO'], $_list_pref)) {
                $_list_pref[$donnees['NOM_CATEGO']]->add_mot_cle($donnees['NOM_CATEGO']);
            } else {

                $cat = new Categorie();
                $cat->set_titre($donnees["NOM_CATEGO"]);
                $cat->add_mot_cle($donnees["MOT_CLE"]);
                $_list_pref[$donnees['NOM_CATEGO']] = $cat;
            }
        }
        $reponse->closeCursor();
        return $_list_pref;
    }

    public static function inserUsager(Usager $_user) {
        $id_Adresse = SQLfunction::id_adrExist($_user);
        SQLfunction::configStatCon($_user->get_courriel());
        if ($id_Adresse <= 0) {
            $id_Adresse = SQLfunction::inserAdresse($_user->get_adresse());
        }

        $bdd = ConnecteBd::getInstance();
        $_iter = 0;

        if ($_user->get_categori() != NULL) {
            $_list = $_user->get_categori();
            $_iter = count($_list);

            for ($i = 0; $i < $_iter; $i++) {
                $cat = $_iter[$i];
                if ($cat != NULL) {
                    SQLfunction::inserCategorie($cat);
                }
            }
        }

        $query = "INSERT INTO USERS (NOM, PRENOM, TEL, COURRIEL,PHOTO,PWD,ROLE,ID_ADR) "
                . "VALUES ('" . $_user->get_nom() . "','" . $_user->get_prenom() . "','"
                . $_user->get_adresse()->get_tel() . "','" . $_user->get_courriel() . "','"
                . $_user->get_photo() . "','" . $_user->get_pwd() . "','" . $_user->get_role()
                . "','" . $id_Adresse . "')";

        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function inserCategorie(Categorie $_cat) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare('INSERT INTO CATEGORIE SET NOM_CATEGO = :nom, MOT_CLE = :mot');
        $_list_mot = $_cat->get_motCle();
        $_id = array();
        foreach ($_list_mot as $value) {
            $reponse->bindValue(':nom', $_cat->get_titre());
            $reponse->bindValue(':mot', $value);
            $reponse->execute();
            $_id[] = $bdd->lastInsertId();
        }

        $reponse->closeCursor();
        return $_id;
    }

    public static function inserPreference(Usager $_us) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare('INSERT INTO PREFERENCE SET NOM_CATEGO = :nom, MOT_CLE = :mot , COURRIEL = :courriel');
        foreach ($_us->get_categori() as $_cat) {
            $_list_mot = $_cat->get_motCle();
            $_id = array();
            foreach ($_list_mot as $value) {
                $reponse->bindValue(':nom', $_cat->get_titre());
                $reponse->bindValue(':mot', $value);
                $reponse->bindValue(':courriel', $_us->get_courriel());
                $reponse->execute();
                $_id[] = $bdd->lastInsertId();
            }
        }

        $reponse->closeCursor();
        return $_id;
    }

    public static function inserAdresse(Coordonnees $_co) {

        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare('INSERT INTO ADRESSE SET PAYS = :pays,PROVINCE=:pro, VILLE=:ville,MUNICI=:muni,RUE=:rue,CODE_POS=:post');
        $reponse->bindValue(':pays', $_co->get_pays());
        $reponse->bindValue(':pro', $_co->get_province());
        $reponse->bindValue(':ville', $_co->get_ville());
        $reponse->bindValue(':muni', $_co->get_municipalite());
        $reponse->bindValue(':rue', $_co->get_rue());
        $reponse->bindValue(':post', $_co->get_codePostal());

        $reponse->execute();
        $_id = $bdd->lastInsertId();
        $reponse->closeCursor();
        return $_id;
    }

    public static function userExist($_courriel, $_pwd) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare("SELECT COUNT(*) FROM USERS WHERE COURRIEL = :courriel AND PWD = :pwd");
        $reponse->bindValue(':courriel', $_courriel);
        $reponse->bindValue(':pwd', $_pwd);
        $reponse->execute();

        if ($reponse->fetchColumn() > 0) {
            $reponse->closeCursor();
            return 1;
        } else {
            $reponse->closeCursor();
            return -1;
        }
    }

    public static function userExist2($_courriel) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare("SELECT COUNT(*) FROM USERS WHERE COURRIEL = :courriel");
        $reponse->bindValue(':courriel', $_courriel);
        $reponse->execute();
        if ($reponse->fetchColumn() > 0) {
            $reponse->closeCursor();
            return 1;
        } else {
            $reponse->closeCursor();
            return -1;
        }
    }

    public static function motCleExist($_nom, $_mot) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare("SELECT COUNT(*) FROM CATEGORIE WHERE NOM_CATEGO = :nom AND MOT_CLE = :mot");
        $reponse->binValue(':nom', $_nom);
        $reponse->binValue(':mot', $_mot);
        $reponse->execute();
        if ($reponse->fetchColumn() > 0) {
            $reponse->closeCursor();
            return 1;
        } else {
            $reponse->closeCursor();
            return -1;
        }
    }

    public static function categoriExist($_nom) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare("SELECT COUNT(*) FROM CATEGORIE WHERE NOM_CATEGO = :nom");
        $reponse->bindValue(':nom', $_nom);
        $reponse->execute();
        if ($reponse->fetchColumn() > 0) {
            $reponse->closeCursor();
            return 1;
        } else {
            $reponse->closeCursor();
            return -1;
        }
    }

    public static function usagerMAJ(Usager $_user) {
        $_id = SQLfunction::id_adrExist($_user);
        if ($_id != -1) {
            SQLfunction::adresseMAJ($_user->get_adresse(), $_id);
        } else {

            SQLfunction::inserAdresse($_user->get_adresse());
        }

        $bdd = ConnecteBd::getInstance();

        $query = "UPDATE USERS SET NOM     = '" . $_user->get_nom() . "',"
                . " PRENOM         = '" . $_user->get_prenom() . "',"
                . " TEL            = '" . $_user->get_adresse()->get_tel() . "',"
                . " COURRIEL       = '" . $_user->get_courriel() . "',"
                . " PHOTO          = '" . $_user->get_photo() . "',"
                . " PWD            = '" . $_user->get_pwd() . "',"
                . " ROLE           = '" . $_user->get_role() . "'"
                . " WHERE COURRIEL = '" . $_user->get_courriel() . "'";

        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function id_adrExist(Usager $_user) {
        $bdd = ConnecteBd::getInstance();
        $reponse = $bdd->prepare("SELECT DISTINCT ID_ADR FROM USERS WHERE COURRIEL = :COURRIEL");
        $reponse->bindValue(':COURRIEL', $_user->get_courriel());
        $reponse->execute();
        $id = -1;
        while ($donnees = $reponse->fetch()) {
            $id = $donnees["ID_ADR"];
        }

        $reponse->closeCursor();
        return $id;
    }

    public static function adresseMAJ(Coordonnees $_coor, $_id) {
        $bdd = ConnecteBd::getInstance();

        $query = "UPDATE ADRESSE SET"
                . "  PAYS          = '" . $_coor->get_pays() . "',"
                . "  PROVINCE      = '" . $_coor->get_province() . "',"
                . "  VILLE         = '" . $_coor->get_ville() . "',"
                . "  MUNICI        = '" . $_coor->get_municipalite() . "',"
                . "  RUE           = '" . $_coor->get_rue() . "',"
                . "  NUM_CIVIC     = '" . $_coor->get_numeroCivic() . "',"
                . "  CODE_POS      = '" . $_coor->get_codePostal() . "'"
                . " WHERE ID_ADR = '" . $_id . "'";

        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function supprimerUsager(Usager $_user) {
        $bdd = ConnecteBd::getInstance();
        $query = "DELETE FROM USERS WHERE USERS.COURRIEL = '" . $_user->get_courriel() . "'";
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function supprimerCategori(Categorie $_cat) {
        $bdd = ConnecteBd::getInstance();
        $query = "DELETE FROM CATEGORIE WHERE NOM_CATEGO = '" . $_cat->get_titre() . "'";
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function supprimerMotCle($_titre, $_mot) {
        $bdd = ConnecteBd::getInstance();
        $query = "DELETE FROM CATEGORIE WHERE NOM_CATEGO = '" . $_titre . "' AND MOT_CLE = '" . $_mot . "'";
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function supprimerPreference($_courriel, $_titre, $_mot) {
        $bdd = ConnecteBd::getInstance();
        $query = "DELETE FROM PREFERENCE WHERE NOM_CATEGO = '" . $_titre . "' AND MOT_CLE = '" . $_mot . "' AND COURRIEL = '" . $_courriel . "'";
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function listeUsagers($_courriel) {
        $bdd = ConnecteBd::getInstance();
        $query = ('SELECT DISTINCT * FROM USERS '
                . ', ADRESSE '
                . 'WHERE USERS.COURRIEL <> "' . $_courriel . '" '
                . 'AND USERS.ID_ADR = ADRESSE.ID_ADR');
        $reponse = $bdd->prepare($query);
        $reponse->execute();

        $_list_user = array();
        while ($donnees = $reponse->fetch()) {
            $nouv = new Usager();
            if ($nouv->get_idUser() == "inconnu") {
                $nouv->set_nom($donnees['NOM']);
                $nouv->set_prenom($donnees['PRENOM']);
                $nouv->set_courriel($donnees['COURRIEL']);
                $nouv->set_photo($donnees['PHOTO']);
                $nouv->set_role($donnees['ROLE']);
                $nouv->set_pwd($donnees['PWD']);
                $nouv->set_idUser($nouv->get_courriel());

                $coor = new Coordonnees();
                $coor->set_codePostal($donnees["CODE_POS"]);
                $coor->set_municipalite($donnees["MUNICI"]);
                //$coor->set_numeroCivic($donnees["PROVINCE"]);
                $coor->set_pays($donnees["PAYS"]);
                $coor->set_province($donnees["PROVINCE"]);
                $coor->set_rue($donnees["RUE"]);
                $coor->set_tel($donnees["TEL"]);
                $coor->set_ville($donnees["VILLE"]);
                $nouv->set_adresse($coor);

                SQLfunction::getUserPreferences($_courriel, $nouv);
                $_list_user[] = $nouv;
            }
        }

        $reponse->closeCursor();
        return $_list_user;
    }

    public static function extraireStatMotCle() {
        $bdd = ConnecteBd::getInstance();
        $query = "SELECT COUNT( * ) NBRE, P.MOT_CLE, P.NOM_CATEGO FROM PREFERENCE P, CATEGORIE C WHERE P.MOT_CLE = C.MOT_CLE AND P.NOM_CATEGO = C.NOM_CATEGO GROUP BY P.MOT_CLE, P.NOM_CATEGO";
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $_statList = array();
        while ($donnees = $reponse->fetch()) {
            $_statList[$donnees["MOT_CLE"]] = $donnees["NBRE"];
        }
        $reponse->closeCursor();
        return $_statList;
    }

    public static function extraireStatConn() {
        $bdd = ConnecteBd::getInstance();
        $query = "SELECT * FROM STATISTIQUE";
        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $_statList = array();
        while ($donnees = $reponse->fetch()) {
            $_statList[$donnees["COURRIEL"]] = $donnees["NBRE_CON"];
        }
        $reponse->closeCursor();
        return $_statList;
    }

    public static function connexionMAJ($_courriel) {
        $bdd = ConnecteBd::getInstance();

        $query = "UPDATE STATISTIQUE SET NBRE_CON = NBRE_CON + 1 WHERE COURRIEL = '" . $_courriel . "'";

        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

    public static function configStatCon($_courriel) {
        $bdd = ConnecteBd::getInstance();

        $query = "INSERT INTO STATISTIQUE(COURRIEL) VALUES('" . $_courriel . "') ";

        $reponse = $bdd->prepare($query);
        $reponse->execute();
        $reponse->closeCursor();
    }

}

?>
