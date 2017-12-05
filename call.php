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
    <body onload="getPhoneNumber()">
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Phone Call Authentication</h1>
                <p>A phone call is being placed to the following number:</p>
                <span style="font-weight:bold"><div id="phoneNumber"></div></span>
                
                <br>
                <input type="password" id="inputPassword" class="form-control"  autocomplete="off" placeholder="Verification Code" required> 
                <input id="call-submit" class="btn btn-lg btn-primary btn-block" type="submit"></input>
                
            </form>

        </div> <!-- /container -->
        
        <footer class="footer">
            <div class="footer navbar-fixed-bottom">
                <img src="logo/footer.PNG" alt="Snap-on-Secure Footer" style="width: 100%;">
            </div>
        </footer>
        
        <script type="text/javascript" src="js/call.js"></script>
        <script type="text/javascript">
            function getPhoneNumber(){
                event.preventDefault();
                $.post('ajax/callAuth.php', {},function(data){ 
                    // display the users phone number to indicate which phone number was called
                    $('div#phoneNumber').text(data);	
                });
            }
        </script>
    </body>
</html>