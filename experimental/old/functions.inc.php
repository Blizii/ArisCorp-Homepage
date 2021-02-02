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
            case "exkurs" :
                echo "ARISCORP - exkurs";
                break;
            case "geschichte":
                echo "geschichte - Mestre";
                break;
            case "map" :
                echo "map - Mestre";
                break;
            case "kontakt" :
                echo "Kontakt - Mestre";
                break;
            case "impressum" : 
                echo "Impressum - Mestre";
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
            case "exkurs" :
                include_once("def.php");
                break;
            case "geschichte" :
                include_once("geschichte.php");
                break;
            case "map" :
                include_once("map.php");
                break;
            case "kontakt" :
                include_once("kontakt.htm");
                break;
            case "impressum" :
                include_once("impressum.htm");
                break;
        }
    }
    else
    {
        include_once("def.php");
    }
 }
 
 



?>