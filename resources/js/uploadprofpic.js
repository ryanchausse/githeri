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

$(".cancelpicupload").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/upperwrapmain.php";
    var cssandjsname = "myprofiledisplay";
    $(".upperwrap").changeupperwrapscrn(loadUrl, cssandjsname);
});