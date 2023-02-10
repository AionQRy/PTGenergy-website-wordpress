<?php
/**
 * Template name: Employees List
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

header_fuc();

global $wpdb;
$prefix = $wpdb->prefix;
$prefix = str_replace("_".get_current_blog_id(),"",$prefix);
$table_company = "{$prefix}vc_company";
$table_department = "{$prefix}vc_department";
$table_section = "{$prefix}vc_section";
$table_division = "{$prefix}vc_division";
$table_subdivision = "{$prefix}vc_subdivision";

$all_company = $wpdb->get_results( "SELECT * FROM $table_company");
$all_department = $wpdb->get_results( "SELECT * FROM $table_department");
$all_section = $wpdb->get_results( "SELECT * FROM $table_section");
$all_division = $wpdb->get_results( "SELECT * FROM $table_division");
$all_subdivision = $wpdb->get_results( "SELECT * FROM $table_subdivision");

$table_user = "{$prefix}usermeta";
$table_userall = "{$prefix}users";
?>
<style media="screen">
/* .hide-o{
	opacity: 0;
	pointer-events: none;
} */
#page .loading.bottom {
	display: none!important;
}

.loading-btn img {
    width: 18px;
    margin-bottom: -4px;
    filter: brightness(500%);
}
.vc_load_more button {
    display: inline-flex;
    flex-wrap: wrap;
		align-items: center;
    gap: 10px;
}
.vc_load_more button:hover .loading-btn img{
	  filter: brightness(1%);
}
.loading.bottom img {
    position: absolute;
    bottom: 290px;
    margin-top: 0!important;
}
.search-filter-wrap .input-wrap select,
.search-filter-wrap .input-wrap.search input {
	color: #222;
	min-width: auto!important;
	width: 100%!important;
	font-size: 14px;
}
.employ-result p {
	text-align: center;
    font-size: 16px;
    margin-top: 50px;
    color: #000;
}
.select2-container--default .select2-search--dropdown .select2-search__field {
    font-size: 16px;
    padding: 8px 10px;
}
#primary {
    background: #fefefe!important;
    overflow: hidden;
}
.wrap-employ{
	position: relative;
}
.loading {
    margin-top: 10px;
    position: absolute;
    z-index: 1;
    background: #fefefe;
    width: calc(100% + 10px);
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: start;
    z-index: 10;
    left: -5px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
	font-size: 14px;
}
.yp-disable {
    pointer-events: none;
}
.search-filter-wrap {
    max-width: 100%;
}
.search-filter-wrap .input-wrap {
    width: 100%;
}
.search-filter-wrap .wrap-in {
    max-width: 260px!important;
}
.select2-container {
    max-width: 260px!important;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #dbdbdb;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 400;
    padding: 5px 35px 5px 15px;
    height: 40px;
    color: #979797;
    text-align: left;
    margin: 0;
    position: relative;
    width: 100%;
    display: block;
    appearance: none;
    -webkit-appearance: none;
}

.search-filter-wrap .input-wrap .wrap-in.select::after,
.select2-container {
    z-index: 11!important;
	}

	@media (max-width:767px) {
		.search-filter-wrap .wrap-in,.select2-container {
    max-width: 100%!important;
		}
		.search-filter-wrap {
    max-width: 100%;
			}
			.input-wrap.blank {
		  display: none;
		}
		.wrap-employ .search-filter-wrap .submit_data {
    margin-top: 15px;
    width: 100%;
    max-width: 100%;
    min-height: 42px;
}
	}


</style>

<?php

