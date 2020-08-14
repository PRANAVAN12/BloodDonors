<?php 
	session_start();

	// variable declaration
	$UserName = "";
	$Email    = "";
	$Mobile    = "";
	$BloodGroup    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'blood');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$UserName = mysqli_real_escape_string($db, $_POST['UserName']);
		$Email = mysqli_real_escape_string($db, $_POST['Email']);
		$Mobile = mysqli_real_escape_string($db, $_POST['Mobile']);
		$BloodGroup = mysqli_real_escape_string($db, $_POST['BloodGroup']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($UserName)) { array_push($errors, "Username is required"); }
		if (empty($Email)) { array_push($errors, "Email is required"); }
		if (empty($Mobile)) { array_push($errors, "Mobile is required"); }
		if (empty($BloodGroup)) { array_push($errors, "BloodGroup is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			
			$query = "INSERT INTO members (UserName,Email,Mobile,BloodGroup, password) 
					  VALUES('$UserName', '$Email', '$Mobile', '$BloodGroup' ,'$password_1')";
			mysqli_query($db, $query);

			$_SESSION['UserName'] = $UserName;
			$_SESSION['success'] = "You are now logged in";
			header('location: ../MemberView.php');
		}

	}

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$UserName = filter_input(INPUT_POST, 'UserName');
		$password = filter_input(INPUT_POST, 'password');
		//$UserName = mysqli_real_escape_string()($db, $_POST['UserName']);
	//	$password = mysqli_real_escape_string()($db, $_POST['password']);

		if (empty($UserName)) {
			array_push($errors, "UserName is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			
			$query = "SELECT * FROM members WHERE UserName='$UserName' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['UserName'] = $UserName;
				$_SESSION['success'] = "You are now logged in";
				header('location:../MemberView.php');
			}else {
				array_push($errors, "Wrong UserName/password combination");
			}
		}
	}

	// Admin
	if (isset($_POST['login_Admin'])) {
		$UserName = filter_input(INPUT_POST, 'UserName');
		$password = filter_input(INPUT_POST, 'password');
		//$UserName = mysqli_real_escape_string()($db, $_POST['UserName']);
	//	$password = mysqli_real_escape_string()($db, $_POST['password']);

		if (empty($UserName)) {
			array_push($errors, "UserName is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			
			$query = "SELECT * FROM admin WHERE UserName='$UserName' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['UserName'] = $UserName;
				$_SESSION['success'] = "You are now logged in";
				header('location:../Admin.php');
			}else {
				array_push($errors, "Wrong UserName/password combination");
			}
		}
	}

?>