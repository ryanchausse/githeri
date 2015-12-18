<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
?>
<div class="upperwrap">
    <?php
        include_once "./resources/php/partialviews/main/dash/myprofile/upperwrapmain.php";
        include_once "../../../../../../resources/php/partialviews/main/dash/myprofile/upperwrapmain.php";
    ?>
</div>
<div class="bottomprofwrap">
    <?php
        include_once "./resources/php/partialviews/main/dash/myprofile/bottomwrapmain.php";
        include_once "../../../../../../resources/php/partialviews/main/dash/myprofile/bottomwrapmain.php";
    ?>
</div>

<script>
    $(".postcontent").focus(function(){
    if($(this).val() == "Write a post here..."){
        //$(this).attr("color","black");
        this.style.color = "black";
        $(this).val("");
    }
}).blur(function(){
    if($(this).val() == ""){
        //$(this).attr("color","gray");
        this.style.color = "gray";
        $(this).val("Write a post here...");
    }
});

$(".changepicbutton").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/uploadprofpic.php";
    var cssandjsname = "uploadprofpic";
    $(".upperwrap").changeupperwrapscrn(loadUrl, cssandjsname);
});

$(".editprofilebutton").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/editprofileinfo.php";
    var cssandjsname = "editprofileinfo";
    $(".profinfo").changeprofinfoscrn(loadUrl, cssandjsname);
});

$(".postbutton").click(function(){
    if (($("#postcontent").val() != "") && ($("#postcontent").val() != "Write a post here...")){
        $(".postbutton").html("Posting...");
        document.postinfo.submit();
    }else{
        $("#postcontent").val("Write a post here...");
    }
});

$("#postinfo").submit(function(event){
    if (($("#postcontent").val() != "") && ($("#postcontent").val() != "Write a post here...")){
        $(".postbutton").html("Posting...");
    }else{
        event.preventDefault();
    }
});

$(".postsender").click(function(){
    $(this).find('.postsenderform').submit();
    $(this).html("Finding...");
});


    $(document).ready(function() {
    $(".friendformdiv").click(function(){
        $(this).find('.friendform').submit();
        $(this).html("Finding...");
    });
    });
</script>