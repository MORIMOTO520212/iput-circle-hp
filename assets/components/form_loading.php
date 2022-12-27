<?php
/**
 * フォーム送信時にロードアニメーションを付ける。
 * Usage:
 * classにform-loadingを付与する。
 * <form class="form-loading">...</form>
 */

function form_loading() {
?>

<!-- form loading animation -->
<style>
    div.spinner {
        position: fixed;
        top: 30vh;
        left: calc(50% - 17px);
        z-index: 500;
    }
    div.mask {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: #ffffff96;
        z-index: 450;
    }
</style>
<div class="loading d-none">
    <div class="spinner spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="mask"></div>
</div>

<script>
    var form = document.querySelector('.form-loading');
    form.addEventListener('submit', () => {
        console.log('form check validate');
        if (form.checkValidity()) {
            document.querySelector('.loading').classList.remove('d-none');
        }
    });
</script>

<?php
}
?>