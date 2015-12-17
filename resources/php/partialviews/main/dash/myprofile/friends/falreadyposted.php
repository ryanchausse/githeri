<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "../../../../../../../resources/php/functions/sqlconnectandselect.php";
include_once "./resources/php/functions/sqlconnectandselect.php";
session_start();
$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }
if (isset($_POST['frienduserid'])){
    $frienduserid = sanitisedata($_POST['frienduserid']);
}
$postquery = "SELECT sender_id, sent_timestamp, post_body FROM posts WHERE recipient_id = '".$frienduserid."' ORDER BY sent_timestamp DESC";
$result = selectNoEmptyHandling($postquery);
if ($result ->num_rows < 1){
        echo "No posts yet. Be the first to write a post!";
    }else{
        while($row = mysqli_fetch_array($result)){
            $sender = sanitisedata($row["sender_id"]);
                $getsendernamequery = "SELECT first_name FROM profileinfo WHERE user_id = '".$sender."'";
                $sendernameresult = selectFromDB($getsendernamequery);
                while($senderrow = mysqli_fetch_array($sendernameresult)){
                    $sendername = sanitisedata($senderrow["first_name"]);
                }
            $senttimestamp = sanitisedata($row["sent_timestamp"]);
            $post = htmlentities($row["post_body"]);
            echo "<span class='postsender'>".
                    "<form name='postsenderform' class='postsenderform' method='post' action='#'>
                        <input type='hidden' name='frienduserid' value='".$sender."'>
                        <input type='hidden' name='formtype' value='seefriend'>
                    </form>".
            $sendername."</span> - <span style='color:darkgray;font-size:0.8em;'>".date("j F", strtotime($senttimestamp))."</span><br /><span style='margin-left:30px;'>".$post."</span><br /><br /><br />";
        }
    }
?>