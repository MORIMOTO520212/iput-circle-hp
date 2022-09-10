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
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
     integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
     crossorigin="anonymous"></script>
    <!-- JavaScript Bootstrap v5.2.0 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
     crossorigin="anonymous"></script>
    <!-- jQuery Slim v3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
     integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
     crossorigin="anonymous"></script>
     <script type="text/javascript" src="assets/base.js"></script>
    </body>
</html>

<?php
}
?>