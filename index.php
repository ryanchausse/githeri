<!DOCTYPE html>
<!--
Githeri.com. Copyright 2013 All Rights Reserved.
-->
<?php
    include_once "./resources/php/functions/login/loginandregistration.php";
    include_once "./resources/php/functions/sqlconnectandselect.php";
    include_once "./resources/php/functions/analytics.php";
    $loginstatus = $login->isUserLoggedIn();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Githeri | Learn Swahili</title>
        <link rel="stylesheet" href="./resources/css/reset.css" />
        <link rel="stylesheet" href="./resources/css/main.css" />
        <link rel="stylesheet" href="./resources/css/interactivelessons.css" />
        <script src="./resources/js/jquery-1.10.2.min.js"></script>
        <script src="./resources/js/main.js"></script>
    </head>
    <body>
        
        <div class='wrapper'>
            <?php
                // put your code here
                include_once "./resources/php/views/header.php";
            ?>
            <div class="maincontentwrapper">
                <?php
                    // check for Registration errors and display signup screen if not ok.
                    if (($registration->errors) || ($registration->messages)) {
                        include_once "./resources/php/partialviews/main/signup.php";
                    }elseif ((isset($_POST["formtype"]))){
                        if (sanitisedata($_POST["formtype"]) === "saveandreturn"){
                            include_once "./resources/php/functions/processsaveandreturn.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "postsubmit"){
                            include_once "./resources/php/functions/postprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "msgsubmit"){
                            include_once "./resources/php/functions/msgprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "firstsigninform"){
                            include_once "./resources/php/functions/firstloginformprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "updateprofinfo"){
                            include_once "./resources/php/functions/updateprofinfoprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "uploadprofpicform"){
                            include_once "./resources/php/functions/uploadprofpicformprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "addblogpost"){
                            include_once "./resources/php/functions/addblogpostprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "addphraseform"){
                            include_once "./resources/php/functions/newphraseprocess.php";
                        }
                        if (sanitisedata($_POST["formtype"]) === "contactform"){
                            include_once "./resources/php/partialviews/main/contact.php";
                    }elseif((sanitisedata($_POST["formtype"]) === "postsubmit") ||
                            (sanitisedata($_POST["formtype"]) === "saveandreturn") ||
                            (sanitisedata($_POST["formtype"]) === "uploadprofpicform") ||
                            (sanitisedata($_POST["formtype"]) === "updateprofinfo") ||
                            (sanitisedata($_POST["formtype"]) === "seefriend") ||
                            (sanitisedata($_POST["formtype"]) === "firstsigninform") ||
                            (sanitisedata($_POST["formtype"]) === "msgsubmit") ||
                            (sanitisedata($_POST["formtype"]) === "addblogpost") ||
                            (sanitisedata($_POST["formtype"]) === "addqrform") ||
                            (sanitisedata($_POST["formtype"]) === "addphraseform") ||
                            (sanitisedata($_POST["formtype"]) === "lessonfrm") ||
                            (sanitisedata($_POST["formtype"]) === "phrasefrm")){
                            if ($loginstatus == true){
                                include_once "./resources/php/partialviews/main/dashboard.php";
                            }else{
                                include_once "./resources/php/views/main.php";
                            }
                        }
                    }else{
                        include_once "./resources/php/views/main.php";
                    }
                ?>
            </div>
            <div class='push'></div>
            <br style='clear:both;'>
        </div>
        <?php
            include_once "./resources/php/views/footer.php";
        ?>
    </body>
</html>
