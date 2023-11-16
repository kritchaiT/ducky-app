<?php session_start(); ?>
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
                <a href="logout.php">LOG OUT</a>
                <a href="logout.php"><img class="account" src="../pictures/account.png" alt="#"></a>
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
<?php
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    } else{ #$user_id = "Philomean";
    $user_id = "1003";
    }
?>
<form action="create_forum_backend.php" method="post" enctype="multipart/form-data" style="height: 60%;">
<div class="fc">
    <h3>forum_name</h3>
    <input type="text" name="forum_name"  required>
</div>
<div class="fc">
    <input type="hidden" name="creator_id" value=<?= $user_id ?>> 
</div>
    
<br>
<div class="submit" style="width: 50%; height: 10%;">
    <input type="submit" value="create_forum">
</div>
</form>

</div>
<footer>

</footer>
</body>
</html>