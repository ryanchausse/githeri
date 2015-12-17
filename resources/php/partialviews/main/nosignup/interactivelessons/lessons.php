<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "./resources/php/functions/login/loginandregistration.php";
$loginstatus = $login->isUserLoggedIn();
$subcat = sanitisedata($_POST["lessonexactnm"]);
$termcounterphp = 1;
?>
<script type="text/javascript">
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/phrases.css"
     }).appendTo("head");
     $.getScript("./resources/js/phrases.js");
</script>
<div class="phrasesectwrap">
<?php
if ($loginstatus){
?>
    <div id= "endoflearnwords" class="endoflearnwords">
        <div class="topbar">
            <div class="introtopbarleft"><?php //echo $subcat; ?></div>
        </div>
        <div class="mainbarwrap">
            <div class="savereturnmsg">Good work.</div>
            <div id="returntofirstscrn" class="startoverinteractive">Interactive Lessons</div>
        </div>
        <div class="lowerbar">
            <div class="lowerbarleft"></div><div class="introhintbutton"><div class="hiddenanswer"></div></div><div class="introlearnnext"><div class="hiddenanswer"></div></div>
        </div>
    </div>
<?php
}else{
?>
    <div id= "endoflearnwords" class="endoflearnwords">
        <div class="topbar">
            <div class="introtopbarleft"><?php //echo $subcat; ?></div>
        </div>
        <div class="mainbarwrap">
            <div class="donenosigninmsg">
                That's the end of this lesson.<br /><br />Now Sign Up to track your progress and chat with other Kiswahili speakers.
            </div>
            <div class="signupbutton"></div>
        </div>
        <div class="lowerbar">
            <div class="lowerbarleft"></div><div class="introhintbutton"><div class="hiddenanswer"></div></div><div class="introlearnnext"><div class="hiddenanswer"></div></div>
        </div>
    </div>
<?php
}

if (file_exists("../../../../../../resources/php/functions/sqlconnectandselect.php")){
    include_once "../../../../../../resources/php/functions/sqlconnectandselect.php";
}else{
    include_once "./resources/php/functions/sqlconnectandselect.php";
}
$phrasearr = array();
$phrases = array();
$i = 0;
$hiddendivcounter = 0;
$hiddenlearnphrasecounter = 0;
if (isset($_POST["lessonexactnm"])){
    $subcat = sanitisedata($_POST["lessonexactnm"]);
}else{
    die("You have to specify a lesson.");
}

$subcatsql = "SELECT * FROM phrases WHERE lesson_name ='".$subcat."'";
$subcatresult = selectNoEmptyHandling($subcatsql);
if ($subcatresult ->num_rows < 1){
    echo "No lessons found for this sub-category.";
}else{
    while($subcatrow = mysqli_fetch_array($subcatresult)){
        $phrases[$i]["lesson_name"] = $subcatrow["lesson_name"];
        if ($subcatrow["lesson_txt1"] != ""){
            $phrases[$i]["lesson_txt1"] = $subcatrow["lesson_txt1"];
            ?>
            <script type='text/javascript'>
                termcounter = 1;
            </script>
            <?php
        }
        if ($subcatrow["lesson_txt2"] != ""){
            $phrases[$i]["lesson_txt2"] = $subcatrow["lesson_txt2"];
            $termcounterphp++;
            ?>
            <script type='text/javascript'>
                termcounter = 2;
            </script>
            <?php
        }
        if ($subcatrow["lesson_txt3"] != ""){
            $phrases[$i]["lesson_txt3"] = $subcatrow["lesson_txt3"];
            $termcounterphp++;
            ?>
            <script type='text/javascript'>
                termcounter = 3;
            </script>
            <?php
        }
        if ($subcatrow["lesson_txt4"] != ""){
            $phrases[$i]["lesson_txt4"] = $subcatrow["lesson_txt4"];
            $termcounterphp++;
            ?>
            <script type='text/javascript'>
                termcounter = 4;
            </script>
            <?php
        }
        if ($subcatrow["lesson_txt5"] != ""){
            $phrases[$i]["lesson_txt5"] = $subcatrow["lesson_txt5"];
            $termcounterphp++;
            ?>
            <script type='text/javascript'>
                termcounter = 5;
            </script>
            <?php
        }
        $i++;
    }
}
?>
<div id="firstscrn" class="firstscrn">
    <div class="topbar">
        <div class="introtopbarleft"><?php //echo $subcat; ?></div>
    </div>
    <div class="mainbarwrap">
        <div class="welcometolesson"><?php echo htmlentities($subcat); ?>&nbsp;-&nbsp;Click Next to begin.</div>
    </div>
    <div class="lowerbar">
        <div class="lowerbarleft"></div><div class="introhintbutton"><div class="hiddenanswer"></div></div><div class="learnlessonnext">Next<div class="hiddenanswer"></div></div>
    </div>
</div>
<?php

function createlearndiv($phrasearr, $hiddenlearnphrasecounter){
    echo "<div style='text-align:left;' id='hiddenlearn_".$hiddenlearnphrasecounter."' class='hiddenlearnsection'>";
    ?>
    <div class="topbar">
        <div class="topbarleft"></div><div class="topbarright"></div>
    </div>
    <div class="mainbarwrap">
        <?php $thelssn = "lesson_txt".($hiddenlearnphrasecounter+1);?>
        <?php echo $phrasearr[$thelssn]; ?>
    </div>
    <div class="lowerbar">
        <div class="lowerbarleft"></div><div class="introhintbutton"><div class="hiddenanswer"></div></div><div class="learnlessonnexttxt">Next<div class="hiddenanswer"></div></div>
    </div>
    <?php
    echo "</div>";
    $hiddenlearnphrasecounter++;
    return $hiddenlearnphrasecounter;
}

for($counter = 0;$counter <= ($termcounterphp-1);$counter++){
    $hiddenlearnphrasecounter = createlearndiv($phrases[0], $hiddenlearnphrasecounter);
}
?>
</div>