<?php

    require '../db/connect.php';  

    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    $email = $_SESSION["Email"];
    // generate 4 digit code to be stored in database
    $code = strVal(rand(1,9));
    $code .= strVal(rand(1,9));
    $code .= strVal(rand(1,9));
    $code .= strVal(rand(1,9));
    // end of code generation
    
    date_default_timezone_set("America/Chicago");
    $date = date("Y/m/d h:i:sa");
    $isValid = "Y"; // for demo purposes, the code entered will ALWAYS be valid

    $submitEmailFactor = $conn->prepare("INSERT INTO EmailFactor(UserName, CompanyID, Email, Code) ".
                                        "VALUES (:username, :companyID, :email, :code)");
    
    $submitEmailFactor->bindValue(':username', $username);
    $submitEmailFactor->bindValue(':companyID', $companyID);
    $submitEmailFactor->bindValue(':email', $email);
    $submitEmailFactor->bindValue(':code', $code);
    $submitEmailFactor->execute();
    
    $submitEmailSessionData = $conn->prepare("INSERT INTO EmailValidation(UserName, CompanyID, Email, Code, EmailValidationDate, IsValid) ".
                                              "VALUES (:username, :companyID, :email, :code, :emailValidationDate, :isValid)");

    // Bind values
    $submitEmailSessionData->bindValue(':username', $username);
    $submitEmailSessionData->bindValue(':companyID', $companyID);
    $submitEmailSessionData->bindValue(':email', $email);
    $submitEmailSessionData->bindValue(':code', $code);
    $submitEmailSessionData->bindValue(':emailValidationDate', $date);
    $submitEmailSessionData->bindValue(':isValid', $isValid);
    $submitEmailSessionData->execute();


    echo "Email code correct!"; 
            
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