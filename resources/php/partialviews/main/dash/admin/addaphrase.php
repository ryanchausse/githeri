<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

include_once '../../../../functions/sqlconnectandselect.php';
include_once './resources/php/functions/sqlconnectandselect.php';

?>
<script type="text/javascript">
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/addaphrase.css"
     }).appendTo("head");
    $.getScript("./resources/js/addaphrase.js");
</script>
<script type="text/javascript">
    function validateForm(){
        if((document.getElementById("majorother").checked == true) && (document.getElementById("majornewname").value == "")){
            alert("You have indicated a New Major Category. Please write the name of the new category.");
            return false;
        }
        if(document.getElementById("majorother").checked == true){
            document.getElementById("isnewmajname").value = "1";
        }else{
            document.getElementById("isnewmajname").value = "";
        }
        if((document.getElementById("subother").checked == true) && (document.getElementById("subnewname").value == "")){
            alert("You have indicated a New Sub-Category. Please write the name of the new category.");
            return false;
        }
        if(document.getElementById("subother").checked == true){
            document.getElementById("isnewsubname").value = "1";
        }else{
            document.getElementById("isnewsubname").value = "";
        }
        if((document.getElementById("optphrasechoice").checked == false) && (document.getElementById("optlessonchoice").checked == false)){
            alert("You have to select either Phrase or Lesson.");
            return false;
        }
        if(document.getElementById("optphrasechoice").checked == true){
            if(document.getElementById("swa_phrase").value == ""){
                alert("Please enter a Swahili phrase.");
                return false;
            }
            if(document.getElementById("eng_phrase").value == ""){
                alert("Please enter an English phrase.");
                return false;
            }
            if(document.getElementById("swa_audio").value == ""){
                alert("Please enter an mp3 file of the Swahili audio clip.");
                return false;
            }
            if(document.getElementById("eng_audio").value == ""){
                alert("Please enter an mp3 file of the English audio clip.");
                return false;
            }
            if(document.getElementById("swa_alt1").value == ""){
                alert("Please enter at least three alternate (and definitely incorrect) Swahili phrases.");
                return false;
            }
            if(document.getElementById("swa_alt2").value == ""){
                alert("Please enter at least three alternate (and definitely incorrect) Swahili phrases.");
                return false;
            }
            if(document.getElementById("swa_alt3").value == ""){
                alert("Please enter at least three alternate (and definitely incorrect) Swahili phrases.");
                return false;
            }
            if(document.getElementById("eng_alt1").value == ""){
                alert("Please enter at least three alternate (and definitely incorrect) English phrases.");
                return false;
            }
            if(document.getElementById("eng_alt2").value == ""){
                alert("Please enter at least three alternate (and definitely incorrect) English phrases.");
                return false;
            }
            if(document.getElementById("eng_alt3").value == ""){
                alert("Please enter at least three alternate (and definitely incorrect) English phrases.");
                return false;
            }
            if(document.getElementById("swa_wrong_alt1").value == ""){
                alert("Please enter at least two close but not ideal Swahili phrases. These will be used if the user types in something close enough that we can say 'ok' but not the correct phrase itself.");
                return false;
            }
            if(document.getElementById("swa_wrong_alt2").value == ""){
                alert("Please enter at least two close but not ideal Swahili phrases. These will be used if the user types in something close enough that we can say 'ok' but not the correct phrase itself.");
                return false;
            }
            if(document.getElementById("eng_wrong_alt1").value == ""){
                alert("Please enter at least two close but not ideal English phrases. These will be used if the user types in something close enough that we can say 'ok' but not the correct phrase itself.");
                return false;
            }
            if(document.getElementById("eng_wrong_alt2").value == ""){
                alert("Please enter at least two close but not ideal English phrases. These will be used if the user types in something close enough that we can say 'ok' but not the correct phrase itself.");
                return false;
            }
        }
        if(document.getElementById("optlessonchoice").checked == true){
            if(document.getElementById("lessontxt1").value == ""){
                alert("At least the first Lesson Text box must be filled in. You're creating an explanation and introduction to some vocabulary or grammar. Don't be light on details.");
                return false;
            }
            if(document.getElementById("lessonnm").value == ""){
                alert("Please give the lesson a name (like a title).");
                return false;
            }
        }
    }
