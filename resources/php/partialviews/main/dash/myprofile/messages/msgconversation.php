<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "../../../../../../../resources/php/functions/sqlconnectandselect.php";
session_start();

function getPicUrl($idforpic){
    $filename = "./resources/images/users/".$idforpic."/profilepic.jpg";
    //reminder to set an .htaccess to restrict access to user pics on this dir.
    if (file_exists($filename)){
        $imgsrc = "./resources/images/users/".$idforpic."/profilepic.jpg";
        return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
    }else{
        $filename = "./resources/images/users/".$idforpic."/profilepic.jpeg";
        if (file_exists($filename)){
            $imgsrc = "./resources/images/users/".$idforpic."/profilepic.jpeg";
            return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
        }else{
            $filename = "./resources/images/users/".$idforpic."/profilepic.png";
            if (file_exists($filename)){
                $imgsrc = "./resources/images/users/".$idforpic."/profilepic.png";
                return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
            }else{
                $filename = "./resources/images/users/".$idforpic."/profilepic.gif";
                if (file_exists($filename)){
                    $imgsrc = "./resources/images/users/".$idforpic."/profilepic.gif";
                    return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
                }else{
                    $imgsrc = "./resources/images/defaultprofpic.jpg";
                    return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
                }
            }
        }
    }
}

$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }
if (isset($_POST['msg_recipient'])){
    $recipientid = sanitisedata($_POST['msg_recipient']);
    $getrecipientname = "SELECT first_name FROM profileinfo WHERE user_id = '".$recipientid."'";
    $sendernameresult = selectFromDB($getrecipientname);
    while($senderrow = mysqli_fetch_array($sendernameresult)){
        $sendername = sanitisedata($senderrow["first_name"]);
    }
    $time = date('Y-m-d H:i:s',time());
    $updatelastseentime = "UPDATE messages SET recipient_last_seen = '".$time."' WHERE (recipient_id = '".$profuserid."' AND sender_id = '".$recipientid."')";
    $lastseenresult = executeSQLtoDB($updatelastseentime);
    $msgquery = "SELECT sender_id, sent_timestamp, msg_body FROM messages WHERE (recipient_id = '".$profuserid."' AND sender_id = '".$recipientid."') OR (recipient_id='".$recipientid."' AND sender_id = '".$profuserid."') ORDER BY sent_timestamp DESC LIMIT 100";
}else{
    die('You have not specified the person you are having a conversation with.');
}
?>
<script type="text/javascript">
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/messages.css"
     }).appendTo("head");
    $.getScript("./resources/js/messages.js");
</script>
<span style="font-size:1.4em;">Conversation with <span style="color:blue;"><?php echo $sendername; ?></span></span><br /><br />
<img style="width:150px; height:150px;" src="<?php echo getPicUrl($recipientid);?>"><br />
<div class="messagewrap">
    <div class="convoreplymsg">
        <div class="replymsgboxconvo">
            <form name="replyform" action="#" method="post">
                <input type="hidden" name="msg_recipient" value="<?php echo $recipientid;?>">
                <input type='hidden' name='formtype' value='msgsubmit'>
                <input type="text" style="width:300px;" name="msgdata" autofocus>
                <input type="submit" name="submit" value="Send Message">
            </form>
        </div>
    </div>
<br /><br />
<?php
$result = selectNoEmptyHandling($msgquery);
if ($result ->num_rows < 1){
        echo "No messages yet. Be the first to say hello!";
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
                <br /><br />
            <?php
        }
    }
?>
</div>