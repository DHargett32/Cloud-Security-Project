<?php

        // require the 'connect.php' file to connect to the database
        require '../db/connect.php';

        // set variables
        $securityQuestions = $_POST['securityQuestionsIsSet'];
        $puzzle = $_POST['puzzleIsSet'];
        $email = $_POST['emailIsSet']; 
        $phoneCall = $_POST['phoneCallIsSet'];
        $textMessage = $_POST['textMessageIsSet'];
        $pin = $_POST['pinIsSet']; 
        
        //get session info of current admin
        session_start();

        // Accessing session data if needed
        //echo 'Hi, ', $_SESSION["username"], " of companyID ", $_SESSION["companyID"];
        
        //DONT FORGET
        //1. Handle an admin selecting new factors for their company (not the first time)
        
        
        
        
?>

