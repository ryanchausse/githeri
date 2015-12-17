/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
var loadedsubadminyet = true;

$.fn.changeadmindashscrn = function(loadUrl, cssandjsname){
    // Function to change submenu Admin Panel wrap contents
    if (loadedsubadminyet == true){
        loadedsubadminyet = false;
        $(".adminpanelwrap").empty();
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/"+cssandjsname+".css"
         }).appendTo("head");
         $.getScript("./resources/js/"+cssandjsname+".js");
        $(".adminpanelwrap").html(ajax_load).load(loadUrl,function(){loadedsubadminyet=true;});
    }else{
        //Display "Please wait" message if I want
    }
};

//Admin Sub-Panel BEGIN
$("#addphrase").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/addaphrase.php";
    var cssandjsname = "addaphrase";
    $(".adminpanelwrap").changeadmindashscrn(loadUrl, cssandjsname);
});
$("#addqrphrase").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/addqrphrase.php";
    var cssandjsname = "addqrphrase";
    $(".adminpanelwrap").changeadmindashscrn(loadUrl, cssandjsname);
});
$("#usermgmt").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/usermgmt/usermgmt.php";
    var cssandjsname = "usermgmt";
    $(".adminpanelwrap").changeadmindashscrn(loadUrl, cssandjsname);
});
$("#blogpost").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/blogpost/blogpost.php";
    var cssandjsname = "blogpost";
    $(".adminpanelwrap").changeadmindashscrn(loadUrl, cssandjsname);
});
//Admin Sub-Panel END