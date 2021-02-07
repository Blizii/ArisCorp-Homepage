<?php
    include_once("https://www.ariscorp.de/php/includes/exkurs/functions.inc.php");
?>
<html>
    <head>
        <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="author" content="AtypicalThemes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- WEBSITE TITLE & DESCRIPTION -->
    <title>ARISCORP - VERSE EXCURS</title>
    <meta name="description" content="ARISCORP - VERSE EXCURS">
    <meta name="keywords" content="sc, starcitizen, organisation, orga, aris, ariscorp, sc-orga">

    <!-- OG meta tags that improve the look of your post on social media -->
    <meta property="og:site_name" content="ArisCorp Homepage" /><!--website name-->
    <meta property="og:site" content="" /> <!--website link-->
    <meta property="og:title" content="ARISCORP"/> <!--Post title-->
    <meta property="og:description" content="ASTRO RESEARCH AND INDUSTRIAL SERVICE CORP." /> <!--Post description-->
    <meta property="og:image" content="" /><!-- Image link (jpg only)-->
    <meta property="og:url" content="" /> <!--where do you want your post to link to-->
    <meta property="og:type" content="article" />

    <!-- Favicon and Apple Icons -->
    <link rel="icon" type="image/png" sizes="175x175" href="https://www.ariscorp.de/assets/img/favicon/favicon-aris-175x175.png">
<!--<link rel="apple-touch-icon" sizes="57x57" href="../images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">-->

    <!-- STYLES -->
    <!-- Time Stylesheet -->
    <link href="https://www.ariscorp.de/assets/css/tima.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://www.ariscorp.de/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://www.ariscorp.de/assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animations -->
    <link href="https://www.ariscorp.de/assets/css/animations.css" rel="stylesheet">
    <!-- Lightbox -->
    <link href="https://www.ariscorp.de/assets/css/lightbox.min.css" rel="stylesheet">
    <!-- Video Lightbox -->
    <link href="https://www.ariscorp.de/assets/css/modal-video.min.css" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link href="https://www.ariscorp.de/assets/css/styli.css" rel="stylesheet">
    <!-- Starmap Stylesheet -->
    <link href="https://www.ariscorp.de/assets/css/starmap.css" rel="stylesheet">

    <link href="https://www.ariscorp.de/assets/css/zozo.tabs.min.css" rel="stylesheet">
    <link href="https://www.ariscorp.de/assets/css/zozo.tabs.flat.min.css" rel="stylesheet">
    <script src="https://www.ariscorp.de/assets/js/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://zozoui.com/js/google-analytics.min.js"></script>
    </head>
    <body>

        <!-- //// HEADER INCLUDE //// -->
            <?php include('https://www.ariscorp.de/php/includes/header.php'); ?>
        <!-- //// END HEADER INCLUDE //// -->

        <!-- /// Main Container /// -->
    <div class="container">

<!-- /// EXCURS SECTION /// -->

<div id="excurs" class='large-margin'>
    <a href="excurs"></a><!-- Nav Anchor -->
    <div class="row heading tiny-margin">
    </div>
    <div class="row medium-margin tab-manifesto">

        <div class="tab">
            <button class="tablinks" onclick="location.href='?tab=start'"><img src="https://www.ariscorp.de/assets/img/excurs/util/ARISBannerVerseExkurs.webp" alt="" width="100%" height="auto"></button> <br> <br> <br> <br>
            <button class="tablinks" onclick="location.href='?tab=geschichte'"><h1 style="float: left; color: <?php echo "$colorh"; ?>"><span class="coloredwhite" style="font-size: unset;">G</span>ESCHICHTE</h1></button>
            <button class="tablinks" onclick="location.href='?tab=uee-regierung'"><h1 style="float: left; color: <?php print_r($colorr); ?>"><span class="coloredwhite" style="font-size: unset;">U</span>EE-REGIERUNG</h1></button>
            <button class="tablinks" onclick="location.href='?tab=uee-leben'"><h1 style="float: left; color: <?php print_r($colorl); ?>"><span class="coloredwhite" style="font-size: unset;">L</span>EBEN IM UEE</h1></button>

            <button class="tablinks" onclick="location.href='?tab=starmap'"><h1 style="float: left; color: <?php print_r($colorm); ?>"><span class="coloredwhite" style="font-size: unset;">A</span>RK-STARMAP</h1></button>
            <button class="tablinks" onclick="location.href='?tab=alienrassen'"><h1 style="float: left; color: <?php print_r($colora); ?>"><span class="coloredwhite" style="font-size: unset;">A</span>LIENRASSEN</h1></button>
            <button class="tablinks" onclick="location.href='?tab=firmen'"><h1 style="float: left; color: <?php print_r($colorf); ?>"><span class="coloredwhite" style="font-size: unset;">F</span>IRMEN</h1></button>
            <button class="tablinks" onclick="location.href='?tab=technologien'"><h1 style="float: left; color: <?php print_r($colort); ?>"><span class="coloredwhite" style="font-size: unset;">T</span>ECHNOLOGIEN</h1></button>
        </div>
        </div>
        
            <div class=""><?php print_content(); ?></div>
        </div>
        </div>
        </div>
        </div>
        <!-- /// CONTACT SECTION /// -->
    </div><!-- Main Container End -->


    
                
    <!-- /// FOOTER INCLUDE /// -->
        <?php include('https://www.ariscorp.de/php/includes/footer.php'); ?>
    <!-- /// END FOOTER INCLUDE /// -->


    <!-- //// SCRIPTS //// -->
    <script src="https://www.ariscorp.de/assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/popper.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/bootstrap.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/blazy.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/isotope.pkgd.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/lightbox.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/jquery-modal-video.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/validator.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/strider.js"></script>

    <!-- /// EXCURS FUNCTIONS INCLUDE /// -->
    <?php include('https://www.ariscorp.de/php/includes/exkurs/excurs.php'); ?>
    <!-- /// END EXCURS FUNCTIONS INCLUDE /// -->
</html>