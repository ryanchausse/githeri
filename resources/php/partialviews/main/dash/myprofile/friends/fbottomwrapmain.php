<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }

if (isset($_POST['frienduserid'])){
    $frienduserid = sanitisedata($_POST['frienduserid']);
}else{
    $frienduserid = $profuserid;
}

?>
<div class="posts">
    <span style="font-size:1.4em;">Posts</span>
    <div class="postthis">
        <div class="postinputbox">
            <form name="postinfo" id="postinfo" method="post" action="#">
                <input class="postcontent" id="postcontent" type="text" name="postdata" autofocus>
                <input type="hidden" name="post_recipient" value="<?php echo $frienduserid;?>">
                <input type="hidden" name="frienduserid" value="<?php echo $frienduserid;?>">
                <input type="hidden" name="formtype" value="postsubmit">
            </form>
        </div>
        <div class="postbutton">Post</div>
    </div>
    <div class="alreadyposted">
        <?php
            include_once "../../../../../../../resources/php/partialviews/main/dash/myprofile/friends/falreadyposted.php";
            include_once "./resources/php/partialviews/main/dash/myprofile/friends/falreadyposted.php";
        ?>
    </div>
</div>