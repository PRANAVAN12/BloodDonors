<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	$UserName = mysqli_real_escape_string($mysqli, $_POST['UserName']);
	$Email = mysqli_real_escape_string($mysqli, $_POST['Email']);
	$Mobile = mysqli_real_escape_string($mysqli, $_POST['Mobile']);	
	$BloodGroup= mysqli_real_escape_string($mysqli, $_POST['BloodGroup']);	

	// checking empty fields
	if(empty($name) || empty($Email) || empty($email)|| empty($BloodGroup)) {	
			
		if(empty($UserName)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($Email)) {
			echo "<font color='red'>email field is empty.</font><br/>";
		}
		
		if(empty($Mobile)) {
			echo "<font color='red'>Mobile field is empty.</font><br/>";
		}
		if(empty($BloodGroup)) {
			echo "<font color='red'>BloodGroup field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE users SET UserName='$UserName',Email='$Email',Mobile='$Mobile' ,BloodGroup='$BloodGroup' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM members WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$UserName = $res['UserName'];
	$Email = $res['Email'];
	$Mobile = $res['Mobile'];
	$BloodGroup = $res['BloodGroup'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="UserName" value="<?php echo $UserName;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="Email" value="<?php echo $Email;?>"></td>
			</tr>
			<tr> 
				<td>Mobile</td>
				<td><input type="text" name="Mobile" value="<?php echo $Mobile;?>"></td>
			</tr>
			<tr> 
				<td>BloodGroup</td>
				<td><input type="text" name="BloodGroup" value="<?php echo $BloodGroup;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
