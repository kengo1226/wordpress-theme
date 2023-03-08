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
                    <p>コストパフォーマンス<br>業界一の精鋭ぞろい。</p>
                </li>
                <li>
                    <p>コストパフォーマンス<br>業界一の精鋭ぞろい。</p>
                </li>
            </ul>
        </div>
    </section>

    <section class="blog">
    <main class="ly_cont_main">
        <div class="ly_cont_card bl_cardUnit bl_cardUnit__col3">
            <?php
					if ( have_posts() ) : 
						
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content');
            
             endwhile;
            
          else :
            
			        get_template_part( 'template-parts/content', 'none' );
            
          endif;
				?>
        </div>
        <?php the_posts_pagination(
            array(
                'mid_size'      => 2,
                'prev_next'     => true,
                'prev_text'     => __( '前へ'),
                'next_text'     => __( '次へ'),
                'type'          => 'list',
                )
        ); ?>

    </main>
    </section>
</div>

<?php
get_footer();