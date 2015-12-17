<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
//echo getcwd();
include_once '../../../../functions/sqlconnectandselect.php';
include_once '../../functions/sqlconnectandselect.php';
include_once './resources/php/functions/sqlconnectandselect.php';
if ((isset($_POST['formtype'])) && (sanitisedata($_POST['formtype']) == "addqrform")){
    if ((isset($_POST['swa_phrase'])) && (isset($_POST['eng_phrase'])) && (sanitisedata($_POST['swa_phrase'] != "")) && (sanitisedata($_POST['eng_phrase'] != ""))){
        $swaphrase = sanitisedata($_POST['swa_phrase']);
        $engphrase = sanitisedata($_POST['eng_phrase']);
        //str_replace(' ', '_', $_FILES["swa_audio"]["name"]);
        $temp = explode(".", $_FILES["swa_audio"]["name"]);
        $extension = end($temp);
        if ($extension == "mp3"){
            $sqlstring = "INSERT INTO quick_ref (english_phrase, swahili_phrase, mp3name) VALUES ('".$engphrase."','".$swaphrase."','".reset($temp)."')";
            $result = executeSQLtoDB($sqlstring);
            if (file_exists("./resources/audio/".$_FILES["swa_audio"]["name"])){
                    echo $_FILES["swa_audio"]["name"] . " already exists. ";
            }else{
                move_uploaded_file($_FILES["swa_audio"]["tmp_name"],
                "./resources/audio/mp3/". $_FILES["swa_audio"]["name"]);
                echo "Received new phrase. Thanks.<br />";
            }
        }else{
            echo "WARNING: File not mp3. Not uploaded.";
        }
    }else{
        echo "WARNING: You need to fill in all of the fields. Not uploaded.";
    }
}
    include "admindashsubmenu.php";
?>
<div class="adminpanelwrap">
<?php
    if ((isset($_POST["formtype"])) && (sanitisedata($_POST["formtype"]) === "addblogpost")){
        include "./resources/php/partialviews/main/dash/admin/blogpost/blogpost.php";
    }else{
        include "addaphrase.php";
    }
?>
</div>