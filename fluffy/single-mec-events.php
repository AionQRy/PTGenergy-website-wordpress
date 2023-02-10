<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fluffy
 */

header_fuc();
global $post;

$post_type = get_post_type( get_the_ID() );
$taxonomy = 'category';
$tags = 'post_tag';
?>

	<main id="primary" class="site-main">

<div class="wrap-bg">

		<div class="v-container">
		<?php
		while ( have_posts() ) :
		the_post();
		?>

		<div class="entry-content">
			<div class="<?php if ( !is_elementor() ) { echo 'v-container'; 	} else { echo "no-container"; }?>">

				<div class="main-content">
					<?php require('template-parts/single-normal.php'); ?>

					<div class="bottom-related">
						<h3 class="widget-title section-title">
								<?php yp_text('กิจกรรมที่เกี่ยวข้อง','Recent Posts'); ?>
						</h3>

						<?php
						$terms = wp_get_object_terms( get_queried_object_id(), $taxonomy);
						$term_id = $terms[0]->term_id;

						$related_posts[] = get_the_ID();
						$args = array(
								'post_type' =>  $post_type,
								'post__not_in' => $related_posts,
								// 'category__in' => wp_get_post_categories(get_the_ID()),
								'tax_query' => array(
									array(
											'taxonomy' => $taxonomy, //double check your taxonomy name in you dd
											'field'    => 'id',
											'terms'    => $term_id,
									),
								 ),
								'posts_per_page' =>	3
						);
						$the_query = new WP_Query( $args );

						?>
						<div class="post-related">
							<div class="v-post-loop">
								<?php
								$no_wow = 1;
								if ($the_query->have_posts()) {
									while ( $the_query->have_posts() ) {
											$the_query->the_post();
							        get_template_part( 'template-parts/content-card-post' );
									}
								}
								else { ?>
									<style media="screen">
										.bottom-related h3{
											display: none;
										}
									</style>
							 <?php } wp_reset_postdata(); ?>
							</div>
						</div>
					</div>

				</div>


				<?php
				$style_theme = 'list-s2';
				$Sassy_Social_Share = '[Sassy_Social_Share]';
				 ?>
				<div class="single_sidebar style-<?php echo $style_theme; ?>">

					<h3 class="widget-title section-title">
					กิจกรรมยอดนิยม
					</h3>
					<?php
					$terms = wp_get_object_terms( get_queried_object_id(), $taxonomy);
					$term_id = $terms[0]->term_id;

					$top_post = vc_top_view(5,'mec-events');

					$related_posts[] = get_the_ID();

					if (!empty($top_post)) {
					foreach ($top_post as $value) {
							$post_id = $value->post_id;
					?>
					<div class="post-related">
						<div class="v-post-loop -list">
							<?php
									require( 'template-parts/content-list-view.php' );
							 ?>
						</div>
					</div>
					<?php
				} // loop
				}
					else {
						$args = array(
								'post_type' =>  $post_type,
								'orderby' => 'rand',
								'posts_per_page' => 4
						);
						$the_query = new WP_Query( $args );
						?>
						<div class="post-related">
							<div class="v-post-loop -list">
								<?php
								while ( $the_query->have_posts() ) {
										$the_query->the_post();
							        get_template_part( 'template-parts/content-list' );
								}
								 ?>
							</div>
						</div>
						<?php
					}
						wp_reset_postdata();
					?>





				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- .entry-content -->

	<?php

		endwhile; // End of the loop.
		?>
	</div>
</div>

	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
