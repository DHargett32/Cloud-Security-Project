<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Authenticate</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FE9A5440-A6DC-CB4C-9A62-76B34002E503/main.js" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="http://gc.kis.v2.scr.kaspersky-labs.com/BDAE74ED-0E40-184A-AD28-83ED56AAA731/abn/main.css"/><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">

    </head>
    <body onload="getPhoneNumber()">
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Phone Call Authentication</h1>
                <p>A phone call is being placed the the following number:</p>
                <span style="font-weight:bold"><div id="phoneNumber"></div></span>
                <script>
                    function getPhoneNumber(){
                        $username = "dhargett"; // replace with session variable
                        $companyID = "1234"; // replace with session variable
                        
                        $.post('ajax/callAuth.php', {"username":$username, "companyID":$companyID},function(data){ 
                            // display the users email address to indicate which email address the code was sent to
                            $('div#phoneNumber').text(data);	
                        });
                    }
                </script>
                <br>
                <input type="password" id="inputPassword" class="form-control" placeholder="Submit Your Code" required> 
                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
                <!-- link to register page -->
                
            </form>

        </div> <!-- /container -->
    </body>
</html>