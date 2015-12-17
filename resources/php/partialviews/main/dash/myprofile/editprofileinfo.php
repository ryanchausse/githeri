<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "../../../../../../resources/php/functions/sqlconnectandselect.php";
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
<form method="post" action="#" name="editprofinfoform">
<div class="canceleditprofilebutton">Cancel</div>
    <span style="font-size:1.4em;">Welcome, <span style="color:red;"><?php echo $username;?></span></span>
    <div class="profileinfosub">
        <table>
            <tr>
                <td class="lbl">Public profile?&nbsp;</td><td class="ipt">
                    <input type="radio" class="profiletype" id="public" value="1" name="profiletype" <?php if($profpublic == "0"){echo "";}else{echo "checked='true'";}?>>
                    <label for="public">Public</label>
                    <br />
                    <input type="radio" class="profiletype" id="private" value="0" name="profiletype" <?php if($profpublic == "1"){echo "";}else{echo "checked='true'";}?>>
                    <label for="private">Private</label>
                </td>
            </tr>
            <tr>
                <td class="lbl">First name:&nbsp;</td><td class="ipt"><input type="text" name="firstname" value="<?php echo $first_name;?>"></td>
            </tr>
            <tr>
                <td class="lbl">Location:&nbsp;</td><td class="ipt"><input type="text" name="location" value="<?php echo $location;?>"></td>
            </tr>
            <tr>
                <td class="lbl">Occupation:&nbsp;</td><td class="ipt"><input type="text" name="occupation" value="<?php echo $occupation;?>"></td>
            </tr>
            <tr>
                <td class="lbl">Relationship?&nbsp;</td><td class="ipt"><input type="text" name="status" value="<?php echo $status;?>"></td>
            </tr>
            <tr>
                <td class="lbl"></td><td class="ipt">
                    <input type="hidden" name="formtype" value="updateprofinfo">
                    <input type="submit" name="submit" value="Update">
                </td>
            </tr>
        </table>
    </div>
</form>