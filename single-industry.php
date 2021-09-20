<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		$content = get_the_content();
		if ($content) :
	?>
			<div data-section="1">
				<div class="container">
					<div class=" column is-10 is-offset-1">
						<?php $title = get_field("title");

						if ($title) :
							echo "<h2 class='top_title'>$title</h2>";
						endif;
						?>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		<?php
		endif;
		$img_carousel = get_field("image_carousel");
		if ($img_carousel) :
		?>
			<div data-section="2">
				<div class="container">
					<div class="image_carousel">

						<?php foreach ($img_carousel as $img) : ?>
							<div class="slide-item">
								<div class="thumbnail new-thumbnail">
									<a data-popup class="image-overlay" href="<?php echo $img["image"]; ?>">
									</a>
									<?php sod_generate_image_tag($img["image"]); ?>
									<div class="tri-area" data-color="#fff"></div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
		<?php
		endif;

		$content_block = get_field("content_block_2");
		$content_block3 = get_field("columned_content_block_3");
		$content_block4 = get_field("content_block_4");
		$content_block4 = get_field("content_block_4");
		$content_block5 = get_field("content_block_5");
		$content_block6 = get_field("columned_content_block_6");

		if ($content_block || !empty($content_block3) || $content_block4 || $content_block5 || !empty($content_block6)) {
		?>
			<div data-section class="content_block">
				<div class="container">
					<div class=" column is-10 is-offset-1">
						<?php echo $content_block; ?>

						<?php
						if (!empty($content_block3)) : ?>
							<div class="columns mt-6">
								<?php
								foreach ($content_block3 as $c3) :
								?>
									<div class="column is-4-desktop">
										<div class=" c3-content">
											<div class="thumbnail new-thumbnail" data-color="#fff">
												<?php sod_generate_image_tag($c3["image"]); ?>
												<div class="tri-area" data-color="#fff"></div>
											</div>

											<h4><?php echo $c3["title"]; ?></h4>
											<?php echo $c3["content"]; ?>

											<div class="download">
												<span class="icon">
													<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
														<path fill="#d50000" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm250.2-143.7c-12.2-12-47-8.7-64.4-6.5-17.2-10.5-28.7-25-36.8-46.3 3.9-16.1 10.1-40.6 5.4-56-4.2-26.2-37.8-23.6-42.6-5.9-4.4 16.1-.4 38.5 7 67.1-10 23.9-24.9 56-35.4 74.4-20 10.3-47 26.2-51 46.2-3.3 15.8 26 55.2 76.1-31.2 22.4-7.4 46.8-16.5 68.4-20.1 18.9 10.2 41 17 55.8 17 25.5 0 28-28.2 17.5-38.7zm-198.1 77.8c5.1-13.7 24.5-29.5 30.4-35-19 30.3-30.4 35.7-30.4 35zm81.6-190.6c7.4 0 6.7 32.1 1.8 40.8-4.4-13.9-4.3-40.8-1.8-40.8zm-24.4 136.6c9.7-16.9 18-37 24.7-54.7 8.3 15.1 18.9 27.2 30.1 35.5-20.8 4.3-38.9 13.1-54.8 19.2zm131.6-5s-5 6-37.3-7.8c35.1-2.6 40.9 5.4 37.3 7.8z" class=""></path>
													</svg>
												</span>
												<a href="<?php echo $c3["download"]; ?>" target="_blank">
													<?php echo $c3["download_title"]; ?>
												</a>
											</div>

										</div>
									</div>
								<?php
								endforeach;
								?>
							</div>
						<?php endif; ?>

						<?php if ($content_block4) : ?>
							<div class="content_block_content content_block4">
								<?php echo $content_block4; ?>
							</div>
						<?php endif; ?>

						<?php if ($content_block5) : ?>
							<div class="content_block_content content_block5">
								<?php echo $content_block5; ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($content_block6)) : ?>
							<div class="  content_block6 columns">
								<?php
								foreach ($content_block6 as $c6) :
								?>
									<div class="column is-4-desktop">
										<div class="c3-content">
											<h4><a href="<?php echo $c6["url"]; ?>" target="_blank"><?php echo $c6["title"]; ?></a></h4>
											<?php echo $c6["content"]; ?>

										</div>
										<div>
										<?php endforeach; ?>
										</div>
									<?php endif; ?>
									</div>
							</div>
					</div>
				<?php
			}
			$item_image_pos = get_field("item_list_image_from_left");
			$left = "";
			$shuffle = "";
			foreach ($item_image_pos as $iip) {
				if ($iip == "Left") {
					$left = "left";
				} else if ($iip == "Shuffle") {
					$shuffle = "shuffle";
				}
			}
				?>

				<?php
				$item_list = get_field("item_list");
				if ($item_list && count($item_list) > 0) : ?>
					<div id="industry_items" class="item_list_container_from_<?php echo $left . "  " . $shuffle; ?> ">
						<?php
						foreach ($item_list as $key => $item) :
							//$bg_color = $item["background_color"];
							$bg_color = $item["background_color"] ? $item["background_color"] : "#fff";

							$full_width = "";
							if ($item["full_width"]) {
								$full_width = "full_width";
							}
						?>

							<div data-section style="<?php echo $bg_color ? "background: $bg_color;" : ""; ?>">
								<style type="text/css">
									.new-thumbnail#th-<?php echo $key; ?>:before {
										border-top-color: <?php echo $bg_color; ?>;
										border-left-color: <?php echo $bg_color; ?>;
									}

									.new-thumbnail#th-<?php echo $key; ?>:after {
										border-right-color: <?php echo $bg_color; ?>;
										border-bottom-color: <?php echo $bg_color; ?>;
									}

									.new-thumbnail#th-<?php echo $key; ?>.tri-area:before {
										border-left-color: <?php echo $bg_color; ?>;
										border-bottom-color: <?php echo $bg_color; ?>;
									}

									.new-thumbnail#th-<?php echo $key; ?>.tri-area:after {
										border-right-color: <?php echo $bg_color; ?>;
										border-top-color: <?php echo $bg_color; ?>;
									}
								</style>

								<div class="container item_list_section">

									<div class="columns  is-multiline">
										<div class="column industy-wrap <?php echo $full_width; ?>">
											<div class="industry-item">

												<a href="<?php echo $item["link"]; ?>" class="title"> <?php echo isset($item["title"]) ? $item["title"] : ""; ?> </a>

												<p>
													<?php echo isset($item["content"]) ? $item["content"] : ""; ?>
												</p>
											</div>
										</div>
										<?php if ($item["image"]) : ?>
											<div class="column <?php echo $full_width; ?>">
												<div class="thumbnail new-thumbnail" id="th-<?php echo $key; ?>" data-color="<?php echo $bg_color; ?>">
													<a class='image-overlay' href="<?php echo $item["link"]; ?>" />
													<?php sod_generate_image_tag($item["image"]); ?>
													</a>
													<div class="tri-area" data-color="<?php echo $bg_color; ?>"></div>
												</div>
											</div>
										<?php endif; ?>
									</div>

								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php
				$testimonial_title = get_field("testimonial_title");
				$testimonial_bg = get_field("testimonial");

				if (!empty($testimonial_bg)) :
					$ids = $testimonial_bg;
				?>
					<div class="testimonial-section">
						<?php
						echo do_shortcode("[testimonial ids='$ids' title='$testimonial_title']");
						?>
					</div>
				<?php
				endif;
				?>

				<?php
				$ready_to_help = get_field("ready_to_help");


				$title = $ready_to_help["title"] ? $ready_to_help["title"] : "";
				$background = $ready_to_help["background"] ? $ready_to_help["background"] : "";
				$description = $ready_to_help["description"] ? $ready_to_help["description"] : "";
				$button = $ready_to_help["button"] ? $ready_to_help["button"] : "";
				$url = $ready_to_help["url"] ? $ready_to_help["url"] : "";
				if ($title && $description) :
					$button_style = "";
					if (strpos("#", $url) !== 0) {
						$button_style = "data-animate";
					}

				?>
					<div class="read-to-section">
						<div class="container" style="background-image: url(<?php echo $background; ?>);">
							<div class="columns">
								<div class="is-offset-half column">
									<div class="rt-content">
										<h4><?php echo $title; ?></h4>
										<div class="content">
											<?php echo $description; ?>
										</div>
										<div class="button_wrapper">
											<a class="s-btn s-normal s-btn-border-radius" <?php echo $button_style; ?> href="<?php echo $url; ?>"><?php echo $button; ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				endif;
				?>



				<?php

				$section_list = get_field("section_list");
				if ($section_list) {
					foreach ($section_list as $section) :

						$section_title =  $section["section_title"];
						$section_sub_title = $section["section_sub_title"];
						$section_image = $section["section_image"];

						if ($section_title || $section_sub_title || $section_image) {
				?>
							<div data-section class="sections sections-custom-content">
								<div class="container">
									<?php if ($section_title) : ?>
										<h2 class="features-title"><?php echo $section_title; ?></h2>
									<?php endif; ?>
									<?php if ($section_sub_title) : ?>
										<p><?php echo $section_sub_title; ?></p>
									<?php endif; ?>

									<?php if ($section_image) : ?>
										<div class="section-image">
											<?php sod_generate_image_tag($section_image); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
				<?php
						}
					endforeach;
				}
				?>

				<?php
				$featues_title = get_field("features_title");
				$featues = get_field("features");
				if ($featues_title || $featues || count($featues) > 0) :
				?>

					<div data-section="4" class="industry-featues-secton">
						<div class="container">
							<h2 class="features-title"><?php echo $featues_title ? $featues_title : ""; ?></h2>
							<div class="columns is-multiline">
								<?php
								if ($featues) :
									foreach ($featues as $f) :
								?>
										<div class="column is-one-third-tablet">

											<div class="s4-item">
												<div class="icon">
													<?php sod_generate_image_tag($f["icon"]); ?>
												</div>
												<div class="content">
													<h5><?php echo $f["title"]; ?></h5>
													<p><?php echo $f["content"]; ?></p>
												</div>
											</div>

										</div>
								<?php
									endforeach;
								endif;
								?>
							</div>
						</div>
					</div>
					<?php
					$headline =  get_field("boxed_section_headline");

					if ($headline) : ?>
						<div class="container brand_section_title">
							<h2 class="features-title"><?php echo $headline; ?></h2>
						</div>
					<?php endif; ?>
					<?php $boxed_option = get_field("boxed_list_option");
					$boxed_class = $boxed_option ? "boxed_brand container" : "";
					?>
				<?php
				endif;
				$brands = get_field("brand_list");
				if ($brands && count($brands) > 0) : ?>

					<?php

					foreach ($brands as $brand) :
						$bd_image = $brand["brand"];
						$brand_title = $brand["brand_title"];
						$brand_content = $brand["brand_content"];
						$bgcolor = $brand["background_color"];
						$url = $brand["url"];

					?>

						<div data-section class="<?php echo $boxed_class; ?>" style="<?php echo $bgcolor ? "background: $bgcolor;" : ""; ?>">
							<div class="container brand_content">
								<div class="columns is-multiline">
									<div class="column is-one-third-desktop text-center">
										<?php sod_generate_image_tag($bd_image); ?>
									</div>
									<div class="column">
										<h4 class="comercial-title" style="text-align: left;">
											<a href="<?php echo $url; ?>">
												<?php echo $brand_title ? $brand_title : ""; ?>
											</a>
										</h4>
										<p class="comercial-content"><?php echo $brand_content ? $brand_content : ""; ?></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="<?php echo $boxed_class; ?> boxed_last" style="height: 0;"></div>

				<?php endif; ?>

				<?php
				$brands = get_field("second_brand_list");
				if ($brands && count($brands) > 0) : ?>
					<div data-section></div>
					<?php

					foreach ($brands as $brand) :
						$bd_image = $brand["brand"];
						$brand_title = $brand["brand_title"];
						$brand_content = $brand["brand_content"];
						$bgcolor = $brand["background_color"];

					?>

						<div data-section style="<?php echo $bgcolor ? "background: $bgcolor;" : ""; ?>">
							<div class="container brand_content">
								<div class="columns is-multiline">
									<div class="column is-one-third-desktop text-center">
										<?php sod_generate_image_tag($bd_image); ?>
									</div>
									<div class="column">
										<h4 class="comercial-title" style="text-align: left;">
											<?php echo $brand_title ? $brand_title : ""; ?>
										</h4>
										<p><?php echo $brand_content ? $brand_content : ""; ?></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>


				<?php endif; ?>
			<?php
		endwhile; // End of the loop.
			?>

</main><!-- #main -->

<?php
get_footer();
