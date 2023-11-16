<?php require("check_login.php");  ?>
<?php session_start(); ?> 
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>chat room</title>
	<link rel="stylesheet" type="text/css" href="chat.css">
</head>
<body>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-size: 400% 400%;
			width: 100%;
			height: 100vh;
			animation: gradient 10s infinite alternate;
		}
		
		.under {
			position: sticky;
			top: 0;
			z-index: 0;
		}

		.over{
			margin-top: -100vh;
			z-index: 10;
			position: relative;
			background-color: rgb(255, 255, 255);
			height: 200vh;
		}

		.contentt {
			z-index: 0;
			width: 100%;
			padding: 0px;
			margin: 0px;
			height: 100%;
		}

		.bgm {
			width: 100%;
			height: auto;
			position: sticky;
			top: 0;

		}
		.navbar {
			background: rgba(255, 252, 219, 0.7);
			padding: 0px;
			position: relative;
			top: 0;
			z-index: 100;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
			width: 100%;
			min-height: 50px;
		}
		.account {
			width: 30px;
			height: 30px;
			margin-right: 20px;
			margin-left: 10px;
		}
		.navbar ul {
			list-style: none;
			text-align: center;
			display: flex;
		}

		.navbar li {
			display: inline;
			margin: 0 20px;
		}

		.navbar a {
			text-decoration: none;
			color: #333;
			font-weight: bold;
		}

		.nav-button{
			background-color: #fcb400;
			padding: 10px 10px;
			border-radius: 100px;
			width: 100px;
			height: 20px;
		}
		.nav-button:hover{
			background-color: #ffffff;
		}
		.nav-search {
			background-color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
			height: 40px;
			width: 400px;
			border-radius: 100px;
			padding: 0px 10px;
			border: #3e3e3e;
		}
		.nav-right {
			padding: 0px;
			margin: 0px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: row;
		}
		.chat-container {
			width: 300px;
			margin: 0 auto;
			border: 1px solid #ccc;
			border-radius: 5px;
			overflow: hidden;
		}

		.chat-messages {
			height: 300px;
			overflow-y: scroll;
			padding: 10px;
			background-color: #f9f9f9;
		}

		.chat-input {
			padding: 10px;
			background-color: #fff;
		}

		form {
			display: flex;
			justify-content: space-between;
		}

		input[type="text"] {
			flex: 1;
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		.button {
			background-color: #007BFF;
			color: #fff;
			border: none;
			padding: 5px 10px;
			width: 100px;
			border-radius: 5px;
			cursor: pointer;
		}

		.button:hover {
			background-color: #0056b3;
		}

		form {
			padding: 20px;
		}
		.fname {
			font-size: larger;
		}
		.message {
			width: 70%;
			height: auto;
			background-color: #ccc;
			margin: 0;
			padding: 15px 15px;
			border-radius: 5px;
		}
		.sender {
			margin: 0;
			padding: 0;
		}

	</style>
	<nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="ducky">
            </div>
            <ul>
                <li class="nav-button"><a href="index.php">Home</a></li>
                <li class="nav-button"><a href="#">About</a></li>
                <li class="nav-button"><a href="#">Contact</a></li>
                <input class="nav-search" type="text">
            </ul>
            <div class="logo">
            </div>
            <div class="nav-right">
                <a href="logout.php">LOG OUT</a>
                <a href=""><img class="account" src="../pictures/account.png" alt="#"></a>
            </div>
    </nav>
	<div style="padding: 0px 40px; height: 75vh; overflow: scroll;">
	<?php
	// showing data part
	require_once('connection.php');
	$username = $_SESSION["username"]; // getting the user's name
	if (isset($_GET['forum_id'])) {
		$fid = $_GET["forum_id"];
		$_SESSION["forum_id"] = $fid;
	} else {
		$fid = $_SESSION["forum_id"];
	}
	if (!isset($fname)) {
		$fname_query = "SELECT forum_session_name FROM forum_sessions WHERE forum_session_id = '$fid'";
    	$fname_result = mysqli_query($db, $fname_query);
    	while($fname_row = mysqli_fetch_array($fname_result)){
			$fname = $fname_row['forum_session_name'];
		}
	}
	
	$query="SELECT * FROM chat_messages INNER JOIN users ON chat_messages.sender_id = users.user_id WHERE chat_messages.forum_session_id = '$fid' ORDER BY chat_messages.timestamp"; 
	// เอาตาราง chat_messages กับ users มา join กันจะได้ดึงข้อมูลง่ายขึ้น

	$result=mysqli_query($db,$query);
	echo "<div class='fname'>".$fname.'</div>'."<br>"."<br>";

	while($list=mysqli_fetch_array($result))
	{
		
		echo "<div class='message'>".$list['message_content']."</div>"."<br>";
        if($list['picture_content_path']){
			$pic_path = $list["picture_content_path"];
			echo  ("<img src='$pic_path' style='width: 100px; height: 75px;'")."<br>";
			//echo <img src=$list['picture_content_path'] style = 'width: 5%; height: 5%'>
		}
		//<a href=chat.php?forum_id=$fid><img src=$path style = 'width: 5%; height: 5%'></a>
		echo "<div class='sender'>"."by ".$list['name']." ".$list['timestamp'].'</div>'."<br>";
		//ให้มันแสดงผลเป็นข้อความที่พิมพ์ ตามด้วยชื่อคนพิมพ์และtimestamp
			
	}
	$query = "SELECT user_id FROM `users` WHERE name = '$username'";
	$result=mysqli_query($db,$query);
	while($list=mysqli_fetch_array($result)){
		$user_id = $list["user_id"];
	}

?>
	</div>
	
	<form action="chat.php" method="post">
		<input type="text" name="message_content" style="border-radius: 100px;">
		<label for="image">Select Image:</label>
        <input type="file" name="file" id="image" accept="image/*" >
		<div style="padding: 10px;">
			<input type="submit" class="button">
			<input type="reset" class="button">
		</div>
	<!-- เป็นแถบพิมพ์ข้อความ และมีปุ่มส่งกับรีเซ็ท -->
	</form>
	<a href="main.php">Back to main page</a>
	<?php 
	// sending part
	$query= "";
	$_SESSION["path"] = "";
	isset( $_FILES['file']['tmp_name'] ) ? $file_tmp_name = $_FILES['file']['tmp_name'] : $file_tmp_name = "";
    if($file_tmp_name != "") {
		echo "horey!";
		$ftype = explode('/',$_FILES["file"]["type"])[1];
        $fname = $_FILES['file']['name'];
        move_uploaded_file( $file_tmp_name, "../chat/".$fname.".".$ftype );
		$_SESSION["path"] = "../chat/".$fname.".".$ftype;
		$picture_content_path= $_SESSION["path"];
    }
	// if their is a file uploaded => define the path to store the file currectly
	// if(isset($_FILES['image']))	{ // check if their is a picture uploaded
	// 	$ftype = explode('/',$_FILES["user_pic"]["type"])[1]; // getting the file type
	// 	move_uploaded_file($_FILES['user_pic']['tmp_name'],"../chat/".$fname.".".$ftype);
	// 	// moving the file from the temporary path to the path defined
	// 	$path = "../chat/".$fname.".".$ftype;
	// }

	if(isset($_POST['message_content']) and $_POST['message_content'] != "" and isset($_SESSION["path"]) and $_SESSION["path"] != ""){
		// if message content isset and not null
		// if picture path isset
		$message_content= $_POST['message_content'];
		$picture_content_path= $_SESSION["path"];
		//กำหนดตัวแปรที่เก็บค่า ข้อความที่พิมพ์,user_id	
		require_once('connection.php');
		$query = "INSERT INTO chat_messages VALUES (NULL, '$fid', NULL, '$user_id', '$message_content','$picture_content_path' , current_timestamp());";
		//นำค่าไปเก็บในตาราง
		$result=mysqli_query($db,$query); 
		//header("refresh: 0; url=chat.php?forum_id=$fid");
		echo "<meta http-equiv='refresh' content='0'>";
	}else if(isset($_POST['message_content']) and $_POST['message_content'] != "" ){
		$message_content= $_POST['message_content'];
		//กำหนดตัวแปรที่เก็บค่า ข้อความที่พิมพ์,user_id	
		require_once('connection.php');
		$query = "INSERT INTO chat_messages VALUES (NULL, '$fid', NULL, '$user_id', '$message_content',NULL , current_timestamp());";
		//นำค่าไปเก็บในตาราง
		$result=mysqli_query($db,$query); 
		//header("refresh: 0; url=chat.php?forum_id=$fid");
		echo "<meta http-equiv='refresh' content='0'>";
	}else if(isset($_SESSION["path"]) and $_SESSION["path"] !="" ){
		$picture_content_path= $_SESSION["path"];
		//กำหนดตัวแปรที่เก็บค่า ข้อความที่พิมพ์,user_id	
		require_once('connection.php');
		$query = "INSERT INTO chat_messages VALUES (NULL, '$fid', NULL, '$user_id', NULL, '$picture_content_path' , current_timestamp());";
		//นำค่าไปเก็บในตาราง
		$result=mysqli_query($db,$query); 
		//header("refresh: 0; url=chat.php?forum_id=$fid");
		echo "<meta http-equiv='refresh' content='0'>";
	}	
	?>
	
</body>
</html>