<html>
<head>
	<title>Register</title>
	<style type="text/css">
		.error {color:#FF0000;}
		.center {text-align: center;}
		.right{text-align: right;}
		.left{text-align: left;}
		#form_register{
			left: 50%;
    		margin-left: -15%;
    		position: absolute;
		}
	</style>
</head>
<body>

<!-- PHP code for input validation -->











	<!-- HTML code -->
			<form id="form_register" action="process-player1.php" method="post">
				<h1>New User Registration</h1>
		<legend class="error">* required field</legend>
		<br/>
		<br/>
				<table>
					<tr>
						<td>First Name:</td><td><input type="textbox" name="firstName"></td><td><p class="error">*</p></td>
					</tr>
					<tr>
						<td>Last Name:</td><td><input type="textbox" name="lastName"></td><td><p class="error">*</p></td>
					</tr>
					<tr>
						<td>Email:</td><td><input type="textbox" name="email"></td><td><p class="error">*</p></td>
					</tr>
					<tr>
						<td>Company ID:</td><td><input type="textbox" name="companyID"></td><td><p class="error">*</p></td>
					</tr>
					<tr>
						<td>Registration Code:</td><td><input type="textbox" name="registrationCode"></td><td><p class="error">*</p></td>
					</tr>
					<tr>
						<td>Username:</td><td><input type="textbox" name="username"></td><td><p class="error">*</p></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type="password" name="password"></td><td><p class="error">*</p></td>
					<tr>
						<td>Re-enter Password:</td><td><input type="password" name="confirmPassword"></td><td><p class="error">*</p></td>
					</tr>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<!-- Security questions -->
					<tr>
						<td colspan="2" class="center">Security Question #1</td>
					</tr>
					<tr>
						<td colspan="2" class="center">
							<select content= "">
								<option value="sq1">What is the name of your hometown?</option>
								<option value="sq2">What is the name of your first pet?</option>
								<option value="sq3">What is your mother's maiden name?</option>
								<option value="sq4">Who is your best friend?</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="center">Answer:</td><td><input type="textbox" name="answer1"></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td colspan="2" class="center">Security Question #2</td>
					</tr>
					<tr>
						<td colspan="2" class="center">
							<select content= "">
								<option value="sq5">Where was your favorite vacation?</option>
								<option value="sq6">What is your favorite food?</option>
								<option value="sq7">Who is your favorite sports team?</option>
								<option value="sq8">What was your high school mascot?</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="center">Answer:</td><td><input type="textbox" name="answer2"></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td colspan="2" class="center">Security Question #3</td>
					</tr>
					<tr>
						<td colspan="2" class="center">
							<select content= "">
								<option value="sq9">Who is the person you most admire?</option>
								<option value="sq10">What is your favorite holiday?</option>
								<option value="sq11">What is your favorite game?</option>
								<option value="sq12">What is your favorite color?</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="center">Answer:</td><td><input type="textbox" name="answer3"></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td></td><td></td><td></td>
					</tr>
					<tr>
						<td colspan="3" class="center"><input type="submit" name="" value=Submit></td><td></td><td></td>
					</tr>
				</table>
			</form>
	</body>
</html>