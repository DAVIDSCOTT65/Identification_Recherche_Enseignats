<?php
require_once 'boostrap.php';
ob_start();
?>

<!-- // End Header // -->
        <!-- \\ Begin Banner Section \\ -->
        <div class="Banner_sec" id="home">
            <!--  \\ Begin banner Side -->
            <div class="bannerside">
	            <div class="Center">
                    <!--  \\ Begin Left Side -->
                    <div class="leftside">
                        <h3>ENSEIGNEMENT<span>pour tous</span></h3>
                        <p>L'identification des enseignants de l'université est notre point focal</p>
                        <a href="identification.php">PLUS SUR NOUS</a>
                        <?php isset($_SESSION['id'])? var_dump($_SESSION['id']): '' ?>
                    </div>                        								
                    <!--  // End Left Side // -->
                    <!--  \\ Begin Right Side -->
                    <div class="rightside">
                    	<ul id="slider">	
                    		<li>
                                <div class="Slider">
                                    <figure><img src="public/november/november/img/3.jpg" alt="image"></figure>
                                    <div class="text">
                                        <div class="Icon">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-heart"></i>17</a></li>
                                                <li><a href="#"><i class="fa fa-commenting"></i>3</a></li>
                                            </ul>	
                                        </div>                        								
                                        <div class="Lorem">
                                            <p>L'enseignement<span>Est un art</span></p>
                                        </div>
                                    </div>
                                </div>
							</li>
                    		<li>
                                <div class="Slider">
                                    <figure><img src="public/november/november/img/2.jpg" alt="image"></figure>
                                    <div class="text">
                                        <div class="Icon">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-heart"></i>243</a></li>
                                                <li class="num"><a href="#"><i class="fa fa-commenting"></i>158</a></li>
                                            </ul>	
                                        </div>                        								
                                        <div class="Lorem">
                                            <p>L'identification<span>rend public</span></p>
                                        </div>
                                    </div>
                                </div>
							</li>
						</ul>                                                            
            	        <figure><img src="public/november/november/img/Shadow-img.png" alt="image" class="Shadow"></figure>                                                        
                    </div>
                    <!--  // End Right Side // -->
	            </div>
            </div>
            <!--  // End banner Side // -->
            <div class="clear"></div>
        </div>
        <!-- // End Banner Section // -->
         <div class="bgcolor"></div>
        <!-- \\ Begin Container \\ -->
        <div id="Container">
            <!-- \\ Begin About Section \\ -->
            <div class="About_sec" id="about">
                <div class="Center">            	
                    <h2>A PROPOS DE NOUS</h2>            		
                    <p>Nous sommes une organisation étatique, centré sur le domaine de l'enseignement<br> Nous travaillons de avec le ministère national pour rendre l'enseignement meilleur en RDCongo.</p>
                    <div class="Line"></div>	
                    <!-- \\ Begin Tab side \\ -->
                           
                    <!-- // End Tab Side // -->
                </div>
            </div>
            <!-- // End About Section // -->
        <!-- \\ Begin Services Section \\ -->
        <div class="Services_sec" id="services">
            <div class="Center">
                <h2>ETENDUE</h2>
                
                <!-- \\ Begin Services Side  \\ -->
                <div class="Serviceside">
                    <ul>
	                    <li class="Development"><a href="#services"><h4>PRIMAIRE</h4></a></li>
	                    <li class="Concept"><a href="#services"><h4>SECONDAIRE</h4></a></li>
                        <li class="System"><a href="#services"><h4>UNIVERSITAIRE</h4></a></li>
                        <li class="Desdin"><a href="#services"><h4>PROFESSIONNEL</h4></a></li>
                    </ul>
                </div>
                <!-- // End Services Side // -->
            </div>                
        </div>
        <!-- // End Services Section // -->
        

<?php

$content = ob_get_clean();
$title = ' - Accueil';
$styles = '#about { background: #fff; }
    header .intro-text { padding-top: 150px; padding-bottom: 50px; }';

require  'template.php';
