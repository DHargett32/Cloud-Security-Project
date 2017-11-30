<?php

    require '../db/connect.php';  

    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    
    echo "Call code correct!"; 
            
    //remove the first factor from the string and redirect to that page
    $stringOfFactors = $_SESSION["factors"]; 
    $stringLength = strlen($stringOfFactors);
    if($stringLength > 1) {
        $factorToComplete = $stringOfFactors[0];
        $stringOfFactors = substr($stringOfFactors, 2);
    } else {
        $factorToComplete = $stringOfFactors[0];
    }

    //increment the number of completed factors
    $_SESSION["completedFactors"] = $_SESSION["completedFactors"] + 1;  

    // store the remaining sequence of factorIDs
    $_SESSION["factors"] = $stringOfFactors;

    if($_SESSION["totalFactors"] === $_SESSION["completedFactors"]){ //completed all factors

        echo "^company.php";

    } else { //more factors remain
        //redirect to correct authentication factor
        if($factorToComplete === "1") {
            echo "^securityQuestion.php";
        } else if ($factorToComplete === "2") {
            echo "^pin.php";
        } else if ($factorToComplete === "3") {
            echo "^call.php";
        } else if ($factorToComplete === "4") {
            echo "^puzzle.php";
        } else if ($factorToComplete === "5") {
            echo "^email.php";
        } else {
            echo "^text.php";
        }
    }

?>