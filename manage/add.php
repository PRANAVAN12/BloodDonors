<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$UserName = mysqli_real_escape_string($mysqli, $_POST['UserName']);
	$Email = mysqli_real_escape_string($mysqli, $_POST['Email']);
	$Mobile = mysqli_real_escape_string($mysqli, $_POST['Mobile']);
	$BloodGroup = mysqli_real_escape_string($mysqli, $_POST['BloodGroup']);
		
	// checking empty fields
	if(empty($UserName) || empty($Email) || empty($Mobile) || empty($BloodGroup)) {
				
		if(empty($UserName)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($Email)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($Mobile)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		if(empty($BloodGroup)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO members (UserName,Email,Mobile,BloodGroup) VALUES('$UserName','$Email','$Mobile','$BloodGroup')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
