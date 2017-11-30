$('input#puzzleAnswer-submit').on('click', function() {﻿
    //event.preventDefault();    
    $username = "dhargett"; // replace with session variable
    $companyID = "1234"; // replace with session variable
    $CaptchaText = $('input#randomfield').val();
    $CaptchaAnswer = $('input#CaptchaAnswer').val();
    
    if($CaptchaText === $CaptchaAnswer)
    {
        alert("Success!");
        // redirect goes here
    }
    else
    {
        alert("Sorry, please try again.");
    }

});

