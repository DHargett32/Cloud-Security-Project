<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Authenticate</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- Add jQuery -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="\winmarkltd-BootstrapFormHelpers-2.3.0-17-gd4201db\winmarkltd-BootstrapFormHelpers-d4201db\js\bootstrap-formhelpers-phone.js"></script>

        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">
        
    </head>
    <body onload="generateSecurityQuestion()">
        
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Security Question</h1>

                <h4 id='generatedQuestion'>question goes here</h4>
                
                <input type="text" id="inputSecurityQuestionAnswer" class="form-control" placeholder="Answer" autocomplete="off" required>

                <input type="submit" class="btn btn-lg btn-primary btn-block" id="securityQuestion-submit" onclick="verifyAnswer()" value="Submit"></input>
            </form>

        </div> <!-- /container -->
        <script>
            function generateSecurityQuestion(){
                event.preventDefault();
                
                //generate random question group number
                $securityQuestionGroupID = Math.floor((Math.random() * 3) + 1); 
                
                $.post('ajax/generateSecurityQuestion.php', {"groupID":$securityQuestionGroupID},function(data){ 
                    $('h4#generatedQuestion').text(data);
                    //alert(data);
                });
            }

            function verifyAnswer(){
                event.preventDefault();
                $answerEntered = $('input#inputSecurityQuestionAnswer').val();
                $.post('ajax/validateSecurityQuestionAnswer.php', {"groupID":$securityQuestionGroupID, "answerEntered":$answerEntered},function(data){ 
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
            }
        </script>
    </body>
</html>