/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

var nosignupscrnloaded = true;
$.fn.changenosignupscrn = function(loadUrl, cssandjsname){
    if (nosignupscrnloaded == true){
        nosignupscrnloaded = false;
    $(".quickreftbl").detach();
    $(".belowmenunosignup").empty();
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/"+cssandjsname+".css"
     }).appendTo("head");
    $(".belowmenunosignup").html(ajax_load).load(loadUrl,function(){
        nosignupscrnloaded=true;
        $.getScript("./resources/js/"+cssandjsname+".js");
    }
);};
};

$(".taketour").click(function(){
    var loadUrl = "./resources/php/partialviews/main/tour.php";
    var cssandjsname = "tour";
    $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
});
$(".signupbutton").click(function(){
    var loadUrl = "resources/php/partialviews/main/signup.php";
    var cssandjsname = "signup";
    $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
});
$(".nosignupbutton").click(function(){
    var loadUrl = "resources/php/partialviews/main/nosignup.php";
    var cssandjsname = "nosignup";
    $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
});

$("#quickreference").click(function(){
    var loadUrl = "./resources/php/partialviews/main/nosignup/quickreference/quickreference.php";
    var cssandjsname = "quickreference";
    $(".belowmenunosignup").changenosignupscrn(loadUrl, cssandjsname);
});
$("#interactivelessons").click(function(){
    var loadUrl = "./resources/php/partialviews/main/nosignup/interactivelessons/interactivelessons.php";
    var cssandjsname = "interactivelessons";
    $(".belowmenunosignup").changenosignupscrn(loadUrl, cssandjsname);
});