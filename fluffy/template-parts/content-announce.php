<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 */
global $post;
$author_id = get_the_author_meta( 'ID' );
$post_date = get_the_date( 'd F Y' );
$post_author_id = get_post_field( 'post_author', get_the_ID() );
$firstname = get_the_author_meta( 'first_name',$post_author_id );
$lastname = get_the_author_meta( 'last_name', $post_author_id );


// Get user data by user id
$user = get_userdata( $post_author_id );
$display_name = $user->display_name;
?>

<article id="post-<?php the_ID(); ?>" class="card-list-announce">
	<div class="box-title">
	    <a href="<?php echo get_the_permalink(); ?>">
		    <h3 class="post-title">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="#07147c" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
					<?php the_title(); ?></h3>
        </a>
    </div>
    <div class="box-terms_text">
		<?php   // Get terms for post

		$parents  = get_the_terms( get_the_ID(), 'category' );
		// print_r($parents);

		 foreach ($parents as $value) {
			// echo $value->parent;
			if ($value->parent == '0') {
				echo '<a href="' . get_term_link( $value, 'category') . '" class="'. $value->slug .'">' . $value->name . '</a>';
			}
			else {
				?>
				<style media="screen">
					#post-<?php echo get_the_ID(); ?> .box-terms_text a:first-child {
							display: none;
						}
				</style>
				<?php
				 echo '<a href="' . get_term_link( $value, 'category') . '" class="'. $value->slug .'">' . $value->name . '</a>';
			}
		}


		?>
    </div>
	<div class="box-post_author">
		<div class="meta-post">
			<div class="calendar-box">
				<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
				<span class="day"><?php echo $post_date;?></span>
			</div>
			<div class="box-count">
				<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
				<?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
			</div>
      <div class="box-author">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				<span class="author"><?php echo $display_name; ?></span>
    	</div>
		</div>
	</div>
    <div class="box-btn">
        <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php yp_text( 'รายละเอียด', 'Details' ); ?> <i class="las la-arrow-right"></i></a>
    </div>
</article>
