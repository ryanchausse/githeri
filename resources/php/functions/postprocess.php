<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "./resources/php/functions/sqlconnectandselect.php";
if(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) === "postsubmit")){    
    $postdata = dbSanitise($_POST["postdata"]);
    $postrecipient = sanitisedata($_POST["post_recipient"]);
    $username = sanitisedata($_SESSION["user_name"]);
    $usersip = $_SERVER['REMOTE_ADDR'];
    $time = date("Y-m-d H:i:s");
    $getuserid = "SELECT user_id FROM users WHERE user_name = '".$username."'";
    $result = selectFromDB($getuserid);
    while($row = mysqli_fetch_array($result)){
        $userid = $row["user_id"];
    }
    
    $addpost = "INSERT INTO posts (sender_id, recipient_id, sent_timestamp, post_body, sent_from_ip) VALUES ('".$userid."','".$postrecipient."','".$time."','".$postdata."','".$usersip."');";
    $result = executeSQLtoDB($addpost);
}  
?>