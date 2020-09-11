<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    
    <!-- Title Tag -->
    <title>MINESURES<?= $title ?></title>
<!--

November Template

http://www.templatemo.com/tm-473-november

-->
    <!-- <<Mobile Viewport Code>> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            
    <!-- <<Attched Stylesheets>> -->
    <link rel="stylesheet" href="public/november/november/css/print.css" media="print" type="text/css" />
    <link rel="stylesheet" href="public/november/november/css/theme.css" type="text/css" />
    <link rel="stylesheet" href="public/november/november/css/media.css" type="text/css" />
    <link rel="stylesheet" href="public/november/november/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="public/bootstrap-4.0.0-dist/css/bootstrap.min.css" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,600italic,400italic,800,700' rel='stylesheet' type='text/css'>    
    <link rel="stylesheet" type="text/css"  href="public/innova/css/bootstrap.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
    
    <style type="text/css">
        .flash {
            position: fixed;
            border: 1px solid #eee;
            background-color: #fff;
            padding: 15px;
            width: 300px;
            top: 120px;
            right: 30px;
            border-radius: 10px;
            z-index: 1000;
            box-shadow: 2px 2px 2px 0px #eee;
            color: #888;
        }
        .flash h4 {
            margin-top: 0;
            /* color: #fff; */
        }
        .flash h4 #dismiss {
          color: #000;
          font-size: 45px;
        }
        #main {
          margin-top: 105px;
          height: 84vh;
        }
        #form {
            height: 84vh;
            overflow-y: scroll;
        }
        #form-img {
            background-color: #303469;
            background-image: linear-gradient(#303469, #339983);
            height: 84vh;
            font-size: 80px;
            color: #fff;
            font-weight: bold;
            padding-top: 25vh;
        }
        .Navigation .dropdown-menu {
            background-color: rgb(48, 57, 106);
            margin-top: 5px;
        }
        .Navigation .dropdown li {
            height: auto;
            width: 100%;
        }
        .Navigation .dropdown li a {
            padding: 15px 20px;
            color: #fff;
        }
        .Navigation .dropdown li:hover a {
            color: #003;
        }
        <?= isset($styles) ? $styles: '' ?>
    </style>
    <?= isset($links) ? $links: '' ?>
    <script type="text/javascript" src="public/innova/js/jquery.1.11.1.js"></script> 
    <script type="text/javascript" src="public/innova/js/bootstrap.js"></script> 
</head>
<body>
<?php
    echo isset($_SESSION['flash'])? 
      '<div class="flash">
        <h4>Message MINESURES<span class="close pull-right" id="dismiss">&times</span></h4>
        ' . $_SESSION['flash'] . 
      '</div>': '';
    unset($_SESSION['flash']);
   ?>