// $department_list = $wpdb->get_results( "SELECT * FROM $table_department WHERE codComp = '101000000000000000000' GROUP BY departmentCode");
// $json_wrap = array();
// $json_data = array();
//
//
// foreach ($department_list as $value) {
//
// $json_data[] = array(
// 		'id' => $value->departmentCode,
// 		'text' => $value->departmentName,
// 	);
//
// }
//
// $json_data_blank[] = array(
// 	'id' => "",
// 	'text' => "- ฝ่ายทั้งหมด -",
// 	);
//
// $json_wrap[""] = $json_data_blank;
//
//
// $json_wrap['101000000000000000000'] = $json_data;
//
// $json_wrap = json_encode($json_wrap);

 ?>
	<main id="primary" class="site-main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (!is_front_page() && !is_elementor()): ?>
		  <?php v_page_title(); ?>
			<?php endif; ?>
		<div class="page wrap-bg<?php if ( is_elementor() ) { echo 'e'; } ?>">
			<div class="entry-content">
				<div class="<?php if ( !is_elementor() ) { echo 'v-container'; 	} else { echo "no-container"; } ?>">

					<div class="wrap-employ">

				<form class="yp-filter-form" enctype="multipart/form-data" action="" method="post">
						<div class="search-filter-wrap">
								<div class="v-row -h">
										<div class="input-wrap search">
												<label for="search_name">ค้นหา</label>
												<div class="wrap-in">
													<input type="text" name="search_name" placeholder="ค้นหา..." id="search_name">
												</div>
										</div>
										<div class="input-wrap company">
													<label for="company_filter">บริษัท</label>
													<div class="wrap-in select">
														<select required class="yp-filter" name="company_filter" id="company_filter">
															<option value="">- บริษัททั้งหมด -</option>
															<?php foreach ($all_company as $value): ?>
																<option value="<?php echo $value->codComp; ?>"><?php echo $value->nameComp; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
										</div>
										<div class="input-wrap depart yp-disable">
											<label for="company_depart">ฝ่าย</label>
											<div class="wrap-in select">
												<select required class="yp-filter" name="company_depart" id="company_depart">
													  <option value="">- ฝ่ายทั้งหมด -</option>
												</select>
											</div>
										</div>
										<div class="input-wrap section yp-disable">
											<label for="section">ส่วน</label>
											<div class="wrap-in select">
												<select class="yp-filter" name="section" id="section">
														<option value="">- ส่วนทั้งหมด -</option>
												</select>
											</div>
										</div>
								</div>
								<div class="v-row -h">


										<div class="input-wrap division yp-disable">
											<label for="division">แผนก</label>
											<div class="wrap-in select">
												<select class="yp-filter" name="division" id="division">
														<option value="">- แผนกทั้งหมด -</option>
												</select>
											</div>
										</div>

										<div class="input-wrap subdivision yp-disable">
											<label for="subdivision">สาขา/หน่วยงาน</label>
											<div class="wrap-in select">
												<select class="yp-filter" name="subdivision" id="subdivision">
														<option value="">- สาขา/หน่วยงานทั้งหมด -</option>
												</select>
											</div>
										</div>

										<div class="input-wrap sort">
													<label for="sort_filter">การเรียงลำดับ</label>
													<div class="wrap-in select">
														<select class="yp-filter" name="sort_filter" id="sort_filter">
															<option value="DESC">จากมากไปน้อย</option>
															<option value="ASC">จากน้อยไปมาก</option>
														</select>
													</div>
										</div>



										<div class="input-wrap blank yp-disable" style="opacity:0;">
													<label for="sort_filter">การเรียงลำดับ</label>
													<div class="wrap-in select">
														<select class="yp-filter" name="blank" id="blank">
															<option value="DESC">จากใหม่ไปเก่า</option>
															<option value="ASC">จากเก่าไปใหม่</option>
														</select>
													</div>
										</div>


								</div>

								<button type="submit" class="submit_data">ค้นหา</button>
						</div>
					</form>
						<!-- end search -->


						<div class="loading hide">
							<img src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/loader.gif" alt="loading">
						</div>
						<div class="employ-result"></div>

						<div class="vc_load_more hide">
						  <button type="button" id="btn_more" per-data="8">
								<div class="t">
									โหลดเพิ่มเติม
								</div>
								<div class="loading-btn hide">
									<img src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/loader.gif" alt="loading">
								</div>
							</button>
						</div>


					</div>

				</div>
			</div><!-- .entry-content -->
		</div>
		</article><!-- #post-<?php the_ID(); ?> -->

	</main><!-- #main -->

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.yp-filter-form').submit(function(e) {
		 e.preventDefault();
			$('.loading').removeClass('hide');
			$('.employ-result').addClass('hide-o');

		 var submit_data = jQuery(this).serialize();
		 // console.log(submit_data);
		 var per_data = $('#btn_more').attr('per-data');
		 per_data = parseInt(per_data);

		 $('#btn_more').attr('per-data',per_data);

		 // console.log(submit_data);
		 var data = {
			load_more: per_data,
			form_data: submit_data,
			action: 'employ_filter_action'
		};

		jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: data,
				success: function (code) {
							 $('.loading').addClass('hide');
							 // $('.loading').removeClass('bottom');

							$('.vc_load_more').removeClass('hide');
							$('.employ-result').removeClass('hide-o');
							 $('.employ-result').html(code);
					// console.log(code);

				},
				dataType: 'html'
		 });


	});


	$('.vc_load_more').click(function(e) {

		e.preventDefault();
		 $('.loading-btn').removeClass('hide');
		 // $('.employ-result').removeClass('hide');
		 $('.loading').addClass('bottom');

		 var per_data = $('#btn_more').attr('per-data');
		 per_data = parseInt(per_data);

		 var new_per = per_data+8;
		 $('#btn_more').attr('per-data',new_per);

		 var submit_data = $('.yp-filter-form').submit().serialize();


		 // console.log(submit_data);
		 var data = {
			load_more: new_per,
			form_data: submit_data,
			action: 'employ_filter_action'
		};


		 jQuery.ajax({
				 type: 'POST',
				 url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				 data: data,
				 success: function (code) {

								$('.loading-btn').addClass('hide');
								$('.loading').removeClass('bottom');
							  // $('.employ-result').removeClass('hide');
								$('.employ-result').html(code);
					 // console.log(code);
				 },
				 dataType: 'html'
			});

	});


  $('#company_filter').select2().on('change', function() {
	$("#company_depart").val(null).trigger("change");
	$('#company_depart').html('').select2({data: [{id: '', text: '- ฝ่ายทั้งหมด -'}]});

	$("#section").val(null).trigger("change");
	$('#section').html('').select2({data: [{id: '', text: '- ส่วนทั้งหมด -'}]});
	$('#division').html('').select2({data: [{id: '', text: '- แผนกทั้งหมด -'}]});
	$('#subdivision').html('').select2({data: [{id: '', text: '- สาขา/หน่วยงานทั้งหมด -'}]});

	$('.input-wrap.depart,.input-wrap.section,.input-wrap.division,.input-wrap.subdivision').addClass('yp-disable');


/////
	var data_val = $(this).val();
	if (data_val != '') {
		$('#company_depart').html('').select2({data: [{id: '', text: 'loading...'}]});
	}

		var data = {
		 select_depart: data_val,
		 action: 'vselect_data_action'
	 };

	jQuery.ajax({
			type: 'POST',
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			data: data,
			success: function (code) {
				if (code) {
					var data_json = JSON.parse(code);
					$('#company_depart').html('').select2({data: [{id: '', text: '- ฝ่ายทั้งหมด -'}]});
					$('#company_depart').select2({
				 	 data:data_json[data_val]
				  });
					if (data_val != '') {
						$('.input-wrap.depart').removeClass('yp-disable');
					}
					else {
						$('.input-wrap.depart').addClass('yp-disable');
					}
				}
			}
	 });
//////


}).trigger('change');



