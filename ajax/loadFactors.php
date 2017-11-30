<?php

    require '../db/connect.php';  
    
    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    
    //step 1: run query to get existing company factors
    $loadFactors = $conn->prepare(
                "SELECT * FROM CompanyAuthenticationFactor caf "
                ."WHERE caf.CompanyID = :companyID"
        );
    
    $loadFactors->bindValue(':companyID', $companyID);

    $loadFactors->execute();
        
    //get count of rows
    $numRowsloadFactors = count($loadFactors->fetchAll());

    // check if the company has any existing factors set
    if($numRowsloadFactors != 0 && $numRowsloadFactors != NULL)   //company has factors exist
    {

        //step 2: put a check in the checkboxes for the existing company factors
        // re-execute the query to "re-fill" the results
        $loadFactors->execute();
        
        //array of existing factors
        $factorIDs = [];
        
        //temp variables used in loops
        $count = 0;
        $count2 = 0;
        
        //a string of existing factorIDs
        $stringOfFactors = "";
        
        //get each existing factor
        while($r = $loadFactors->fetch()){
            $tempfactorID = $r['FactorID'];
            $factorIDs[$count] = $tempfactorID; 
            $count = $count + 1;
        }
        
        //get a string of existing factors with delimiter
        if ($count === 1) {
            $stringOfFactors = $stringOfFactors . $factorIDs[0];
        } else {
            while($count2 < $count){
                if(($count - $count2) === 1){ //no comma if last factor
                    $stringOfFactors = $stringOfFactors . $factorIDs[$count2];
                    $count2 = $count2 + 1;
                } else {
                     $stringOfFactors = $stringOfFactors . $factorIDs[$count2] . ",";
                     $count2 = $count2 + 1;
                }
               
            }
        }
        
        $stringOfFactors = $stringOfFactors . "^";
        
        echo $stringOfFactors;
        
        echo "Your company has existing authentication factors. Please update the list from below.";
        
        //NOTE: In Database, our factorID's are as follows:
        //1 - Security Questions
        //2 - PIN
        //3 - Phone Call
        //4 - Puzzles
        //5 - Email
        //6 - Text Message
        //7 - Biometrics
        
    } else {        //company does not have any existing factors set
       echo "Your company does not have any existing authentication factors. Please set some from the list below.";
    }
    
?>