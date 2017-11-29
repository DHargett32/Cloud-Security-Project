$('input#registerUser-submit').on('click', function() {﻿
        event.preventDefault()
	var firstName = $('input#inputFirstName').val();
	var lastName = $('input#inputLastName').val();
	var email = $('input#inputEmail').val();
	var phone = $('input#inputPhone').val();
        var pin = $('input#inputPin').val();
	var companyID = $('input#inputCompanyID').val();
	var registrationCode = $('input#inputRegistrationCode').val();
	var username = $('input#inputUsername').val();
	var password = $('input#inputPassword').val();
	var confirmPassword = $('input#inputConfirmPassword').val();
	var question1 = $('select#sqg1').val();
	var question2 = $('select#sqg2').val();
	var question3 = $('select#sqg3').val();
	var answer1 = $('input#inputSecurityQuestionAnswer1').val();
	var answer2 = $('input#inputSecurityQuestionAnswer2').val();
	var answer3 = $('input#inputSecurityQuestionAnswer3').val();

	$.post('ajax/registerUser.php', {inputFirstName: firstName, inputLastName: lastName, inputEmail: email, inputPhone: phone, inputCompanyID: companyID, inputPin: pin,
                                         inputRegistrationCode: registrationCode, inputUsername: username, inputPassword: password, sqg1: question1, sqg2: question2, 
                                         sqg3: question3, inputSecurityQuestionAnswer1: answer1, inputSecurityQuestionAnswer2: answer2, inputSecurityQuestionAnswer3: answer3},
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
	});
	

});