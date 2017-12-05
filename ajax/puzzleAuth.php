<?php

    require '../db/connect.php';    

    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    $CaptchaAnswer = $_POST['CaptchaAnswer'];
    $CaptchaText = $_POST['CaptchaText'];
    $correct = "N";
    date_default_timezone_set("America/Chicago");
    $date = date("Y/m/d h:i:sa");;

    $submitPuzzleSessionData = $conn->prepare("INSERT INTO PuzzleAnswer(UserName, CompanyID, AnswerText, PuzzleAnswerDate, Correct) ".
                                              "VALUES (:username, :companyID, :answerText, :puzzleAnswerDate, :correct)");



    //check if puzzle is correct
    if($CaptchaText === $CaptchaAnswer)
    {
        echo "Puzzle correct!";
        
        // answer is correct
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
        echo "Incorrect answer. Please try again.";        
    }

    $submitPuzzleSessionData->bindValue(':username', $username);
    $submitPuzzleSessionData->bindValue(':companyID', $companyID);
    $submitPuzzleSessionData->bindValue(':answerText', $CaptchaAnswer);
    $submitPuzzleSessionData->bindValue(':puzzleAnswerDate', $date);
    $submitPuzzleSessionData->bindValue(':correct', $correct);
   
    // send authentication factor data to the database
    $submitPuzzleSessionData->execute();
?>

