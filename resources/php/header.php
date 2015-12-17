<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "./resources/php/functions/isuserloggedin.php";
$loginstatus = false;
$loginstatus = isuserloggedin();
if ($loginstatus == true){
    include_once "./resources/php/views/loggedinmenu.php";
}else{
    include_once "./resources/php/views/notloggedinmenu.php";
}