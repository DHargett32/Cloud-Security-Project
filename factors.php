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
        
        <!-- Add jQuery -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="\winmarkltd-BootstrapFormHelpers-2.3.0-17-gd4201db\winmarkltd-BootstrapFormHelpers-d4201db\js\bootstrap-formhelpers-phone.js"></script>

        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">
        
    </head>
    <body onload="getCurrentFactors()">

        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Authentication Factors</h1>
                <br>

                <div class="form-group">
                    <label for="selectionType"><h4><b>Factor Selection Type:</b></h4></label>
                    <select class="form-control" id="selectionType">
                        <option value="auto">Auto-Select (We choose for you!)</option>
                        <option selected value="custom">Custom-Select (You choose!)</option>
                    </select>
                    <select class="form-control" id="autoNumFactors" style="display: none;">
                        <option disabled selected value="selectOther"> -- select number of factors -- </option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <br>

                <div class="form-group">
                    <label for="sel1"><h4><b>Choose Factors:</b></h4></label>
                </div>

                <div class="checkbox">
                    <label><input id="scqu" type="checkbox" value=""><h4>Security Questions</h4></label>
                </div>
                <div class="checkbox">
                    <label><input id="puz" type="checkbox" value=""><h4>Puzzles</h4></label>
                </div>
                <div class="checkbox">
                    <label><input id="eml" type="checkbox" value=""><h4>Email</h4></label>
                </div>
                <div class="checkbox">
                    <label><input id="phc" type="checkbox" value=""><h4>Phone Call</h4></label>
                </div>
                <div class="checkbox">
                    <label><input id="txtm" type="checkbox" value=""><h4>Text Message</h4></label>
                </div>
                <div class="checkbox">
                    <label><input id="pin" type="checkbox" value=""><h4>PIN</h4></label>
                </div>
                <div class="checkbox disabled">
                    <label><input id="bio" type="checkbox" value="" disabled><h4>Biometrics (coming soon!)</h4></label>
                </div>
                
                <input type="submit" class="btn btn-lg btn-primary btn-block" id="factors-submit" value="Set Factors"></input>
            </form>

        </div> <!-- /container -->
        
        <!-- Associated JavaScript File-->
        <script type="text/javascript" src="js/factors.js"></script>
        
        <script type="text/javascript">
            function getCurrentFactors() {
                $username = "slavett"; // replace with session variable
                $companyID = "1234"; // replace with session variable

                $.post('ajax/loadFactors.php', {"username": $username, "companyID": $companyID}, function (data) {
                    var delimiter = data.indexOf("^");
                    if(delimiter == "-1"){   //delimiter does not exist, alert normal message
                       alert(data);
                    } else {           //delimiter exists, (1)output correct message, and (2) check existing factors
                       var datalength = data.length;

                       var factorIDs = data.substr(0, delimiter);
                       var alertData = data.substr(delimiter + 1, datalength);
                       factorIDs.trim();

                       //split factorIDs string into array of variables
                       var factorIDArray = factorIDs.split(',');
                       
//                       alert(factorIDs);
//                       alert("length is " + factorIDArray.length);
//                       alert(factorIDArray[0]);
//                       alert(factorIDArray[1]);
                       
                       //NOTE: In Database, our factorID's are as follows:
                       //1 - Security Questions
                       //2 - PIN
                       //3 - Phone Call
                       //4 - Puzzles
                       //5 - Email
                       //6 - Text Message
                       //7 - Biometrics
                       
                       //check the boxe
                       for (i = 0; i < factorIDArray.length; i++) { 
                            var temp = factorIDArray[i];
                            if(temp === "1"){
                                $("#scqu").prop("checked", true);
                            } else if (temp === "2") {
                                $("#pin").prop("checked", true);
                            } else if (temp === "3") {
                                $("#phc").prop("checked", true);
                            } else if (temp === "4") {
                                $("#puz").prop("checked", true);
                            } else if (temp === "5") {
                                $("#eml").prop("checked", true);
                            } else if (temp === "6") {
                                $("#txtm").prop("checked", true);
                            }
                        }
                       alert(alertData);
                    }
                });
            }
        </script> 
    </body>
</html> 

