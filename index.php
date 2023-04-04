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


<?php
get_sidebar();
get_footer();
