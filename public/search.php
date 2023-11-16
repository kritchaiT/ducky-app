<?php require_once("check_login.php"); ?>
<html>

<head></head>

<body>
    <h2>Search Data from shop_name</h2>
    <form action="search_data.php" method="GET" name="shop_name">
        <table border="1">
            <tr>
                <td>Shop_name Name keyword : </td>
                <td><input type="text" name="keyword"></td>
            </tr>
        </table>

        <br>
        <input type="submit" value="Search Data">
    </form>

    <h2>Search Data from forum_name</h2>
    <form action="search_forum.php" method="GET" name="forum_name">
        <table border="1">
            <tr>
                <td>Forum_name Name keyword : </td>
                <td><input type="text" name="keyword"></td>
            </tr>
        </table>

        <br>
        <input type="submit" value="Search Data">
    </form>
</body>

</html>