<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Website - Login</title>
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
    <body>
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Login or Sign Up</h1>
                <label for="inputUsername" class="sr-only">Username:</label>
                <input type="text" id="inputUsername" class="form-control" placeholder="Username" required>

                <label for="inputPassword" class="sr-only">Password:</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> 
                
                <label for="inputCompanyID" class="sr-only">Company ID:</label>
                <input type="text" id="inputCompanyID" class="form-control" placeholder="Company ID" required>
                
                <!-- JavaScript only seems to work with "input" tag... so we can disguise the input tag as a Bootstrap button-->
                <input type="submit" class="btn btn-lg btn-primary btn-block" id="loginUser-submit" value="Login"></input>
                <script type="text/javascript" src="js/login.js"></script>
                
                <!-- link to register page -->
                <a href="register.php"><h4>New User? Click Here to Sign Up!</h4></a>
            </form>

        </div> <!-- /container -->
    </body>
</html>