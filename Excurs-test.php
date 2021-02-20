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





            <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Orders</a></li>
                <li><a href="?gn=employees">Employees</a></li>
                <li><a href="?gn=products">Products</a></li>
                <li><a href="?gn=customers">Customers</a></li>
                <li><a href="?gn=suppliers">Suppliers</a></li>
            </ul>

            <div id="tabs-1" style="padding:0">
        <?php
        echo $grid;
        ?>
    </div>
        </div>












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



<script>
// IIFE
(function($) {

// Define Plugin
$.organicTabs = function(el, options) {

    // JavaScript native version of this
var base = this;

// jQuery version of this
base.$el = $(el);

// Navigation for current selector passed to plugin
base.$nav = base.$el.find(".nav");

// Runs once when plugin called       
base.init = function() {

        // Pull in arguments
    base.options = $.extend({},$.organicTabs.defaultOptions, options);
                
    // Accessible hiding fix (hmmm, re-look at this, screen readers still run JS)
    $(".hide").css({
        "position": "relative",
        "top": 0,
        "left": 0,
        "display": "none"
    }); 
    
    // When navigation tab is clicked...
    base.$nav.delegate("a", "click", function(e) {
    
            // no hash links
            e.preventDefault();
    
        // Figure out current list via CSS class
        var curList = base.$el.find("a.current").attr("href").substring(1),
        
        // List moving to
            $newList = $(this),
            
        // Figure out ID of new list
            listID = $newList.attr("href").substring(1),
        
        // Set outer wrapper height to (static) height of current inner list
            $allListWrap = base.$el.find(".list-wrap"),
            curListHeight = $allListWrap.height();
                $allListWrap.height(curListHeight);
                                
        if ((listID != curList) && ( base.$el.find(":animated").length == 0)) {
                                    
            // Fade out current list
            base.$el.find("#"+curList).fadeOut(base.options.speed, function() {
                
                // Fade in new list on callback
                base.$el.find("#"+listID).fadeIn(base.options.speed);
                
                // Adjust outer wrapper to fit new list snuggly
                var newHeight = base.$el.find("#"+listID).height();
                $allListWrap.animate({
                    height: newHeight
                }, base.options.speed);
                
                // Remove highlighting - Add to just-clicked tab
                base.$el.find(".nav li a").removeClass("current");
                $newList.addClass("current");
                
                                        // Change window location to add URL params
                                        if (window.history && history.pushState) {
                                          // NOTE: doesn't take into account existing params
                                            history.replaceState("", "", "?" + base.options.param + "=" + listID);
                                        }    
            });
            
        }   

    });
    
    var queryString = {};
                window.location.href.replace(
                    new RegExp("([^?=&]+)(=([^&]*))?", "g"),
                    function($0, $1, $2, $3) { queryString[$1] = $3; }
                );
    
    if (queryString[base.options.param]) {
    
        var tab = $("a[href='#" + queryString[base.options.param] + "']");
    
                    tab
                        .closest(".nav")
                        .find("a")
                        .removeClass("current")
                        .end()
                        .next(".list-wrap")
                        .find("ul")
                        .hide();
                    tab.addClass("current");
                    $("#" + queryString[base.options.param]).show();
                
            };            
    
};
base.init();
};

$.organicTabs.defaultOptions = {
    "speed": 300,
    "param": "tab"
};

$.fn.organicTabs = function(options) {
return this.each(function() {
    (new $.organicTabs(this, options));
});
};

})(jQuery);
</script>

<style>
/* Generic Utility */
.hide { position: absolute; top: -9999px; left: -9999px; }


/* Specific to example one */

#example-one { background: #eee; padding: 10px; margin: 0 0 20px 0; -moz-box-shadow: 0 0 5px #666; -webkit-box-shadow: 0 0 5px #666; }

#example-one .nav { overflow: hidden; margin: 0 0 10px 0; }
#example-one .nav li { width: 97px; float: left; margin: 0 10px 0 0; }
#example-one .nav li.last { margin-right: 0; }
#example-one .nav li a { display: block; padding: 5px; background: #959290; color: white; font-size: 10px; text-align: center; border: 0; }
#example-one .nav li a:hover { background-color: #111; }

#example-one ul { list-style: none; }
#example-one ul li a { display: block; border-bottom: 1px solid #666; padding: 4px; color: #666; }
#example-one ul li a:hover { background: #fe4902; color: white; }
#example-one ul li:last-child a { border: none; }

#example-one ul li.nav-one a.current, #example-one ul#featured li a:hover { background-color: #0575f4; color: white; }
#example-one ul li.nav-two a.current, #example-one ul#core li a:hover { background-color: #d30000; color: white; }
#example-one ul li.nav-three a.current, #example-one ul#jquerytuts li a:hover { background-color: #8d01b0; color: white; }
#example-one ul li.nav-four a.current, #example-one ul#classics li a:hover { background-color: #FE4902; color: white; }



/* Specific to example two */

#example-two .list-wrap { background: #eee; padding: 10px; margin: 0 0 15px 0; }

#example-two ul { list-style: none; }
#example-two ul li a { display: block; border-bottom: 1px solid #666; padding: 4px; color: #666; }
#example-two ul li a:hover { background: #333; color: white; }
#example-two ul li:last-child a { border: none; }

#example-two .nav { overflow: hidden; }
#example-two .nav li { width: 97px; float: left; margin: 0 10px 0 0; }
#example-two .nav li.last { margin-right: 0; }
#example-two .nav li a { display: block; padding: 5px; background: #666; color: white; font-size: 10px; text-align: center; border: 0; }

#example-two li a.current,#example-two li a.current:hover { background-color: #eee !important; color: black; }
#example-two .nav li a:hover, #example-two .nav li a:focus { background: #999;}
</style>
    
</html>