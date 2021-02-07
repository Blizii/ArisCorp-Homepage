<?php

/**
 * @author Sebastian Theobald
 * @copyright 2010
 */
 
 function title()
 {
    if(isset($_GET["tab"]))
    {
        $seite = $_GET["tab"];
        switch($seite)
        {
            case "start" :
                echo "ARISCORP - Verse-Exkurs";
                break;
            case "geschichte":
                echo "ARISCORP - Verse-Exkurs - GESCHICHTE";
                break;
            case "uee-regierung" :
                echo "ARISCORP - Verse-Exkurs - UEE REGIERUNG";
                break;
            case "uee-leben" :
                echo "ARISCORP - Verse-Exkurs - UEE LEBEN";
                break;

            case "starmap" : 
                echo "ARISCORP - Verse-Exkurs - STARMAP";
                break;
            case "alienrassen" : 
                echo "ARISCORP - Verse-Exkurs - ALIENRASSEN";
                break;
            case "firmen" : 
                echo "ARISCORP - Verse-Exkurs - FIRMEN";
                break;
        }
    }
    else
    {
        echo "ARISCORP - exkurs";
    }
 }
 
 function print_content()
 {
    if(isset($_GET["tab"]))
    {
        $seite = $_GET["tab"];
        switch($seite)
        {
            case "start" :
                include_once("start.php");
                break;
            case "geschichte" :
                include_once("geschichte.php");
                break;
            case "uee-regierung" :
                include_once("uee-regierung.php");
                break;
            case "uee-leben" :
                include_once("uee-leben.php");
                break;

            case "starmap" :
                include_once("starmap.php");
                break;
            case "alienrassen" :
                include_once("alienrassen.php");
                break;
            case "firmen" :
                include_once("firmen.php");
                break;
        }
    }
    else
    {
        include_once("start.php");
    }
 }
 
 



?>