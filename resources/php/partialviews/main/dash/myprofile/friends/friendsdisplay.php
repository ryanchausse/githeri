<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

$idforpic = "";

//function getPicUrl($idforpic){
//    $idforpic = "./resources/images/users/".$idforpic."/profilepic.jpg";
//    return $idforpic;
//}
function getPicUrl($idforpic){
    $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.jpg";
    //reminder to set an .htaccess to restrict access to user pics on this dir.
    if (file_exists($filename)){
        $imgsrc = "./resources/images/users/".$idforpic."/profilepic.jpg";
        return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
    }else{
        $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.jpeg";
        if (file_exists($filename)){
            $imgsrc = "./resources/images/users/".$idforpic."/profilepic.jpeg";
            return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
        }else{
            $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.png";
            if (file_exists($filename)){
                $imgsrc = "./resources/images/users/".$idforpic."/profilepic.png";
                return $imgsrc."?lastmodified=".filemtime("/var/www/kiswahili2/".$imgsrc);
            }else{
                $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.gif";
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
function getPicRelUrl($idforpic){
    $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.jpg";
    //reminder to set an .htaccess to restrict access to user pics on this dir.
    if (file_exists($filename)){
        $imgsrc = "./resources/images/users/".$idforpic."/profilepic.jpg";
        return true;
    }else{
        $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.jpeg";
        if (file_exists($filename)){
            $imgsrc = "./resources/images/users/".$idforpic."/profilepic.jpeg";
            return true;
        }else{
            $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.png";
            if (file_exists($filename)){
                $imgsrc = "./resources/images/users/".$idforpic."/profilepic.png";
                return true;
            }else{
                $filename = "../../../../../../../resources/images/users/".$idforpic."/profilepic.gif";
                if (file_exists($filename)){
                    $imgsrc = "./resources/images/users/".$idforpic."/profilepic.gif";
                    return true;
                }else{
                    $imgsrc = "./resources/images/defaultprofpic.jpg";
                    return false;
                }
            }
        }
    }
}

include_once "../../../../../../../resources/php/functions/sqlconnectandselect.php";
session_start();
$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }
?>
<span style="font-size:1.4em;">Meet People, Speak Kiswahili</span>
<div class="friendswrap">
<?php
$friendcount = "0";
$getpublicuserids = "SELECT user_id, first_name FROM profileinfo WHERE profile_public='1'";
$result = selectFromDB($getpublicuserids);
while($row = mysqli_fetch_array($result)){
        if ($friendcount % 3 == "0"){
            echo "<div class='threefriends'>";
        }
        if ($friendcount % 3 == "2"){
            echo "<div class='friendlast'";
        }else{
            echo "<div class='friend'";
        }
            if (getPicRelUrl($row['user_id'])){
                echo " style=background-image:url('".getPicUrl($row['user_id'])."')>";
            }else{
                echo ">";
            }
        ?>
                <div class="friendbutton">
                    <?php
                        if ($profuserid != $row['user_id']){
                            echo "<div class='friendformdiv'>";
                            echo "<form action='#' method='post' class='friendform'>";
                            echo "<input type='hidden' name='formtype' value='seefriend'>";
                            echo "<input type='hidden' name='frienduserid' value='".$row['user_id']."'>";
                            echo sanitisedata($row['first_name']);
                            echo "</form>";
                            echo "</div>";
                        }else{
                            echo "Me";
                        }
                    ?>
                </div>
        </div>
        <?php
        if ($friendcount % 3 == "2"){
            echo "</div>";
        }
        $friendcount++;
    }
if ($friendcount % 3 != "2"){
        echo "</div>";
    }

?>
</div>