<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "../../../../../../resources/php/functions/sqlconnectandselect.php";
include_once "./resources/php/functions/sqlconnectandselect.php";
session_start();
$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }
    include "profilesubmenu.php";
?>
<div class="profilewrap">
<?php
    if (isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) === "seefriend")){
        if ((isset($_POST['frienduserid'])) && (sanitisedata($_POST['frienduserid']) != $profuserid)){
            include "./resources/php/partialviews/main/dash/myprofile/friends/friendprofiledisplay.php";
        }else{
            include "myprofiledisplay.php";
        }
    }else{
        if((sanitisedata($_POST["formtype"]) === "postsubmit") && (sanitisedata($_POST['post_recipient']) != $profuserid)){
            include "./resources/php/partialviews/main/dash/myprofile/friends/friendprofiledisplay.php";
        }else{
            if (sanitisedata($_POST["formtype"]) === "msgsubmit"){
                include "./resources/php/partialviews/main/dash/myprofile/messages/msgconversation.php";
            }else{
                include "myprofiledisplay.php";
            }
        }
    }
?>
</div>