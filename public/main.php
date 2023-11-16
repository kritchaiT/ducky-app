<?php require_once("check_login.php"); ?>
<?php // session_start(); // start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="wrapper">
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
<?php 

if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
}
?>
<h2>Join Forum now!</h2>
<table>
    <tr>
        <td>forum_name</td> 
        <td>creator_pic</td>
        <td>creator_name</td>     
    </tr>
    <?php
    require_once("connection.php");

    // query for creator,creator_pic_path,forum id, forum name for 5 most recently created forum
    $query_forum = "SELECT u.name as creator, u.profile_picture_path as path, f.forum_session_id as forum_id ,f.forum_session_name as forum_name FROM forum_sessions as f LEFT JOIN users as u ON f.creator_id = u.user_id ORDER BY f.created_at DESC LIMIT 5";
    $result = mysqli_query($db,$query_forum);
    while($row = mysqli_fetch_array($result)){
        $creator = $row["creator"] ;
        $path   = $row["path"];
        $fid = $row["forum_id"];
        $fname = $row["forum_name"];
        
        // show the 5 forums and sent you to chat.php if clicked along with FORUM_ID in 'GET' method
        echo ("<tr>   
        <td><a href=chat.php?forum_id=$fid>$fname</a></td> 
        <td><a href=chat.php?forum_id=$fid><img src=$path style = 'width: 5%; height: 5%'></a></td>
        <td>creator: $creator</td>
        </tr>\n");        
    }
    ?>
</table>
<br>
<br>
<table>
    <h2>Try it!</h2>
    <p> จะบอกว่า shop มันอัพโหลดรูปไม่ได้นะ ก็เลยแสดงแต่ชื่อ ตอนจัดหน้าอาจจะเปลี่ยนสีพื้นหลังชื่อร้านให้ดูมีอะไรหน่อย หรือไม่ก็ปล่อยไว้ก็ได้ เสร็จแล้วก็ลบข้อความนี้ทิ้งในไฟล์ main.php line 68-69</p>
    <?php
    require_once("connection.php");
    //query 5 random shops and show it
    $query_shop = "SELECT s.shop_id as id, s.shop_name as sname, s.profile_picture_path as path FROM shops as s ORDER BY RAND() LIMIT 5";
    $result = mysqli_query($db,$query_shop);
    while($row = mysqli_fetch_array($result)){
        $shop_id = $row["id"];
        $sname = $row["sname"];
        $path = $row["path"];
        // suppose to show shop profile pic but can't be used cuz shop pic can't be upload when create shop :)
        // <td> <form method='POST' action='shop.php'> <input type='hidden' name='shop_id' value='$shop_id'> <input type='image' name='submit' src=$path border='0' alt='submit' width='100' height='100'/> </form> </td> 
        echo("<tr>
         
        <td> <form method='POST' action='shop.php'> <input type='hidden' name='shop_id' value='$shop_id'> <input type='submit' value='$sname'> </form> </td>
        </tr>\n");
    }
    //<td> <a href=shop.php?shop_id=$shop_id> <img src=$path alt='no_pic' > </a> </td>
    //<td><a href=shop.php?shop_id=$shop_id>$sname </a></td>
    ?>
</table>
    <!-- <h1>Hi Client</h1> -->
</body>
</html>