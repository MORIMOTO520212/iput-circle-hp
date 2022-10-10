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

/**
 * Bootstrap 入力チェック
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
    });
}