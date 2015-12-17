<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "./resources/php/functions/sqlconnectandselect.php";
if(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) === "updateprofinfo")){    
    $proftype = sanitisedata($_POST["profiletype"]);
    
    if ($proftype == "0"){
        $proftype = "0";
    }else{
        $proftype = "1";
    }
    
    $firstname = dbSanitise($_POST["firstname"]);
    $location = dbSanitise($_POST["location"]);
    $occupation = dbSanitise($_POST["occupation"]);
    $status = dbSanitise($_POST["status"]);
    $usersip = $_SERVER['REMOTE_ADDR'];
    $time = date("Y-m-d H:i:s");
    $username = dbSanitise($_SESSION["user_name"]);
    $getuserid = "SELECT user_id FROM users WHERE user_name = '".$username."'";
    $result = selectFromDB($getuserid);
    while($row = mysqli_fetch_array($result)){
        $userid = $row["user_id"];
    }
    
    $updateinfo = "UPDATE profileinfo SET profile_public='".$proftype."', first_name='".$firstname."', location='".$location."', occupation='".$occupation."', status='".$status."' WHERE user_id ='".$userid."'";
    $result = executeSQLtoDB($updateinfo);
}