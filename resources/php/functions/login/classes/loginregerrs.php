<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

class regErrors{
    function areThereErrs(){
        if (($registration->errors) || ($registration->messages)) {
            return true;
        }else{
            return false;
        }
    }
    function loginMsgs(){
        if (($login->errors) || ($login->messages)) {
            // show negative messages
            if ($login->errors) {
                foreach ($login->errors as $error) {
                    echo $error;    
                }
            }
            // show positive messages
            if ($login->messages) {
                foreach ($login->messages as $message) {
                    echo $message;
                }
            }
        }
    }
}