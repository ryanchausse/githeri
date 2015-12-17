/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */

$(".replymsgbox").hide();

$(".postsender").click(function(){
    $(this).find('.postsenderform').submit();
    $(this).html("Finding...");
});

$(".seeconvospan").click(function(){
    $(this).find('.seeconvoform').submit();
    $(this).html("Finding...");
});

$(".replymsgspan").click(function(){
    if ($(this).parent().find('.replymsgbox').css('display') == "none"){
        $(this).parent().find('.replymsgbox').css('display','block');
    }else{
        $(this).parent().find('.replymsgbox').css('display','none');
    }
});