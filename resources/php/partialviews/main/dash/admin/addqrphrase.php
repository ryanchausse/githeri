<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

?>

<h2>Add a Quick Reference Phrase</h2>
<div class="addphrase">
    <form name="theqrform" method="post" action="#" enctype="multipart/form-data">
        <table class="addphrasetable">
            <tr>
                <td class="lbl"><label for="swa_phrase">Swahili Phrase:&nbsp;</label></td>
                <td class="ipt"><input type="text" name="swa_phrase" required></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl"><label for="eng_phrase">English Phrase:&nbsp;</label></td>
                <td class="ipt"><input type="text" name="eng_phrase" required></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl"><label for="swa_audio">Upload Swahili Audio File (mp3 only):&nbsp;</label></td>
                <td class="ipt"><input type="file" accept="audio/mpeg" name="swa_audio" required></td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
            <tr>
                <td class="lbl"></td>
                <td class="ipt">
                    <input type="hidden" name="formtype" value="addqrform">
                    <input type="submit" name="submit" value="Add Phrase">
                </td>
            </tr>
        </table>
    </form>
</div>