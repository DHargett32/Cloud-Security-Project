<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Choosing Factors</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">

    </head>
    <body>

        <?php
        // Starting session (if any session for this person already exists [which it should!!], they are automatically used... else, new session started)
        session_start();

        // Accessing session data
        echo 'Hi, ' . $_SESSION["username"];
        ?>



        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Authentication Factors</h1>
                <br>

                <div class="form-group">
                    <label for="sel1"><h4><b>Number of Factors:</b></h4></label>
                    <select class="form-control" id="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                    </select>
                </div>

                <div>
                    <label class="radio-inline"><input type="radio" name="optradio"><h4>Auto-Select</h4></label>
                    <label class="radio-inline"><input type="radio" name="optradio"><h4>Custom</h4></label>
                </div>
                <br>

                <div class="form-group">
                    <label for="sel1"><h4><b>Factors:</b></h4></label>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" value=""><h4>Security Questions</h4></label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value=""><h4>Puzzles</h4></label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value=""><h4>Email</h4></label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value=""><h4>Phone Call</h4></label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value=""><h4>Text Message</h4></label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" value=""><h4>PIN</h4></label>
                </div>
                <div class="checkbox disabled">
                    <label><input type="checkbox" value="" disabled><h4>Biometrics</h4></label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Save and Continue</button>
            </form>

        </div> <!-- /container -->
    </body>
</html> 

