var startPos = 0;
var winScrollTop = 0;

$(window).on('scroll', function(){
    winScrollTop = $(this).scrollTop();
    if(winScrollTop >= startPos){
        $('nav').addClass('hide');
    } else {
        $('nav').removeClass('hide');
    }
    startPos = winScrollTop;
});