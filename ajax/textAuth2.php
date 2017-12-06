<?php

    require '../db/connect.php';  

    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    $phoneNumber = $_SESSION["PhoneNumber"];
    // generate 4 digit code to be stored in database
    $code = strVal(rand(1,9));
    $code .= strVal(rand(1,9));
    $code .= strVal(rand(1,9));
    $code .= strVal(rand(1,9));
    // end of code generation
    
    date_default_timezone_set("America/Chicago");
    $date = date("Y/m/d h:i:sa");
    $correct = "Y";
    
    echo "Text code correct!"; 
            
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
            
            
            // here
            $submitTextFactor = $conn->prepare("INSERT INTO TextFactor(UserName, CompanyID, PhoneNumber, TextCode, TextDate) ".
                                        "VALUES (:username, :companyID, :phoneNumber, :textCode, :textDate)");
    
            $submitTextFactor->bindValue(':username', $username);
            $submitTextFactor->bindValue(':companyID', $companyID);
            $submitTextFactor->bindValue(':phoneNumber', $phoneNumber);
            $submitTextFactor->bindValue(':textCode', $code);
            $submitTextFactor->bindValue(':textDate', $date);
            $submitTextFactor->execute();

            $submitTextSessionData = $conn->prepare("INSERT INTO TextAnswer(UserName, CompanyID, TextCode, TextAnswerDate, Correct) ".
                                        "VALUES (:username, :companyID, :textCode, :textAnswerDate, :correct)");

            $submitTextSessionData->bindValue(':username', $username);
            $submitTextSessionData->bindValue(':companyID', $companyID);
            $submitTextSessionData->bindValue(':textCode', $code);
            $submitTextSessionData->bindValue(':textAnswerDate', $date);
            $submitTextSessionData->bindValue(':correct', $correct);
            $submitTextSessionData->execute();
?>