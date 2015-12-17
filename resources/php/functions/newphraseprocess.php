<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "./resources/php/functions/sqlconnectandselect.php";
if(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) === "addphraseform")){
    $finalmajname = dbSanitise($_POST["finalmajname"]);
    $finalsubname = dbSanitise($_POST["finalsubname"]);
    if ((dbSanitise($_POST["phraseorlesson"]) == "lesson")){
        $phraseorlesson = 1;
    }else{
        $phraseorlesson = 0;
    }
    $swa_phrase = dbSanitise($_POST["swa_phrase"]);
    $eng_phrase = dbSanitise($_POST["eng_phrase"]);
    $swa_alt1 = dbSanitise($_POST["swa_alt1"]);
    $swa_alt2 = dbSanitise($_POST["swa_alt2"]);
    $swa_alt3 = dbSanitise($_POST["swa_alt3"]);
    $swa_alt4 = dbSanitise($_POST["swa_alt4"]);
    $swa_alt5 = dbSanitise($_POST["swa_alt5"]);
    $swa_alt6 = dbSanitise($_POST["swa_alt6"]);
    $swa_alt7 = dbSanitise($_POST["swa_alt7"]);
    $swa_alt8 = dbSanitise($_POST["swa_alt8"]);
    $swa_alt9 = dbSanitise($_POST["swa_alt9"]);
    $swa_alt10 = dbSanitise($_POST["swa_alt10"]);
    $eng_alt1 = dbSanitise($_POST["eng_alt1"]);
    $eng_alt2 = dbSanitise($_POST["eng_alt2"]);
    $eng_alt3 = dbSanitise($_POST["eng_alt3"]);
    $eng_alt4 = dbSanitise($_POST["eng_alt4"]);
    $eng_alt5 = dbSanitise($_POST["eng_alt5"]);
    $eng_alt6 = dbSanitise($_POST["eng_alt6"]);
    $eng_alt7 = dbSanitise($_POST["eng_alt7"]);
    $eng_alt8 = dbSanitise($_POST["eng_alt8"]);
    $eng_alt9 = dbSanitise($_POST["eng_alt9"]);
    $eng_alt10 = dbSanitise($_POST["eng_alt10"]);
    $swa_wrong_alt1 = dbSanitise($_POST["swa_wrong_alt1"]);
    $swa_wrong_alt2 = dbSanitise($_POST["swa_wrong_alt2"]);
    $swa_wrong_alt3 = dbSanitise($_POST["swa_wrong_alt3"]);
    $eng_wrong_alt1 = dbSanitise($_POST["eng_wrong_alt1"]);
    $eng_wrong_alt2 = dbSanitise($_POST["eng_wrong_alt2"]);
    $eng_wrong_alt3 = dbSanitise($_POST["eng_wrong_alt3"]);
    $lessonnm = dbSanitise($_POST["lessonnm"]);
    $lessontxt1 = dbSanitise($_POST["lessontxt1"]);
    $lessontxt2 = dbSanitise($_POST["lessontxt2"]);
    $lessontxt3 = dbSanitise($_POST["lessontxt3"]);
    $lessontxt4 = dbSanitise($_POST["lessontxt4"]);
    $lessontxt5 = dbSanitise($_POST["lessontxt5"]);
    $username = sanitisedata($_SESSION["user_name"]);
    $getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
    $result = selectFromDB($getuseridquery);
    while($row = mysqli_fetch_array($result)){
            $thisuserid = $row["user_id"];
        }
    $isnewmajname = dbSanitise($_POST["isnewmajname"]);
    $isnewsubname = dbSanitise($_POST["isnewsubname"]);
    
    $temp = explode(".", $_FILES["swa_audio"]["name"]);
    $extension = end($temp);
    if ($extension == "mp3"){
        //$swa_audio_file_name = dbSanitise(reset($temp));
        $swa_audio_file_name = dbSanitise($_FILES["swa_audio"]["name"]);
        if (file_exists("./resources/audio/".dbSanitise($_FILES["swa_audio"]["name"]))){
                echo dbSanitise($_FILES["swa_audio"]["name"]) . " already exists. ";
                die();
        }else{
            move_uploaded_file($_FILES["swa_audio"]["tmp_name"],
            "./resources/audio/mp3/". dbSanitise($_FILES["swa_audio"]["name"]));
            //echo "Received new phrase. Thanks.<br />";
        }
    }else{
        if($phraseorlesson == 0){
            die("WARNING: File not mp3. Not uploaded.");
        }
    }
    
    $temp = explode(".", $_FILES["eng_audio"]["name"]);
    $extension = end($temp);
    if ($extension == "mp3"){
        //$eng_audio_file_name = dbSanitise(reset($temp));
        $eng_audio_file_name = dbSanitise($_FILES["eng_audio"]["name"]);
        if (file_exists("./resources/audio/".dbSanitise($_FILES["eng_audio"]["name"]))){
                echo dbSanitise($_FILES["eng_audio"]["name"]) . " already exists. ";
                die();
        }else{
            move_uploaded_file($_FILES["eng_audio"]["tmp_name"],
            "./resources/audio/mp3/". dbSanitise($_FILES["eng_audio"]["name"]));
            //echo "Received new phrase. Thanks.<br />";
        }
    }else{
        if($phraseorlesson == 0){
            die("WARNING: File not mp3. Not uploaded.");
        }
    }
    if ($isnewmajname != ""){
        $isexistingmajquery = "SELECT major_cat FROM tblreforder WHERE major_cat='".$finalmajname."'";
        $resultexistingmaj = selectNoEmptyHandling($isexistingmajquery);
        if ($resultexistingmaj ->num_rows < 1){
            $newmajinsert = "INSERT INTO tblreforder (major_cat, position_no) VALUES ('".$finalmajname."',0)";
            $result = executeSQLtoDB($newmajinsert);
            echo "<div style='background-color:yellow;'>New Major Category added successfully.</div><br />";
        }else{
            die("That major category exists already. Be careful.");
        }
    }
    if ($isnewsubname != ""){
        $isexistingsubquery = "SELECT sub_cat FROM tblreforder WHERE sub_cat='".$finalsubname."'";
        $resultexistingsub = selectNoEmptyHandling($isexistingsubquery);
        if ($resultexistingsub ->num_rows < 1){
            $newsubinsert = "INSERT INTO tblreforder (major_cat, sub_cat, position_no) VALUES ('".$finalmajname."','".$finalsubname."',0)";
            $result = executeSQLtoDB($newsubinsert);
            $newsubinserttoprofinfo = "ALTER TABLE profileinfo ADD ".$finalsubname." TINYINT";
            $resultprofinfo = executeSQLtoDB($newsubinserttoprofinfo);
            echo "<div style='background-color:yellow;'>New Sub Category added successfully.</div><br />";
        }else{
            die("That sub category exists already. Be careful.");
        }
    }
    //print_r($_POST);
    $addpost = "INSERT INTO phrases "
            . "(major_cat, sub_cat, lesson_or_phrase, swa_phrase, eng_phrase, swa_audio_file_name, eng_audio_file_name, "
            . "alt_swa_1, alt_swa_2, alt_swa_3, alt_swa_4, alt_swa_5, alt_swa_6, alt_swa_7, alt_swa_8, alt_swa_9, "
            . "alt_swa_10, alt_eng_1, alt_eng_2, alt_eng_3, alt_eng_4, alt_eng_5, alt_eng_6, alt_eng_7, alt_eng_8, "
            . "alt_eng_9, alt_eng_10, wrng_swa_1, wrng_swa_2, wrng_swa_3, wrng_eng_1, wrng_eng_2, wrng_eng_3, "
            . "added_by_userid, lesson_name, lesson_txt1, lesson_txt2, lesson_txt3, lesson_txt4, lesson_txt5) "
            . "VALUES ('".$finalmajname."','".$finalsubname."','".$phraseorlesson."','".$swa_phrase."'"
            . ",'".$eng_phrase."','".$swa_audio_file_name."','".$eng_audio_file_name."'"
            . ",'".$swa_alt1."','".$swa_alt2."','".$swa_alt3."','".$swa_alt4."'"
            . ",'".$swa_alt5."','".$swa_alt6."','".$swa_alt7."','".$swa_alt8."'"
            . ",'".$swa_alt9."','".$swa_alt10."','".$eng_alt1."','".$eng_alt2."'"
            . ",'".$eng_alt3."','".$eng_alt4."','".$eng_alt5."','".$eng_alt6."'"
            . ",'".$eng_alt7."','".$eng_alt8."','".$eng_alt9."','".$eng_alt10."'"
            . ",'".$swa_wrong_alt1."','".$swa_wrong_alt2."','".$swa_wrong_alt3."','".$eng_wrong_alt1."'"
            . ",'".$eng_wrong_alt2."','".$eng_wrong_alt3."','".$thisuserid."','".$lessonnm."'"
            . ",'".$lessontxt1."','".$lessontxt2."','".$lessontxt3."','".$lessontxt4."'"
            . ",'".$lessontxt5."');";

    $result = executeSQLtoDB($addpost);
    echo "<div style='background-color:yellow;'>New phrase or lesson added successfully.</div>";
}