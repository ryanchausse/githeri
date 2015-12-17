/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
var nosignupscrnloaded = true;
$.fn.changenosignupscrn = function(loadUrl, cssandjsname){
    if (nosignupscrnloaded == true){
        nosignupscrnloaded = false;
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
        $.getScript("./resources/js/"+cssandjsname+".js");
        $(".belowmenudash").html(ajax_load).load(loadUrl,function(){loadedyet=true;});
    }else{
        //alert ("Please wait for screen to load.");
    }
};
//begin my code

healthscore = 5;
lcurrentphrase = 0;
tcurrentphrase = 0;

function changescreen(screenout, screenin){
    //alert(screenout);
    //$("#"+screenout).css("display","none");
    
    $("#"+screenout).fadeOut(150,function(){
        $("#"+screenin).fadeIn(150);
    });
}

function rightnext(){
    var scrnout = "correctscrn";
    tcurrentphrase++;
    if (tcurrentphrase == termcounter){
        var scrnin = "lastscr";
    }else{
        var scrnin = "hiddenphrase_"+tcurrentphrase;
    }
    changescreen(scrnout, scrnin);
}

function gotitright(currscrn){
    var rightscrn = "correctscrn";
    changescreen(currscrn, rightscrn);
}

function wrongnext(){
    var scrnout = "wrongscrn";
    var scrnin = "hiddenphrase_"+tcurrentphrase;
    healthupdate();
    changescreen(scrnout, scrnin);
}

function gotitwrong(currscrn){
    healthscore = healthscore-1;
    if (healthscore != 0){
        var wrngscrn = "wrongscrn";
    }else{
        var wrngscrn = "failscrn";
    }
    changescreen(currscrn, wrngscrn);
}

//function rightorwrong(){
//    var uanswer = trim(lcase($("#useranswer_"+tcurrentphrase).val()));
//    var correctans = trim(lcase($(this).find(".hiddenanswer").html()));
//    var currscrn = $(this).parent().parent().parent().attr("id");
//    if (uanswer == correctans){
//        gotitright(currscrn);
//    }else{
//        gotitwrong(currscrn);
//    }
//}

//function hint(){
//    alert($(this).children(".hiddenanswer").html());
//}

//function learn(){
//    var currscrn = "firstscrn";
//    var scrnin = "hiddenlearn_0";
//    changescreen(currscrn, scrnin);
//}

//function test(){
//    var currscrn = "firstscrn";
//    var scrnin = "hiddenphrase_0";
//    changescreen(currscrn, scrnin);
//}

function startover(currscrn){
    lcurrentphrase = 0;
    tcurrentphrase = 0;
    nextscrn = "firstscrn";
    changescreen(currscrn, nextscrn);
}

function healthupdate(){
    var imghtml = "";
    switch(healthscore){
        case 5:
            imghtml = "<img src='./resources/images/health5.png'>";
            break;
        case 4:
            imghtml = "<img src='./resources/images/health4.png'>";
            break;
        case 3:
            imghtml = "<img src='./resources/images/health3.png'>";
            break;
        case 2:
            $(".hidehintbutton").css("display","none");
            $(".hintbutton").css("display","block");
            imghtml = "<img src='./resources/images/health2.png'>";
            break;
        case 1:
            imghtml = "<img src='./resources/images/health1.png'>";
            break;
        case 0:
            imghtml = "<img src='./resources/images/health0.png'>";
            break;
        default:
            imghtml = "<img src='./resources/images/health5.png'>";
            break;
    }
    $(".topbarright").html(imghtml);
}
//and now with the clickety clack...

$(".learnnext").click(function(){
    var scrnout = $(this).parent().parent().attr("id");
    lcurrentphrase++;
    if (lcurrentphrase != termcounter){
        var scrnin = "hiddenlearn_"+lcurrentphrase;
    }else{
        var scrnin = "endoflearnwords";
    }
    changescreen(scrnout,scrnin);
});

$(".learnlessonnext").click(function(){
    var scrnout = $(this).parent().parent().attr("id");
    var scrnin = "hiddenlearn_0";
    changescreen(scrnout,scrnin);
});

$(".learnlessonnexttxt").click(function(){
    var scrnout = $(this).parent().parent().attr("id");
    lcurrentphrase++;
    if (lcurrentphrase < termcounter){
        var scrnin = "hiddenlearn_"+lcurrentphrase;
    }else{
        var scrnin = "endoflearnwords";
    }
    changescreen(scrnout,scrnin);
});

$("#learnwordsbutton").click(function(){
    var scrnout = $(this).parent().parent().parent().attr("id");
    var scrnin = "hiddenlearn_0";
    changescreen(scrnout, scrnin);
});

$("#returntofirstscrn").click(function(){
    var loadUrl = "./resources/php/partialviews/main/nosignup/interactivelessons/interactivelessons.php";
    var cssandjsname = "interactivelessons";
    $(".belowmenunosignup").changenosignupscrn(loadUrl, cssandjsname);
    $(".belowmenunosignup").changedashscrn(loadUrl, cssandjsname);
});

$("#taketestbutton").click(function(){
    var scrnout = $(this).parent().parent().parent().attr("id");
    var scrnin = "hiddenphrase_0";
    changescreen(scrnout, scrnin);
});

$(".hintbutton").click(function(){
    alert($(this).children(".hiddenanswer").html());
});

$(".submitresponse").click(function(){
    var uanswer = $("#useranswer_"+tcurrentphrase).html().toString().toLowerCase().trim();
    var correctans = $(this).children(".hiddenanswer").html().toString().toLowerCase().trim();
    var currscrn = $(this).parent().parent().attr("id");
    if (uanswer == correctans){
        gotitright(currscrn);
    }else{
        gotitwrong(currscrn);
    }
});

$(".ans").click(function(){
    $(this).parent().parent().parent().parent().children(".usranswr").html($(this).val());
});

$(".anslbl").click(function(){
    $(this).parent().parent().parent().parent().children(".usranswr").html($(this).html());
});

$(".txtareaunderinstructdesc").keyup(function(){
    $(this).parent().parent().parent().parent().children(".usranswr").html($(this).val());
});

$(".backbutton").click(function(){
    wrongnext();
});

$(".nextbutton").click(function(){
    rightnext();
});

$(".startover").click(function(){
    if ($(this).parent().parent().attr("id") == "failscrn"){
        var currscrn = "failscrn";
    }else if(typeof $(this).parent().parent().attr("id") !== 'undefined'){
        var currscrn = $(this).parent().parent().attr("id");
    }else{
        var currscrn = $(this).parent().parent().parent().attr("id");
    }
    if (healthscore == 0){
        healthscore = 5;
        imghtml = "<img src='./resources/images/health5.png'>";
        $(".topbarright").html(imghtml);
        $(".hidehintbutton").css("display","block");
        $(".hintbutton").css("display","none");
    }
    startover(currscrn);
});