<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
	header("location: dashboard");
	exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = trim($_POST["email"]);
	$password = trim($_POST["pass"]);


    // Validate credentials
	if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
		$sql = "SELECT email, password FROM login_table WHERE email = ?";

		if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
			$param_email = $email;

            // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
                // Store result
				mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
					mysqli_stmt_bind_result($stmt, $email, $hashed_password);
					if(mysqli_stmt_fetch($stmt)){
						if(strcmp($password, $hashed_password)==0){
                            // Password is correct, so start a new session
							session_start();

                            // Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["email"] = $email;                            

                            // Redirect user to welcome page
                            header('Location:dashboard');
                            exit;
							
						} else{
                            // Display an error message if password is not valid
							$password_err = "Invalid Password ";
						}
					}
				} else{
                    // Display an error message if username doesn't exist
					$username_err = "No account found with that username.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
		mysqli_stmt_close($stmt);
		}
		else {
    echo "Something's wrong with the query: " . mysqli_error($conn);
        
	}
	
}
}

?>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url(images/bg.jpg); background-size: cover;">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" id="login-form" name="login-form" method="post">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<span class="help-block"><?php echo $username_err; ?></span>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>


					</div>

					<span class="help-block"><?php echo $password_err; ?></span>
					
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="Login">
					</div>

					
					
				</form>
			</div>
		</div>
	</div>
	
	

	
	<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>

	<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>

	<!-- <script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script> -->
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>



<?php
include 'close.php';
?>

</html>