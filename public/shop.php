<?php require_once("check_login.php");  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

  </head>
  <body>
  <a href="search_data.php">Back to store list</a>
    <?php
    if (!isset($_POST["shop_id"]))
    {
      header("refresh:0 ; url=search_data.php?keyword=");
    }
    $SHOP_ID  = $_POST['shop_id'];
    require('connection.php');
    $sql = '
    SELECT shops.shop_id,shops.shop_name,product_name,product_price,product_type,product_img_path,items.description, items.item_id
    FROM items Left Join shops ON shops.shop_id = items.shop_id 
    WHERE items.shop_id = ' . $SHOP_ID . '
        ';

    $objQuery = mysqli_query($db, $sql) or die("Error Query [" . $sql . "]");  
    ?>  
    <h1><?php echo mysqli_fetch_array($objQuery)["shop_name"]; ?></td></h1>
  <table border="1">
    <tr>
      <th width="50">
        <div align="center">No</div>
      </th>
      <th width="100">
        <div align="center">Product Name</div>
      </th>
      <th width="100">
        <div align="center">Product Price</div>
      </th>
      <th width="100">
        <div align="center">Product Type</div>
      </th>
      <th width="100">
        <div align="center">Product Image</div>
      </th>
      <th width="150">
        <div align="center">Description</div>
      </th>
      <th width="100">
        <div align="center">Buy</div>
      </th>
      
    <?php
    $objQuery = mysqli_query($db, $sql) or die("Error Query [" . $sql . "]");  
    $i = 1;
    while ($objResult = mysqli_fetch_array($objQuery)) {
    
      $path = $objResult["product_img_path"];
      $item_id = $objResult["item_id"];
      $product_name = $objResult["product_name"];
      $product_price = $objResult["product_price"];
    ?>
      <tr>
        <td>
          <div align="center"><?php echo $i; ?></div>
        </td>
        <td><?php echo $product_name; ?></td>
        <td><?php echo $product_price; ?></td>
        <td><?php echo $objResult["product_type"]; ?></td>
        <td><?php echo ("<img src='$path' style='width: 100px; height: 75px;'>"); ?></td>
        <td><?php echo $objResult["description"]; ?></td>
        <td> <div align="center"> <?php echo ("<FORM METHOD='POST' target='_blank' ACTION='purchase.php'> <input type='hidden' name='item_id' value=$item_id> <input type='submit' value='buy'> </Form>"); ?> </div> </td>
      </tr>
    <?php
      $i++;
    }
    ?>
    
  </body>
</html>
