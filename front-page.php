<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package testsite
 */

get_header();
?>

<div>
    <section class="hero">
        <h2>キャッチコピー（商品やサービスを端的に紹介）</h2>
        <p>商品やサービスに関するテキストが入ります。商品やサービスに関するテキストが入ります。</p>
        <button class="heroBtn">お問い合わせ</button>
    </section>

    <section class="news">
        <h3>お知らせ・新着情報</h3>
        <?php echo do_shortcode('[news_list]'); ?>
    </section>

    <section class="feature">
        <div class="container">
            <h3><span>特徴</span>私たちには選ばれる3つの理由があります</h3>
            <ul>
                <li>
                    <p>コストパフォーマンス<br>業界一の精鋭ぞろい。</p>
                </li>
                <li>
                    <p>圧倒的なクオリティ<br>業界一の精鋭ぞろい。</p>
                </li>
                <li>
                    <p>コストパフォーマンス<br>業界一の精鋭ぞろい。</p>
                </li>
            </ul>
        </div>
    </section>


    <!--コンテンツ部分の出力-->
	<main id="primary" class="site-main">

<!--header-->
<?php get_header();?>

<!-- コンテンツ部分出力開始 -->
<d class="ly_cont ly_cont__col">
    <main class="ly_cont_main">
    <div class="blog ly_cont_card bl_card">
        <?php
            $latest_blog_posts = new WP_Query( array( 'posts_per_page' => 4 ) );

            if ( $latest_blog_posts->have_posts() ) : while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post();
            ?>
            <article class="bl_card">
            <a href="<?php the_permalink(); ?>" class="bl_card_link">
                <figure class="bl_card_imgWrapper">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                </figure>
                <div class="bl_card_body">
                    <?php the_title( '<h3 class="bl_card_ttl">', '</h3>' );?>
                    <span class="entry-date"><?php echo get_the_date(); ?></span>
                    <p class="bl_card_txt"><?php echo get_the_excerpt(); ?></p>
                    <a class="exce-read" href="<?php get_permalink($post->ID) ?>">続きを読む</a>
                </div>
            </a>
        </article>
        <?php
            endwhile; endif; 
        ?>
    </div>
    </main>
<!--コンテンツ部分の出力終了-->

</div>

<?php
get_footer();