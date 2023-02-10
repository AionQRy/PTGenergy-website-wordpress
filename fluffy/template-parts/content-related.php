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
    'posts_per_page' => 3
);
$the_query = new WP_Query( $args );
if ($the_query->have_posts()) {
?>

<div class="post-related">
          <h2 class="fluffy-title">Related Posts</h2>
            <div class="v-post-loop -card">
              <?php
              while ( $the_query->have_posts() ) {
                  $the_query->the_post();
                  get_template_part( 'template-parts/content', 'card' );
              }
               ?>
            </div>
</div>
<?php
} 	wp_reset_postdata();
?>
