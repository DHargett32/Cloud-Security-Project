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

        <!-- Custom styles for this template, given with example on bootstrap website -->
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php
        // database setup
        try
        {
            $conn = new PDO("sqlsrv:Server=sqlsv-cs667auth.cbpyuvpamt0n.us-east-2.rds.amazonaws.com,1430;Database=sqlauth", "admin", "sqlsv-cs667auth!");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /*if($conn)
            {
                echo "Connected!";
            }*/
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        // connect to database

        // generate number 1-3 to determine which security question to generate
        $questionToRetrieve = rand(1,3);
        // run query
        //$generateSecurityQuestion = $conn->query("SELECT ");


        ?>
        <div class="container">

            <form class="form-signin">
                <h1 class="form-signin-heading">Security Question</h1>

                <h4>question goes here</h4>
                <input type="text" id="inputSecurityQuestionAnswer1" class="form-control" placeholder="Answer" autocomplete="off" required>


                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </form>

        </div> <!-- /container -->
    </body>
</html>