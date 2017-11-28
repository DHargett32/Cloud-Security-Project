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
        
        // get session data of admin
        $username = "slavett"; //$_SESSION["username"];
        $companyID = "1234"; //$_SESSION["companyID"];
        
        //step 1: delete any existing factors from table
        $deleteFactors = $conn->prepare(
                "DELETE FROM CompanyAuthenticationFactor "
                ."WHERE CompanyAuthenticationFactor.CompanyID = :companyID"
        );
        $deleteFactors->bindValue(':companyID', $companyID);

        $deleteFactors->execute();
        
        //step 2: insert new company factors
        $insertFactors = $conn->prepare(
                "DELETE FROM CompanyAuthenticationFactor "
                ."WHERE CompanyAuthenticationFactor.CompanyID = :companyID"
        );
        $insertFactors->bindValue(':companyID', $companyID);

        $insertFactors->execute();
        
        //date_default_timezone_set("America/Chicago");
        //$createDate = date("Y/m/d h:i:sa");
        $sql['UserClient'] = "INSERT INTO UserClient(UserName, CompanyID, FirstName, LastName, RoleID, Password, Pin, PhoneNumber,  Email, CreateDate) ".
                                             "VALUES(:username, :companyID, :firstname, :lastname, :roleID, :password, :pin, :phoneNumber, :email, :createDate)";

        
        
        //DONT FORGET
        //1. Handle an admin selecting new factors for their company (not the first time)
        
        
        
        
?>

