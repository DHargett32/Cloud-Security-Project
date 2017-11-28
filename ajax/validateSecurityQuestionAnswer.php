<?php
    
    require '../db/connect.php';
    
    $username = $_POST['username']; //"dhargett";//
    $companyID = $_POST['companyID'];//"1234";
    $questionGroupID = $_POST['groupID'];

    $getSecurityQuestionAnswer = $conn->prepare(
            "SELECT SecurityQuestionAnswer.Answer FROM SecurityQuestionAnswer "
            ."WHERE SecurityQuestionAnswer.Username = :username "
            ."AND SecurityQuestionAnswer.QuestionGroupID = :questionGroupID "
            //."AND SecurityQuestionAnswer.CompanyID = :companyID "
    );

    $getSecurityQuestionAnswer->bindValue(':username', $username);
    //$getSecurityQuestionAnswer->bindValue(':companyID', $companyID);
    $getSecurityQuestionAnswer->bindValue(':questionGroupID', $questionGroupID);

    try {
        $getSecurityQuestionAnswer->execute();
    } catch (Exception $ex) {
        echo $ex;
    }
    
    $r = $getSecurityQuestionAnswer->fetch();
    $QuestionAnswerResult = $r['Answer'];
    
    echo $QuestionAnswerResult;
?>

