<?php
		// require the 'connect.php' file to connect to the database
		require '../db/connect.php';
                
                // set variables
                $firstName = $_POST['inputFirstName'];
		$lastName = $_POST['inputLastName'];
		$email = $_POST['inputEmail'];
		$phone = $_POST['inputPhone'];
		$pin = $_POST['inputPin'];
		$companyID = $_POST['inputCompanyID'];
                $registrationCode = $_POST['inputRegistrationCode'];
		$username = $_POST['inputUsername'];
		$password = $_POST['inputPassword'];
		//$confirmPassword = $_POST['inputConfirmPassword'];
		$question1 = $_POST['sqg1'];
		$question2 = $_POST['sqg2'];
		$question3 = $_POST['sqg3'];
		$answer1 = $_POST['inputSecurityQuestionAnswer1'];
		$answer2 = $_POST['inputSecurityQuestionAnswer2'];
		$answer3 = $_POST['inputSecurityQuestionAnswer3'];
		$roleID;

        // IN PROGRESS     [COMPLETE]
        // Checks to see if the registration code has been used for a particular company
        $checkRegistrationCodeAvailability = $conn->prepare(
                "SELECT RegistrationCode.used FROM RegistrationCode "
                ."WHERE RegistrationCode.companyID = :companyID AND RegistrationCode.code = :registrationCode"
        );
        // Bind values
        $checkRegistrationCodeAvailability->bindValue(':companyID', $companyID);
        $checkRegistrationCodeAvailability->bindValue(':registrationCode', $registrationCode);
        // Run query checking if a code exists for a particular company
        $checkRegistrationCodeAvailability->execute();
        
        
        $numRowsRegistrationCodeAvailability = count($checkRegistrationCodeAvailability->fetchAll());
        
        // if the companyID & registrationCode pair exists, proceed
        if($numRowsRegistrationCodeAvailability != 0 || $numRowsRegistrationCodeAvailability != NULL)
        {
            // re-execute the query to "re-fill" the results
            $checkRegistrationCodeAvailability->execute();
            $r = $checkRegistrationCodeAvailability->fetch();
            
            // look at the 'Used' property of the first row returned (should be the only row returned)
            $used = $r['used'];
            // if the registration code HAS NOT been used, continue
            if($used == "N")
            {
                // run query to check if username is available
                        // IN PROGRESS     [COMPLETE]
                // Checks to see if the users' desired username is available
                $checkUsernameAvailability = $conn->prepare(
                "SELECT UserClient.UserName ".
                "FROM UserClient ".
                "WHERE UserClient.UserName= :username AND UserClient.CompanyID = :companyID"
                );

                // Bind values
                $checkUsernameAvailability->bindValue(':username', $username);
                $checkUsernameAvailability->bindValue(':companyID', $companyID);

                // run query
                $checkUsernameAvailability->execute();
                $numRowsUsernameAvailability = count($checkUsernameAvailability->fetchAll());
                // if no results then the username is available
                if($numRowsUsernameAvailability == 0)
                {
                        // [IN PROGRESS]     COMPLETE
                        // Adds the user-client info to the database


                        $sql['UserClient'] = "INSERT INTO UserClient(UserName, CompanyID, FirstName, LastName, RoleID, Password, Pin, PhoneNumber,  Email, CreateDate) ".
                                             "VALUES(:username, :companyID, :firstname, :lastname, :roleID, :password, :pin, :phoneNumber, :email, :createDate)";

                        $sql['SecurityQuestionAnswers'] = "INSERT INTO SecurityQuestionAnswer(QuestionID, QuestionGroupID, UserName, Answer, AnswerDate)". 
                                                          "VALUES(:questionID, :questionGroupID, :username, :answer, :answerDate)";

                        try
                        {
                            $conn = null;
                            $conn = new PDO("sqlsrv:Server=sqlsv-cs667auth.cbpyuvpamt0n.us-east-2.rds.amazonaws.com,1430;Database=sqlauth", "admin", "sqlsv-cs667auth!");
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $conn->beginTransaction();
                        }
                        catch(PDOException $e)
                        {
                            //echo $e;
                        }
                        try
                            {
                                foreach($sql as $stmt_name => &$sql_command)
                                {
                                    $stmt[$stmt_name] = $conn->prepare($sql_command);
                                }
                                date_default_timezone_set("America/Chicago");
                                $createDate = date("Y/m/d h:i:sa");

                                // insert UserClient information
                                $stmt['UserClient']->bindValue(':username', $username);
                                $stmt['UserClient']->bindValue(':companyID', $companyID);
                                $stmt['UserClient']->bindValue(':firstname', $firstName);
                                $stmt['UserClient']->bindValue(':lastname', $lastName);
                                $stmt['UserClient']->bindValue(':roleID', "1");
                                $stmt['UserClient']->bindValue(':password', $password);
                                $stmt['UserClient']->bindValue(':pin', $pin);
                                $stmt['UserClient']->bindValue(':phoneNumber', $phone);
                                $stmt['UserClient']->bindValue(':email', $email);
                                $stmt['UserClient']->bindValue(':createDate', $createDate);
                                $stmt['UserClient']->execute();

                                // insert security question answers 1
                                $stmt['SecurityQuestionAnswers']->bindValue(':questionID', getQuestionID($question1));
                                $stmt['SecurityQuestionAnswers']->bindValue(':questionGroupID', "1");
                                $stmt['SecurityQuestionAnswers']->bindValue(':username', $username);
                                $stmt['SecurityQuestionAnswers']->bindValue(':answer', $answer1);
                                $stmt['SecurityQuestionAnswers']->bindValue(':answerDate', $createDate);
                                $stmt['SecurityQuestionAnswers']->execute();

                                // insert security question answers 2
                                $stmt['SecurityQuestionAnswers']->bindValue(':questionID', getQuestionID($question2));
                                $stmt['SecurityQuestionAnswers']->bindValue(':questionGroupID', "2");
                                $stmt['SecurityQuestionAnswers']->bindValue(':username', $username);
                                $stmt['SecurityQuestionAnswers']->bindValue(':answer', $answer2);
                                $stmt['SecurityQuestionAnswers']->bindValue(':answerDate', $createDate);
                                $stmt['SecurityQuestionAnswers']->execute();

                                // insert security question answers 3
                                $stmt['SecurityQuestionAnswers']->bindValue(':questionID', getQuestionID($question3));
                                $stmt['SecurityQuestionAnswers']->bindValue(':questionGroupID', "3");
                                $stmt['SecurityQuestionAnswers']->bindValue(':username', $username);
                                $stmt['SecurityQuestionAnswers']->bindValue(':answer', $answer3);
                                $stmt['SecurityQuestionAnswers']->bindValue(':answerDate', $createDate);
                                $stmt['SecurityQuestionAnswers']->execute();


                                $conn->commit();

                                // flag the registration code for the particular company as used ('true')

                                // IN PROGRESS     [COMPLETE]
                                // changes the 'used' property from 'false' to 'true'. Indicates that the code is no longer valid and will prevent future users from registering with it.
                                $updateRegistrationCodeAvailability = $conn->prepare(
                                "UPDATE RegistrationCode ".
                                "SET RegistrationCode.Used = 'Y' ".
                                "WHERE RegistrationCode.CompanyID = :companyID AND RegistrationCode.Code = :registrationCode"
                                );
                                //SET RegistrationCode.Used = 'Y', RegistrationCode.RegistrationDate = ':date'
                                //$updateRegistrationCodeAvailability->bindValue(':date', $createDate);
                                $updateRegistrationCodeAvailability->bindValue(':companyID', $companyID);
                                $updateRegistrationCodeAvailability->bindValue(':registrationCode', $registrationCode);

                                $updateRegistrationCodeAvailability->execute();

                                echo "Registration Successful!";
                                // navigate to login page
                            }

                            catch(PDOException $e)
                            {
                                        $conn->rollBack();
                                        //echo $e;
                            }


                        // Need to insert user data, update code used flag, add security questions
                }
                // if we get results, output error message
                else
                {
                                echo "Sorry. Our records indicate that that username is already taken. Please select a different username.";
                }
            }
            // if the registration code HAS been used, show error message
            else
            {
                    echo "Sorry. Our records indicate that the Registration Code you entered has already been used. Please verify that you have entered the correct information.";
            }
        	

        }
        // if no results, show error message
        else
        {
            echo "Sorry. Either the Company ID, Registration Code, or both that you entered do match our records. Please verify that you have entered the correct information.";
        }




        function getQuestionID($question)
		{
			$qID = "1";

			if($question == "What is the name of your hometown?" || $question == "Where was your favorite vacation?" || $question == "Who is the person you most admire?")
			{
				$qID = "1";
			}	
			else if($question == "What is the name of your first pet?" || $question == "What is your favorite food?" || $question == "What is your favorite holiday?")
			{
				$qID = "2";
			}
			else if($question == "What is your mother's maiden name?" || $question == "Who is your favorite sports team?" || $question == "What is your favorite game?")
			{
				$qID = "3";
			}
			else if($question == "Who is your best friend?" || $question == "What was your high school mascot?" || $question == "What is your favorite color?")
			{
				$qID = "4";
			}

			return $qID;
		}
?>