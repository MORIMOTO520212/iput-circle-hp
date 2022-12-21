<?php
/**
 * Template Name: サークル詳細ページ
*/
?>



<?php get_header(); ?>

<?php
global $post;

// カスタムデータ取得
$post_custom = get_post_custom( $post->ID );

// ヘッダー画像のURL取得（ない場合はダミー画像を使う）
$headerImageUrl = !empty( $post_custom['headerImage'][0] ) ? wp_get_attachment_image_src( $post_custom['headerImage'][0] )[0] : get_theme_file_uri('src/no_image_circle_header.png');
?>

<div class="top-image" style="background-image: url('<?php echo $headerImageUrl ?>');">
    <img src="<?php echo $headerImageUrl ?>" />
    <p class="top-text"><?php the_title(); ?></p>
</div>

<!-- サークル基本情報 -->
<div class="container p-md-3 g-0 mt-4 top-sub-text">
    <ul class="p-0">
        <li class="line">
            <h2>所属人数</h2>
            <p><?php echo $post_custom['belongNum'][0]; ?></p>
        </li>
        <li class="line">
            <h2>活動日程</h2>
            <p><?php echo $post_custom['schedule'][0]; ?></p>
        </li>
        <li class="line">
            <h2>活動場所</h2>
            <p><?php echo $post_custom['place'][0]; ?></p>
        </li>
        <li>
            <h2>カテゴリ</h2>
            <p><?php echo $post_custom['categoryRadio'][0]; ?></p>
        </li>
    </ul>
</div>

