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


                <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="verifyAnswer()">Submit</button>
            </form>

        </div> <!-- /container -->
        <script>
            //
            $username = "dhargett"; // replace with session variable
            $companyID = "1234"; // replace with session variable
            $securityQuestionGroupID = Math.floor((Math.random() * 3) + 1);

            function generateSecurityQuestion(){

                $.post('ajax/generateSecurityQuestion.php', {"username":$username, "companyID":$companyID, "groupID":$securityQuestionGroupID},function(data){ 
                    // display the generated security question

                    $('h4#generatedQuestion').text(data);	
                });
            }

            function verifyAnswer(){
                event.preventDefault();
                //alert("IN");
                $.post('ajax/validateSecurityQuestionAnswer.php', {"username":$username, "companyID":$companyID, "groupID":$securityQuestionGroupID},function(data){ 
                    // 
                    var answerInDB = data.trim();
                    //alert("data: ." + answerInDB + "."); // DEBUG
                    var answerEntered = document.getElementById("inputSecurityQuestionAnswer").value;
                    //alert("entered: ." + answerEntered + "."); // DEBUG


                    if(answerEntered === answerInDB)
                    {
                        alert("Answer Matched!");
                        // redirect
                    }
                });
            }
        </script>
    </body>
</html>