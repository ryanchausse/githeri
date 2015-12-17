<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
if (isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) == "lessonfrm")){
    include_once './resources/php/partialviews/main/nosignup/interactivelessons/lessons.php';
    include_once '../../../../../../resources/php/partialviews/main/nosignup/interactivelessons/lessons.php';
}elseif(isset($_POST["formtype"]) && (sanitisedata($_POST["formtype"]) == "phrasefrm")){
    include_once './resources/php/partialviews/main/nosignup/interactivelessons/phrases.php';
    include_once '../../../../../../resources/php/partialviews/main/nosignup/interactivelessons/phrases.php';
}else{
?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".specificles").click(function(){
            $(this).parent(".lessonformgo").submit();
            $(this).html("Finding...");
        });
        $(".phrasewrap").click(function(){
            $(this).find(".phrasefrm").submit();
            $(this).html("Finding...");
        });
    });
</script>

<?php
include_once '../../../../functions/sqlconnectandselect.php';
include_once './resources/php/functions/sqlconnectandselect.php';

session_start();
$username = sanitisedata($_SESSION["user_name"]);
$getuseridquery = "SELECT user_id FROM users WHERE user_name='".$username."'";
$result = selectFromDB($getuseridquery);
while($row = mysqli_fetch_array($result)){
        $profuserid = $row["user_id"];
    }

//ok here it be...
//1. Check tblreforder for records with sub_cat = null
//That way, I'll get major_cat names (e.g. Beginner) and a position no for each
//Hmm, position no.s must start with 0 and work up sequentially. Remember for later.

$majcatorderquery = "SELECT major_cat, position_no FROM tblreforder WHERE sub_cat IS NULL";
$majresult = selectNoEmptyHandling($majcatorderquery);
if ($majresult ->num_rows < 1){
        echo ('Please first enter some phrases to get started.');
    }else{
        while($majrow = mysqli_fetch_array($majresult)){
            //$majcatarray[$row["position_no"]] = $majrow["major_cat"];
            echo "<div class='majsectdiv'>".$majrow["major_cat"]."</div>";
            echo "<div class='lessonwrapper'>";
            
            $subcatnum = 0;
            $subcatorderquery = "SELECT sub_cat, position_no FROM tblreforder WHERE ((major_cat ='".$majrow["major_cat"]."') && (sub_cat IS NOT NULL)) ORDER BY position_no";
            $subresult = selectNoEmptyHandling($subcatorderquery);
            if ($subresult ->num_rows < 1){
                echo ('No lessons yet.');
            }else{
                while($subrow = mysqli_fetch_array($subresult)){
                    if ($subcatnum % 3 == "0"){
                        echo "<div class='groupof3'>";
                    }
                        if ($subcatnum % 3 != "2"){
                            $subcatcompletesql = "SELECT ".$subrow["sub_cat"]." FROM profileinfo WHERE user_id ='".$profuserid."'";
                            $subcatcompleteresult = selectNoEmptyHandling($subcatcompletesql);
                            while($subcatcompleterow = mysqli_fetch_array($subcatcompleteresult)){
                                    if (!is_null($subcatcompleterow[$subrow["sub_cat"]])){
                                        $subcatiscomplete = true;
                                        echo "<div class='lessondiv'><div class='completedcheck'><img src='./resources/images/checkmark_small.png'></div>";
                                    }else{
                                        $subcatiscomplete = false;
                                        echo "<div class='lessondiv'><div class='completedcheck' style='display:none;'><img src='./resources/images/checkmark_small.png'></div>";
                                    }
                                }
                        }else{
                            $subcatcompletesql = "SELECT ".$subrow["sub_cat"]." FROM profileinfo WHERE user_id ='".$profuserid."'";
                            $subcatcompleteresult = selectNoEmptyHandling($subcatcompletesql);
                            while($subcatcompleterow = mysqli_fetch_array($subcatcompleteresult)){
                                    if (!is_null($subcatcompleterow[$subrow["sub_cat"]])){
                                        $subcatiscomplete = true;
                                        echo "<div class='lessondivlast'><div class='completedcheck'><img src='./resources/images/checkmark_small.png'></div>";
                                    }else{
                                        $subcatiscomplete = false;
                                        echo "<div class='lessondivlast'><div class='completedcheck' style='display:none;'><img src='./resources/images/checkmark_small.png'></div>";
                                    }
                                }
                        }
                        echo "<div class='lessontitle'><h3>".$subrow["sub_cat"]."</h3></div>";
                            echo "<ul>";
                                $getengwrdsquery = "SELECT eng_phrase FROM phrases WHERE ((sub_cat='".$subrow["sub_cat"]."') AND (lesson_txt1 = ''))";
                                $engwrdsresult = selectNoEmptyHandling($getengwrdsquery);
                                $getlessonwrdsquery = "SELECT lesson_txt1, lesson_name FROM phrases WHERE ((sub_cat='".$subrow["sub_cat"]."') AND (eng_phrase = ''))";
                                $lessonwrdsresult = selectNoEmptyHandling($getlessonwrdsquery);
                                if ($lessonwrdsresult ->num_rows >= 1){
                                    echo "<div class='lessonheadline'>Lessons:</div>";
                                    echo "<div class='lessonwrap'>";
                                    while($lessonwrdsrow = mysqli_fetch_array($lessonwrdsresult)){
                                        echo "<form class='lessonformgo' name='lessonfrm' action='#' method='post'>"
                                            . "<input type='hidden' name='subcatexactnm' value='".sanitisedata($subrow["sub_cat"])."'>"
                                            . "<input type='hidden' name='lessonexactnm' value='".sanitisedata($lessonwrdsrow["lesson_name"])."'>"
                                            . "<input type='hidden' name='formtype' value='lessonfrm'>"
                                            . "<span class='specificles'>"
                                                .sanitisedata($lessonwrdsrow["lesson_name"])
                                            . "</span>"
                                            . "</form>"
                                            . "<br />";
                                    }
                                    echo "</div>";
                                }
                                if ($engwrdsresult ->num_rows >= 1){
                                    echo "<div class='phraseheadline'>Phrases:</div>";
                                    echo "<div class='phrasewrap'>";
                                    echo "<form class='phrasefrm' action='#' method='post'>"
                                            . "<input type='hidden' name='phraseexactnm' value='".sanitisedata($subrow["sub_cat"])."'>"
                                            . "<input type='hidden' name='formtype' value='phrasefrm'>";
                                    while($engwrdsrow = mysqli_fetch_array($engwrdsresult)){
                                        echo "<li>".sanitisedata($engwrdsrow["eng_phrase"])."</li>";
                                    }
                                    echo "</form>";
                                    echo "</div>";
                                }
                            echo "</ul>";
                        echo "</div>";
                        
                        if ($subcatnum % 3 == "2"){
                            echo "</div>";
                        }
                    $subcatnum++;
                }
            }
            //if ($subcatnum % 3 != "2"){
                    echo "</div>";
            //    }
            //echo "</div>";
        }
        //echo "</div>";
        //...switching the position of the last echo </div> worked to fix a bug when there was only one box of phrases
    }
}
echo "</div>";
echo "</div>";
//The above two lines are the most recent iteration, fixing a problem of a non-sticky footer after saveandreturn submit...
//Must fix as this is still dependent on the number of lesson blocks on page...
?>