<?php
    require '../db/connect.php';  
    
    $username = $_POST['username']; //"dhargett";//
    $companyID = $_POST['companyID'];//"1234";
    $questionGroupID = $_POST['groupID'];

    $getSecurityQuestionID = $conn->prepare(
                "SELECT SecurityQuestionAnswer.QuestionID FROM SecurityQuestionAnswer "
                ."WHERE SecurityQuestionAnswer.Username = :username "
                ."AND SecurityQuestionAnswer.QuestionGroupID = :questionGroupID "
                ."AND SecurityQuestionAnswer.CompanyID = :companyID "
        );

    $getSecurityQuestionID->bindValue(':username', $username);
    $getSecurityQuestionID->bindValue(':companyID', $companyID);
    $getSecurityQuestionID->bindValue(':questionGroupID', $questionGroupID);

    try {
        $getSecurityQuestionID->execute();
    } catch (Exception $ex) {
        echo $ex;
    }


    //
    $r = $getSecurityQuestionID->fetch();
    $QuestionIDResult = $r['QuestionID']; 
        
    
        
    
    
    $getSecurityQuestionText = $conn->prepare(
            "SELECT SecurityQuestion.Question FROM SecurityQuestion "
            ."WHERE SecurityQuestion.QuestionID = :questionID "
            ."AND SecurityQuestion.QuestionGroupID = :questionGroupID "
    );
    
    $getSecurityQuestionText->bindValue(':questionID', $QuestionIDResult);
    $getSecurityQuestionText->bindValue(':questionGroupID', $questionGroupID);
    
    try {
        $getSecurityQuestionText->execute();
    } catch (Exception $ex) {
        echo $ex;
    }
    
    $r = $getSecurityQuestionText->fetch();
    $QuestionTextResult = $r['Question'];
    
        // return the <> to the javascript file
        echo $QuestionTextResult;

?>