<?php require_once("check_login.php"); ?>
<html>

<head></head>

<body>
  <?php
  if (!isset($_GET["keyword"]))
  {
    header("refresh:0 ; url=search_data.php?keyword=");
  }
  $keyword  = $_REQUEST['keyword'];
  require('connection.php');

  $sql = "
    SELECT *
    FROM forum_sessions
    WHERE forum_session_name LIKE '%" . $keyword . "%';
    ";

  $objQuery = mysqli_query($db, $sql) or die("Error Query [" . $sql . "]");
  ?>
  <table border="1">
    <tr>
      <th width="50">
        <div align="center">No</div>
      </th>
      <th width="100">
        <div align="center">forum_session_id</div>
      </th>
      <th width="100">
        <div align="center">forum_session_name</div>
      </th>
      <th width="100">
        <div align="center">GoForum</div>
      </th>
    </tr>
    <?php
    $i = 1;
    while ($objResult = mysqli_fetch_array($objQuery)) {
    ?>
      <tr>
        <td>
          <div align="center"><?php echo $i; ?></div>
        </td>
        <td><?php echo $objResult["forum_session_id"]; ?></td>
        <td><?php echo $objResult["forum_session_name"]; ?></td>
        <!-- <td align="center"> <a href="shop.php?shop_id=<?php echo $objResult["shop_id"]; ?> ">GoShop</a></td> -->
        <!-- <td align="center"> <FORM METHOD='POST' ACTION='.php'> <input type='hidden' name='shop_id' value=<?php echo($objResult["shop_id"]); ?>> <input type='submit' value='Go Forum'> </FORM> </td> -->
        <td><a href=chat.php?forum_id=<?php echo $objResult["forum_session_id"]; ?>>GoForum</a></td> 
      </tr>
    <?php
      $i++;
    }
    ?>
  </table>
  <?php
  mysqli_close($db); // ปิดฐานข้อมูล
  echo "<br><br>";
  echo "--- END ---";
  ?>
</body>

</html>