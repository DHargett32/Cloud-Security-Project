<?php
    require '../db/connect.php';  
    
    $username = $_POST['username']; //"dhargett";//
    $companyID = $_POST['companyID'];//"1234";
    $enteredPIN = $_POST['enteredPIN'];
    
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
        
        
        // return the users PIN to the javascript file
        echo $userPINResult;
?>

