$('input#submitPin').on('click', function() {﻿
    event.preventDefault();
    $username = "dhargett"; // replace with session variable
    $companyID = "1234"; // replace with session variable
    $enteredPIN = $('input#inputPIN').val();
    var entered = $enteredPIN.toString();
    $.post('ajax/pinAuth.php', {"username":$username, "companyID":$companyID, "enteredPIN":$enteredPIN}, function(data){
        
        //alert("Before: " + data);
        var dataPin = data.trim();
        //alert("Entered PIN: " + entered);
        //alert("After: " + dataPin);
        if(entered === dataPin)
        {
            alert("Pin correct!"); 
            // redirect goes here  
        }
        else
        {
            alert("Incorrect pin. Please try again.");
        }
    });

});




