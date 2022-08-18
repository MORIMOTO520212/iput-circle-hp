<?php
/*  * * * フッター * * *
    $page_name - この引数にページの名前を指定するとそのページのCSSが読み込まれます.
*/
function footer($page_name) {
?>

        <footer>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 footer-links">
                            <div class="row">
                                <div class="col">
                                    <h6>リンク</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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

                        <div class="col-md-6 offset-md-1">
                            <h6>外部リンク</h6>
                            <p><a href="#">東京国際工科専門職大学</a></p>
                            <p><a href="#">IPUT days Tokyo - Twitter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="assets/base.js"></script>
        <!-- JavaScript Bootstrap v5.0.2 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
        <!-- jQuery Slim v3.3.1 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
    </body>
</html>

<?php
}
?>