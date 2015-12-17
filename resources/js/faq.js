/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */


$('#faqs h3').each(function() {
    var tis = $(this), state = false, answer = tis.next('div').hide().css('height','auto').slideUp();
    tis.click(function() {
        state = !state;
        answer.slideToggle(state);
        tis.toggleClass('active',state);
    });
});