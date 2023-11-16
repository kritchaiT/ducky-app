<?php
session_start();
require("connection.php");
if ((!isset($_POST["item_id"])) && (isset($_POST["shop_id"]))) //Add Item
{
    $shop_id = $_POST["shop_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_type = $_POST["product_type"];
    $description = $_POST["description"];
    $product_img = $_FILES["product_img"];
    $product_img_path = "../product_imgs/".$product_name.".png";

    move_uploaded_file($product_img['tmp_name'], $product_img_path);

    $query = "
    INSERT INTO `items` (`item_id`, `shop_id`, `product_name`, `product_price`, `product_type`, `product_img_path`, `description`)
    VALUES (NULL, '$shop_id', '$product_name', '$product_price', '$product_type', '$product_img_path', '$description') 
    ";

    if (mysqli_query($db, $query))
    {
        header("refresh:0 ; url=edit_item.php");
    }
    else
    {
        echo("<h1> ERROR!! </h1> <br>");
        echo($query);
    }
}
elseif ((isset($_POST["item_id"])) && (isset($_POST["delete"]))) //Delete Item
{
    $item_id = $_POST["item_id"];
    $query = "DELETE FROM `items` WHERE `items`.`item_id` = $item_id";

    if (mysqli_query($db, $query))
    {
        header("refresh:0 ; url=edit_item.php");
    }
    else
    {
        echo("<h1> ERROR!! </h1> <br>");
        echo($query);
    }
}
elseif (isset($_POST["item_id"])) //Edit Item
{
    $shop_id = $_POST["shop_id"];
    $item_id = $_POST["item_id"];

    $query = "SELECT * FROM items WHERE item_id = '$item_id'";
    $result = mysqli_query($db, $query);
    $list = mysqli_fetch_array($result);

    if ($_POST["product_name"] != "") {$product_name = $_POST["product_name"];} else {$product_name = $list["product_name"];}
    if ($_POST["product_price"] != "") {$product_price = $_POST["product_price"];} else {$product_price = $list["product_price"];}
    if ($_POST["product_type"] != "") {$product_type = $_POST["product_type"];} else {$product_type = $list["product_type"];}
    if ($_POST["description"] != "") {$description = $_POST["description"];} else {$description = $list["description"];}
    if (($_FILES["product_img"]['tmp_name']) && ($_POST["product_name"] != "")) {$product_img_path = "../product_imgs/".$product_name.".png";} else {$product_img_path = $list["product_img_path"];}

    if ($_FILES["product_img"]['tmp_name'])
    {
        move_uploaded_file($_FILES["product_img"]['tmp_name'], $product_img_path);
    }

    $query = "
    UPDATE `items` SET `product_name` = '$product_name', `product_price` = '$product_price', `product_type` = '$product_type', `product_img_path` = '$product_img_path',
    `description` = '$description' WHERE `items`.`item_id` = $item_id
    ";

    if (mysqli_query($db, $query))
    {
        header("refresh:0 ; url=edit_item.php");
    }
    else
    {
        echo("<h1> ERROR!! </h1> <br>");
        echo($query);
    }
}
elseif ($_SESSION["user_id"] != FALSE)
{
    #header("refresh:0 ; url=main.php");
}
else
{
    #header("refresh:0 ; url=login.php");
}
?>