<?php
    require_once("connection.php");
    $forum_name = $_POST["forum_name"];
    $creator_id = $_POST["creator_id"];
    
    $query = 
    "INSERT INTO `forum_sessions` (`forum_session_name`, `creator_id`, `created_at`) VALUES ('$forum_name', '$creator_id', current_timestamp())";
   
    if (mysqli_query($db,$query))
    {
        header("Location: .\create_forum.php");
        exit();
    }
    else
    {
        echo("<h1>ERROR!!</h1>");
        
    }


?>