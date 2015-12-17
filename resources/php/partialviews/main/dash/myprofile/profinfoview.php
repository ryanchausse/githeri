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
?>
<div class="editprofilebutton">Edit</div>
    <span style="font-size:1.4em;">Welcome, <span style="color:red;"><?php echo $username;?></span></span>
    <div class="profileinfosub">
        <table>
            <tr>
                <td class="lbl">Public profile?&nbsp;</td><td class="ipt"><?php if($profpublic == "0"){echo "No";}else{echo "Yes";};?></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">First name:&nbsp;</td><td class="ipt"><?php echo $first_name;?></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Location:&nbsp;</td><td class="ipt"><?php echo $location;?></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Occupation:&nbsp;</td><td class="ipt"><?php echo $occupation;?></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl">Relationship?&nbsp;</td><td class="ipt"><?php echo $status;?></td>
            </tr>
        </table>
    </div>