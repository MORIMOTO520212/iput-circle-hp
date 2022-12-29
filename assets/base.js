var startPos = 0;
var winScrollTop = 0;

/**
 * スクロールでヘッダーが隠れる
 * navタグのclass属性にhideを追加すると表示、消すと非表示になる。
 * モバイル版のみ有効化。
*/
if($('nav').width() < 500){
    $(window).on('scroll', function(){
        winScrollTop = $(this).scrollTop();
        if(winScrollTop >= startPos){
            $('nav').addClass('hide');
        } else {
            $('nav').removeClass('hide');
        }
        startPos = winScrollTop;
    });
}

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

/**
 * フォーム送信時にロードアニメーションを付ける。
 * Usage:
 * classにform-loadingを付与する。
 * <form class="form-loading">...</form>
 */
var formLoading = document.querySelector('.form-loading');
formLoading.addEventListener('submit', () => {
    console.log('form check validate');
    if (formLoading.checkValidity()) {
        document.querySelector('.loading').classList.remove('d-none');
    }
});