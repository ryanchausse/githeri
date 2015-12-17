/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
$.ajaxSetup ({  
        cache: false  
    });  
var ajax_load = "<br /><img src='./resources/images/loading.gif' alt='loading...' />";
var mainscrnloaded = true;
$.fn.changemainscrn = function(loadUrl, cssandjsname){
    // Function to change maincontentwrapper contents (main screen)
    if (mainscrnloaded == true){
        mainscrnloaded = false;
        $(".maincontentwrapper").empty();
        $("<link/>", {
            rel: "stylesheet",
            type: "text/css",
            href: "./resources/css/"+cssandjsname+".css"
         }).appendTo("head");
        //$.getScript("./resources/js/"+cssandjsname+".js");
        $(".maincontentwrapper").html(ajax_load).load(loadUrl,function(){
            mainscrnloaded=true;
            $.getScript("./resources/js/"+cssandjsname+".js");
        });
    }else{
        //alert("Please wait for screen to load");
    }
};
$(document).ready(function(){
    $("#privacypolicy").click(function(){
        var loadUrl = "resources/php/partialviews/main/privacypolicy.php";
        var cssandjsname = "privacypolicy";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $("#termsofuse").click(function(){
        var loadUrl = "resources/php/partialviews/main/termsofuse.php";
        var cssandjsname = "termsofuse";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $(".logoimg").click(function(){
        var loadUrl = "./resources/php/partialviews/main/notloggedin.php";
        var cssandjsname = "nosignup";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $(".logoimgloggedin").click(function(){
        var loadUrl = "./resources/php/partialviews/main/dashboard.php";
        var cssandjsname = "dashboard";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
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
    $(".aboutmnu").click(function(){
        var loadUrl = "resources/php/partialviews/main/about.php";
        var cssandjsname = "about";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $("#faqmnu").click(function(){
        var loadUrl = "resources/php/partialviews/main/faq.php";
        var cssandjsname = "faq";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $(".contactmnu").click(function(){
        var loadUrl = "resources/php/partialviews/main/contact.php";
        var cssandjsname = "contact";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $("#blogmnu").click(function(){
        var loadUrl = "resources/php/partialviews/main/blog.php";
        var cssandjsname = "blog";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $(".infomnu").click(function(){
        var loadUrl = "resources/php/partialviews/main/about.php";
        var cssandjsname = "about";
        $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
    });
    $(".msgicon").click(function(){
        if ($(".subnavmsgs").css("left") == "-350px"){
            $(".msgimg").attr("src", "./resources/images/message.jpg");
            $(".subnavmsgs").css("left","-999em");
        }else{
            $(".msgimg").attr("src", "./resources/images/messageactive.jpg");
            $(".subnavmsgs").css("left","-350px");
        }
    });
    $(".msgfragment").click(function(){
        $(this).find('.seeconvoform').submit();
        $(this).html("Finding...");
    });
});