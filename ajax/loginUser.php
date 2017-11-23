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
        //[add] num of factors needed to complete
        //[add] num of factors completed
        
        //we have a total of 7 authentication factors
        //using sessions to create a series of factors they have to solve
        //string nums 1-7, go through and parse one at a time
        //say we had 1,3,5,and7
        //just have one string with 1,3,5,7 (delimited by something)
        //and as you go through each authentication factor, you just pop the front one off and restore the string
        //or could use file name or authentication name
        
        

        //Steps: Check username, password, and companyID combination 
        //              - if exists: 
        //                      -- (1) is user? 
        //                              --- begin series of company authentication factors
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

            
            // check user role
            if($roleID == 1) //role is (1) user, redirect and begin series of authentication factors
            {
                
                echo "Welcome ", $user, "! You are a user. Please authenticate yourself through the following set of factors.";
                
            } else {    //role is (2) admin, redirect to authentication factors page
                
                echo "Welcome ", $user, "! You are an admin. Please select the set of authentication factors your company desires to use.";
                echo "^factors.php"; //redirect to factors page. include "^" delimiter
                
                
                //in the future, we would probably switch to sessions? I'm not sure if this changes anything 
            }
            
        } else {    //username, password, and companyID combination does not exist! (or fields were left empty)
            
            echo "Sorry! Username, Password, or Company ID is incorrect.";
            
        }
        
        
?>