<?php
    require '../db/connect.php';  

    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    $enteredPIN = $_POST['enteredPIN'];
    date_default_timezone_set("America/Chicago");
    $date = date("Y/m/d h:i:sa");;
    $isValid = "Y"; // for demo purposes, the code entered will ALWAYS be valid
    $correct = "N";
    
    
    $getUserPIN = $conn->prepare(
                "SELECT UserClient.PIN FROM UserClient "
                ."WHERE UserClient.Username = :username AND UserClient.CompanyID = :companyID"
        );
    
    $getUserPIN->bindValue(':username', $username);
    $getUserPIN->bindValue(':companyID', $companyID);
    
    try {
        $getUserPIN->execute();
    } catch (Exception $ex) {
        echo $ex;
    }
        // get the PIN of the user
        $r = $getUserPIN->fetch();
        $userPINResult = $r['PIN']; 
        
        //check if PIN is correct
        if($enteredPIN === $userPINResult)
        {
            echo "Pin correct!"; 
            $correct = "Y";
            
            
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

        }
        else
        {
            echo "Incorrect pin. Please try again.";
            $correct = "N";
        }
        
        $submitPinFactor = $conn->prepare("INSERT INTO PinFactor(UserName, CompanyID, Pin, PinDate) ".
                                        "VALUES (:username, :companyID, :pin, :pinDate)");
    
        $submitPinFactor->bindValue(':username', $username);
        $submitPinFactor->bindValue(':companyID', $companyID);
        $submitPinFactor->bindValue(':pin', $enteredPIN);
        $submitPinFactor->bindValue(':pinDate', $date);
        $submitPinFactor->execute();

        $submitPinSessionData = $conn->prepare("INSERT INTO PinAnswer(UserName, CompanyID, Pin, PinDate, Correct) ".
                                    "VALUES (:username, :companyID, :pin, :pinDate, :correct)");

        $submitPinSessionData->bindValue(':username', $username);
        $submitPinSessionData->bindValue(':companyID', $companyID);
        $submitPinSessionData->bindValue(':pin', $enteredPIN);
        $submitPinSessionData->bindValue(':pinDate', $date);
        $submitPinSessionData->bindValue(':correct', $correct);
        $submitPinSessionData->execute();
        
        
?>

