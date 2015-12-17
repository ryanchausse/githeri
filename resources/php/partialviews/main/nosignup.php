<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
?>
<script type="text/javascript">
    $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/nosignup.css"
         }).appendTo("head");
    $.getScript("./resources/js/nosignup.js");
</script>
<?php
    if (file_exists("./resources/php/partialviews/main/nosignup/nosignupmenu.php")){
        include_once "./resources/php/partialviews/main/nosignup/nosignupmenu.php";
    }else{
        include_once '../../../../resources/php/partialviews/main/nosignup/nosignupmenu.php';
    }
?>
<div class="belowmenunosignup">
    <?php
        if (isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) == "lessonfrm")){
            include_once './resources/php/partialviews/main/nosignup/interactivelessons/lessons.php';
            //include_once '../../../../resources/php/partialviews/main/nosignup/interactivelessons/lessons.php';
        }elseif(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) == "phrasefrm")){
            include_once './resources/php/partialviews/main/nosignup/interactivelessons/phrases.php';
            //include_once '../../../../resources/php/partialviews/main/nosignup/interactivelessons/phrases.php';
        }else{
            if (file_exists("./resources/php/partialviews/main/nosignup/quickreference/quickreference.php")){
                include_once "./resources/php/partialviews/main/nosignup/quickreference/quickreference.php";
            }else{
                include_once '../../../../resources/php/partialviews/main/nosignup/quickreference/quickreference.php';
            }
        }
    ?>
</div>