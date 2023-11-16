<?php
	$fname = $_POST["username"]; // getting the username
	$ftype = explode('/',$_FILES["user_pic"]["type"])[1];
	if(isset($_FILES['user_pic']))	{
		move_uploaded_file($_FILES['user_pic']['tmp_name'],"../profile_imgs/".$fname.'.'.$ftype);
		// uploading the file to the folder indicated
	}
	/* upload file to folder profile_imgs and save as username.originalfiletype */
	require_once("connection.php");
	$username = $_POST["username"];
	$password = $_POST["password"];
	$age = $_POST["user_age"];
	$email = $_POST["user_email"];
	$bio = $_POST["user_bio"];
	$path = "../profile_imgs/".$fname.'.'.$ftype;
	$seller = $_POST["is_seller"];
	
	#$query = "INSERT INTO users SET name= '$username', age= $age, email= '$email', password = '$password', is_seller = $seller, bio = '$bio', profile_picture_path = '$path'";

	$query = "
	INSERT INTO `users` (`user_id`, `name`, `age`, `email`, `bio`, `password`, `profile_picture_path`, `is_seller`, `created_at`)
	VALUES (NULL, '$username', '$age', '$email', '$bio', '$password', '$path', '$seller', current_timestamp())
	";

	if (mysqli_query($db,$query))
	{
		header("refresh: 0; url=login.php");
	}
	else
	{
		echo("<h1>ERROR!!</h1>");
	}
?>