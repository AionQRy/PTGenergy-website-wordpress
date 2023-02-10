<?php
global $wp_query;
$current_user_id = get_current_user_id();
$args = array(
'post_type'      => 'vc_request_content',
'posts_per_page'  => -1,
'orderby' => 'date',
'meta_key'		=> 'reuser_id',
'meta_value'	=> $current_user_id,
'order' => 'DESC'
);
query_posts( $args );
$i = 0;
if ( have_posts() ) : while ( have_posts() ) : the_post();
$i++;
?>
<div class="col-lg-4 col-md-6 mb-4 kanit-font item-request">
  <div class="card">
    <div class="card-body p-3">
      <div class="d-flex mt-n2">
        <div class="avatar avatar-xl bg-gradient-dark border-radius-xl p-2 mt-n4">
          <span><?php echo $i; ?></span>
        </div>
        <div class="ms-3 my-autox">
          <a href="<?php the_permalink(); ?>">
             <h6 class="mb-0"><?php the_title(); ?></h6>
          </a>
        </div>
        <div class="ms-auto">
          <div class="dropdown">
            <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-ellipsis-v text-lg"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink">
            <a href="<?php the_permalink(); ?>" class="dropdown-item">ดูรายละเอียด</a>
            </div>
          </div>
        </div>
      </div>
      <p class="text-sm mt-3 reObj">
        <?php echo get_field('reObj'); ?>
      </p>
      <hr class="horizontal dark">
      <div class="row">
        <div class="col-6">
          <h6 class="text-sm mb-0 cate-text">
            <?php echo get_field('reStatus')['label']; ?>
          </h6>
          <p class="text-secondary text-sm font-weight-normal mb-0">สถานะ</p>
        </div>
        <div class="col-6 text-end">
          <h6 class="text-sm mb-0"><?php echo get_the_date(); ?></h6>
          <p class="text-secondary text-sm font-weight-normal mb-0">วันที่ส่งคำร้อง</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php else: ?>
<p class="complaint_not_found">ยังไม่มีข้อมูล</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