<!-- \\ Begin Holder \\ -->
<div class="DesignHolder">
	<!-- \\ Begin Frame \\ -->
	<div class="LayoutFrame">
        <!-- \\ Begin Header \\ -->
        <header>
            <div class="Center">
                <div class="site-logo">
                	<h1>
                        <a href="#">Mi<span>ne</span>sures</a>
                    </h1>
                </div>
               <div id="mobile_sec">
               <div class="mobile"><i class="fa fa-bars"></i><i class="fa fa-times"></i></div>
                <div class="menumobile">
                    <!-- \\ Begin Navigation \\ -->
                    <nav class="Navigation">
                        <ul>
                            <li>                                
                                <a href="index.php">Accueil</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>                                
                                <a href="search.php">Recherche</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            
                            <!-- <li>
                                <a href="search.php">Recherche</a>
                                <span class="menu-item-bg"></span>
                            </li> -->
                            <?php
                                if ( ! isset($_SESSION['user'])) {
                                    echo '<li>
                                        <a href="identification.php">Identification</a>
                                        <span class="menu-item-bg"></span>
                                    </li>
                                    <li>
                                        <a href="login.php">Connexion</a>
                                        <span class="menu-item-bg"></span>
                                    </li>';
                                } else {
                                    echo '<li class="dropdown">
                                    <a href="#" class="page-scroll" data-toggle="dropdown">Administration</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="teachers_list.php">Liste des enseignants</a>
                                                        
                                            </li>';
                                        if ($_SESSION['user']['role'] != 'ROLE_TEACHER') {
                                            if ($unvalidated_teachers > 0) {
                                                echo '<li>
                                                    <a href="validate_teachers.php">Validation enseignants</a>
                                                            
                                                </li>';
                                            }

                                            if ($_SESSION['user']['role'] == 'ROLE_SUPER_ADMIN') {
                                                echo '<li>
                                                    <a href="new_admin.php">Ajout admin</a>
                                                </li>';
                                            }
                                        } else {
                                            echo '<li>
                                                <a href="add_competence.php">Ajouter compétence</a>
                                            </li>
                                            <li>
                                                <a href="add_publication.php">Ajouter publication</a>
                                            </li>';
                                        }
                                    
                                    echo '
                                        <li>
                                            <a href="profile.php">Profil</a>
                                        </li>
                                    </ul>
                                    </li>';
                                    echo '<li>
                                        <a href="?logout=1">Déconnexion</a>
                                        <span class="menu-item-bg"></span>
                                    </li>';
                                    
                                }
                            ?>
                            
                        </ul>
                    </nav>
                    <!-- // End Navigation // -->
				</div>
				</div>
                <div class="clear"></div>
            </div>
        </header>
        <?= $content; ?>
        <!-- // End Pricing Section // -->
        <!-- \\ Begin Contact Section \\ -->
        <div class="Contact_sec" id="contact">
            
                <!-- \\ Begin Get Section \\ -->
                <div class="Get_sec">
                    <div class="Mid">					
                        <!-- \\ Begin Left Side \\ -->
                        <div class="Leftside">
                            <form action="#">
                                <fieldset>
                                    <p><input type="text" value="" placeholder="NOM" class="field"></p>
                                    <p><input type="email" value="" placeholder="ADRESSE EMAIL" class="field"></p>
                                    <p><textarea cols="2"  rows="2" placeholder="MESSAGE"></textarea></p>
                                    <p><input type="submit" value="ECRIVEZ-NOUS" class="button"></p>
                                </fieldset>
                            </form>
                        </div>
                        <!-- // End Left Side // -->
                        <!-- \\ Begin Right Side \\ -->
                        <div class="Rightside">
                            <h3>Contactez-nous !</h3>
                                <address>
                                    Commune de Goma, Quartier Katindo, Avenue Masisi N°23,<br>Goma, R.D.Congo.
                                </address>	
                                <address class="Number">
                                    (+243) 971 778 161<br>(+243) 970 070 335
                                </address>	
                                <address class="Email">
                                    <a href="#">info@minesures.com</a>
                                </address>	
                                <div class="clear"></div>
                                <ul>
                                    <li><a href="#"><img src="public/november/november/img/facebook-icn.png" alt="image"></a></li>
                                    <li><a href="#"><img src="public/november/november/img/twitter-icn.png" alt="image"></a></li>
                                    <li><a href="#"><img src="public/november/november/img/google-plus-icn.png" alt="image"></a></li>
                                </ul>
                        </div>
                        <!-- // End Right Side // -->
                    </div>
                    <!-- \\ Begin Footer \\-->
                    <footer>
                        <div class="Cntr">                
                            <p>COPYRIGHT © 2020 MINESURES. DESIGN: @DavCoding</p>
                        </div>
                    </footer>
                    <!-- // End Footer // -->
                </div>
                <!-- // End Get Section // -->
            
            </div>
            <!-- // End Contact Section // -->
        </div>
        <!-- // End Container // -->
	</div>
	<!-- // End Layout Frame // -->
</div>
<!-- // End Design Holder // -->
<div id="loader-wrapper">
<div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>

<!-- <<Attched Javascripts>> -->
<script type="text/javascript" src="public/november/november/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="public/november/november/js/jquery.sudoSlider.min.js"></script>
<script type="text/javascript" src="public/november/november/js/global.js"></script>
<script type="text/javascript" src="public/november/november/js/modernizr.js"></script>
<script type="text/javascript">
  $('#dismiss').click(function() {
    $('.flash').toggle('slow');
  });
  $('a[href="<?= explode('/', $_SERVER['REQUEST_URI'])[2] ?>"]').parent().addClass('active');
</script>
<?= isset($scripts) ? $scripts: '' ?>
</body>
</html>
