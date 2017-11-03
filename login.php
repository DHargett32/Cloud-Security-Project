<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CDN-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- PHP code for input validation -->



        <!-- HTML/Bootstrap code -->

        <!-- Login Modal -->
        
        <!-- class="modal show" is what allows the modal to appear statically on the page. you can use "modal fade" to hide the modal.-->
        <div class="modal show" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Login or Sign Up</h2>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input class="form-control" id="signupUsername" type="text" placeholder="joe_bob" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input class="form-control" id="signupPassword" type="password" placeholder="*****" required>
                            </div>
                        </form>
                        <!-- link to register page -->
                        <a href="#"><h4>New User? Click Here to Sign Up!</h4></a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>