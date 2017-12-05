/*$(function(){
    alert("Hello!");

});*/

$('input#loginUser-submit').on('click', function() {﻿
    //alert("in this");
	event.preventDefault();
    var username = $('input#inputUsername').val();
	var password = $('input#inputPassword').val(); 
    var companyID = $('input#inputCompanyID').val();
	//alert("username: " + username);
        
	$.post('ajax/loginUser.php', {inputUsername: username, inputPassword: password, inputCompanyID: companyID},
                                         function(data){
                                             //check returned data, see if page redirect is appended to an echo message
                                             //our delimiter is "^", if it exists in the message, there is a page redirect too
                                             var delimiter = data.indexOf("^");
                                             if(delimiter == "-1"){   //delimiter does not exist, alert normal message
                                                alert(data);
                                             } else {           //delimiter exists, (1 )output correct message, and (2) redirect to correct page
                                                var datalength = data.length;
                                                
                                                var alertData = data.substr(0, delimiter);
                                                var redirectPage = data.substr(delimiter + 1, datalength);
                                                
                                                alert(alertData);
                                                
                                                window.location = redirectPage;
                                             }
	})//.error(function(){alert("Error");}).success(function(){alert("success");});
	

});

