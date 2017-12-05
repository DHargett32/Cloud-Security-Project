<?php

        // require the 'connect.php' file to connect to the database
        require '../db/connect.php';

        // set variables
        $username = $_POST['inputUsername'];
        $password = $_POST['inputPassword'];
        $companyID = $_POST['inputCompanyID']; 
        
        //start a session 
        session_start();
 
        // Storing session data
        $_SESSION["username"] = $username;
        $_SESSION["companyID"] = $companyID;
        
        //Steps: Check username, password, and companyID combination 
        //              - if exists: 
        //                      -- (1) is user? 
        //                              --- begin series of factors if admin has set some 
        //                              --- output message and go no further if admin has not set any factors 
        //                      -- (2) is admin?
        //                              --- allow company authentication factor selection
        //              - if not exists: output an alert
        
        
        //step 1: check username, password, and companyID combination
        $checkUserExists = $conn->prepare(
                "SELECT UserClient.username, UserClient.companyID, UserClient.roleID FROM UserClient "
                . "WHERE UserClient.username = :username AND UserClient.password = :password AND UserClient.companyID = :companyID"
        );
        
        // Bind values
        $checkUserExists->bindValue(':username', $username);
        $checkUserExists->bindValue(':password', $password);
        $checkUserExists->bindValue(':companyID', $companyID);
        
        // Run query checking if user exists
        $checkUserExists->execute();
        
        //get count of rows
        $numRowsUserExists = count($checkUserExists->fetchAll());
        
        // check if the user exists in current records
        if($numRowsUserExists != 0 && $numRowsUserExists != NULL)   //user exists
        {
            
            //step 2: check if existing user has role (1) user or (2) admin
            // re-execute the query to "re-fill" the results
            $checkUserExists->execute();
            $r = $checkUserExists->fetch();
            
            // look at the role property (should be the only row returned)
            $roleID = $r['roleID'];
            //echo $roleID;
            
            // Storing session data
            $_SESSION["roleID"] = $roleID;
            
            //get other variables for session (passing variables through session...might need these later)
            $user = $r['username'];
            $compID = $r['companyID'];
            //echo $user;
            //echo $compID;

            // Query to retrieve additional data related to the user
            $getUserDetails = $conn->prepare(
                "SELECT UserClient.Email, UserClient.PhoneNumber, UserClient.Pin FROM UserClient "
                . "WHERE UserClient.username = :username AND UserClient.password = :password AND UserClient.companyID = :companyID"
            );

            // Bind values
            $getUserDetails->bindValue(':username', $username);
            $getUserDetails->bindValue(':password', $password);
            $getUserDetails->bindValue(':companyID', $companyID);

            $getUserDetails->execute();
            $d = $getUserDetails->fetch();

            $_SESSION["Email"] = $d['Email'];
            $_SESSION["PhoneNumber"] = $d['PhoneNumber'];
            $_SESSION["Pin"] = $d['Pin'];



            
            // check user role
            if($roleID == 1) //role is (1) user, redirect and begin series of authentication factors
            {
                
                //step 3: get the total number of authentication factors for this company (if any exist)
                $getNumberOfFactors = $conn->prepare(
                "SELECT * FROM CompanyAuthenticationFactor "
                . "WHERE CompanyAuthenticationFactor.CompanyID = :companyID"
                );

                // Bind values
                $getNumberOfFactors->bindValue(':companyID', $companyID);

                // Run query checking if any factors are set
                $getNumberOfFactors->execute();

                //get count of rows
                $numRowsNumberOfFactors = count($getNumberOfFactors->fetchAll());
                
                if($numRowsNumberOfFactors != 0 && $numRowsNumberOfFactors != NULL) {    //factors exist
                    
                    // Storing session data (total number of factors to complete, and total number of factors completed)
                    $_SESSION["totalFactors"] = $numRowsNumberOfFactors;
                    $_SESSION["completedFactors"] = 0;
                    
                    // re-execute the query to "re-fill" the results
                    $getNumberOfFactors->execute();
                    
                    //array of existing factors
                    $factorIDs = [];

                    //temp variables used in loops
                    $count = 0;
                    $count2 = 0;

                    //a string of existing factorIDs
                    $stringOfFactors = "";

                    //get each existing factor
                    while($r = $getNumberOfFactors->fetch()){
                        $tempfactorID = $r['FactorID'];
                        $factorIDs[$count] = $tempfactorID; 
                        $count = $count + 1;
                    }
                    
                    //shuffle the order of factors to complete
                    shuffle($factorIDs);

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

                    
                    //remove the first factor from the string and redirect to that page
                    $stringLength = strlen($stringOfFactors);
                    if($stringLength > 1) {
                        $firstFactorToComplete = $stringOfFactors[0];
                        $stringOfFactors = substr($stringOfFactors, 2);
                    } else {
                        $firstFactorToComplete = $stringOfFactors[0];
                    }
                    
                    // store the sequence of factorIDs
                    $_SESSION["factors"] = $stringOfFactors;
                    
                    //NOTE: In Database, our factorID's are as follows:
                    //1 - Security Questions
                    //2 - PIN
                    //3 - Phone Call
                    //4 - Puzzles
                    //5 - Email
                    //6 - Text Message
                    //7 - Biometrics
                    
                    echo "Welcome ", $user, "! Please authenticate yourself through the factors your company has set up.";
                    
                    //redirect to correct authentication factor
                    if($firstFactorToComplete === "1") {
                        echo "^securityQuestion.php";
                    } else if ($firstFactorToComplete === "2") {
                        echo "^pin.php";
                    } else if ($firstFactorToComplete === "3") {
                        echo "^call.php";
                    } else if ($firstFactorToComplete === "4") {
                        echo "^puzzle.php";
                    } else if ($firstFactorToComplete === "5") {
                        echo "^email.php";
                    } else {
                        echo "^text.php";
                    }
                    
                } else {        //no factors exist
                    
                    echo "Welcome ", $user, "! Sorry, it appears your company admin(s) has not set up any authentication factors yet. Please "
                            . "try again later.";
                    
                }
                
            } else {    //role is (2) admin, redirect to authentication factors page
                
                echo "Welcome ", $user, "! You are an admin.";
                echo "^factors.php"; //redirect to factors page. include "^" delimiter
                
                
                //in the future, we would probably switch to sessions? I'm not sure if this changes anything 
            }
            
        } else {    //username, password, and companyID combination does not exist! (or fields were left empty)
            
            echo "Sorry! Username, Password, or Company ID is incorrect.";
            
        }
        
        
?>