//detect auto-select vs. custom-select type
$('#selectionType').on('change', function () {
    event.preventDefault();
    if ($(this).val() === "auto") { //type is auto-select
        
        //disable all boxes
        $("#autoNumFactors").val("selectOther");
        $("#autoNumFactors").show();
        $("#scqu").attr("disabled", true);
        $("#pin").attr("disabled", true);
        $("#phc").attr("disabled", true);
        $("#puz").attr("disabled", true);
        $("#eml").attr("disabled", true);
        $("#txtm").attr("disabled", true);
        
        //uncheck all boxes
        $("#scqu").prop("checked", false);
        $("#pin").prop("checked", false);
        $("#phc").prop("checked", false);
        $("#puz").prop("checked", false);
        $("#eml").prop("checked", false);
        $("#txtm").prop("checked", false);
        
    } else {                    //type is custom-select
        
        //enable all boxes
        $("#autoNumFactors").hide();
        $("#scqu").attr("disabled", false);
        $("#pin").attr("disabled", false);
        $("#phc").attr("disabled", false);
        $("#puz").attr("disabled", false);
        $("#eml").attr("disabled", false);
        $("#txtm").attr("disabled", false);
        
        //uncheck all boxes
        $("#scqu").prop("checked", false);
        $("#pin").prop("checked", false);
        $("#phc").prop("checked", false);
        $("#puz").prop("checked", false);
        $("#eml").prop("checked", false);
        $("#txtm").prop("checked", false);
    }
});

//auto-select the specified number of factors
$('#autoNumFactors').on('change', function () {
    event.preventDefault();
    if ($(this).val() === "1") {    //select 1 factor
        $("#scqu").prop("checked", true);
        $("#pin").prop("checked", false);
        $("#phc").prop("checked", false);
        $("#puz").prop("checked", false);
        $("#eml").prop("checked", false);
        $("#txtm").prop("checked", false);
    } else if ($(this).val() === "2") { //select 2 factors
        $("#scqu").prop("checked", true);
        $("#pin").prop("checked", true);
        $("#phc").prop("checked", false);
        $("#puz").prop("checked", false);
        $("#eml").prop("checked", false);
        $("#txtm").prop("checked", false);
    } else if ($(this).val() === "3") { //select 3 factors
        $("#scqu").prop("checked", true);
        $("#pin").prop("checked", true);
        $("#phc").prop("checked", true);
        $("#puz").prop("checked", false);
        $("#eml").prop("checked", false);
        $("#txtm").prop("checked", false);
    } else if ($(this).val() === "4") { //select 4 factors
        $("#scqu").prop("checked", true);
        $("#pin").prop("checked", true);
        $("#phc").prop("checked", true);
        $("#puz").prop("checked", true);
        $("#eml").prop("checked", false);
        $("#txtm").prop("checked", false);
    } else if ($(this).val() === "5") { //select 5 factors
        $("#scqu").prop("checked", true);
        $("#pin").prop("checked", true);
        $("#phc").prop("checked", true);
        $("#puz").prop("checked", true);
        $("#eml").prop("checked", true);
        $("#txtm").prop("checked", false);
    } else {                            //select 6 factors
        $("#scqu").prop("checked", true);
        $("#pin").prop("checked", true);
        $("#phc").prop("checked", true);
        $("#puz").prop("checked", true);
        $("#eml").prop("checked", true);
        $("#txtm").prop("checked", true);
    }
});


//on click handler for setting the company's authentication factors
$('input#factors-submit').on('click', function() {﻿
	event.preventDefault();
        
        //set variables
        var securityQuestions = $("#scqu").is(":checked");
        var puzzle = $("#puz").is(":checked");
        var email = $("#eml").is(":checked");
        var phoneCall = $("#phc").is(":checked");
        var textMessage = $("#txtm").is(":checked");
        var pin = $("#pin").is(":checked");
        
        //count how many factors were set
        var count = 0;
        if(securityQuestions === true) {
            count++;
        }
        if(puzzle === true) {
            count++;
        }
        if(email === true) {
            count++;
        }
        if(phoneCall === true) {
            count++;
        }
        if(textMessage === true) {
            count++;
        }
        if(pin === true) {
            count++;
        }
        
//        alert(securityQuestions);
//        alert(puzzle);
//        alert(email);
//        alert(phoneCall);
//        alert(textMessage);
//        alert(pin);

        //only continue if admin has selected at least 1 factor
        if(count > 0) {
            $.post('ajax/setFactors.php', {securityQuestionsIsSet: securityQuestions, puzzleIsSet: puzzle, emailIsSet: email, phoneCallIsSet: phoneCall, textMessageIsSet: textMessage, pinIsSet: pin},
                                             function(data){

                                                 //check returned data, see if page redirect is appended to an echo message
                                                 //our delimiter is "^", if it exists in the message, there is a page redirect too
                                                 var delimiter = data.indexOf("^");
                                                 if(delimiter == "-1"){   //delimiter does not exist, alert normal message
                                                    alert("Sorry! It appears an error has occurred. Please try again!");
                                                 } else {           //delimiter exists, (1 )output correct message, and (2) redirect to login
                                                    var datalength = data.length;

                                                    var alertData = data.substr(0, delimiter);
                                                    var redirectPage = data.substr(delimiter + 1, datalength);

                                                    alert(alertData);

                                                    window.location = redirectPage;
                                                 }
            })//.error(function(){alert("Error");}).success(function(){alert("success");});

        } else {
            alert("Please select at least 1 factor.");
        }
});

