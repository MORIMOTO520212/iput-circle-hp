<?php
/*  * * * フッター * * *
    $page_name - この引数にページの名前を指定するとそのページのCSSが読み込まれます.
*/
function footer($page_name) {
?>
    <footer>
        <div class="footer-top">
            <div class="container">
                <h2 class="mb-3">IPUT学生団体</h2>
                <div class="row">
                    <div class="col-md-4 footer-links">
                        <div class="row">
                            <div class="col">
                                <h6>リンク</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-flex flex-column">
                                <p class="mb-1"><a href="#">活動一覧</a></p>
                                <p class="mb-1"><a href="#">ニュース一覧</a></p>
                                <p class="mb-1"><a href="#">FAQ</a></p>
                                <p class="mb-1"><a href="#">お問い合わせ</a></p>
                            </div>
                            <div class="col-md-6">
                                <p><a href="#">このサイトについて</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-1 d-flex flex-column">
                        <h6>外部リンク</h6>
                        <p class="mb-1"><a href="#">東京国際工科専門職大学</a></p>
                        <p class="mb-1"><a href="#">IPUT days Tokyo - Twitter</a></p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <span>&copy;2022 Nectgrams 学生によって運営されています</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- base.js -->
     <script type="text/javascript" src="assets/base.js"></script>
    </body>
</html>

<?php
}
?>