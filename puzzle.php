<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Authenticate</title>
        <style>
        #randomfield { 
        -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none; 
          max-width: 350px;
          color: black;
          border-color: black;
          text-align: center;
          align-self: center;
          margin-bottom: 10px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
          font-size: 40px;
          background-image: url('http://4.bp.blogspot.com/-EEMSa_GTgIo/UpAgBQaE6-I/AAAAAAAACUE/jdcxZVXelzA/s1600/ca.png');
        }
        </style>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
        event.preventDefault(); // prevent page reload   
        // Do not remove this (it's just a comment and won't effect the functions)
        // SimpleCaptcha v1.0 © Anudeep Tubati
        function ChangeCaptcha() {
            var chars = "a"; //0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz
            var string_length = 1; //6
            var ChangeCaptcha = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                ChangeCaptcha += chars.substring(rnum,rnum+1);
            }
            document.getElementById('randomfield').value = ChangeCaptcha;
        }
        </script>
        
        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">
    </head>
    <body onLoad="ChangeCaptcha()">

        

        

        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Puzzle</h1>
                <input type="text" id="randomfield" class="form-control" disabled>
                <br>
                <br>
                <h4>Please enter the text in the box above</h4>
                <input type="text" id="CaptchaAnswer" maxlength="6" class="form-control" placeholder="Answer" autocomplete="off" required>


                <button id="puzzleAnswer-submit" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </form>
            <script type="text/javascript" src="js/puzzle.js"></script>

        </div> <!-- /container -->
    </body>
</html>