</script>
<h2>Add a Phrase or Lesson</h2>
<div class="addphrase">
    <form name="lessonphraseform" method="post" action="#" onsubmit="return validateForm();" enctype="multipart/form-data">
        <table class="addphrasetable">
            <tr>
                <td class="lbl"><label for="majorcategory">Major Category:&nbsp;</label></td>
                <td class="ipt">
                    <?php
                        $majcatnamequery = "SELECT major_cat FROM tblreforder WHERE sub_cat IS NULL ORDER BY position_no";
                        $majresult = selectNoEmptyHandling($majcatnamequery);
                        if ($majresult ->num_rows < 1){
                                echo ("<span style='color:red;'>Please first enter a New Major Category to get started.</span><br />");
                            }else{
                                while($majrow = mysqli_fetch_array($majresult)){
                                    echo "<input type='radio' class='majorcatchoice' id='".$majrow["major_cat"]."' name='majorcategory' value='".$majrow["major_cat"]."'>";
                                    echo "<label for='".$majrow["major_cat"]."'>".$majrow["major_cat"]."</label>";
                                    echo "<br />";
                                }
                            }
                    ?>
                    <input type="radio" id="majorother" name="majorcategory" value="other">
                    <label for="majorother">New</label><br />
                    <div class="hiddenothertext" id="majorhidden" style="display:none;">
                        New category:&nbsp;<br />
                        <input type="text" id="majornewname" name="majorcategory"><br />
                    </div>
                    <input type="hidden" name="isnewmajname" id="isnewmajname" value="">
                    <input type="hidden" name="finalmajname" id="finalmajname" value="">
                </td>
            </tr>
            <tr>
                <td class="lbl">&nbsp;</td>
                <td class="ipt">&nbsp;</td>
            </tr>
    </table>
            <div class="subcatdiv" style="display:none;">
                <table class="addphrasetable">
                    <tr>
                        <td class="lbl"><label for="subcategory">Sub-Category:&nbsp;</label></td>
                        <td class="ipt">
                            <?php
                            $subcatnamequery = "SELECT major_cat FROM tblreforder WHERE sub_cat IS NOT NULL ORDER BY position_no";
                            $subresult = selectNoEmptyHandling($subcatnamequery);
                            if ($subresult ->num_rows < 1){
                                    echo ("<span style='color:red;'>None yet.</span><br />");
                                }else{
                                    while($subrow = mysqli_fetch_array($subresult)){
                                        echo "<div style='display:none;' id='hidden_".$subrow["major_cat"]."'>";
                                        $subcatoptionnamequery = "SELECT sub_cat FROM tblreforder WHERE ((major_cat ='".$subrow["major_cat"]."') AND (sub_cat IS NOT NULL)) ORDER BY position_no";
                                        $suboptionresult = selectNoEmptyHandling($subcatoptionnamequery);
                                        if ($suboptionresult ->num_rows < 1){
                                                echo ("<span style='color:red;'>No Subcategories found for this Major Category.</span><br />");
                                            }else{
                                                while($suboptionrow = mysqli_fetch_array($suboptionresult)){
                                                    echo "<input type='radio' class='subcatchoice' id='".$suboptionrow["sub_cat"]."' name='subcategory' value='".$suboptionrow["sub_cat"]."'>";
                                                    echo "<label for='".$suboptionrow["sub_cat"]."'>".$suboptionrow["sub_cat"]."</label>";
                                                    echo "<br />";
                                                }
                                            }
                                        echo "</div>";
                                    }
                                }
                            ?>
                            <input type="radio" id="subother" name="subcategory" value="other">
                            <label for="subother">New</label><br />
                            <div class="hiddenothertext" id="subhidden" style="display:none;">
                                New sub-category:&nbsp;<br />
                                <input type="text" id="subnewname" name="subcategory"><br />
                            </div>
                            <input type="hidden" name="isnewsubname" id="isnewsubname" value="">
                            <input type="hidden" name="finalsubname" id="finalsubname" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div class="phraseorlessondiv" style="display:none;">
                <table class="addphrasetable">
                    <tr>                        
                        <td class="lbl"><label for="phraseorlesson">Phrase or Lesson:&nbsp;</label></td>
                        <td class="ipt">
                            <input type="radio" id="optphrasechoice" name="phraseorlesson" value="phrase">
                            <label for="optphrasechoice">Phrase</label><br />
                        </td>
                    </tr>
                    <tr>                        
                        <td class="lbl"></td>
                        <td class="ipt">
                            <input type="radio" id="optlessonchoice" name="phraseorlesson" value="lesson">
                            <label for="optlessonchoice">Lesson</label><br />
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div class="phraseoptionsdiv" style="display:none;">
                <table class="addphrasetable">
                    <tr>
                        <td class="lbl"><label for="swa_phrase">Swahili Phrase:&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="swa_phrase" id="swa_phrase"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="eng_phrase">English Phrase:&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="eng_phrase" id="eng_phrase"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="swa_audio">Upload Swahili mp3 File:&nbsp;</label></td>
                        <td class="ipt"><input type="file" name="swa_audio" accept="audio/mpeg" id="swa_audio"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="eng_audio">Upload English mp3 File:&nbsp;</label></td>
                        <td class="ipt"><input type="file" name="eng_audio" accept="audio/mpeg" id="eng_audio"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for=swapossiblealts">Wrong Swahili Phrases (3):&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="swa_alt1" id="swa_alt1"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt2" id="swa_alt2"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt3" id="swa_alt3"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt4"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt5"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt6"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt7"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt8"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt9"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_alt10"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="engpossiblealts">Wrong English Phrases (3):&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="eng_alt1" id="eng_alt1"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt2" id="eng_alt2"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt3" id="eng_alt3"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt4"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt5"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt6"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt7"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt8"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt9"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_alt10"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="swawrongclose">Alternate Swahili Phrases(2):&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="swa_wrong_alt1" id="swa_wrong_alt1"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_wrong_alt2" id="swa_wrong_alt2"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="swa_wrong_alt3"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="engwrongclose">Alternate English Phrases (2):&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="eng_wrong_alt1" id="eng_wrong_alt1"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_wrong_alt2" id="eng_wrong_alt2"></td>
                    </tr>
                    <tr>
                        <td class="lbl"></td>
                        <td class="ipt"><input type="text" name="eng_wrong_alt3"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div class="lessonoptionsdiv" style="display:none;">
                <table class="addphrasetable">
                    <tr>
                        <td class="lbl"><label for="lessonnm">Lesson Name:&nbsp;</label></td>
                        <td class="ipt"><input type="text" name="lessonnm" id="lessonnm"></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="lbl" style="vertical-align: top;"><label for="lessontxt1">Lesson Text 1:&nbsp;</label></td>
                        <td class="ipt"><textarea rows="15" name="lessontxt1" id="lessontxt1"></textarea></td>
                    </tr>
                    <tr>
                        <td class="lbl" style="vertical-align: top;"><label for="lessontxt2">Lesson Text 2:&nbsp;</label></td>
                        <td class="ipt"><textarea rows="15" name="lessontxt2" id="lessontxt2"></textarea></td>
                    </tr>
                    <tr>
                        <td class="lbl" style="vertical-align: top;"><label for="lessontxt3">Lesson Text 3:&nbsp;</label></td>
                        <td class="ipt"><textarea rows="15" name="lessontxt3" id="lessontxt3"></textarea></td>
                    </tr>
                    <tr>
                        <td class="lbl" style="vertical-align: top;"><label for="lessontxt4">Lesson Text 4:&nbsp;</label></td>
                        <td class="ipt"><textarea rows="15" name="lessontxt4" id="lessontxt4"></textarea></td>
                    </tr>
                    <tr>
                        <td class="lbl" style="vertical-align: top;"><label for="lessontxt5">Lesson Text 5:&nbsp;</label></td>
                        <td class="ipt"><textarea rows="15" name="lessontxt5" id="lessontxt5"></textarea></td>
                    </tr>
                    <tr>
                        <td class="lbl">&nbsp;</td>
                        <td class="ipt">&nbsp;</td>
                    </tr>
                </table>
            </div>
    <table class="addphrasetable">
            <tr>
                <td class="lbl"></td>
                <td class="ipt">
                    <input type="hidden" name="lessonorphrase" id="lessonorphrase" value="">
                    <input type="hidden" name="formtype" value="addphraseform">
                    <input type="submit" name="submit" value="Add Phrase or Lesson">
                </td>
            </tr>
        </table>
    </form>
</div>