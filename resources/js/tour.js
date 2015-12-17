/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */


$(".signupbutton").click(function(){
    var loadUrl = "resources/php/partialviews/main/signup.php";
    var cssandjsname = "signup";
    $(".maincontentwrapper").changemainscrn(loadUrl, cssandjsname);
});