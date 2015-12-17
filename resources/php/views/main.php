<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
    if ($loginstatus == true){
        include_once "./resources/php/partialviews/main/dashboard.php";
    }else{
        include_once "./resources/php/partialviews/main/notloggedin.php";
    }
?>