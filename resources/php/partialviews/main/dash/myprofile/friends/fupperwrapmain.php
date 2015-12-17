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
$profilequery = "SELECT profile_public, first_name, location, occupation, status FROM profileinfo WHERE user_id='".$frienduserid."'";
$result = selectFromDB($profilequery);
while($row = mysqli_fetch_array($result)){
        $profpublic = $row["profile_public"];
        $first_name = sanitisedata($row["first_name"]);
        $location = sanitisedata($row["location"]);
        $occupation = sanitisedata($row["occupation"]);
        $status = sanitisedata($row["status"]);
    }
$filename = "./resources/images/users/".$frienduserid."/profilepic.jpg";
//reminder to set an .htaccess to restrict access to user pics on this dir.
if (file_exists($filename)){
    $imgsrc = $filename;
}else{
    $filename = "./resources/images/users/".$frienduserid."/profilepic.jpeg";
    if (file_exists($filename)){
        $imgsrc = $filename;
    }else{
        $filename = "./resources/images/users/".$frienduserid."/profilepic.png";
        if (file_exists($filename)){
            $imgsrc = $filename;
        }else{
            $filename = "./resources/images/users/".$frienduserid."/profilepic.gif";
            if (file_exists($filename)){
                $imgsrc = $filename;
            }else{
                $imgsrc = "./resources/images/defaultprofpic.jpg";
            }
        }
    }
}
?>
<div class="picdiv" style="background-image: url('<?php echo $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);?>');">
</div>
<div class="profinfo">
    <?php
        include_once "../../../../../../../resources/php/partialviews/main/dash/myprofile/friends/fprofinfoview.php";
        include_once "./resources/php/partialviews/main/dash/myprofile/friends/fprofinfoview.php";
    ?>
</div>