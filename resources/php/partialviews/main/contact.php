<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
    include_once "./resources/php/functions/sqlconnectandselect.php";
    echo "<h1 style='margin-bottom:10px;'>Contact</h1>";
    if(isset($_POST['firstname'])){
        $firstname = sanitisedata($_POST['firstname']);
        $comment = sanitisedata($_POST['comment']);
        $email = sanitisedata($_POST['email']);
        $ip = sanitisedata($_SERVER['REMOTE_ADDR']);
        $agentstring = sanitisedata($_SERVER['HTTP_USER_AGENT']);

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
        echo "<div class='highlightmsgs'>";
        echo "Your message has been received. Thanks for the feedback!";
        echo "</div>";
    }
?>
<script type="text/javascript">
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/contact.css"
     }).appendTo("head");
    $.getScript("./resources/js/contact.js");
</script>
<div class="contactwrapper">
    <table class="contactform">
        <form method="post" action="#">
            <tr>
                <td class="lbl"><label for="firstname">First Name:&nbsp;</label></td>
                <td class="ipt"><input type="text" name="firstname" size="10"></td>
            </tr>
            <tr>
                <td style="vertical-align:top;" class="lbl"><label for="comment">Question/Comment:&nbsp;</label></td>
                <td class="ipt"><textarea rows="4" cols="20" name="comment"></textarea></td>
            </tr>
            <tr>
                <td class="lbl"><label for="email">E-mail Address:&nbsp;</label></td>
                <td class="ipt"><input type="text" name="email" size="20"></td>
            </tr>
            <tr>
                <td class="lbl"></td>
                <td class="ipt">
                    <input type="hidden" name="formtype" value="contactform">
                    <input type="submit" name="submit" value="Submit to Githeri.com">
                </td>
            </tr>
        </form>
    </table>
</div>