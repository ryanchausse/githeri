<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
if (isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) == "lessonfrm")){
    include_once './resources/php/partialviews/main/nosignup.php';
    include_once '../../../../resources/php/partialviews/main/nosignup.php';
}elseif(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) == "phrasefrm")){
    include_once './resources/php/partialviews/main/nosignup.php';
    include_once '../../../../resources/php/partialviews/main/nosignup.php';
}else{
?>
<div class='maincontentnotloggedin'>
    <?php
        // show negative Login messages
        if ($login->errors) {
            foreach ($login->errors as $error) {
                echo "<div class='highlightmsgs'>";
                echo $error;
                echo "</div>";
            }
        }
        // show positive Login messages
        if ($login->messages) {
            foreach ($login->messages as $message) {
                echo "<div class='highlightmsgs'>";
                echo $message;
                echo "</div>";
            }
        }
    ?>
    <div class="hidden">
        <img src="./resources/images/loading.gif">
        <img src="./resources/images/signup-button.png">
        <img src="./resources/images/signup-button-hover.png">
        <img src="./resources/images/signup-button-active.png">
        <img src="./resources/images/without-signup-button.png">
        <img src="./resources/images/without-signup-button-hover.png">
        <img src="./resources/images/without-signup-button-active.png">
    </div>
    <div class="introcontent">
        <h1>Learn Swahili Online<br />For Free</h1>
        <img class="mainimg" src='./resources/images/splash.png' alt='Swahili'>
        <h2>We have you covered.</h2>
        <p>Githeri is the most <span style='font-weight:bold;'>efficient</span>, <span style='font-weight:bold;'>social</span>, and <span style='font-weight:bold;'>interactive</span> site to help you learn Kiswahili <span style='font-weight:bold;'>fast</span>.</p>
        <ul>
            <li>See</li>-
            <li>Listen</li>-
            <li>Socialise</li>-
            <li>Learn</li>
        </ul>
        <br />
        <div class="signupbutton"></div>
        <h3>or</h3>
        <div class="nosignupbutton"></div>
        <h3>or</h3>
        <h3 class='taketour'>Take the Tour</h3>
    </div>
</div>
<?php
}