$('#company_depart').on('select2:select', function (e) {

	$("#section").val(null).trigger("change");
	$('#section').html('').select2({data: [{id: '', text: '- ส่วนทั้งหมด -'}]});

	/////
	var data_val = $(this).val();
		if (data_val != '') {
			$('#section').html('').select2({data: [{id: '', text: 'loading...'}]});
		}

			var data = {
			 select_section: data_val,
			 action: 'vselect_data_action'
		 };

		jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: data,
				success: function (code) {
					if (code) {
						var data_json = JSON.parse(code);
						$('#section').html('').select2({data: [{id: '', text: '- ส่วนทั้งหมด -'}]});
						$('#section').select2({
					 	 data:data_json[data_val]
					  });
						if (data_val != '') {
							$('.input-wrap.section').removeClass('yp-disable');
						}
						else {
							$('.input-wrap.section').addClass('yp-disable');
						}
					}
				}
		 });

});
/////////

$('#section').on('select2:select', function (e) {

	$("#division").val(null).trigger("change");
	$('#division').html('').select2({data: [{id: '', text: '- แผนกทั้งหมด -'}]});

	/////
	var data_val = $(this).val();
		if (data_val != '') {
			$('#division').html('').select2({data: [{id: '', text: 'loading...'}]});
		}

			var data = {
			 select_division: data_val,
			 action: 'vselect_data_action'
		 };

		jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: data,
				success: function (code) {
					if (code) {
						var data_json = JSON.parse(code);
						console.log(data_json);
						$('#division').html('').select2({data: [{id: '', text: '- แผนกทั้งหมด -'}]});
						$('#division').select2({
					 	 data:data_json[data_val]
					  });
						if (data_val != '') {
							$('.input-wrap.division').removeClass('yp-disable');
						}
						else {
							$('.input-wrap.division').addClass('yp-disable');
						}
					}
				}
		 });

});
/////////


$('#division').on('select2:select', function (e) {

	$("#subdivision").val(null).trigger("change");
	$('#subdivision').html('').select2({data: [{id: '', text: '- สาขา/หน่วยงานทั้งหมด -'}]});

	var data_val = $(this).val();
		if (data_val != '') {
			$('#subdivision').html('').select2({data: [{id: '', text: 'loading...'}]});
		}

			var data = {
			 select_subdivision: data_val,
			 action: 'vselect_data_action'
		 };

		jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: data,
				success: function (code) {
					if (code) {
						var data_json = JSON.parse(code);
						console.log(data_json);
						$('#subdivision').html('').select2({data: [{id: '', text: '- สาขา/หน่วยงานทั้งหมด -'}]});
						$('#subdivision').select2({
					 	 data:data_json[data_val]
					  });
						if (data_val != '') {
							$('.input-wrap.subdivision').removeClass('yp-disable');
						}
						else {
							$('.input-wrap.subdivision').addClass('yp-disable');
						}
					}
				}
		 });

});


/////
		$('#search_name').keyup(function(event) {
			var chk = $(this).val();
			if (chk != '') {
				$('#company_depart,#company_filter').removeAttr('required');
			}
			else {
				$('#company_depart,#company_filter').attr('required','required');
			}
		});

});

</script>


<?php
// get_sidebar();
footer_fuc();
