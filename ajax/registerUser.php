<?php
	
		// require the 'connect.php' file to connect to the database
		require '../db/connect.php';
        $firstName = $_POST['input#inputFirstName'];
		$lastName = $_POST['input#inputLastName'];
		$email = $_POST['input#inputEmail'];
		$phone = $_POST['input#inputPhone'];
		$pin = $_POST['input#inputPin'];
		$companyID = $_POST['input#inputCompanyID'];
		$registrationCode = $_POST['input#inputRegistrationCode'];
		$username = $_POST['input#inputUsername'];
		$password = $$_POST['input#inputPassword'];
		$confirmPassword = $_POST['input#inputConfirmPassword'];
		$question1 = $_POST['select#sqg1'];
		$question2 = $_POST['input#sqg2'];
		$question3 = $_POST['input#sqg3'];
		$answer1 = $_POST['input#inputSecurityQuestionAnswer1'];
		$answer2 = $_POST['input#inputSecurityQuestionAnswer2'];
		$answer3 = $_POST['input#inputSecurityQuestionAnswer3'];
		$roleID;

        // IN PROGRESS     [COMPLETE]
        // Checks to see if the registration code has been used for a particular company
        echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
        $checkRegistrationCodeAvailability = $handler->prepare(
        "SELECT RegistrationCode.used FROM RegistrationCode
         WHERE RegistrationCode.companyID = :companyID AND RegistrationCode.code = :registrationCode"
        );
        // Bind values
        $checkRegistrationCodeAvailability->bindValue(':companyID', $companyID);
        $checkRegistrationCodeAvailability->bindValue(':registrationCode', $registrationCode);
        // Run query checking if a code exists for a particular company
        $checkRegistrationCodeAvailability->execute();
        echo "<script>alert(inside! 0); </script>";
        // if we get any results from our query, proceed
        if($checkRegistrationCodeAvailability->rowCount() != 0)
        {
        	echo "<script>alert(inside! 1); </script>";
        	// look at the 'Used' property of the first row returned (should be the only row returned)
        	if(($r = $checkRegistrationCodeAvailability->fetch()) != '')
        	{
        		$used = $r['Used'];
        		// if the registration code HAS NOT been used, continue
        		if($used == "N")
        		{
        			// run query to check if username is available
					// IN PROGRESS     [COMPLETE]
			        // Checks to see if the users' desired username is available
			        $checkUsernameAvailability = $handler->prepare(
			        "SELECT COUNT(UserClient.UserName)
			         FROM UserClient
			         WHERE UserClient.UserName= :username AND UserClient.CompanyID = :companyID"
			        );

			        // Bind values
			        $checkUsernameAvailability->bindValue(':username', $username);
			        $checkUsernameAvailability->bindValue(':companyID', $companyID);

			        // run query
			        $checkUsernameAvailability->execute();

			        // if no results then the username is available
			        if($checkUsernameAvailability->rowCount() == 0)
			        {
			        	// [IN PROGRESS]     COMPLETE
				        // Adds the user-client info to the database


				        $sql['UserClient'] = "INSERT INTO UserClient(UserName, CompanyID, FirstName, LastName, RoleID, Password, Pin, PhoneNumber,  Email, CreateDate)
				        					  VALUES(:username, :companyID, :firstname, :lastname, :roleID, :password, :pin, :phoneNumber, :email, :createDate)";

				        $sql['SecurityQuestionAnswers'] = "INSERT INTO SecurityQuestionAnswer(QuestionID, QuestionGroupID, UserName, Answer, AnswerDate) 
				         								   VALUES(:questionID, :questionGroupID, :username, :answer, :answerDate)";

				        $conn->beginTransaction();

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
					        $stmt['UserClient']->bindValue(':companyID', $);
					        $stmt['UserClient']->bindValue(':firstname', $firstName);
					        $stmt['UserClient']->bindValue(':lastname', $lastName);
					        $stmt['UserClient']->bindValue(':roleID', "1");
					        $stmt['UserClient']->bindValue(':password', $);
					        $stmt['UserClient']->bindValue(':pin', $pin);
					        $stmt['UserClient']->bindValue(':phoneNumber', $phone);
							$stmt['UserClient']->bindValue(':email', $email);
					        $stmt['UserClient']->bindValue(':createDate', $createDate);


							$stmt['UserClient']->bindValue(':', $);
					        $stmt['UserClient']->bindValue(':', $);
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
					        $updateRegistrationCodeAvailability = $handler->prepare(
					        "UPDATE RegistrationCode 
					         SET RegistrationCode.Used = 'Y'
					         WHERE RegistrationCode.CompanyID = :companyID AND RegistrationCode.Code = :registrationCode"
					        );
					        //SET RegistrationCode.Used = 'Y', RegistrationCode.RegistrationDate = ':date'
					        //$updateRegistrationCodeAvailability->bindValue(':date', $createDate);
					        $updateRegistrationCodeAvailability->bindValue(':companyID', $companyID);
					        $updateRegistrationCodeAvailability->bindValue(':registrationCode', $registrationCode);

					        $updateRegistrationCodeAvailability->execute();
					    }

					    catch(PDOException $e)
					    {
					   		$conn->rollBack();
					   		echo $e;
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