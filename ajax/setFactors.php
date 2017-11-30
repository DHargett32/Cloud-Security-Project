<?php

        // require the 'connect.php' file to connect to the database
        require '../db/connect.php';
        
        //NOTE: In Database, our factorID's are as follows:
        //1 - Security Questions
        //2 - PIN
        //3 - Phone Call
        //4 - Puzzles
        //5 - Email
        //6 - Text Message
        //7 - Biometrics

        // set variables
        $securityQuestions = $_POST['securityQuestionsIsSet'];
        $puzzle = $_POST['puzzleIsSet'];
        $email = $_POST['emailIsSet']; 
        $phoneCall = $_POST['phoneCallIsSet'];
        $textMessage = $_POST['textMessageIsSet'];
        $pin = $_POST['pinIsSet']; 
        
        //get session info of current admin
        session_start();
        
        //session variables
        $username = $_SESSION["username"];
        $companyID = $_SESSION["companyID"];
        
        //step 1: delete any existing factors from table
        $deleteFactors = $conn->prepare(
                "DELETE FROM CompanyAuthenticationFactor "
                ."WHERE CompanyAuthenticationFactor.CompanyID = :companyID"
        );
        $deleteFactors->bindValue(':companyID', $companyID);

        $deleteFactors->execute();
        
        //step 2: insert new company factors
        
        date_default_timezone_set("America/Chicago");
        $createDate = date("Y/m/d h:i:sa");
        
        if($securityQuestions === "true"){  //1
            $insertFactors1 = $conn->prepare(
                "INSERT INTO CompanyAuthenticationFactor(CompanyID, FactorID, CreateDate) ".
                "VALUES(:companyID, :factorID, :createDate)"
            );
            $insertFactors1->bindValue(':companyID', $companyID);
            $insertFactors1->bindValue(':factorID', 1);
            $insertFactors1->bindValue(':createDate', $createDate);

            $insertFactors1->execute();
        }
        if($pin === "true"){                //2
            $insertFactors2 = $conn->prepare(
                "INSERT INTO CompanyAuthenticationFactor(CompanyID, FactorID, CreateDate) ".
                "VALUES(:companyID, :factorID, :createDate)"
            );
            $insertFactors2->bindValue(':companyID', $companyID);
            $insertFactors2->bindValue(':factorID', 2);
            $insertFactors2->bindValue(':createDate', $createDate);

            $insertFactors2->execute();
        }
        if($phoneCall === "true"){          //3
            $insertFactors3 = $conn->prepare(
                "INSERT INTO CompanyAuthenticationFactor(CompanyID, FactorID, CreateDate) ".
                "VALUES(:companyID, :factorID, :createDate)"
            );
            $insertFactors3->bindValue(':companyID', $companyID);
            $insertFactors3->bindValue(':factorID', 3);
            $insertFactors3->bindValue(':createDate', $createDate);

            $insertFactors3->execute();
        }
        if($puzzle === "true"){             //4
            $insertFactors4 = $conn->prepare(
                "INSERT INTO CompanyAuthenticationFactor(CompanyID, FactorID, CreateDate) ".
                "VALUES(:companyID, :factorID, :createDate)"
            );
            $insertFactors4->bindValue(':companyID', $companyID);
            $insertFactors4->bindValue(':factorID', 4);
            $insertFactors4->bindValue(':createDate', $createDate);

            $insertFactors4->execute();
        }
        if($email === "true"){              //5
            $insertFactors5 = $conn->prepare(
                "INSERT INTO CompanyAuthenticationFactor(CompanyID, FactorID, CreateDate) ".
                "VALUES(:companyID, :factorID, :createDate)"
            );
            $insertFactors5->bindValue(':companyID', $companyID);
            $insertFactors5->bindValue(':factorID', 5);
            $insertFactors5->bindValue(':createDate', $createDate);

            $insertFactors5->execute();
        }
        if($textMessage === "true"){        //6
            $insertFactors6 = $conn->prepare(
                "INSERT INTO CompanyAuthenticationFactor(CompanyID, FactorID, CreateDate) ".
                "VALUES(:companyID, :factorID, :createDate)"
            );
            $insertFactors6->bindValue(':companyID', $companyID);
            $insertFactors6->bindValue(':factorID', 6);
            $insertFactors6->bindValue(':createDate', $createDate);

            $insertFactors6->execute();
        }

echo "Authentication factors are set! Redirecting to Login page...^login2.php"        
        
?>

