<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
if ($loginstatus == true){
    include_once "./resources/php/partialviews/header/loggedinmenu.php";
}else{
    include_once "./resources/php/partialviews/header/notloggedinmenu.php";
}