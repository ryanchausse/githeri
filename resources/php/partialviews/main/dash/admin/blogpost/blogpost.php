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
$getfirstnamequery = "SELECT first_name FROM profileinfo WHERE user_id='".$profuserid."'";
$result = selectFromDB($getfirstnamequery);
while($row = mysqli_fetch_array($result)){
        $firstnameofposter = $row["first_name"];
    }

?>
<h2>Add a New Blog Post</h2>
<div class="addphrase">
    <form method="post" action="#">
        <table class="addphrasetable">
            <tr>
                <td class="lbl" style="vertical-align: top;"><label for="title">Blog Title:&nbsp;</label></td>
                <td class="ipt"><input type="text" name="title" required></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl" style="vertical-align: top;"><label for="blogdata">Blog Content:&nbsp;</label></td>
                <td class="ipt"><textarea rows="10" cols="20" name="blogdata" required></textarea></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl"><label for="author">Author:&nbsp;</label></td>
                <td class="ipt"><input type="text" name="author" value="<?php echo $firstnameofposter;?>" required></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl"></td>
                <td class="ipt">
                    <input type="hidden" name="formtype" value="addblogpost">
                    <input type="submit" name="submit" value="Add Blog Post">
                </td>
            </tr>
        </table>
    </form>
</div>