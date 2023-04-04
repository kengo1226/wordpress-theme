<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package testsite
 */

?>

<article class="bl_card">
    <a href="/blog/<?php the_permalink(); ?>" class="bl_card_link">
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


