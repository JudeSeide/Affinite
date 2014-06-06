<?PHP
ini_set("display_errors", 0);
error_reporting(0);

require('../SERVICES/SQLfunction.php');

$id_usager = $_POST['email'];
$pwd = $_POST['password'];

if (SQLfunction::userExist($id_usager, $pwd) == 1) {

//extraction de l'usager
    $user = SQLfunction::extraireUsager($id_usager, $pwd);

// On appelle la session
    session_start();

// On écrase le tableau de session
    $_SESSION = array();

// On détruit la session
    session_destroy();

//creation de la session
    session_start();
    $_SESSION['id_usager'] = $user->get_courriel();
    $_SESSION['pwd'] = $user->get_pwd();
    $_SESSION['connect'] = "TRUE";
        
    if (isset($_SESSION['connect'])) {
      SQLfunction::connexionMAJ($user->get_courriel());
    }

//affichage de la page de profil usager ou administrateur

    if ($user->get_role() == "admin") {
        printf("<script>location.href='Administrateur.php'</script>");
    } else {
        ?>

        <!doctype html>
        <html class="no-js">

            <head>
                <meta charset="utf-8"/>
                <title>AFFINITE|usager</title>
                <link rel="stylesheet" media="all" href="../css/style.css"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->


                <!-- JS -->
                <script src="../js/jquery-1.6.4.min.js"></script>
                <script src="../js/css3-mediaqueries.js"></script>
                <script src="../js/custom.js"></script>
                <script src="../js/tabs.js"></script>

                <!-- superfish -->
                <link rel="stylesheet" media="screen" href="../css/superfish.css" /> 
                <script  src="../js/superfish-1.4.8/js/hoverIntent.js"></script>
                <script  src="../js/superfish-1.4.8/js/superfish.js"></script>
                <script  src="../js/superfish-1.4.8/js/supersubs.js"></script>
                <!-- ENDS superfish -->

                <!-- poshytip -->
                <link rel="stylesheet" href="../js/poshytip-1.1/src/tip-twitter/tip-twitter.css"  />
                <link rel="stylesheet" href="../js/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css"  />
                <script  src="../js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
                <!-- ENDS poshytip -->

                <!-- GOOGLE FONTS -->
                <link href="http://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet" type="text/css">

                <!-- Flex Slider -->
                <link rel="stylesheet" href="../css/flexslider.css" >
                <script src="../js/jquery.flexslider-min.js"></script>
                <!-- ENDS Flex Slider -->

                <!-- Masonry -->
                <script src="../js/masonry.min.js" ></script>
                <script src="../js/imagesloaded.js" ></script>
                <!-- ENDS Masonry -->

                <!-- Less framework -->
                <link rel="stylesheet" media="all" href="../css/lessframework.css"/>

                <!-- modernizr -->
                <script src="../js/modernizr.js"></script> 

                <!-- SKIN -->
                <link rel="stylesheet" media="all" href="../css/skin.css"/>
                <link rel="stylesheet" media="all" href="../css/diagram.css"/>


            </head>

            <body lang="en">



                <header>
                    <div class="wrapper clearfix">

                        <div id="logo">
                            <a href="../index.html"><img  src="../img/logo.png" alt="Simpler"></a>
                        </div>

                        <!-- nav -->
                        <ul id="nav" class="sf-menu">
                            <li><a href="../index.html">Accueil</a></li>
                            <li><a href="../inscription.html">Inscription</a></li>
                            <li class="current-menu-item"><a href="../connexion.html">Usager</a>
                                <ul>
                                    <li><a href="../connexion.html">Administrateur</a></li>
                                </ul>					
                            </li>
                            <li><a href="../contact.html">Contact</a></li>
                            <li><a href="../connexion.html">Connexion</a>
                                <ul>
                                    <li>
                                        <form id="deconnexionForm" action="Deconnexion.php" method="post">
                                            <input type="submit" value="Deconnexion" name=""/>                                   
                                        </form>
                                    </li>
                                </ul>							
                            </li>
                        </ul>
                        <!-- ends nav -->

                        <!-- comboNav -->
                        <select id="comboNav">
                            <option value="../index.html">Accueil</option>
                            <option value="../inscription.html">Inscription</option>
                            <option value="../connexion.html" selected="selected">Usager</option>
                            <option value="../connexion.html">Administrateur</option>
                            <option value="../contact.html">Contact</option>
                            <option value="../connexion.html">Connexion</option>
                            <option value="#deconnexionForm">Deconnexion</option>
                        </select>
                        <!-- comboNav -->	

                    </div>
                </header>

                <!-- MAIN -->
                <div id="main">	
                    <div class="wrapper clearfix">

                        <!-- masthead -->
                        <div class="masthead clearfix">
                            <h1> </h1><span class="subheading">Bienvenue sur votre page de profil</span>
                        </div>
                        <div class="mh-div"></div>
                        <!-- ENDS masthead -->


                        <!-- widgets -->
                        <ul  class="widget-cols clearfix">

                            <li class="first-col">

                                <div class="widget-block">
                                    <div class="recent-post clearfix">

                                        <?php
                                        //AFFINITE
                                        //GRAPHE

                                        $listeUsages = SQLfunction::listeUsagers($id_usager);

                                        $affinities = array();
                                        $taille = 4;

                                        foreach ($listeUsages as $oneUser) {
                                            $i = 1;
                                            $temp = $user->affinity($oneUser);

                                            if ($i <= $taille) {
                                                $affinities . array_push($affinities, $temp);
                                                $i++;
                                            } else {

                                                for ($j = 0; $j < $taille - 1; $j++) {

                                                    $min = $temp->getAfin();

                                                    if ($min > $affinities[$j]->getAfin()) {
                                                        $tmp = $affinities[$j];
                                                        $affinities[$j] = $temp;
                                                        $temp = $tmp;
                                                    }
                                                }
                                            }
                                        }

                                        $size = count($affinities);
                                        $indice = $size;
                                        $indice--;
                                        $tmp = 0;
                                        ?>

                                        <div id="diagram"> 

                                            <div id="user_top">
        <?php
        if ($indice >= 0) {
            $temp = $affinities[$indice];
            echo '<p>' . $temp->get_nom() . ' ' . $temp->get_prenom() . '</p>';
            $indice--;
            $tmp = 1;
        } else {
            $tmp = 0;
        }
        ?>        
                                            </div>

                                            <hr id= "vertical_long"/>

                                            <div id="user_center">
        <?php
        echo '<p>' . $user->get_nom() . ' ' . $user->get_prenom() . '</p>';
        ?>   
                                            </div>

                                            <hr class= "vertical_short"/>

                                            <div id="user_bottom">
        <?php
        if ($indice >= 0) {
            $temp = $affinities[$indice];
            echo '<p>' . $temp->get_nom() . ' ' . $temp->get_prenom() . '</p>';
            $indice--;
            $tmp = 1;
        } else {
            $tmp = 0;
        }
        ?>  
                                            </div>

                                            <hr class= "vertical_short"/>

        <?php
        if ($tmp == 1) {
            echo '<img src="../img/avatars/' . $temp->get_photo() . '" id="picture_bottom">';
        } else {
            echo '<img src="../img/avatars/blank.jpg" id="picture_bottom">';
        }
        ?>

                                            <hr class= "vertical_short"/>

                                            <div id="details_center">
        <?php
        if ($tmp == 1) {
            $tab = $temp->get_categori();
            $taille = count($tab) - 1;
            for ($i = 0; $i < 5 && $i < $taille; $i++) {
                $titre = $tab[$i]->get_titre();
                echo $titre . ' ';
            }
        }
        ?>
                                            </div>

                                            <div id="user_left">
        <?php
        if ($indice >= 0) {
            $temp = $affinities[$indice];
            echo '<p>' . $temp->get_nom() . ' ' . $temp->get_prenom() . '</p>';
            $indice--;
            $tmp = 1;
        } else {
            $tmp = 0;
        }
        ?>  
                                            </div>

                                            <hr id="horizontal_left"/>

                                            <hr id= "vertical_left_bottom"/>

        <?php
        if ($tmp == 1) {
            echo '<img src="../img/avatars/' . $temp->get_photo() . '" id="picture_left">';
        } else {
            echo '<img src="../img/avatars/blank.jpg" id="picture_left">';
        }
        ?>

                                            <hr id= "vertical_left_top"/>

                                            <div id="details_left">
        <?php
        if ($tmp == 1) {
            $tab = $temp->get_categori();
            $taille = count($tab);
            for ($i = 0; $i < 5 && $i < $taille; $i++) {
                $titre = $tab[$i]->get_titre();
                echo $titre . ' ';
            }
        }
        ?>
                                            </div>

                                            <div id="user_right">
                                                <?php
                                                if ($indice >= 0) {
                                                    $temp = $affinities[$indice];
                                                    echo '<p>' . $temp->get_nom() . ' ' . $temp->get_prenom() . '</p>';
                                                    $indice--;
                                                    $tmp = 1;
                                                } else {
                                                    $tmp = 0;
                                                }
                                                ?>  
                                            </div>

                                            <hr id="horizontal_right"/>

                                            <hr id= "vertical_right_bottom"/>

        <?php
        if ($tmp == 1) {
            echo '<img src="../img/avatars/' . $temp->get_photo() . '" id="picture_right">';
        } else {
            echo '<img src="../img/avatars/blank.jpg" id="picture_right">';
        }
        ?>

                                            <hr id= "vertical_right_top"/>

                                            <div id="details_right">
                                            <?php
                                            if ($tmp == 1) {
                                                $tab = $temp->get_categori();
                                                $taille = count($tab);
                                                for ($i = 0; $i < 5 && $i < $taille; $i++) {
                                                    $titre = $tab[$i]->get_titre();
                                                    echo $titre . ' ';
                                                }
                                            }
                                            ?>
                                            </div>

                                        </div>                                

                                    </div>         
                                </div>
                            </li>


                        </ul>
                        <!-- ENDS widgets -->


                        <!-- page content -->
                        <div id="page-content" class="clearfix">        	



                            <!-- Tabs -->
                            <h3 class="heading">Categories</h3><span class="subheading">Selectionnez les categories definissant vos affinites selon votre priorite</span>
                            </br></br>                    <ul class="tabs">

        <?php
        // GENERATION CATEGORIE

        $list_categories = SQLfunction::getCategorie();

        foreach ($list_categories as $type => $categorie) {
            echo '<li><a href = "#' . $type . '"><span>' . $type . '</span></a></li>';
        }

        echo'             </ul><div class="panes">';
        $j = 1;
        $choix = "categorie";
        foreach ($list_categories as $type => $categorie) {
            echo '<div id="' . $type . '">';

            $list_mot = $categorie->get_motCle();

            foreach ($list_mot as $mot_cle) {

                for ($i = 1; $i <= 3; $i++) {

                    echo '</br></br>choix' . $i . ' : <select name="' . $choix . $j . '" form="category">';
                    echo '<option name="' . $mot_cle . '" value="' . $mot_cle . '">' . $mot_cle . '</option>';

                    echo '</select>';
                }
            }

            $j++;

            echo '</br></br></div>';
        }


        // FIN GENERATION CATEGORIE
        ?>

                        </div>
                        <!-- ENDS TABS -->

                        <form action="AjouterCategorieUser.php" method="post" id="category">
                            </br>
                            <input type="submit" value="Envoyez" name="submit" id="submit" />
                        </form>                    


                    </div>
                    <!-- ENDS page content -->

                    <!-- Fold image -->
                    <div id="fold"></div>
                </div>

            </div>
            <!-- ENDS MAIN -->

            <footer>	

                <div class="wrapper clearfix">

                    <!-- widgets -->
                    <ul  class="widget-cols clearfix">
                        <li class="first-col">						

                        </li>					

                    </ul>
                    <!-- ENDS widgets -->	

                </div>
            </footer>

        </body>

        </html>

        <?php
    }
} else {
    echo '<p textColor = "red">Erreur de connection mot de passe ou identifiant incorrecte</p>';
}
?> 