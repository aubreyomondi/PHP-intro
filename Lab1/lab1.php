<?php
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';

$con=new DBConnector;
if(isset($_POST['btn-save'])){
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$city=$_POST['city_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$file = $_FILES['fileToUpload'];
	$utc_timestamp = $_POST['utc_timestamp'];
    $offset = $_POST['time_zone_offset'];

	$user=new User($first_name, $last_name, $city, $username, $password, $file, $utc_timestamp, $offset);

	$uploader = new fileUploader;

	if (!$user->validateForm()) {
			$user->createFormErrorSessions("All fields are required");
			header("Refresh:0");
			die();
		}

	$res=$user->save($con->conn);
	
	//call uploadFile()
	$file_upload_response = $uploader->uploadFile();
	/*
	if ($file_upload_response) {
		$res=$user->save($con->conn);
	}
	else {
		echo "<br>"."Save operation failed:Error occurred on file upload!";
	}
	*/

}

$user=new User("", "", "", "", "", "", "", ""); 
$res=$user->readAll($con->conn);
echo "<br>";
echo "<thead>
            <tr>
                <th>User Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>File Uploaded</th>
            </tr>
        </thead>";
echo "<br>";
echo "<tbody>";
foreach($res as $row){
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['user_city'] . "</td>";
    echo "<td><img src=".$row['file']." width=\"50px\" height=\"50px\"></td>";
    //echo "<td>".$row['file']."</td>";
    echo "</tr>";
    echo "<br>";
}
echo "</tbody>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP OOP">
    <meta name="author" content="Aubrey J">

    <title>PHP OOP</title>

    <script type="text/javascript" src="assets/js/validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="timezone.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/validate.css">

</head>
<body>
	<form name="user_details" id="user_details" onsubmit="return validateForm()" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
		<table align="center">
			<tr>
					<td>
						<div id="form-errors">
							<?php 
								session_start();
								if (!empty($_SESSION['form_errors'])) {
									echo " ".$_SESSION['form_errors'];
									unset($_SESSION['form_errors']);
								}
							 ?>
						</div>
					</td>
				</tr>
			<tr>
				<td><input type="text" name="first_name" required placeholder="First Name"/></td>
			</tr>
			<tr>
				<td><input type="text" name="last_name" placeholder="Last Name"/></td>
			</tr>
			<tr>
				<td><input type="text" name="city_name" placeholder="City"/></td>
			</tr>
			<tr>
				<td><input type="text" name="username" placeholder="Username"></td>
			</tr>
			<tr>
				<td><input type="password" name="password" placeholder="Password"></td>
			</tr>
			<tr>
		 		<td>Profile Image:<input type="file" name="fileToUpload" id="fileToUpload" required></td>
		 	</tr>
			<tr>
				<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
			</tr>
			<input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
			<input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>
			<tr>
				<td><a href="login.php">Login</a></td>
			</tr>
		</table>
	</form>
</body>
</html>