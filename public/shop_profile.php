<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Shop Profile </title>
</head>
<body>
    <?php
            session_start();
            require("connection.php");
            if ($_SESSION["user_id"] == FALSE)  #try if (isset($_SESSION["user_id"])== false) #🙏Thx
            {
                header("refresh:0 ; url=login.php");
            }
            elseif (($_SESSION["status"] == 0))
            {
                header("refresh:0 ; url=main.php");
            }
            else
            {
                $user_id = $_SESSION["user_id"];
                $user_name = $_SESSION["username"];
                $query = "SELECT shop_id FROM `shops` WHERE user_id = $user_id";
                $result = mysqli_query($db, $query);
                $list = mysqli_fetch_array($result); //need check if query is successful first
                if (!$list)   
                {
                    header("refresh:0 ; url=create_shop.php");
                }
            }
            // $user_id = 1001;
            // $user_name = "POOM";
    ?>
    <a href="logout.php">LOG OUT</a>
    <a href="edit_item.php" target="_blank" rel="noopener noreferrer">
        <h1> SHOP PROFILE: <?php echo($user_name); ?> </h1>
    </a>
    <table>
        <tr>
            <td> forum ล่าสุดที่มึงเข้าไปเสือก </td>
            <td> chat ล่าสุดที่มึงเข้าไปเสือก </td>
        </tr>
        <tr> 
            <td>  
                <div style="border: 1px solid rgb(23, 65, 202); height: 500px; width:700px; overflow-y: scroll; overflow-x: scroll;">
                    <p style="width: 250%;">
                        <?php
                            $query = "
                                SELECT DISTINCT
                                    forum_sessions.forum_session_name AS forum_name,
                                    forum_sessions.forum_session_id AS forum_session_id
                                FROM
                                    `forum_sessions`
                                INNER JOIN
                                    `chat_messages` ON
                                    forum_sessions.forum_session_id = chat_messages.forum_session_id
                                WHERE
                                    chat_messages.sender_id = '$user_id'
                                ORDER BY
                                    timestamp DESC
                                LIMIT
                                    30
                            ";
                            $result = mysqli_query($db, $query);

                            if ($result)
                            {
                                while ($list = mysqli_fetch_array($result))
                                {
                                    $forum_name = $list["forum_name"];
                                    $forum_session_id = $list["forum_session_id"];
                                    echo("<a href='chat.php?forum_id=$forum_session_id' target='_blank'> $forum_name </a> <hr>");
                                }
                            }
                            else
                            {
                                echo("Error!!");
                            }
                            #echo($_SESSION["user_id"]);
                        ?>
                    </p>
                </div>
            </td>
            <td>  
                <div style="border: 1px solid rgb(23, 65, 202); height: 500px; width:700px; overflow-y: scroll; overflow-x: scroll;">
                    <p style="width: 250%;">
                        <?php
                            $query = "
                                WITH buyers AS
                                (
                                SELECT DISTINCT
                                    direct_message_sessions.buyer_id AS buyer_id
                                FROM
                                    `direct_message_sessions`
                                INNER JOIN
                                    `chat_messages` ON
                                    direct_message_sessions.direct_message_session_id = chat_messages.direct_message_session_id
                                WHERE
                                    direct_message_sessions.seller_id = '$user_id'
                                ORDER BY
                                    chat_messages.timestamp DESC
                                )
                                SELECT
                                    users.name AS buyer_name
                                FROM
                                    `users`
                                INNER JOIN
                                    `buyers` ON
                                    buyers.buyer_id = users.user_id
                                LIMIT
                                    30
                            ";
                            $result = mysqli_query($db, $query);

                            if ($result)
                            {
                                while ($list = mysqli_fetch_array($result))
                                {
                                    $buyer_name = $list["buyer_name"];
                                    echo("<a href='https://www.google.com/' target='_blank'> $buyer_name </a> <hr>");
                                } 
                            }
                            else
                            {
                                echo("Error!!");
                            }
                        ?>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>