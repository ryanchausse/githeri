<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "./resources/php/functions/sqlconnectandselect.php";
if(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) === "saveandreturn")){    
    $subcatname = dbSanitise($_POST["subcatname"]);
    $username = dbSanitise($_SESSION["user_name"]);
    $getuserid = "SELECT user_id FROM users WHERE user_name = '".$username."'";
    $result = selectFromDB($getuserid);
    while($row = mysqli_fetch_array($result)){
        $userid = $row["user_id"];
    }
    $updateprogress = "UPDATE profileinfo SET ".$subcatname."='1' WHERE user_id='".$userid."';";
    $result = executeSQLtoDB($updateprogress);
}
?>