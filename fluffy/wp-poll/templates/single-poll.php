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

$taxonomy = 'poll_cat';
$tags = 'poll';
?>

	<main id="primary" class="site-main">

 <?php v_page_title(); ?>

		<div class="v-container">
		<?php
		while ( have_posts() ) :
		the_post();
		?>

		<div class="entry-content">
			<div class="<?php if ( !is_elementor() ) { echo 'v-container'; 	} else { echo "no-container"; }?>">

				<div class="main-content">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<div class="single-meta">
						<div class="left-items">
							<div class="post_by">
								<i class="flaticon-account"></i>
								<?php
								$byline = sprintf(
									/* translators: %s: post author. */
									esc_html_x( '%s', 'post author', 'fluffy' ),
									'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
								);

								echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								 ?>
								 <div class="clearfix"></div>
							</div>

							<div class="post_date">
								<div class="icon-date">
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								</div>
								<?php fluffy_posted_on_onlytext(); ?>
							</div>
						</div>
						<div class="right-items">
							<div class="post_views">
								<div class="icon-view">
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
								</div>
								<?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

					<?php if (has_post_thumbnail()): ?>
						<div class="entry-featured-image">
						<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>







					<?php
					/**
					 * Template - Single Poll Content
					 */

					global $poll, $wp_query;

					$poll        = wpp_get_poll();
					$embed_class = $wp_query->get( 'poll_in_embed', false ) ? 'inside-embed' : '';

					/**
					 * Hook: wpp_before_single_poll.
					 */
					do_action( 'wpp_before_single_poll' );

					if ( post_password_required() ) {
						echo get_the_password_form(); // WPCS: XSS ok.

						return;
					}

					?>
					    <div id="poll-<?php the_ID(); ?>" <?php wpp_single_post_class( $embed_class ); ?>>
							<?php
							/**
							 * Before Single poll main content
							 */
							do_action( 'wpp_before_single_poll_main' );


							if ( apply_filters( 'wpp_filters_display_single_poll_main', true ) ) {
								/**
								 * Hook: wpp_single_poll_main
								 *
								 * @hooked wpp_single_poll_title
								 * @hooked wpp_single_poll_thumb
								 * @hooked wpp_single_poll_content
								 * @hooked wpp_single_poll_options
								 * @hooked wpp_single_poll_notice
								 * @hooked wpp_single_poll_message
								 * @hooked wpp_single_poll_buttons
								 */
								do_action( 'wpp_single_poll_main' );
							}


							/**
							 * After Single poll main content
							 */
							do_action( 'wpp_after_single_poll_main' );
							?>
					    </div>

					<?php
					/**
					 * Hook: wpp_after_single_poll
					 */
					do_action( 'wpp_after_single_poll' );
					?>












				</div>

				<div class="single_sidebar">

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- .entry-content -->

	<?php

		endwhile; // End of the loop.
		?>
	</div>

	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
