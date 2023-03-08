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

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			<div>
				<?php
				if(have_posts()) :
					while(hav_posts()) : the_post();
					get_template_part('templete-parts/content');
				endwhile;
			else:
				get_template_part('templete-parts/content', 'none');
			endif;
			</div>

		endif;
		?>

	</main>

<?php
get_sidebar();
get_footer();
