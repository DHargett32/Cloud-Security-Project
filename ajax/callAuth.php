<?php
    require '../db/connect.php';  
    
    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    
    $getUserPhoneNumber = $conn->prepare(
                "SELECT UserClient.PhoneNumber FROM UserClient "
                ."WHERE UserClient.Username = :username AND UserClient.CompanyID = :companyID"
        );
    
    $getUserPhoneNumber->bindValue(':username', $username);
    $getUserPhoneNumber->bindValue(':companyID', $companyID);
    
    try {
        $getUserPhoneNumber->execute();
    } catch (Exception $ex) {
        echo $ex;
    }
    
    
    //$numRowsgetUserEmail = count($getUserEmail->fetchAll());
    
    //if($numRowsgetUserEmail != 0)
    //{
        // get the email address of the user
        $r = $getUserPhoneNumber->fetch();
        $phoneNumberResult = $r['PhoneNumber']; 
        // return the email address to the javascript file
        echo $phoneNumberResult;
    //}
?>