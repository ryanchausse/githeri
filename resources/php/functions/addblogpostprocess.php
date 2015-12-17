<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once "./resources/php/functions/sqlconnectandselect.php";
if(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) === "addblogpost")){
    $title = dbSanitise($_POST["title"]);
    $blogpostdata = dbSanitise($_POST["blogdata"]);
    $username = dbSanitise($_POST["author"]);
    
    $addpost = "INSERT INTO blogposts (title, blogpost_author, blogpost_content) VALUES ('".$title."','".$username."','".$blogpostdata."');";
    if ($blogpostdata != ""){
        $result = executeSQLtoDB($addpost);
        echo "<div style='background-color:yellow;'>Blog post added successfully.</div>";
    }else{
        echo "You did not write anything in your blog post.";
    }
}  
?>