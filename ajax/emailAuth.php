<?php
    require '../db/connect.php';  
    
    //start a session 
    session_start();
    
    $username = $_SESSION["username"];
    $companyID = $_SESSION["companyID"];
    
    $getUserEmail = $conn->prepare(
                "SELECT UserClient.Email FROM UserClient "
                ."WHERE UserClient.Username = :username AND UserClient.CompanyID = :companyID"
        );
    
    $getUserEmail->bindValue(':username', $username);
    $getUserEmail->bindValue(':companyID', $companyID);
    
    try {
        $getUserEmail->execute();
    } catch (Exception $ex) {
        echo $ex;
    }
    
    
    //$numRowsgetUserEmail = count($getUserEmail->fetchAll());
    
    //if($numRowsgetUserEmail != 0)
    //{
        // get the email address of the user
        $r = $getUserEmail->fetch();
        $emailResult = $r['Email']; 
        // return the email address to the javascript file
        echo $emailResult;
    //}
?>

