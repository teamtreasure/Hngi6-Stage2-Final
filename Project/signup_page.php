<?php
include_once('dbcon.php');
$full_name = '';
$email = '';
$username = '';
$error = '';
if (isset($_POST['signup'])) {
	/* secure the data that will be submitted into the database 
	from hacker of any funny user with mysqli_real_escape_string()*/
	$full_name = mysqli_real_escape_string($connect2db, $_POST['full_name']);
	$email = mysqli_real_escape_string($connect2db, $_POST['email']);
	$username = mysqli_real_escape_string($connect2db, $_POST['username']);
	$password = mysqli_real_escape_string($connect2db, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($connect2db, $_POST['confirm_password']);

	//Check for empty input
	if (empty($full_name)) {
		$error = "Full name can'\t be empty";
	}
	if (empty($email)) {
		$error = "Email can'\t be empty";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		//this filter_var will validtae if is email or not
		$error = "Invalid Email Type";
	}
	if (empty($username)) {
		$error = "Username can'\t be empty";
	}
	if (empty($password)) {
		$error = "Password can'\t be empty";
	} elseif ($confirm_password !== $password) {
		$error = "Password not match";
	} elseif (strlen($password) < 8) {
		//checking for the length of password
		$error = "Password must be 8 character long";
	}

	//Check if email already exist by because email must be unique
	$emailCheck = mysqli_query($connect2db, "SELECT * FROM registration WHERE email = '$email' ");
	$result = mysqli_num_rows($emailCheck);
	if ($result > 0) {
		$error = "Email has been taken";
	}

	if (empty($error)) {

		//Hash user password for security reason
		$password = password_hash($password, PASSWORD_BCRYPT);
		//insert data into the database table registration
		$insertSQL = mysqli_query($connect2db, "INSERT INTO registration (full_name, email, password, username) VALUES ('$full_name', '$email', '$password', '$username') ");
		//check if query is successful or failed
	
			$_SESSION['message'] = "Resgistration successful";
			header("location: login.php");
		} 
	}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Sign Up</title>
</head>

<body>
	<div class="container-signup">
		<div class="signup-image">
			<img src="background.jpeg" id="s.image" width="820px" height="0px"><br>
			<!-- <i id="team">TEAM TREASURE</i> -->
		</div>
		<div id="signup-form">
			<form action="" method="post">
				<h2>Sign Up</h2>
				<?php
				// Echo error out
				if (isset($error)) {
					echo	"<h3 class='error'>" . $error . "</h3>";
				}

				?>
				<label>Full Name</label><br>
				<input type="text" class="form-control name" name="full_name" value="<?= $full_name; ?>"><br>
				<label id="em">Email</label><br>
				<input type="Email" class="form-control name" name="email" value="<?= $email; ?>"><br>
				<label>Username</label><br>
				<input type="name" name="username" value="<?= $username; ?>"><br>
				<label id="">Password?</label><br>
				<input type="password" name="password" id="s.password"><br>
				<label>Repeat Password</label><br>
				<input type="password" name="confirm_password" id="repassword"><br>
				<!-- <input type="checkbox" name="checkbox" id="check"><i id="check-writeup">I agree to the terms of User</i> <br>	 -->
				<input type="submit" name="signup" id="signup" value="Sign Up" onClick="valid()"><br><br>
				If you have an Account?<a href="login.php" id="signin">Login in </a>

			</form>
		</div>

	</div>

</body>

</html>

<!-- <script type="text/javascript">
	function valid() {
		const password = document.getElementById("s.password");
		const repassword = document.getElementById("repassword");

		if (password.value != repassword.value) {
			alert("Password and Confirm Password Field do not match  !!");
			document.getElementById(repassword).focus();
			return false;
		}
		return true;
	}
</script> -->