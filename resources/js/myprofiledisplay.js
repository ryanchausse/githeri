/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
var upperwraploaded = true;
$.fn.changeupperwrapscrn = function(loadUrl, cssandjsname){
    // Function to change maincontentwrapper contents (main screen)
    if (upperwraploaded == true){
        upperwraploaded = false;
        $(".upperwrap").empty();
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/"+cssandjsname+".css"
         }).appendTo("head");
        //$.getScript("./resources/js/"+cssandjsname+".js");
        $(".upperwrap").html(ajax_load).load(loadUrl,function(){
            upperwraploaded=true;
            $.getScript("./resources/js/"+cssandjsname+".js");
        });
    }else{
        //alert("Please wait for screen to load");
    }
};

var profinfoloaded = true;
$.fn.changeprofinfoscrn = function(loadUrl, cssandjsname){
    // Function to change profinfo contents (main screen)
    if (profinfoloaded == true){
        profinfoloaded = false;
        $(".profinfo").empty();
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/"+cssandjsname+".css"
         }).appendTo("head");
        //$.getScript("./resources/js/"+cssandjsname+".js");
        $(".profinfo").html(ajax_load).load(loadUrl,function(){
            profinfoloaded=true;
            $.getScript("./resources/js/"+cssandjsname+".js");
        });
    }else{
        //alert("Please wait for screen to load");
    }
};

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