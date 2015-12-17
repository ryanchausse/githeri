<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

?>
<script type="text/javascript">
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/signup.css"
     }).appendTo("head");
    $.getScript("./resources/js/signup.js");
</script>
<h1>Sign Up</h1>
<div class="signupwrapper">
    <?php
        // show negative Registration messages
        if ($registration->errors) {
            foreach ($registration->errors as $error) {
                echo "<div class='highlightmsgs'>";
                echo $error;
                echo "</div>";
            }
        }
        // show positive Registration messages
        if ($registration->messages) {
            foreach ($registration->messages as $message) {
                echo "<div class='highlightmsgs'>";
                echo $message;
                echo "</div>";
            }
        }
    ?>
    <form method="post" action="index.php" name="registerform">
        <table class="signupform">
            <tr>
                <td class="lbl"><label for="login_input_username">Username:&nbsp;</label></td>
                <td class="ipt"><input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required autofocus/></td>
            </tr>
            <tr>
                <td class="lbl"><label for="login_input_email">Email:&nbsp;</label></td>
                <td class="ipt"><input id="login_input_email" class="login_input" type="email" name="user_email" required /></td>
            </tr>
            <tr>
                <td class="lbl"><label for="login_input_password_new">Password (6+ characters):&nbsp;</label></td>
                <td class="ipt"><input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /></td>
            </tr>
            <tr>
                <td class="lbl"><label for="login_input_password_repeat">Repeat Password:&nbsp;</label></td>
                <td class="ipt"><input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /></td>
            </tr>
            <tr>
                <td class="lbl"></td>
                <td class="ipt">
                    <input type="submit"  name="register" value="Register" />
                </td>
            </tr>
        </table>
    </form>
</div>