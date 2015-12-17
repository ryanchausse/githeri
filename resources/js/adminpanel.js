/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

$.fn.changeadmindashscrn = function(loadUrl, cssandjsname){
    // Function to change submenu Admin Panel wrap contents
    $(".adminpanelwrap").empty();
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "./resources/css/"+cssandjsname+".css"
     }).appendTo("head");
    $.getScript("./resources/js/"+cssandjsname+".js");
    $(".adminpanelwrap").html(ajax_load).load(loadUrl);
};
//Admin Sub-Panel BEGIN
$("#addphrase").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/addaphrase.php";
    var cssandjsname = "addaphrase";
    $(".adminpanelwrap").changeadmindashscrn(loadUrl, cssandjsname);
    $.getScript("./resources/js/adminpanel.js");
});
$("#usermgmt").click(function(){
    var loadUrl = "./resources/php/partialviews/main/dash/admin/usermgmt.php";
    var cssandjsname = "usermgmt";
    $(".adminpanelwrap").changeadmindashscrn(loadUrl, cssandjsname);
});
//Admin Sub-Panel END