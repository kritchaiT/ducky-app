<?php 
    $db = mysqli_connect("127.0.0.1","t66g9","t66g9",); // conected to the mySql database
    mysqli_select_db($db,"t66g9"); // to select the database that we would like to use
    mysqli_query($db,"SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
?>