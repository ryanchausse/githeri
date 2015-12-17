<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "../../../../../../../resources/php/functions/sqlconnectandselect.php";
session_start();
$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }
$msgquery = "SELECT sender_id, recipient_last_seen, msg_body, sent_timestamp "
                                . "FROM ( SELECT * FROM messages "
                                . "WHERE recipient_id = '".$profuserid."' "
                                . "ORDER BY sent_timestamp DESC) as subquery "
                                . "GROUP BY sender_id";
?>
<span style="font-size:1.4em;">Recent Messages</span>
<div class="messagewrap">
<?php
$result = selectNoEmptyHandling($msgquery);
if ($result ->num_rows < 1){
        echo "No messages yet. Click 'Friends' to find people to speak with!";
    }else{
        while($row = mysqli_fetch_array($result)){
            $sender = sanitisedata($row["sender_id"]);
                $getsendernamequery = "SELECT first_name FROM profileinfo WHERE user_id = '".$sender."'";
                $sendernameresult = selectFromDB($getsendernamequery);
                while($senderrow = mysqli_fetch_array($sendernameresult)){
                    $sendername = sanitisedata($senderrow["first_name"]);
                }
            $senttimestamp = sanitisedata($row["sent_timestamp"]);
            $msg = htmlentities($row["msg_body"]);
            echo "<span class='postsender'>".
                    "<form name='postsenderform' class='postsenderform' method='post' action='#'>
                        <input type='hidden' name='frienduserid' value='".$sender."'>
                        <input type='hidden' name='formtype' value='seefriend'>
                    </form>".
                    $sendername."</span> - <span style='color:darkgray;font-size:0.8em;'>".date("g:i a, j F", strtotime($senttimestamp))."</span><br /><span style='margin-left:30px;'>".$msg."</span>".
                    "<br />";
            ?>
                <div class="replymsg">
                    <span class='replymsgspan'>Reply</span>
                    <div class="replymsgbox">
                        <form name="replyform" action="#" method="post">
                            <input type="hidden" name="msg_recipient" value="<?php echo $sender;?>">
                            <input type='hidden' name='formtype' value='msgsubmit'>
                            <input type="text" name="msgdata">
                            <input type="submit" name="submit" value="Reply">
                        </form>
                    </div>
                </div>
                <div class="seeconvo">
                    <span class='seeconvospan'>See Conversation
                        <form name="seeconvoform" class="seeconvoform" action="#" method="post">
                            <input type="hidden" name="msg_recipient" value="<?php echo $sender;?>">
                            <input type='hidden' name='formtype' value='msgsubmit'>
                            <input type="hidden" name="msgdata">
                        </form>
                    </span>
                </div>
                <br /><br /><br />
            <?php
        }
    }
?>
</div>