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
$profilequery = "SELECT profile_public, first_name, location, occupation, status FROM profileinfo WHERE user_id='".$profuserid."'";
$result = selectFromDB($profilequery);
while($row = mysqli_fetch_array($result)){
        $profpublic = $row["profile_public"];
        $first_name = sanitisedata($row["first_name"]);
        $location = sanitisedata($row["location"]);
        $occupation = sanitisedata($row["occupation"]);
        $status = sanitisedata($row["status"]);
    }
$filename = "../../../../../../resources/images/users/".$profuserid."/profilepic.jpg";
$filename2 = "./resources/images/users/".$profuserid."/profilepic.jpg";
//reminder to set an .htaccess to restrict access to user pics on this dir.
if (file_exists($filename) || file_exists($filename2)){
    $imgsrc = "./resources/images/users/".$profuserid."/profilepic.jpg";
}else{
    $filename = "../../../../../../resources/images/users/".$profuserid."/profilepic.jpeg";
    $filename2 = "./resources/images/users/".$profuserid."/profilepic.jpeg";
    if (file_exists($filename || file_exists($filename2))){
        $imgsrc = "./resources/images/users/".$profuserid."/profilepic.jpeg";
    }else{
        $filename = "../../../../../../resources/images/users/".$profuserid."/profilepic.png";
        $filename2 = "./resources/images/users/".$profuserid."/profilepic.png";
        if (file_exists($filename) || file_exists($filename2)){
            $imgsrc = "./resources/images/users/".$profuserid."/profilepic.png";
        }else{
            $filename = "../../../../../../resources/images/users/".$profuserid."/profilepic.gif";
            $filename2 = "./resources/images/users/".$profuserid."/profilepic.gif";
            if (file_exists($filename) || file_exists($filename2)){
                $imgsrc = "./resources/images/users/".$profuserid."/profilepic.gif";
            }else{
                $imgsrc = "./resources/images/defaultprofpic.jpg";
            }
        }
    }
}
?>
<div class="picdiv" style="background-image: url('<?php echo $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);?>');">
    <div class="changepicbutton">Change</div>
</div>
<div class="profinfo">
    <?php
        include_once "../../../../../../resources/php/partialviews/main/dash/myprofile/profinfoview.php";
        include_once "./resources/php/partialviews/main/dash/myprofile/profinfoview.php";
    ?>
</div>