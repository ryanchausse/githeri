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
}else{
    die("There was an error");
}

$getusernamequery = "SELECT user_name FROM users WHERE user_id='".$frienduserid."'";
$result = selectFromDB($getusernamequery);
while($row = mysqli_fetch_array($result)){
        $friendusername = $row["user_name"];
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
?>
<div class="msgbutton">
    <form name="seeconvoform" class="seeconvoform" action="#" method="post">
        <input type="hidden" name="msg_recipient" value="<?php echo $frienduserid;?>">
        <input type='hidden' name='formtype' value='msgsubmit'>
        <input type="hidden" name="msgdata">
        <input type="image" src='./resources/images/messagenew.jpg' alt="Message">
    </form>
</div>
    <span style="font-size:1.4em;"><span style="color:red;"><?php echo $first_name;?></span></span>
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