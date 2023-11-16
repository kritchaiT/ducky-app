<?php require_once("check_login.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Item </title>
</head>
<body>
<?php
        session_start();
        require("connection.php");
        if ($_SESSION["user_id"] == FALSE)
        {
            header("refresh:0 ; url=login.php");
        }
        elseif (($_SESSION["status"] == 0))
        {
            header("refresh:0 ; url=main.php");
        }

        $user_id = $_SESSION["user_id"];
        $user_name = $_SESSION["username"];
        // $user_id = 1001;
        // $user_name = "POOM";

        $query = "SELECT shop_id, shop_name FROM `shops` WHERE user_id = $user_id";
        $result = mysqli_query($db, $query);
        $list = mysqli_fetch_array($result);
        if (!$list)
        {
            header("refresh:0 ; url=create_shop.php");
        }
        $shop_id = $list["shop_id"];
        $shop_name = $list["shop_name"];
?>
<a href="logout.php">LOG OUT</a>
<h1> <?php echo("$shop_name's catalog") ?> </h1>
<hr>
<table>
<tr>
<td>
<div style="border: 1px solid rgb(23, 65, 202); height: 700px; width:700px; overflow-y: scroll; overflow-x: scroll;">
    <table border='1'>
        <th width='100'> Product Name </th> <th width='100'> Product Price </th> <th width='100'> Product Type </th> <th width='150'> Description </th> <th> Product Image </th> <th> </th> <th> </th>
        <?php
            $query = "SELECT * FROM `items` WHERE shop_id = $shop_id";
            $result = mysqli_query($db, $query);
            while ($list = mysqli_fetch_array($result))
            {
                $item_id = $list["item_id"];
                $product_name = $list["product_name"];
                $product_price = $list["product_price"];
                $product_type = $list["product_type"];
                $description = $list["description"];
                $product_img_path = $list["product_img_path"];

                echo("<tr>");
                echo("<td> $product_name </td>");
                echo("<td> $product_price </td>");
                echo("<td> $product_type </td>");
                echo("<td> $description </td>");
                echo("<td> <img src='$product_img_path' alt='' width='100' height='75'> </td>");
                echo("<td> <FORM METHOD='POST' ACTION='edit_item.php'> <input type='hidden' name='item_id' value=$item_id> <input type='hidden' name='product_name' value=$product_name> <input type='submit' value='edit'> </FORM> </td>");
                echo("<td> <FORM METHOD='POST' ACTION='edit_item_backend.php'> <input type='hidden' name='item_id' value=$item_id> <input type='hidden' name='delete' value=1> <input type='submit' value='delete'> </FORM> </td>");
                echo("</tr>");
            }
        ?>
    </table>
</div>
</td>
<td>
<h2>
<?php
    if (isset($_POST["item_id"]))
    {
        $item_id = $_POST["item_id"];
        $product_name = $_POST["product_name"];
        echo("Edit Item : $product_name");
    }
    else
    {
        echo("Add Item");
    }
?>
</h2>
<FORM METHOD='POST' ACTION='edit_item_backend.php' ENCTYPE='multipart/form-data'>
<table>
    <tr>
        <td> Product Name </td>
        <td><input type='text' name='product_name' <?php if (!isset($_POST["item_id"])) {echo("required");} ?>></td>
    </tr>
    <tr>
        <td> Product Price </td>
        <td><input type='number' step='any' name='product_price' <?php if (!isset($_POST["item_id"])) {echo("required");} ?>></td>
    </tr>
    <tr>
        <td> Product Type </td>
        <td><input type='text' name='product_type' <?php if (!isset($_POST["item_id"])) {echo("required");} ?>></td>
    </tr>
    <tr>
        <td> Description </td>
        <td><input type='text' name='description'></td>
    </tr>
    <tr>
        <td> Product Image</td>
        <td><input type='file' name='product_img' accept='image/*' <?php if (!isset($_POST["item_id"])) {echo("required");} ?>></td>
    </tr>
    <tr>
        <td> <input type='submit' value='<?php if (isset($_POST["item_id"])) {echo("EDIT ITEM");} else {echo("ADD ITEM");} ?>'> </td>
        <td>  </td>
    </tr>
</table>
<input type='hidden' name='shop_id' value=<?php echo($shop_id); ?>>
<?php
    if (isset($_POST["item_id"]))
    {
        $item_id = $_POST["item_id"];
        echo("<input type='hidden' name='item_id' value=$item_id>");
    }
?>
</FORM>
<?php if (isset($_POST["item_id"])) {echo("<button onclick=\"document.location='edit_item.php'\"> EXIT EDIT </button>");} ?>
</td>
</tr>
</table>
</body>
</html>