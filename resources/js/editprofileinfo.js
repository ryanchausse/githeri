/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

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

$(".canceleditprofilebutton").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/profinfoview.php";
    var cssandjsname = "profinfoview";
    $(".profinfo").changeprofinfoscrn(loadUrl, cssandjsname);
});

$(".editprofilebutton").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/editprofileinfo.php";
    var cssandjsname = "editprofileinfo";
    $(".profinfo").changeprofinfoscrn(loadUrl, cssandjsname);
});