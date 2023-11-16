<!-- can't upload shop profile picture :< -->
<?php
session_start();
include("../model/shop.php");
include("../model/Database.php");
include("../model/login.php");

#-----check if user id is set-----
if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
	$id = $_SESSION['user_id'];
	$login = new Login();

	$result_login = $login->check_login($id);

	if ($result_login) {
	#----- user is logged in-----
		echo 'logged in';
	#---------
	} else {
	#----- user is not logged in, redirects back to login page -----
			header("Location: login.php");
		die;
	}
} else {
	header("Location: login.php");
	die;
	#---------
}
#----------


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create shop</title>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// $ftype = explode('/',$_FILES["shop_pic"]["type"])[1];
	// var_dump($_FILES['shop_pic']);
	// if(isset($_FILES['shop_pic']))	{
	// 	print_r("file shop is set"); echo ("<br>");
	// 	$shop_name = $_POST['shop_name'];
	// 	print_r($shop_name); echo ("<br>");
	// 	$shop_img_path = "../shop_imgs/".$shop_name.".png";
	// 	var_dump($shop_img_path); echo ("<br>");
	// 	if(move_uploaded_file($_FILES['shop_pic']['tmp_name'],$shop_img_path))
	// 	{
	// 		print_r('successful upload'); echo ("<br>");
	// 	}
	// 	else{
	// 		print_r('error can not upload'); echo ("<br>");
	// 	}
	// 	// moving the file uploaded to the path defined relative to the file name
	// }	

	$shop = new Shop();
	$result = $shop->evaluate($_POST);

	if ($result == "") {
		#----- create shop success, redirect to somewhere -----
		# header("Location: choose redirect site here");
		// echo "success";
		header("Location: shop_profile.php"); exit();
		
		#----------
	} else {
		#----- create shop error, displays error message. Frontend pls handle -----
		echo $result;
		#-----
	}
}
?>

<form action="create_shop.php" method="POST">
    <!-- Assuming the user_id is retrieved and set elsewhere, e.g., from a session after the user logs in -->
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
    <input type="text" name="shop_name" placeholder="Shop Name" required />
    <textarea name="description" placeholder="Description"></textarea>
    <input type="text" name="type" placeholder="Shop Type" required />
    <!-- <input type="hidden" name="profile_picture_path" placeholder="Profile Picture Path" /> -->
	<!-- <input type='file' name='shop_pic'  accept="image/*" required  /> -->
    <button type="submit">Create Shop</button>
</form>
<br><a href="main.php">Back to main page</a>
</body>
</html>

