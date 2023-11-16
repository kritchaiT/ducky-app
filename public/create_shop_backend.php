<?php
if(isset($_FILES['shop_pic'])){
    $name = $_POST['shop_name'];
    $uid = $_POST['user_id'];
    $descri = $_POST['description'];
    $type = $_POST['type'];
    $path = '../shop_imgs/'.$name.'.png';
    if(move_uploaded_file($_FILES['shop_pic']['tmp_name'],$path)){
        echo ("upload success");
    }
    else{ echo ('error<br>');}
}
?>