<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>
	<?php
		$top_header = get_field('top_header', 'options');
		if ($top_header):
	?>
	<div id="top_header">
		<?php echo $top_header; ?>
	</div>
	<?php
		endif;
	?>
	<header id="masthead" class="site-header polygone-header">
		<div class="main-header d-flex">			
			<div class="site-branding">
				<?php
				
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				
				if ($custom_logo_id) {
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					//
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home" title="<?php echo bloginfo( 'name' ); ?>"><img src="<?php echo $image[0]; ?>" width="320" height="70" /></a>

					<?php
				} else {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				}

				$_s_description = get_bloginfo( 'description', 'display' );
				if ( $_s_description || is_customize_preview() ) :
					?>
					
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14 fa-5x"><path fill="#fff" d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z" class=""></path></svg>
				<svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-7x"><path fill="#fff" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path></svg>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>

				
			</nav><!-- #site-navigation -->
			
			<nav class="secondary-nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary-menu',
						'menu_id'        => 'secondary-menu',
					)
				);
				?>
			</nav>
		</div>
	</header><!-- #masthead -->
	<script type="text/javascript">
		var el = document.querySelector(".search_panel > .sub-menu");
		if (el) {
			el.innerHTML = `<form role='search' method='get' class='search-form' action='<?php echo home_url('/'); ?>'><input type="search" class="search-field" name="s" placeholder="Search ..."></form>`;
		}
	</script>
	<?php

	$gradient_color = get_field("gradient_for_featured_image");
	$graident_class = "";

	if ($gradient_color) {
		$gradient_class = "gradient_bg";
	}

	if (is_front_page()):
	$header = get_field('home_slide', 'options');				
	?>
	<div class="banner-slider">
		<?php 
		foreach ($header as $head): 
		?>
		<div class="slide-item">
			<?php if (isset($head["text"])): ?>
			<div class="content">
				<div class="float-bottom"></div>
				<div class="float-right"></div>
				<?php echo $head["text"]; ?></div>
			<?php endif; ?>
			<?php if (isset($head["image"])): 
			?>			
			<?php sod_generate_image_tag($head["image"], ['float']); ?>
			<?php endif; ?>

			<?php if (isset($head["background_image"])) : ?>			
			<?php sod_generate_image_tag($head["background_image"], ['bg']); ?>
			<?php endif; ?>
		</div>
		<?php
		endforeach;
		?>		
	</div>
	<?php else: 
	global $post;
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' ); 
	$url = $url ? $url : get_field("banner_image", "option");
		?>

	<div class="static-banner <?php echo $gradient_class; ?>">		
		<div class="slide-item">
			
			<div class="content new-content">
				<h1 class="page-title">				
				<?php if (is_404()) {
					echo "404";
				} else if (is_search()) {
					echo "Search Results";
				} else {
				 the_title( '', ''); 
				}
				?>
				</h1>
				<?php if (is_page()) { the_field("custom");} ?>
			</div>
			<?php sod_generate_image_tag($url, ['bg']); ?>
		</div>			
	</div>
	<?php endif;?>