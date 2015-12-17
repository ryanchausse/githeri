/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

//Add a Phrase BEGIN
$("#majorother").click(function(){
    $(".subcatdiv").show(300);
    $("[id^=hidden_]").css("display","none");
    $("#majorhidden").show(300);
});
$("#subother").click(function(){
    $(".phraseorlessondiv").show(300);
    $("#subhidden").show(300);
});
$(".majorcatchoice").click(function(){
    $(".subcatdiv").show(300);
    $("[id^=hidden_]").css("display","none");
    $("#hidden_"+$(this).attr("id")).show(100);
    $("#majorhidden").hide(300);
});
$(".subcatchoice").click(function(){
    $(".phraseorlessondiv").show(300);
    $("#subhidden").hide(300);
});

$("#optphrasechoice").click(function(){
    $(".lessonoptionsdiv").hide();
    $(".phraseoptionsdiv").show(300);
    document.getElementById("lessonorphrase").value = "phrase";
});
$("#optlessonchoice").click(function(){
    $(".phraseoptionsdiv").hide();
    $(".lessonoptionsdiv").show(300);
    document.getElementById("lessonorphrase").value = "lesson";
});
//Add a Phrase END

$(".majorcatchoice").click(function(){
    if ($(this).attr("id") != "majorother"){
        $("#majornewname").val("");
        $("#finalmajname").val($(this).attr("id"));
    }
});
$(".subcatchoice").click(function(){
    if ($(this).attr("id") != "subother"){
        $("#subnewname").val("");
        $("#finalsubname").val($(this).attr("id"));
    }
});
$("#majornewname").keyup(function() {
    $("#finalmajname").val($(this).val());
});
$("#subnewname").keyup(function() {
    $("#finalsubname").val($(this).val());
});