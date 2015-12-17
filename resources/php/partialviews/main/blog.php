<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "../../../../resources/php/functions/sqlconnectandselect.php";

?>

<h1>Blog</h1>
<div class="blogwrapper">
    <?php
        $getblogposts = "SELECT * FROM blogposts ORDER BY time_posted DESC";
        $result = selectFromDB($getblogposts);
        while($row = mysqli_fetch_array($result)){
    ?>
    <table style="margin-top:20px;margin-bottom:50px;">
        <tr class="titleofblogpost">
            <td>&nbsp;</td><td><h2 style="color:blue;"><?php echo $row['title']; ?></h2></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr class="timeblogposted">
            <td>&nbsp;</td><td style="color:red;"><?php echo date("j F", strtotime($row['time_posted'])); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr class="blogpostcontent">
            <td>&nbsp;</td><td><?php echo $row['blogpost_content']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr class="blogpostauthor">
            <td>Author:&nbsp;</td><td style="color:blue;"><?php echo $row['blogpost_author']; ?></td>
        </tr>
    </table>
    <?php
        }
    ?>
</div>