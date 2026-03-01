<?php

/**
 * Bootstrap モーダル テンプレート関数
 * @param string $title モーダルのタイトル
 * @param string $message モーダルの本文
 */
function modal($title, $message)
{
?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $title; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">了解</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = () => {
            var myModalElm = $('#myModal');
            var options = "keyboard";
            myModalElm.removeClass('display'); // display:none解除
            var myModal = new bootstrap.Modal(myModalElm, options);
            myModal.show();
        }
    </script>
<?php
}


/**
 * inputフォームエラー時の警告モーダル
 * @param string $error_code - エラーコード
 */
function input_value_error_exit($error_code = "")
{
    modal('エラー', "入力フォームを修正してもう一度お試しください。{$error_code}");
    return;
}
