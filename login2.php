<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login2</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="login2.css" rel="stylesheet">

    </head>
    <body>
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Login or Sign Up</h1>
                <label for="inputUsername" class="sr-only">Username:</label>
                <input type="text" id="inputUsername" class="form-control" placeholder="Username" required>

                <label for="inputPassword" class="sr-only">Password:</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> 
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                <!-- link to register page -->
                <a href="#"><h4>New User? Click Here to Sign Up!</h4></a>
            </form>

        </div> <!-- /container -->
    </body>
</html>