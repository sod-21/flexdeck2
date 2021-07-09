<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="columns  is-multiline">
	<div class="column ">
		<div class="thumbnail  new-thumbnail">	
		<?php _s_post_thumbnail(); ?>
		<div class="tri-area" data-color="#f6f9fc"></div>
		</div>
				</div>
				<div class="column is-8 industy-wrap ">
					<div class="industry-item">									
							
					<?php the_title( sprintf( '<a class="title" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>	
					<?php the_excerpt(); ?>
						
					</div>
				</div>
				
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
