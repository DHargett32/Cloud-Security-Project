<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Add jQuery -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="\winmarkltd-BootstrapFormHelpers-2.3.0-17-gd4201db\winmarkltd-BootstrapFormHelpers-d4201db\js\bootstrap-formhelpers-phone.js"></script>

        
        

        <!--<script>
            $(document).ready(function(){
                alert("Working!");
            });
        </script> -->
        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">

    </head>
    <body>
        <div id="name-data"></div>
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">New User Registration</h1>
                <label for="inputFirstName" class="sr-only">First Name:</label>
                <input type="text" id="inputFirstName" class="form-control" placeholder="First Name" autocomplete="off" required>

                <label for="inputLastName" class="sr-only">Last Name:</label>
                <input type="text" id="inputLastName" class="form-control" placeholder="Last Name" autocomplete="off" required> 

                <label for="inputEmail" class="sr-only">Email:</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="Email" autocomplete="off" required>

                <label for="inputPhone" class="sr-only">Phone:</label>
                <input type="text" class="form-control bfh-phone" data-toggle="tooltip" data-placement="top" title="Phone" data-format=" (ddd) ddd-dddd" id="inputPhone"  autocomplete="off" required>
                
                <label for="inputPin" class="sr-only">PIN:</label>
                <input type="text" id="inputPin" class="form-control" placeholder="PIN" autocomplete="off" required>

                <label for="inputCompanyID" class="sr-only">Company ID:</label>
                <input type="text" id="inputCompanyID" class="form-control" placeholder="Company ID" autocomplete="off" required>

                <label for="inputRegistrationCode" class="sr-only">Registration Code:</label>
                <input type="text" id="inputRegistrationCode" class="form-control" placeholder="Registration Code" autocomplete="off" required>

                <label for="inputUsername" class="sr-only">Username:</label>
                <input type="text" id="inputUsername" class="form-control" placeholder="Username" autocomplete="off" required>

                <label for="inputPassword" class="sr-only">Password:</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" autocomplete="off" required>

                <label for="inputConfirmPassword" class="sr-only">Confirm Password:</label>
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" autocomplete="off" required>

                <h4>   Security Question #1</h4>
                <select class="form-control" data-toggle="tooltip" id="sqg1">
                    <option>What is the name of your hometown?</option>
                    <option>What is the name of your first pet?</option>
                    <option>What is your mother's maiden name?</option>
                    <option>Who is your best friend?</option>
                </select>
                <input type="text" id="inputSecurityQuestionAnswer1" class="form-control" placeholder="Answer" autocomplete="off" required>



                <h4>Security Question #2</h4>
                <select class="form-control" id="sqg2">
                    <option>Where was your favorite vacation?</option>
                    <option>What is your favorite food?</option>
                    <option>Who is your favorite sports team?</option>
                    <option>What was your high school mascot?</option>
                </select>
                <input type="text" id="inputSecurityQuestionAnswer2" class="form-control" placeholder="Answer" autocomplete="off" required>


                <h4>Security Question #3</h4>
                <select class="form-control" id="sqg3">
                    <option>Who is the person you most admire?</option>
                    <option>What is your favorite holiday?</option>
                    <option>What is your favorite game?</option>
                    <option>What is your favorite color?</option>
                </select>
                <input type="text" id="inputSecurityQuestionAnswer3" class="form-control" placeholder="Answer" autocomplete="off" required>


                <br/>


                <!-- JavaScript only seems to work with "input" tag... so we can disguise the input tag as a Bootstrap button with class attribute-->
                <input type="submit" class="btn btn-lg btn-primary btn-block" id="registerUser-submit" value="Register Now!"></input>
                <script type="text/javascript" src="js/register.js"></script>
            </form>

        </div> <!-- /container -->
    </body>
</html>