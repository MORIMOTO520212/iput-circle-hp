<?php
/* Template Name: サークルを作成&編集する */

get_header();
?>

<form class="container d-flex justify-content-around  mt-4 mb-4 needs-validation"
 id="form" action="#" method="post" novalidate>

    <div>
        <h5 style="margin:0 20px 10px 20px;">サークル基本情報</h5>
        <div class="mainarea">
            <div class="mb-3">
                <label class="form-label" for="email-input">サークル名</label>
                <input type="text" class="form-control" id="circle-name-input" name="circle-name"
                    value="" placeholder="サークル名を入力してください"
                    aria-label="サークル名を入力してください" aria-describedby="circle-name-help" required>
                <div class="invalid-feedback">
                    入力必須です
                </div>
            </div>

            <div class="mb-3">
                <p>トップ画像</p>
                <input type="file" class="form-control" aria-label="file example">
                <div class="form-text">大学のメールアドレス</div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="belong-input">所属人数</label>
                <input type="text" class="form-control" id="belong-input" name="belong-name"
                    value="" placeholder="10" aria-label="10" required>
                <div class="invalid-feedback">
                    入力必須です
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="input">活動日程</label>
                <input type="text" class="form-control" id="schedule" name=""
                value="" placeholder="例）毎週土曜日、第2月曜日など" aria-label="10" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="input">活動場所</label>
                <input type="text" class="form-control" id="place" name=""
                value="" placeholder="例）コクーンタワー、Discord、LINEなど" aria-label="place" required>
            </div>

            <div class="mb-3">
                <p>サークルカテゴリ</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1" value="option1">
                    <label class="form-check-label" for="radio1">運動</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2" value="option2">
                    <label class="form-check-label" for="radio2">文化・学術</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio3" value="option3">
                    <label class="form-check-label" for="radio3">創造</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="input">設立日</label>
                <input type="text" class="form-control" id="date-of-establishment" name=""
                value="" placeholder="2022年9月10日" aria-label="date-of-establishment" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="input">活動頻度</label>
                <input type="text" class="form-control" id="activity-frequency" name=""
                value="" placeholder="例）毎週、不定期" aria-label="activity-frequency" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="input">会費</label>
                <input type="text" class="form-control" id="membership-free" name=""
                value="" placeholder="例）2000円/年、なし など" aria-label="membership-free" required>
            </div>

            <div class="mb-3">
                <p>特色</p>
                <div class="d-flex justify-content-around flex-wrap">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">のんびり</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">掛け持ちOK</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">掛け持ち非推奨</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">しっかり</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">オンライン活動</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">飲み会あり</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">顧問在籍</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">土日活動</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">平日活動</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">設立1年未満</label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div>
        <div class="mainarea">

        </div>
        <div class="mainarea">

        </div>
    </div>

</form>

<?php get_footer(); ?>