<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
    //echo getcwd();
    session_start();
    $isuseradmin = 0;
    $firstlogin = 0;
    //Bug: As directory changes when AJAX is called, only one of the includes will work without error.
    include_once './resources/php/functions/sqlconnectandselect.php';
    include_once '../../functions/sqlconnectandselect.php';
    $username = dbSanitise($_SESSION['user_name']);
    $sqlstring = "SELECT admin, user_active FROM users WHERE user_name='".$username."'";
    $result = selectFromDB($sqlstring);
    while($row = mysqli_fetch_array($result)){
        $isuseradmin = $row["admin"];
        $firstlogin = $row["user_active"];
    }
    if (($firstlogin == 1)){
        if ($isuseradmin == 1){
            include "./resources/php/partialviews/main/dash/admindashmenu.php";
            include "./dash/admindashmenu.php";
        }else{
            include "./resources/php/partialviews/main/dash/dashmenu.php";
            include "./dash/dashmenu.php";
        }
        ?>
            <script type="text/javascript">
                $("<link/>", {
                    rel: "stylesheet",
                    type: "text/css",
                    href: "./resources/css/dashboard.css"
                 }).appendTo("head");
                $.getScript("./resources/js/dashboard.js");
            </script>
            <div class="belowmenudash">
        <?php
            if (isset($_POST["formtype"]) && 
                    (((sanitisedata($_POST["formtype"]) == "postsubmit") ||
                            (sanitisedata($_POST["formtype"]) == "uploadprofpicform") ||
                            (sanitisedata($_POST["formtype"]) == "updateprofinfo") ||
                            (sanitisedata($_POST["formtype"]) === "seefriend")) ||
                            (sanitisedata($_POST["formtype"]) === "msgsubmit"))){
                include "./resources/php/partialviews/main/dash/myprofile/myprofile.php";
            }else{
                if ($isuseradmin == 1){
                    if ((isset($_POST["formtype"])) && 
                        (sanitisedata($_POST["formtype"]) === "saveandreturn") ||
                        (sanitisedata($_POST["formtype"]) === "lessonfrm") ||
                        (sanitisedata($_POST["formtype"]) === "phrasefrm")){
                        include "./resources/php/partialviews/main/dash/interactivelessons/interactivelessons.php";
                        include "./dash/interactivelessons/interactivelessons.php";
                    }else{
                        include "./resources/php/partialviews/main/dash/admin/adminpanel.php";
                        include "./dash/admin/adminpanel.php";
                    }
                }else{
                    include "./resources/php/partialviews/main/dash/interactivelessons/interactivelessons.php";
                    include "./dash/interactivelessons/interactivelessons.php";
                }
            }
        ?>
            </div>
        <?php
    }else{
        include "./resources/php/partialviews/main/firstlogin.php";
    }
?>