<!-- メイン -->
<div class="container mt-3 mt-md-5">
    <div class="row justify-content-center">
        <!-- main contents -->
        <div class="col-lg-6">
            <div class="d-block d-lg-none">
                <div class="container">
                    <!-- mobile navigation -->
                    <div class="row flex-wrap">
                        <div class="col-6 g-2">
                            <div class="mobile-menu-link a-button icon journal-bookmark-fill" style="background:#767676;">
                                <a href="#"></a>
                                活動一覧
                            </div>
                        </div>
                        <?php
                        if ( !empty($post_custom['twitterUserName'][0]) ):
                        ?>
                        <div class="col-6 g-2">
                            <div class="mobile-menu-link a-button icon twitter">
                                <a href="<?php echo "https://twitter.com/" . $post_custom['twitterUserName'][0]; ?>" target="_blank"></a>
                                公式Twitter
                            </div>
                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="col-6 g-2">
                            <div class="mobile-menu-link a-button icon person-fill" style="background:#767676;">
                                <a href="#"></a>
                                参加申請
                            </div>
                        </div>
                        <div class="col-6 g-2">
                            <div class="mobile-menu-link a-button icon envelope-fill">
                                <a href="<?php echo home_url("index.php/circle-contact/?circlename=" . get_the_title() . "&to=" . $post_custom['contactMailAddress'][0] . "&from=" . wp_get_current_user()->user_email ); ?>"></a>
                                お問い合わせ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-nav">
                <div class="mt-5"></div>
            </div>
            <div class="overview">
                <h2>サークル概要</h2>
                <hr />
                <p><?php echo $post->post_content; ?></p>
            </div>

            <!-- 基本情報テーブル -->
            <div class="information mt-5">
                <h2>サークル情報</h2>
                <hr />
            </div>
            <table class="table table-bordered border-3 border-dark">
                <tbody>
                    <tr>
                        <th scope="row">代表者</th>
                        <td><?php echo $post_custom['representative'][0] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">設立日</th>
                        <td><?php echo date_formatting( $post_custom['establishmentDate'][0] ); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">活動頻度</th>
                        <td><?php echo $post_custom['activityFrequency'][0] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">会費</th>
                        <td><?php echo $post_custom['membershipFree'][0] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">特色</th>
                        <td>
                            <?php
                            if ( isset( $post_custom['features'][0] ) ):
                            // 非シリアライズ化して取り出し
                            $features = maybe_unserialize( $post_custom['features'][0] );
                            foreach( $features as $name ):
                            ?>
                            <span class="features badge rounded-pill bg-primary"><?php echo $name ?></span>
                            <?php
                            endforeach;
                            else:
                            ?>
                            なし
                            <?php
                            endif;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="activity-content mt-5">
                <h2>活動内容</h2>
                <hr />
                <?php echo $post_custom['activityDetail'][0]; ?>
            </div>

            <!--
            <div class="album mt-5">
                <h2>アルバム</h2>
                <hr />
                <div class="container">
                    <div class="row row-cols-2">
                        <?php
                        for($i = 0; $i < 4; $i++):
                        ?>
                            <div class="col-6 col-lg-12 col-xl-6">
                                <img class="img-thumbnail mt-4" src="<?php echo get_theme_file_uri('src/no_image.png'); ?>" />
                            </div>
                        <?php
                        endfor;
                        ?>
                    </div>
                </div>
            </div>
            -->

            <div class="activity-posts mt-5">
                <h2>活動記録</h2>
                <hr />
                <?php
                $args = array(
                    'posts_per_page' => 5, // 読み込む記事数
                    'category' => get_the_category()[0]->cat_ID // サークルカテゴリID
                );
                $posts = get_posts( $args );

                if ( $posts ):

                foreach ( $posts as $post ):

                // カスタムデータ取得
                $activity_post_custom = get_post_custom( $post->ID );

                // 内部公開判定
                if ( $activity_post_custom['permission'][0] === 'false' ):
                ?>
                <div class="card a-button mb-3">
                    <a href="<?php echo get_permalink( $post->ID ); ?>"></a>
                    <div class="row act-card">
                        <div class="col-4 col-sm-3 h-100 pe-0">
                            <img src="<?php echo !empty( $activity_post_custom['topImage'][0] ) ? wp_get_attachment_image_src( $activity_post_custom['topImage'][0] )[0] : get_theme_file_uri('src/no_image_activity.png'); ?>" />
                        </div>
                        <div class="col-8 col-sm-9 p-0">
                            <div class="card-body">
                                <p><?php echo date_formatting( $post->post_date ); ?></p>
                                <p class="card-text line-clamp-2"><?php echo $post->post_title; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endif;
                endforeach;

                else:
                ?>
                <p class="text-center">活動記録がまだありません。</p>
                <?php
                endif;
                ?>
            </div>
        </div>
        <!-- desktop navigation -->
        <div class="col-lg-4 mt-5">
            <nav class="toc d-none d-lg-block">
                <div class="menu-link a-button mt-4 icon journal-bookmark-fill" style="background:#767676;">
                    <a href="#"></a>
                    活動一覧
                </div>
                <div class="menu-link a-button mt-4 icon person-fill" style="background:#767676;">
                    <a href="#"></a>
                    参加申請
                </div>
                <?php
                if ( !empty($post_custom['twitterUserName'][0]) ):
                ?>
                <div class="menu-link a-button mt-4 icon twitter">
                    <a href="<?php echo "https://twitter.com/" . $post_custom['twitterUserName'][0]; ?>" target="_blank"></a>
                    公式Twitter
                </div>
                <?php
                endif;
                ?>
                <div class="menu-link a-button mt-4 icon envelope-fill">
                    <a href="javascript:piplup();"></a>
                    お問い合わせ
                </div>
                <p class="mt-4">更新日: <?php echo date_formatting( $post->post_modified ); ?></p>
            </nav>
        </div>
    </div>
</div>

<script>
/* お問い合わせポップアップ画面 */
function piplup() {
    window.open("<?php echo home_url("index.php/circle-contact/?circlename=" . get_the_title() . "&to=" . $post_custom['contactMailAddress'][0] . "&from=" . wp_get_current_user()->user_email ); ?>", "window1", "width=400, height=400, scrollbars=1");
}
</script>

<?php get_footer(); ?>