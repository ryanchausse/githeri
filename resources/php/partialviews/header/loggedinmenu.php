<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
?>
<div class="header">
    <div style="display:none;">
        <img src='./resources/images/message.jpg'>
        <img src='./resources/images/messagenew.jpg'>
        <img src='./resources/images/messageactive.jpg'>
    </div>
    <div class="navbar">
        <ul>
            <li style="padding-left:0px;"><img class="logoimgloggedin" src='./resources/images/logo.jpg'></li>
            <li>
                <h4 class="mainlink" id="faqmnu">FAQ</h4>
                <div class="subnav">
                    <ul>
                        <li class="infomnu">
                            <h4>About</h4>
                        </li>
                        <br />
                        <li class="contactmnu">
                            <h4>Contact</h4>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <h4 class="mainlink" id="blogmnu">Blog</h4>
            </li>
            <li>
                <h4 class="mainlink" id="likemnu">
                    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fgitheri.com&amp;width=20&amp;layout=button&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:125px; height:21px;" allowTransparency="true"></iframe>
                </h4>
                <div class="subnav">
                    <ul>
                        <!--<li>
                            <!-- FACEBOOK BEGIN 
                                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fgitheri.com&amp;width=125&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:125px; height:21px;" allowTransparency="true"></iframe>
                            <!-- FACEBOOK END 
                        </li>
                        <br />-->
                        <li>
                            <!-- TWITTER BEGIN -->
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://githeri.com/" data-text="I'm learning Swahili on Githeri.com! It is awesome." data-via="githeri_com">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                            <!-- TWITTER END -->
                        </li>
                        <br />
                        <li>
                            <!-- LINKEDIN BEGIN -->
                                <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                                <script type="IN/Share" data-url="http://githeri.com/" data-counter="right"></script>
                            <!-- LINKEDIN END -->
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="rightmnu">
            <li class="msgicon" style="padding-right:20px;">
                <?php
                    include_once "../../../../resources/php/functions/sqlconnectandselect.php";
                    session_start();
                    $username = sanitisedata($_SESSION["user_name"]);
                    $getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
                    $result = selectFromDB($getuseridquery);
                    while($row = mysqli_fetch_array($result)){
                            $profuserid = $row["user_id"];
                        }
                    if (isset($_POST['msg_recipient'])){
                        $recipientid = sanitisedata($_POST['msg_recipient']);
                        $time = date('Y-m-d H:i:s',time());
                        $updatelastseentime = "UPDATE messages SET recipient_last_seen = '".$time."' WHERE (recipient_id = '".$profuserid."' AND sender_id = '".$recipientid."')";
                        $lastseenresult = executeSQLtoDB($updatelastseentime);
                    }
                    $msgquery = "SELECT recipient_last_seen "
                            . "FROM messages "
                            . "WHERE ((recipient_id = '".$profuserid."') AND (recipient_last_seen is null))";
                    $result = selectNoEmptyHandling($msgquery);
                    if ($result ->num_rows < 1){
                        echo "<img class='msgimg' style='padding-top:18px;' src='./resources/images/message.jpg'>";
                    }else{
                        echo "<img class='msgimg' style='padding-top:18px;' src='./resources/images/messagenew.jpg'>";
                    }
                ?>
                <div class="subnavmsgs">
                    <?php
                        $msgquery = "SELECT sender_id, recipient_last_seen, msg_body, sent_timestamp "
                                . "FROM ( SELECT * FROM messages "
                                . "WHERE recipient_id = '".$profuserid."' "
                                . "ORDER BY sent_timestamp DESC) as subquery "
                                . "GROUP BY sender_id";
                        $result = selectNoEmptyHandling($msgquery);
                        if ($result ->num_rows < 1){?>
                            <div style="text-align:center;" class="msgfragment"><span class="msgfragmentuser">No messages received yet.</span></div>
                        <?php
                        }else{
                            while($row = mysqli_fetch_array($result)){
                                $senderid = sanitisedata($row["sender_id"]);
                                $senttime = sanitisedata($row["sent_timestamp"]);
                                $msgbody = htmlentities($row["msg_body"]);
                                $getsendername = "SELECT first_name FROM profileinfo WHERE user_id = '".$senderid."'";
                                $sendernameresult = selectFromDB($getsendername);
                                while($senderrow = mysqli_fetch_array($sendernameresult)){
                                    $sendername = sanitisedata($senderrow["first_name"]);
                                }
                                if ($row["recipient_last_seen"] == null){
                                    echo "<div class='msgfragment' style='background-color:#424242'>";
                                }else{
                                    echo "<div class='msgfragment'>";
                                }
                            ?>
                                <form name="seeconvoform" class="seeconvoform" action="#" method="post">
                                    <input type="hidden" name="msg_recipient" value="<?php echo $senderid;?>">
                                    <input type='hidden' name='formtype' value='msgsubmit'>
                                    <input type="hidden" name="msgdata">
                                    <span class="msgfragmentuser"><?php echo $sendername; ?></span> <span class="msgfraghyphen">-</span>&nbsp;<?php echo $msgbody; ?>
                                </form>
                            </div>
                        <?php        
                            }
                        }
                        ?>
                </div>
            </li>
            <a href="index.php?logout"><li><h4 class="mainlink" id="infomnu">Log Out</h4></li></a>
        </ul>
    </div>
</div>