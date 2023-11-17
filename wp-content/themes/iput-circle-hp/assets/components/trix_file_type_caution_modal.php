<?php
/**
 * Trix.jsエディタのファイル添付時にpng, jpeg以外の画像を
 * 添付しようとしたときにエラーをモーダルで表示させるコンポーネント
 * Usage:
 * Trix.jsを使っているページのget_header()より後に以下のコードを設置する。
 * <?php require_once( get_theme_file_path("assets/components/trix_file_type_caution_modal.php") ); ?>
*/
?>

<div class="modal fade" id="fileTypeCaution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header alert alert-warning">
            <h5 class="modal-title" id="exampleModalLabel">非対応のファイルです</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            jpegまたはpng形式のファイルのみ添付できます。
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">わかりました</button>
        </div>
        </div>
    </div>
</div>
<script>
    var fileTypeCautionElm = $('#fileTypeCaution');
    var options = "keyboard";
    fileTypeCautionElm.removeClass('display'); // display:none解除
    fileTypeCaution = new bootstrap.Modal(fileTypeCautionElm, options);
</script>