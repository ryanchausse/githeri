/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
var loadedsubmyprofileyet = true;
$.fn.changemyprofiledashscrn = function(loadUrl, cssandjsname){
    // Function to change submenu Admin Panel wrap contents
    if (loadedsubmyprofileyet == true){
        loadedsubmyprofileyet = false;
        $(".profilewrap").empty();
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/"+cssandjsname+".css"
         }).appendTo("head");
        $(".profilewrap").html(ajax_load).load(loadUrl,function(){loadedsubmyprofileyet=true;});
        $.getScript("./resources/js/"+cssandjsname+".js");
    }else{
        //Display "Please wait" message if I want
    }
};

var upperwraploaded = true;
$.fn.changeupperwrapscrn = function(loadUrl, cssandjsname){
    // Function to change upper wrap contents (main screen)
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

//My Profile Sub-Panel BEGIN
$("#myprofilesub").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/myprofiledisplay.php";
    var cssandjsname = "myprofiledisplay";
    $(".profilewrap").changemyprofiledashscrn(loadUrl, cssandjsname);
});
$("#friendssub").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/friends/friendsdisplay.php";
    var cssandjsname = "friends";
    $(".profilewrap").changemyprofiledashscrn(loadUrl, cssandjsname);
});
$("#messagessub").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/messages/messagesdisplay.php";
    var cssandjsname = "messages";
    $(".profilewrap").changemyprofiledashscrn(loadUrl, cssandjsname);
});
//My Profile Sub-Panel END

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

	function findfriend(){
		setTimeout(friendsubmitform(),5000);
	};
	function friendsubmitform(){
		$(this).find('.friendform').submit();
		$(this).html("Finding...");
	};
    });
