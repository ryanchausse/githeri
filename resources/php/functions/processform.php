<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

    include_once "../../../resources/php/functions/sanitise.php";
    
    $firstname = clean_data($_POST['firstname']);
    $comment = clean_data($_POST['comment']);
    $email = clean_data($_POST['email']);
    $ip = clean_data($_SERVER['REMOTE_ADDR']);
    $agentstring = clean_data($_SERVER['HTTP_USER_AGENT']);

    $to = "chausse@ryanchausse.com";
    $subject = "Githeri.com Comment";
    $message = "
    First Name:
    $firstname


    Comment:
    $comment


    Email Address:
    $email

    IP:
    $ip

    Agent String:
    $agentstring

    ";
    $from = "chausse@ryanchausse.com";
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);

