<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="register.css">
</head>
<body>
	<nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="ducky">
            </div>
            <ul>
                <li class="nav-button"><a href="#">Home</a></li>
                <li class="nav-button"><a href="about.php">About</a></li>
                <li class="nav-button"><a href="#">Contact</a></li>
                <li ><input class="nav-search" type="text"></li>
            </ul>
            <div class="logo">
            </div>
            <div class="nav-right">
                <a href="login.php">SIGN IN</a>
                <a href="login.php"><img class="account" src="../pictures/account.png" alt="#"></a>
            </div>
    </nav>
	<div class="container" style="width: 60%; 
    height: 80vh; 
    background: linear-gradient(154deg, rgba(255, 255, 255, 0.40) 0%, rgba(255, 255, 255, 0) 100%);
	padding: 20px; 
    border-radius: 10px; 
    justify-content: space-between; 
    display: flex; flex-direction: column;">
	<img src="logo.png" alt="logo" style="width: 250px;">
	<form action="register_backend.php" method="post" enctype="multipart/form-data" style="height: 60%;">
	<div class="fc">
		<h3>Name</h3>
		<input type="text" name="username"  required>
	</div>
	<div class="fc">
	<h3>Email</h3>
		<td><input type="text" name="user_email" required>
	</div>
	<div class="fc">
		<h3>Password</h3>
		<input type="password" name="password" required>
	</div>
	<div class="fc">
	<td>Profile Picture</td>
		<input type="file" name="user_pic"  accept="image/*" required>
	</div>
	<div class="fc">
	<label for="is_seller">Are you a seller?</label>
	<p><input type="radio" name="is_seller"> Yes. I'm a seller.</p>
	<p><input type="radio" name="is_seller"> No. I'm a customer.</p>
	</div>
	<div class="bio" >
		<h3>Bio</h3>
		<input type="text" name="user_bio" style="width: 50%; height: 70px; text-align: left; ">
	</div>
	<!-- <table>
	<tr>
		<td>Name</td>
		<td><input type="text" name="username"  required></td>
	</tr>
	<tr>
		<td>Age</td>
		<td><input type="number" name="user_age" required></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input type="text" name="user_email" required></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" required></td>
	</tr>
	<tr>
		<td>Bio</td>
		<td><input type="text" name="user_bio" required></td>
	</tr>
	<tr>
		<td>Profile Picture</td>
		<td><input type="file" name="user_pic"  accept="image/*" required></td>
	</tr>
	<tr>
		<td><label for="is_seller">Are you a seller?</label></td>
		<td><input type="radio" name="is_seller"> Yes. I'm a seller.</td>
		<td><input type="radio" name="is_seller"> No. I'm a customer.</td>
	</tr>
	</table> -->
	<br>
	<div class="submit" style="width: 50%; height: 10%;">
		<input type="submit" value="register">
	</div>
	</form>
	
	</div>
	<footer>

	</footer>
</body>
</html>