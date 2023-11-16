<!-- line 55 and below are no longer used, replaced by edit_item.php and it's backend -->
<?php require_once("check_login.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase</title>
</head>
<body>
    <?php
        session_start();
        require("connection.php");

        if ((isset($_POST['item_id'])) && (isset($_POST["count"])))
        {
            $item_id = $_POST["item_id"];
            $count = $_POST["count"];

            $query = "SELECT * FROM items WHERE item_id = '$item_id'";
            $result = mysqli_query($db, $query);
            $list = mysqli_fetch_array($result);

            $product_name = $list['product_name'];
            $product_img_path = $list['product_img_path'];
            $total_price = $list['product_price'] * $count;
            $shop_id = $list['shop_id'];

            #$product_img_path = "../product_imgs/".$item_id;
            $shop_qr_path = "../shop_qr/".$shop_id;

            echo("<h2> Item Name: $product_name </h2>");
            echo("<img src='$product_img_path' alt='' width='500'  height='500'>");
            echo("<p> Total Price: $total_price </p>");
            echo("<img src='$shop_qr_path' alt='' width='500'  height='500'>");
            echo("Close this tab after finish and continue shopping");
        }
        elseif (isset($_POST['item_id']))
        {
            $item_id = $_POST['item_id'];

            $query = "SELECT * FROM items WHERE item_id = '$item_id'";
            $result = mysqli_query($db, $query);
            $list = mysqli_fetch_array($result);

            $product_name = $list["product_name"];
            $product_img_path = $list["product_img_path"];
            $product_price = $list['product_price'];

            echo(
                "<FORM METHOD=POST ACTION='purchase.php'>
                <table>
                <tr>
                    <td>$product_name</td>
                    <td><img src='$product_img_path' alt='' width='200' height='150'></td>
                </tr>
                <tr>
                    <td>price per unit:</td>
                    <td>$product_price</td>
                </tr>
                <tr>
                    <td>How many do you want to buy?</td>
                    <td><INPUT TYPE='number' NAME='count' required></td>
                </tr>
                <tr>
                    <td>gift code</td>
                    <td><INPUT TYPE='text' NAME='code' placeholder='xxxxxxxxxxxxxx'></td>
                </tr>
                </table>

                <INPUT TYPE='hidden' name='item_id' value=$item_id>

                <INPUT TYPE='submit' value='Okay!'>
                </FORM>
                "
                );
        }
        elseif (isset($_GET['quick_buy']))
        {
            echo(
                "<FORM METHOD=POST ACTION='purchase.php'>
                <table>
                <tr>
                    <td>item id</td>
                    <td><INPUT TYPE='text' NAME='item_id' required></td>
                </tr>
                <tr>
                    <td>count</td>
                    <td><INPUT TYPE='number' NAME='count'></td>
                </tr>
                </table>
                <INPUT TYPE='submit' value='Okay!'>
                </FORM>
                "
                );
        }
        else
        {
            #header('refresh: 0; url=purchase.php?quick_buy');
            header("refresh:0 ; url=search_data.php?keyword=");
        }
        // elseif (isset($_GET['add_item']))
        // {
        //     echo(
        //         "
        //         <FORM METHOD='POST' ACTION='purchase.php' ENCTYPE='multipart/form-data'>
        //         <table>
        //         <tr>
        //             <td>shop id</td>
        //             <td><input type='text' name='shop_id' required></td>
        //         </tr>
        //         <tr>
        //             <td>product name</td>
        //             <td><input type='text' name='product_name' required></td>
        //         </tr>
        //         <tr>
        //             <td>product price</td>
        //             <td><input type='text' name='product_price' required></td>
        //         </tr>
        //         <tr>
        //             <td>product type</td>
        //             <td><input type='text' name='product_type' required></td>
        //         </tr>
        //         <tr>
        //             <td>description</td>
        //             <td><input type='text' name='description'></td>
        //         </tr>
        //         <tr>
        //             <td>product image</td>
        //             <td><input type='file' name='product_img' accept='image/*' required></td>
        //         </tr>
        //         </table>
        //         <input type='submit' value='ADD ITEM'>
        //         <INPUT TYPE='hidden' name='add_item' value=1>
        //         </FORM>
        //         ");
        // }
        // elseif (isset($_POST['add_item']))
        // {
        //     $shop_id = $_POST["shop_id"];
        //     $product_name = $_POST["product_name"];
        //     $product_price = $_POST["product_price"];
        //     $product_type = $_POST["product_type"];
        //     $description = $_POST["description"];
        //     $product_img = $_FILES["product_img"];
        //     $product_img_path = "../product_imgs/".$product_name.".png";

        //     move_uploaded_file($product_img['tmp_name'], $product_img_path);

        //     $query = "
        //         INSERT INTO `items` (`item_id`, `shop_id`, `product_name`, `product_price`, `product_type`, `product_img_path`, `description`)
        //         VALUES (NULL, '$shop_id', '$product_name', '$product_price', '$product_type', '$product_img_path', '$description') 
        //     ";

        //     if (mysqli_query($db, $query))
        //     {
        //         header("refresh:0 ; url=purchase.php?add_item");
        //     }
        //     else
        //     {
        //         echo("Error");
        //     } 
        // }

    ?>
</body>
</html>