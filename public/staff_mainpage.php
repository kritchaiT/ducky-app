<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staff_mainpage.css">
</head>
<body>
<nav class="navbar">
            <div class="logo">
                <img src="logo.png" alt="ducky">
            </div>
            <ul>
                <li class="nav-button"><a href="index.php">Home</a></li>
                <li class="nav-button"><a href="about.php">About</a></li>
                <li class="nav-button"><a href="#">Contact</a></li>
                <li ><input class="nav-search" type="text"></li>
            </ul>
            <div class="logo">
            </div>
            <div class="nav-right">
                <a href="login.php">
                    <?php 
                        session_start();
                        echo $_SESSION["username"];
                    ?>
                </a>
                <a href="login.php"><img class="account" src="../pictures/account.png" alt="#"></a>
            </div>
        </nav>
    <?php 
        $username = $_SESSION["username"];
        $password = $_SESSION["password"];
        echo "hello";
    ?>
    <footer></footer>
</body>
</html>