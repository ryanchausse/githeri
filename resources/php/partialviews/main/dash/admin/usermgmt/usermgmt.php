<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "../../../../../../../resources/php/functions/sqlconnectandselect.php";
session_start();
$username = sanitisedata($_SESSION["user_name"]);

if ($username != "chausse"){
    ?>
    <h2>User Management</h2>
    <h3>Sorry, user data is private.</h3>
    <div class="useradmininfo">
        <table class="usermgmttbl">
    <?php
}else{

$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $myuserid = $row["user_id"];
    }
?>
<h2>User Management</h2>
<div class="usersswrap">
    <div class="useradmininfo">
        <table class="usermgmttbl">
<?php
    $getpublicuserids = "SELECT * FROM profileinfo";
    $result = selectFromDB($getpublicuserids);
    while($row = mysqli_fetch_array($result)){
        $getuserid = "SELECT user_name, user_active, admin FROM users WHERE user_id ='".sanitisedata($row['user_id'])."'";
        $resultids = selectFromDB($getuserid);
        while($rowids = mysqli_fetch_array($resultids)){
            echo "<tr><td class='infotdlbl'>Username:&nbsp;</td><td class='usernm'>";
            echo sanitisedata($rowids['user_name']);
            echo "</td></tr>";
            echo "<tr><td class='infotdlbl'>Admin?:&nbsp;</td><td>";
            if (sanitisedata($rowids['admin']) == "1"){
                echo "<span style='color:red'>Yes</span>";
            }else{
                echo "No";
            }
            echo "</td></tr>";
        }
        echo "<tr><td class='infotdlbl'>User ID:&nbsp;</td><td>";
        echo sanitisedata($row['user_id']);
        echo "</td></tr>";
        echo "<tr><td class='infotdlbl'>Profile Public?:&nbsp;</td><td>";
        if (sanitisedata($row['profile_public']) == "1"){
                echo "Yes";
            }else{
                echo "No";
            }
        echo "</td></tr>";
        echo "<tr><td class='infotdlbl'>First Name:&nbsp;</td><td>";
        echo sanitisedata($row['first_name']);
        echo "</td></tr>";
        echo "<tr><td class='infotdlbl'>Location:&nbsp;</td><td>";
        echo sanitisedata($row['location']);
        echo "</td></tr>";
        echo "<tr><td class='infotdlbl'>Occupation:&nbsp;</td><td>";
        echo sanitisedata($row['occupation']);
        echo "</td></tr>";
        echo "<tr><td class='infotdlbl'>Status:&nbsp;</td><td>";
        echo sanitisedata($row['status']);
        echo "</td></tr>";
        echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
        echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
    ?>
<?php
    }
}
?>
    </table>
</div>