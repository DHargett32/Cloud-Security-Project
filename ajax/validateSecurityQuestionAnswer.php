<?php
    
    require '../db/connect.php';
    
    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    $questionGroupID = $_POST['groupID'];
    $answerEntered = $_POST['answerEntered'];

    $getSecurityQuestionAnswer = $conn->prepare(
            "SELECT SecurityQuestionAnswer.Answer FROM SecurityQuestionAnswer "
            ."WHERE SecurityQuestionAnswer.Username = :username "
            ."AND SecurityQuestionAnswer.QuestionGroupID = :questionGroupID "
            ."AND SecurityQuestionAnswer.CompanyID = :companyID "
    );

    $getSecurityQuestionAnswer->bindValue(':username', $username);
    $getSecurityQuestionAnswer->bindValue(':companyID', $companyID);
    $getSecurityQuestionAnswer->bindValue(':questionGroupID', $questionGroupID);

    try {
        $getSecurityQuestionAnswer->execute();
    } catch (Exception $ex) {
        echo $ex;
    }
    
    $r = $getSecurityQuestionAnswer->fetch();
    $QuestionAnswerResult = $r['Answer'];
    
    //check if answer matches database answer
    if($answerEntered === $QuestionAnswerResult)
    {
        echo "Answer Matched!";
        
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
            
    } else {
        echo "Incorrect answer. Please try again.";
    }
    
?>

