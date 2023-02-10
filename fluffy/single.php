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

if ($post_type == 'e-book') {
	$taxonomy = 'ebook_category';
	$tags = 'ebook_tags';

}
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

					<?php



					// echo $_COOKIE['vc_postview_count_'.get_the_ID()];

					require('template-parts/single-normal.php'); ?>

					<div class="bottom-related">
						<h3 class="widget-title section-title">
							<?php if ( $post_type == 'e-book' ): ?>
								<?php yp_text('หนังสือที่เกี่ยวข้อง','Related E-books'); ?>
								<?php else: ?>
								<?php yp_text('ข่าวที่เกี่ยวข้อง','Recent Posts'); ?>
							<?php endif; ?>
						</h3>

						<?php

						// echo $post_type;
						// echo $taxonomy;

						// print_r($terms);

								$term_list = wp_get_post_terms(get_the_ID(), $taxonomy, ['fields' => 'all']);
								$primary = get_post_meta(get_the_ID(), '_yoast_wpseo_primary_category',true);

									foreach($term_list as $term) {
										 if( $primary == $term->term_id ) {
												 $term_id = $term->term_id;
										 }
										 else {
											 $terms = wp_get_object_terms( get_queried_object_id(), $taxonomy);
											 $term_id = $terms[0]->term_id;
										 }
									}





						$related_posts[] = get_the_ID();

						$yp_split_company = get_field('yp_split_company');
						$userdata = yp_user_data_api();
						$company_name = $userdata->nameComp;

						if (!empty($yp_split_company) && !empty($company_name) ) {
							$args = array(
						  	'post_type' =>  $post_type,
								'post__not_in' => $related_posts,
								'posts_per_page'  => 3,
								'tax_query' => array(
								'relation' => 'AND',
										array(
												'taxonomy' => $taxonomy, //double check your taxonomy name in you dd
												'field'    => 'id',
												'terms'    => $term_id,
										),
										 array(
												 'taxonomy' => 'company',
												 'field'    => 'name',
												 'terms'    => $company_name,
												 ),
										 ),
							);
						}
						else {
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
						}



						$the_query = new WP_Query( $args );
						?>
						<div class="post-related">
							<div class="v-post-loop">
								<?php
								$no_wow = 1;
								while ( $the_query->have_posts() ) {
										$the_query->the_post();
						        get_template_part( 'template-parts/content-card-post' );
								}
								 ?>
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
						<?php if ( $post_type == 'e-book' ):
								$top_post = vc_top_view(5,'e-book');
							?>
							<?php yp_text('หนังสือยอดนิยม','Related E-books'); ?>
							<?php else:
									$top_post = vc_top_view(5,'post'); ?>
							<?php yp_text('ข่าวยอดนิยม','Related Posts'); ?>
						<?php endif; ?>
					</h3>
					<?php
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 1188;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 1198;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 81052;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 1195;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 1196;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 1194;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 1197;
					// UPDATE `wpdg_vc_post_view` SET `post_type` = 'e-book' WHERE `wpdg_vc_post_view`.`post_id` = 84089;

					// $terms = wp_get_object_terms( get_queried_object_id(), $taxonomy);
					// $term_id = $terms[0]->term_id;


					// print_r($per_posts);
					// $i = 0;
					// foreach ($top_post as $value) {
					// $post_id = $value->post_id;
					// }


					// $args = array(
					// 	'post_type' =>  $post_type,
					// 	'order'	=> 'DESC',
					// 	'meta_key' => 'post_view',
					// 	'orderby' => 'meta_value_num',
					// 	'tax_query' => array(
					// 		array(
					// 				'taxonomy' => $taxonomy, //double check your taxonomy name in you dd
					// 				'field'    => 'id',
					// 				'terms'    => $term_id,
					// 		),
					// 	 ),
					// 	'date_query' => array(
					// 			array(
					// 			'after' => '3 month ago',
					// 			),
					// 	),
					// 	'posts_per_page' => 4
					// );
					// $the_query = new WP_Query( $args );
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
								'posts_per_page' => $per_post
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
								wp_reset_postdata();
								 ?>
							</div>
						</div>
						<?php
					}

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
