<!doctype html>
<html class="no-js">

    <head>
        <meta charset="utf-8"/>
        <title>AFFINITE|administrateur</title>


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
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

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

        <!-- form-validation -->
        <script type="text/javascript" src="../js/form-validation.js"></script>

        <!-- SKIN -->
        <link rel="stylesheet" media="all" href="../css/skin.css"/>


    </head>

    <body lang="en">


        <header>
            <div class="wrapper clearfix">

                <div id="logo">
                    <a href="../index.html"><img  src="../img/logo.png" alt="Affinite"></a>
                </div>

                <!-- nav -->
                <ul id="nav" class="sf-menu">
                    <li><a href="../index.html">Accueil</a></li>
                    <li><a href="../inscription.html">Inscription</a></li>
                    <li  class="current-menu-item"><a href="../connexion.html">Administrateur</a>
                        <ul>
                            <li><a href="../connexion.html">Usager</a></li>
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
                    <option value="../index.html" >Accueil</option>
                    <option value="../inscription.html" selected="selected">Inscription</option>
                    <option value="../connexion.html">Usager</option>
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
                    <h1>Administrateur</h1><span class="subheading">Page reservee a un administrateur du systeme</span>
                </div>
                <div class='mh-div'></div>
                <!-- ENDS masthead -->

                <!-- page content -->
                <div id="page-content" class="clearfix">        	


                    <!-- Accordions -->
                    <h4 class="heading">Gerer usagers</h4>
                    <div class="accordion-trigger">Ajouter/Modifier un usager</div>		
                    <div class="accordion-container">
                        </br></br>
                        <!-- form -->
                        <form id="modificationForm" action="GererUsager.php" method="post">

                            <!-- 2 cols -->
                            <div class="left-page-block">

                                <fieldset>

                                    <div>
                                        <input name="nom"  id="nom" type="text" class="form-poshytip" title="Entrez le nom" placeholder="Doe"/>
                                        <label>Nom</label>
                                    </div>
                                    <div>
                                        <input name="prenom"  id="prenom" type="text" class="form-poshytip" title="Entrez le prenom" placeholder="John"/>
                                        <label>Prenom</label>
                                    </div>
                                    <div>
                                        <input name="telephone"  id="telephone" type="text" class="form-poshytip" title="Entrez le numero de telephone" placeholder="000-000-0000"/>
                                        <label>Telephone</label>
                                    </div>
                                    <div>
                                        <input name="email"  id="email" type="email" class="form-poshytip" title="Entrez le courriel" placeholder="johndoe@server.com"/>
                                        <label>Courriel</label>
                                    </div>
                                    <div>									
                                        <input name="password"  id="password" type="password" class="form-poshytip" title="Entrez le mot de passe" />
                                        <label>Mot de passe</label>
                                    </div>
                                    <div>									
                                        <input name="photo"  id="photo" type="file" class="form-poshytip" title="Selectionnez une photo" />
                                        <label>Photo</label>
                                    </div>
                            </div>

                            <div class="right-page-block">
                                <div>
                                    <input name="pays"  id="pays" type="text" class="form-poshytip" title="Entrez le pays de residence" placeholder="Canada"/>
                                    <label>Pays</label>
                                </div>
                                <div>
                                    <input name="province"  id="province" type="text" class="form-poshytip" title="Entrez la province de residence" placeholder="Quebec"/>
                                    <label>Province</label>
                                </div>
                                <div>
                                    <input name="ville"  id="ville" type="text" class="form-poshytip" title="Entrez la ville de residence" placeholder="Montreal"/>
                                    <label>Ville</label>
                                </div>
                                <div>
                                    <input name="numerorue"  id="numerorue" type="text" class="form-poshytip" title="Entrez le numero et la rue de residence" placeholder="000 ste-catherine"/>
                                    <label>Rue</label>
                                </div>
                                <div>
                                    <input name="codepostal"  id="codepostal" type="text" class="form-poshytip" title="Entrez le code postal" placeholder="X0X 0X0"/>
                                    <label>Code Postal</label>
                                </div>
                                <div>
                                    <input name="role"  id="role" type="text" class="form-poshytip" title="Entrez le role" placeholder="usager"/>
                                    <label>Role</label>
                                </div>

                                <p><input type="button" value="Enregistrer" name="submit" id="submit" /> <span id="error" class="warning">Message</span></p>


                                </fieldset>
                            </div>
                            <!-- ENDS 2 cols -->

                        </form>
                        <p id="sent-form-msg" class="success">Modification/ajout reussi !</p>


                    </div>

                    <div class="accordion-trigger">Supprimer un usager</div>		
                    <div class="accordion-container">

                        </br></br>
                        <!-- form -->
                        <form id="suppressionForm" action="SupprimerUser.php" method="post">

                            <!-- 2 cols -->
                            <div class="left-page-block">

                                <fieldset>

                                    <div>
                                        <input name="email"  id="email1" type="email" class="form-poshytip" title="Entrez votre courriel" placeholder="johndoe@server.com"/>
                                        <label>Courriel</label>
                                    </div>
                            </div>

                            <div class="right-page-block">

                                <p><input type="button" value="Enregistrer" name="submit" id="submit" /> <span id="error" class="warning"></span></p>


                                </fieldset>
                            </div>
                            <!-- ENDS 2 cols -->

                        </form>
                        <p id="sent-form-msg2" class="success">Suppression reussi !</p>


                    </div>					
                    <!-- ENDS Accordions -->


                    <div class="block-divider"></div>

                    <!-- Accordions -->
                    <h4 class="heading">Gerer categories</h4>
                    <div class="accordion-trigger">Ajouter/Modifier une categorie</div>		
                    <div class="accordion-container">
                        </br></br>
                        <!-- form -->
                        <form id="categoryForm" action="AjouterCategorie.php" method="post">

                            <!-- 2 cols -->
                            <div class="left-page-block">

                                <fieldset>

                                    <div>
                                        <input name="type"  id="type" type="text" class="form-poshytip" title="Entrez le type" placeholder="Sport"/>
                                        <label>Type</label>
                                    </div>
                                    <div>
                                        <input name="mot1"  id="mot1" type="text" class="form-poshytip" title="Entrez le mot1" />
                                        <label>Mot 1</label>
                                    </div>
                                    <div>
                                        <input name="mot2"  id="mot2" type="text" class="form-poshytip" title="Entrez le mot2" />
                                        <label>Mot 2</label>
                                    </div>
                                    <div>
                                        <input name="mot3"  id="mot3" type="text" class="form-poshytip" title="Entrez le mot3" />
                                        <label>Mot 3</label>
                                    </div>
                                    <div>
                                        <input name="mot4"  id="mot4" type="text" class="form-poshytip" title="Entrez le mot4" />
                                        <label>Mot 4</label>
                                    </div>
                                    <div>
                                        <input name="mot5"  id="mot5" type="text" class="form-poshytip" title="Entrez le mot5" />
                                        <label>Mot 5</label>
                                    </div>
                            </div>

                            <div class="right-page-block">
                                <div>
                                    <input name="mot6"  id="mot6" type="text" class="form-poshytip" title="Entrez le mot6" />
                                    <label>Mot 6</label>
                                </div>
                                <div>
                                    <input name="mot7"  id="mot7" type="text" class="form-poshytip" title="Entrez le mot7" />
                                    <label>Mot 7</label>
                                </div>
                                <div>
                                    <input name="mot8"  id="mot8" type="text" class="form-poshytip" title="Entrez le mot8" />
                                    <label>Mot 8</label>
                                </div>
                                <div>
                                    <input name="mot9"  id="mot9" type="text" class="form-poshytip" title="Entrez le mot9" />
                                    <label>Mot 9</label>
                                </div>
                                <div>
                                    <input name="mot10"  id="mot10" type="text" class="form-poshytip" title="Entrez le mot10" />
                                    <label>Mot 10</label>
                                </div>

                                <p><input type="button" value="Enregistrer" name="submit" id="submit" /> <span id="error" class="warning">Message</span></p>


                                </fieldset>
                            </div>
                            <!-- ENDS 2 cols -->

                        </form>
                        <p id="sent-form-msg3" class="success">Modification/ajout reussi !</p>


                    </div>

                    <div class="accordion-trigger">Supprimer une categorie</div>		
                    <div class="accordion-container">
                        </br></br>
                        <!-- form -->
                        <form id="supcatForm" action="SupprimerCategorie.php" method="post">

                            <!-- 2 cols -->
                            <div class="left-page-block">

                                <fieldset>

                                    <div>
                                        <input name="type"  id="type1" type="text" class="form-poshytip" title="Entrez le type" placeholder="sport"/>
                                        <label>Type de la categorie</label>
                                    </div>
                            </div>

                            <div class="right-page-block">

                                <p><input type="button" value="Enregistrer" name="submit" id="submit" /> <span id="error" class="warning">Message</span></p>


                                </fieldset>
                            </div>
                            <!-- ENDS 2 cols -->

                        </form>
                        <p id="sent-form-msg4" class="success">Suppression reussi !</p>

                    </div>	

                    <div class="block-divider"></div>

                    <h4 class="heading">Statisques</h4>
                    <div class="accordion-trigger">Statistiques</div>		
                    <div class="accordion-container">
                        </br></br>

                        <div class="left-page-block">
                            <h4 class="heading">Statistiques sur les mots cles</h4>
                            <?php
                            require('../SERVICES/SQLfunction.php');

                            $stat_mot_cles = SQLfunction::extraireStatMotCle();

                            foreach ($stat_mot_cles as $value => $nbr) {
                                echo '<p> ' . $value . ' = ' . $nbr . ' </p>';
                            }
                            ?>

                        </div>

                        <div class="right-page-block">
                            <h4 class="heading">Statistiques sur les connexions</h4>
                            <?php
                            $stat_conn = SQLfunction::extraireStatConn();
                            
                            foreach ($stat_conn as $value => $nbr){
                                $nbr = $nbr / 2;
                                echo '<p> ' . $value . ' = ' . $nbr . ' </p>';
                            }
                            ?>

                        </div>




                    </div>					
                    <!-- ENDS Accordions -->
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
