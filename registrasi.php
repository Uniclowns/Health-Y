<?php
require 'functions.php';
$conn = mysqli_connect("localhost","root","","healthydata");
if( isset($_POST["register"])) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
		alert('user baru berhasil ditambahkan!');
		</script>";
	} else {
		echo mysqli_error($conn);
	}
}
function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);

	$result = mysqli_query($conn,"SELECT * FROM healthyuser WHERE name='$username'");
	if( mysqli_fetch_assoc($result) ){
		echo "<script>
		alert('Try another name!');
		</script>";
		return false;
	}


	if($password !== $password2){
		echo "<script>alert('failed');</script>";
		return false;
	}
	
	mysqli_query($conn,"INSERT INTO healthyuser VALUES('$username','$password')");
	header("Location: index.php");
	return mysqli_affected_rows($conn);

}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style/login.css">
    <link href="https://fonts.googleapis.com/css?family=Changa&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/5.png" type="image/x-icon">
    <link rel="icon" href="assets/5.png" type="image/x-icon">
	<title></title>
</head>
<style type="text/css">
	.form{
		margin: 60px 0 0 40%;
	}
	ul{
		list-style-type: none;
	}
	input:focus{
border-bottom: 1px solid #000;
	}
</style>
<body>



	<div class="header">
        <h1>HEALTH-Y</h1>
    </div>

    

   <div class="form">
   	
   	<form action="" method="post">

		<ul>
			<li>
				<div class="finput">
				<label for="username">username </label><br>
				<input type="text" name="username" id="username" required>
			 	</div>
			</li>

			<li>
				<div class="finput">
				<label for="password">password </label><br>
				<input type="password" name="password" id="password" required style="outline: 0;">
				</div>
			</li>
			<li>
				<div class="finput">
				<label for="password2">konfirmasi password </label><br>
				<input type="password" name="password2" id="password" required style="outline: 0;">
				</div>
			</li>
			<li>
				<div class="button">
				<button type="submit" name="register">Register!</button>
			 	</div>
			</li>
		</ul>
	</form>
   </div>






	
</body>
</html>