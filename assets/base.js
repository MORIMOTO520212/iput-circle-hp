var startPos = 0;
var winScrollTop = 0;

$(window).on('scroll', function(){
    winScrollTop = $(this).scrollTop();
    if(winScrollTop >= startPos && winScrollTop >= 100){
        $('nav').addClass('hide');
    } else {
        $('nav').removeClass('hide');
    }
    startPos = winScrollTop;
});

/** 入力フォームチェック
 * submitされたら入力チェックを行う
*/
var form = document.querySelector('.needs-validation');
if (form) {
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
}