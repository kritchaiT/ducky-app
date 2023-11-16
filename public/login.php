<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<?php 
    // resetting the result
    $username = $password = "";
    $error = "";
    require_once("connection.php"); // connect to the database
    if($_SERVER["REQUEST_METHOD"] == "POST"){ // recieving the data from the form
        $username = $_POST["username"]; 
        $password = $_POST["password"];
        // var_dump($password);
        // var_dump($username);
        // var_dump($_POST["privilege"]);
        // echo "<br>";
        if($_POST["privilege"]=="staff"){ // using the privilege to classify the login
            
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
        
            $query = "SELECT user_id, staff_password FROM `user_auth` WHERE user_id = '$username' AND staff_password = '$password'";
            $result = mysqli_query($db, $query);
            // var_dump($result);
            if( $result){
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["user_id"] == $username and $row["staff_password"] == $password){
                        $_SESSION["username"] = $row["user_id"];
                        $_SESSION["password"] = $row["staff_password"];
                        header("Location: ./staff_mainpage.php"); // redirect to staff
                        exit();
                    } 
                    else {
                        // echo '<h3>staff checked but not found</h3><br>';
                        header("refresh:0 ; url=login.php");
                        exit();
                    }
                }
            }    
                // echo "<h3>found staff</h3><br>";
                
            
           
            
        }
        else{ 
            # ไม่ใช่ admin ก็เช็ค user ปกติต่อ
            $query = "SELECT * FROM `users` WHERE name = '$username' AND password = '$password'";
            $result = mysqli_query($db,$query);
            // print_r($result);
            // echo '<h3>checking client</h3><br>';
            if ($result){
                // echo '<h3>found client</h3><br>';
                // print_r($result);

            while ($row = mysqli_fetch_array($result))
            {
                if($row["name"]==$username and $row["password"]==$password){
                    $_SESSION["username"] = $row["name"];
                    $_SESSION["user_id"] = $row["user_id"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["status"] = $row["is_seller"];
                    if ($_SESSION["status"] == 1)
                    {
                        // var_dump('going seller page');
                        // echo '<br>';
                        header("refresh:0 ; url=shop_profile.php"); exit();
                    }
                    elseif ($_SESSION["status"] == 0)
                    {
                        // var_dump('going buyer page');
                        // echo '<br>';
                        header("refresh:0 ; url=main.php");  exit();
                }
                }
                // var_dump($row);
                
                
            }
        }
        else {
            // all fail
            header("refresh:0 ; url=login.php"); exit();
        }

            } 
        }
    ?>
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
                <a href="">SIGN IN</a>
                <a href=""><img class="account" src="../pictures/account.png" alt="#"></a>
            </div>
    </nav>
    <div class="login-container" style="justify-content: space-between;">
        <img src="logo.png" alt="logo">
        <form action="login.php" method="post" class="form">
            <select name = "privilege">
                <option value="client" selected>client/seller</option>
                <option value="staff">staff</option>
            </select>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" style="height : 30px; padding: 5px;" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" style="height : 30px; padding: 5px;" required>
            </div>
            <div class="link">
                <a href="register.php">create account</a> or <a href="">forget password</a>
            </div>
            <button type="submit" name="submit" style="margin-top:20px; margin-bottom:20px; "> Submit </button>
        </form>
    </div>
</body>
<div class="footer">
        
    </div>
</html>