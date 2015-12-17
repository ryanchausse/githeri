/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
var loadedyet = true;

$.fn.changedashscrn = function(loadUrl, cssandjsname){
    // Function to change dashboard contents under menu
    if (loadedyet == true){
        loadedyet = false; //Like me on a Friday afternoon...
        $(".belowmenudash").empty();
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/"+cssandjsname+".css"
         }).appendTo("head");
        $(".belowmenudash").html(ajax_load).load(loadUrl,function(){
            loadedyet=true;
            $.getScript("./resources/js/"+cssandjsname+".js");
        });
    }else{
        //alert ("Please wait for screen to load.");
    }
};

$("#adminchoice").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/adminpanel.php";
    var cssandjsname = "adminpanel";
    $(".belowmenudash").changedashscrn(loadUrl, cssandjsname);
    //$.getScript("./resources/js/dashboard.js");
});
$("#lessonchoice").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/interactivelessons/interactivelessons.php";
    var cssandjsname = "interactivelessons";
    $(".belowmenudash").changedashscrn(loadUrl, cssandjsname);
    //$.getScript("./resources/js/dashboard.js");
});
$("#myprofile").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/myprofile/myprofile.php";
    var cssandjsname = "myprofile";
    $(".belowmenudash").changedashscrn(loadUrl, cssandjsname);
    //$.getScript("./resources/js/dashboard.js");
});
$("#quickreference").click(function(){
    var loadUrl = "./resources/php/partialviews/main/nosignup/quickreference/quickreference.php";
    var cssandjsname = "quickreference";
    $(".belowmenudash").changedashscrn(loadUrl, cssandjsname);
    //$.getScript("./resources/js/dashboard.js");
});