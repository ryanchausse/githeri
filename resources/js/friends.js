/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

//this is to change defaultprofilepic to the path for the individual user on load of page
//$(".friend").css("background-image","url('http://ryanchausse.com/kiswahili2/resources/images/logo.jpg')");



$(document).ready(function() {
    $(".friendformdiv").click(function(){
        $(this).find('.friendform').submit();
        $(this).html("Finding...");
    });
});
