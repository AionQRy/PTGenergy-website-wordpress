<?php
/**
 * fluffy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fluffy
 */

 function yp_thai_year($date){
   $reDate_start = $date;
   $reDate_start = explode("/",$reDate_start);
   $reDate_start = $reDate_start[0].'/'.$reDate_start[1].'/'.$reDate_start[2]+543;
   return $reDate_start;
 }

add_filter('body_class','role_class_names');
function role_class_names($classes) {
  $user_roles = get_users(
      array(
          'blog_id' => 1,
          'search'  => get_current_user_id()
      ));

    $classes[] = 'role-'.$user_roles[0]->roles[0];
    return $classes;
}

add_action("wp_ajax_vselect_data_action", "vselect_data");
add_action("wp_ajax_nopriv_vselect_data_action", "vselect_data");

function vselect_data(){

    if ( !empty($_POST['select_depart']) ) {

      global $wpdb;
      $prefix = $wpdb->prefix;
      $prefix = str_replace("_".get_current_blog_id(),"",$prefix);
      // $table_company = "{$prefix}vc_company";
      $table_name = "{$prefix}vc_department";
      // $table_section = "{$prefix}vc_section";
      // $table_division = "{$prefix}vc_division";
      // $table_subdivision = "{$prefix}vc_subdivision";

      $list = $wpdb->get_results( "SELECT * FROM $table_name WHERE codComp = '".$_POST['select_depart']."' GROUP BY departmentCode");
      $json_wrap = array();
      $json_data = array();
      foreach ($list as $value) {
      $json_data[] = array(
      		'id' => $value->departmentCode,
      		'text' => $value->departmentName
      	);

      }
      $json_data_blank[] = array(
      	'id' => "",
      	'text' => "- ฝ่ายทั้งหมด -"
      	);

      $json_wrap[""] = $json_data_blank;
      $json_wrap[$_POST['select_depart']] = $json_data;
      $json_wrap = json_encode($json_wrap);
      print_r($json_wrap);

    }

    ////////////////
    if ( !empty($_POST['select_section']) ) {
      global $wpdb;
      $prefix = $wpdb->prefix;
      $prefix = str_replace("_".get_current_blog_id(),"",$prefix);
      $table_name = "{$prefix}vc_section";

      $list = $wpdb->get_results( "SELECT * FROM $table_name WHERE departmentCode = '".$_POST['select_section']."' GROUP BY sectionCode");

      $json_wrap = array();
      $json_data = array();
      foreach ($list as $value) {
      $json_data[] = array(
          'id' => $value->sectionCode,
          'text' => $value->sectionName
        );

      }
      $json_data_blank[] = array(
        'id' => "",
        'text' => "- ส่วนทั้งหมด -"
        );

      $json_wrap[""] = $json_data_blank;
      $json_wrap[$_POST['select_section']] = $json_data;
      $json_wrap = json_encode($json_wrap);
      print_r($json_wrap);
    }

    ////////////////
    if ( !empty($_POST['select_division']) ) {
      global $wpdb;
      $prefix = $wpdb->prefix;
      $prefix = str_replace("_".get_current_blog_id(),"",$prefix);
      $table_name = "{$prefix}vc_division";

      $list = $wpdb->get_results( "SELECT * FROM $table_name WHERE sectionCode = '".$_POST['select_division']."' GROUP BY divisionCode");

      $json_wrap = array();
      $json_data = array();
      foreach ($list as $value) {
      $json_data[] = array(
          'id' => $value->divisionCode,
          'text' => $value->divisionName
        );

      }
      $json_data_blank[] = array(
        'id' => "",
        'text' => "- แผนกทั้งหมด -"
        );

      $json_wrap[""] = $json_data_blank;
      $json_wrap[$_POST['select_division']] = $json_data;
      $json_wrap = json_encode($json_wrap);
      print_r($json_wrap);
    }
    ////////////////
    if ( !empty($_POST['select_subdivision']) ) {
      global $wpdb;
      $prefix = $wpdb->prefix;
      $prefix = str_replace("_".get_current_blog_id(),"",$prefix);
      $table_name = "{$prefix}vc_subdivision";

      $list = $wpdb->get_results( "SELECT * FROM $table_name WHERE divisionCode = '".$_POST['select_subdivision']."' GROUP BY subDivisionCode");

      $json_wrap = array();
      $json_data = array();
      foreach ($list as $value) {
      $json_data[] = array(
          'id' => $value->subDivisionCode,
          'text' => $value->subDivisionName
        );

      }
      $json_data_blank[] = array(
        'id' => "",
        'text' => "- สาขาทั้งหมด -"
        );

      $json_wrap[""] = $json_data_blank;
      $json_wrap[$_POST['select_subdivision']] = $json_data;
      $json_wrap = json_encode($json_wrap);
      print_r($json_wrap);
    }

  die();
}







add_action("wp_ajax_employ_filter_action", "employ_filter");
add_action("wp_ajax_nopriv_employ_filter_action", "employ_filter");

function employ_filter(){
  ob_start();

  if (!empty($_POST['form_data'])) {

    parse_str($_POST['form_data'], $form_data);
    $search_name = $form_data['search_name'];
    $company_filter = $form_data['company_filter'];
    $company_depart = $form_data['company_depart'];
    $section = $form_data['section'];
    $division = $form_data['division'];
    $subdivision = $form_data['subdivision'];


    $sort_filter = $form_data['sort_filter'];

    if (!empty($company_filter)) {
      $WHERE_COMPANY = "WHERE codComp LIKE '".$company_filter."%'";
    }

    if (!empty($search_name) && !empty($company_filter)) {
      $WHERE_COMPANY_S = "AND nameEmpT LIKE '%".$search_name."%' AND codComp LIKE '".$company_filter."%'";
    }

    if (!empty($search_name) && empty($company_filter)) {
      $WHERE_COMPANY_S = "WHERE nameEmpT LIKE '%".$search_name."%'";
    }

    if (!empty($company_depart)) {
      $WHERE_DEPART = "AND departmentCode LIKE '".$company_depart."%'";
    }

    if (!empty($section)) {
      $WHERE_SECTION = "AND sectionCode LIKE '".$section."%'";
    }

    if (!empty($division)) {
      $WHERE_DEVISION = "AND divisionCode LIKE '".$division."%'";
    }

    if (!empty($subdivision)) {
      $WHERE_SUBDEVISION = "AND subdivisionCode LIKE '".$subdivision."%'";
    }

    if (!empty($sort_filter)) {
      // $orderby = "ORDER BY numLvl $sort_filter, dteEmpMt";
            $orderby = "ORDER BY numLvl $sort_filter";
    }


    $WHERE = "$WHERE_COMPANY $WHERE_COMPANY_S $WHERE_DEPART $WHERE_SECTION $WHERE_DEVISION $WHERE_SUBDEVISION";


    global $wpdb;

    if (!empty($_POST['load_more'])) {
      $limit = $_POST['load_more'];
    }
    else {
      $limit = 8;
    }

    $table_name = "{$wpdb->prefix}vc_pt_user";
    $table_name = str_replace("_".get_current_blog_id(),"",$table_name);
    $all_user_com = $wpdb->get_results( "SELECT * FROM $table_name $WHERE $orderby LIMIT $limit");
    // $test = "SELECT * FROM $table_name $WHERE $orderby LIMIT $limit";
    // echo $test;
    $count_item = count($all_user_com);
    if ($limit > $count_item) {
      $hide_btn = 1;
    }

       if (!empty($all_user_com)) {
         require_once('employ-content.php');
       }
       else {
        ?>
        <style media="screen">
          .vc_load_more{
            display: none!important;
          }
        </style>
        <p>ไม่พบข้อมูล</p>
        <?php
       }

    }
    die();
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}


add_filter ( 'auth_cookie_expiration', 'wpdev_login_session' );

function wpdev_login_session( $expire ) { // Set login session limit in seconds
    // return YEAR_IN_SECONDS;
    // return MONTH_IN_SECONDS;
    return 7948800;
    // 3 month
    // return HOUR_IN_SECONDS;
}

// add_filter('wpmu_validate_user_signup', 'skip_email_exist');
// function skip_email_exist($result){
//     if(isset($result['errors']->errors['user_email']) && ($key = array_search(__('Sorry, that email address is already used!'), $result['errors']->errors['user_email'])) !== false) {
//         unset($result['errors']->errors['user_email'][$key]);
//         if (empty($result['errors']->errors['user_email'])) unset($result['errors']->errors['user_email']);
//     }
//     define( 'WP_IMPORTING', 'SKIP_EMAIL_EXIST' );
//     return $result;
// }

function my_login_logo() {
  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  ?>
    <style type="text/css">
    .login #nav{
      display: none;
    }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $image[0]; ?>);
		height:65px;
		width:320px;
		background-size: contain;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
          outline: none!important;
        }

  #login .button-primary {
    background: #00ab4e;
    border-color: #00ab4e;
  }
  #login .button-primary.focus,
    #login .button-primary.hover,
  #login .button-primary:focus,
  #login .button-primary:hover {
    background: #00ab4e;
    border-color: #00ab4e;
    color: #fff;
}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


add_filter( 'wpmu_validate_user_signup', 'yp_short_user_names' );

function yp_short_user_names( $result )
{

  $error_name = $result[ 'errors' ]->get_error_message( 'user_name' );
     if ( empty ( $error_name )
         or $error_name !== __( 'Sorry, usernames must have letters too!' )
     )
     {
         return $result;
     }

     unset ( $result[ 'errors' ]->errors[ 'user_name' ] );

    return $result;

}


function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
    return '»';
};

// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);

function my_profile_menu(){
  if (is_user_logged_in()) {
     $wp_logout .= '<li><a href="'. wp_logout_url() .'"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg><span>'. __("Log Out") .'</span></a></li>';
  }
  $author_info = wp_get_current_user();
  if (is_user_logged_in()) {
    $url_redirect = get_home_url().'/my-profile';
      $text = "มุมมองส่วนตัว";
  }
  else {
    $url_redirect = get_home_url().'/login';
    $text = "เข้าสู่ระบบ สมาชิก";
  }
  ?>
  <div class="wrap-my-profile desktop_menu">
    <a href="<?php echo $url_redirect; ?>" class="my-profile">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M17.7541 14.0002C18.9961 14.0002 20.0029 15.007 20.0029 16.2491V16.8245C20.0029 17.7188 19.6833 18.5836 19.1018 19.263C17.5324 21.0965 15.1453 22.0013 11.9999 22.0013C8.85401 22.0013 6.468 21.0962 4.9017 19.2619C4.32194 18.583 4.00342 17.7195 4.00342 16.8267V16.2491C4.00342 15.007 5.01027 14.0002 6.25229 14.0002H17.7541ZM17.7541 15.5002H6.25229C5.8387 15.5002 5.50342 15.8355 5.50342 16.2491V16.8267C5.50342 17.3624 5.69453 17.8805 6.04239 18.2878C7.29569 19.7555 9.26157 20.5013 11.9999 20.5013C14.7382 20.5013 16.7058 19.7555 17.9623 18.2876C18.3112 17.8799 18.5029 17.361 18.5029 16.8245V16.2491C18.5029 15.8355 18.1676 15.5002 17.7541 15.5002ZM11.9999 2.00488C14.7613 2.00488 16.9999 4.24346 16.9999 7.00488C16.9999 9.76631 14.7613 12.0049 11.9999 12.0049C9.23845 12.0049 6.99988 9.76631 6.99988 7.00488C6.99988 4.24346 9.23845 2.00488 11.9999 2.00488ZM11.9999 3.50488C10.0669 3.50488 8.49988 5.07189 8.49988 7.00488C8.49988 8.93788 10.0669 10.5049 11.9999 10.5049C13.9329 10.5049 15.4999 8.93788 15.4999 7.00488C15.4999 5.07189 13.9329 3.50488 11.9999 3.50488Z" fill="white"/>
        </svg>
        <span><?php echo $text; ?></span>
    </a>
    <ul class="my_profile_menu">
      <li>
        <a href="<?php echo $url_redirect; ?>">
          <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          <span>ข้อมูลผู้ใช้งาน</span>
        </a>
      </li>
        <li>
          <a href="<?php echo home_url('/request-contents'); ?>">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
           <span>จัดการคำร้องประกาศ</span>
          </a>
        </li>
      <?php echo $wp_logout; ?>
    </ul>
  </div>

  <?php
}


///////////////////////////////
 function show_menu_item_svg( $title, $item ) {
	if( is_object( $item ) && isset( $item->ID ) ) {
		$menu_item_svg = get_post_meta( $item->ID, '_menu_item_svg', true );
		if ( ! empty( $menu_item_svg ) ) {
			$title .= '<div class="menu-item-svg">' . $menu_item_svg . '</div>';
		}
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'show_menu_item_svg', 10, 2 );

 function menu_item_svg( $item_id, $item ) {
 	$menu_item_svg = get_post_meta( $item_id, '_menu_item_svg', true );
 	?>
 	<div style="clear: both;">
 	    <span class="description"><?php _e( "SVG Code", 'menu-item-desc' ); ?></span><br />
 	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
 	    <div class="logged-input-holder">
 	        <textarea style="width:100%;" name="menu_item_svg[<?php echo $item_id ;?>]" id="menu-item-desc-<?php echo $item_id ;?>"><?php echo esc_attr( $menu_item_svg ); ?></textarea>
 	    </div>
 	</div>
 	<?php
 }
 add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_svg', 10, 2 );

 function save_menu_item_svg( $menu_id, $menu_item_db_id ) {
 	if ( isset( $_POST['menu_item_svg'][$menu_item_db_id]  ) ) {
 		$sanitized_data = $_POST['menu_item_svg'][$menu_item_db_id];
 		update_post_meta( $menu_item_db_id, '_menu_item_svg', $sanitized_data );
 	} else {
 		delete_post_meta( $menu_item_db_id, '_menu_item_svg' );
 	}
 }
 add_action( 'wp_update_nav_menu_item', 'save_menu_item_svg', 10, 2 );




///////////////////////////////////
 function add_specific_menu_location_atts( $atts, $item, $args ) {
     // check if the item is in the primary menu
     if( is_object( $item ) && isset( $item->ID ) ) {
        $menu_item_company = get_post_meta( $item->ID, '_menu_item_company', true );
       // add the desired attributes:
       if ( ! empty( $menu_item_company ) ) {
         $userdata = yp_user_data_api();
         $company_name = $userdata->nameComp;

         $term = get_term_by('name', $company_name, 'company');
         $atts['class'] = 'select-company-'.$item->ID;
         ?>
         <?php if (!empty($term)): ?>
           <script type="text/javascript">
             jQuery(document).ready(function($) {
               var old_href = $('.select-company-<?php echo $item->ID; ?>').attr('href');
               if (old_href.includes('_sft_company')) {
                 var new__href = old_href;
               }
               else {
                 var new__href = old_href+'?_sft_company=<?php echo $term->slug; ?>';
               }

                $('.select-company-<?php echo $item->ID; ?>').attr('href',new__href);
             });
           </script>
         <?php endif; ?>
         <?php
         }
     }
     return $atts;
 }
 add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );


 function menu_item_company( $item_id, $item ) {
  $menu_item_company = get_post_meta( $item_id, '_menu_item_company', true );
  ?>
  <div style="clear: both;">
      <span class="description"><?php _e( "แยกบริษัท", 'menu-item-desc' ); ?></span><br />
      <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
      <div class="logged-input-holder">
          <input type="checkbox" name="menu_item_company[<?php echo $item_id ;?>]" id="menu-item-desc-<?php echo $item_id ;?>" <?php if ($menu_item_company): echo "checked"; endif; ?> value="1">
      </div>
  </div>
  <?php
 }
 add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_company', 10, 2 );

 function save_menu_item_company( $menu_id, $menu_item_db_id ) {
  if ( isset( $_POST['menu_item_company'][$menu_item_db_id]  ) ) {
    $sanitized_data = $_POST['menu_item_company'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_company', $sanitized_data );
  } else {
    delete_post_meta( $menu_item_db_id, '_menu_item_company' );
  }
 }
 add_action( 'wp_update_nav_menu_item', 'save_menu_item_company', 10, 2 );
///////////////////////////////////





 function yp_upload_from_url( $url, $title = null ) {
 	require_once( ABSPATH . "/wp-load.php");
 	require_once( ABSPATH . "/wp-admin/includes/image.php");
 	require_once( ABSPATH . "/wp-admin/includes/file.php");
 	require_once( ABSPATH . "/wp-admin/includes/media.php");

 	// Download url to a temp file
 	$tmp = download_url( $url );
 	if ( is_wp_error( $tmp ) ) return false;

 	// Get the filename and extension ("photo.png" => "photo", "png")
 	$filename = pathinfo($url, PATHINFO_FILENAME);
 	$extension = pathinfo($url, PATHINFO_EXTENSION);

 	// An extension is required or else WordPress will reject the upload
 	if ( ! $extension ) {
 		// Look up mime type, example: "/photo.png" -> "image/png"
 		$mime = mime_content_type( $tmp );
 		$mime = is_string($mime) ? sanitize_mime_type( $mime ) : false;

 		// Only allow certain mime types because mime types do not always end in a valid extension (see the .doc example below)
 		$mime_extensions = array(
 			// mime_type         => extension (no period)
 			'text/plain'         => 'txt',
 			'text/csv'           => 'csv',
 			'application/msword' => 'doc',
 			'image/jpg'          => 'jpg',
 			'image/jpeg'         => 'jpeg',
 			'image/gif'          => 'gif',
 			'image/png'          => 'png',
 			'video/mp4'          => 'mp4',
 		);

 		if ( isset( $mime_extensions[$mime] ) ) {
 			// Use the mapped extension
 			$extension = $mime_extensions[$mime];
 		}else{
 			// Could not identify extension
 			@unlink($tmp);
 			return false;
 		}
 	}



 	// Upload by "sideloading": "the same way as an uploaded file is handled by media_handle_upload"
 	$args = array(
 		'name' => "$filename.$extension",
 		'tmp_name' => $tmp,
 	);

 	// Do the upload
 	$attachment_id = media_handle_sideload( $args, 0, $title);

 	// Cleanup temp file
 	@unlink($tmp);

 	// Error uploading
 	if ( is_wp_error($attachment_id) ) return false;

 	// Success, return attachment ID (int)
 	return (int) $attachment_id;
 }




 function upload_user_file( $file = array() ) {

         require_once( ABSPATH . 'wp-admin/includes/admin.php' );

           $file_return = wp_handle_upload( $file, array('test_form' => false ) );

           if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
               return false;
           } else {

               $filename = $file_return['file'];

               $attachment = array(
                   'post_mime_type' => $file_return['type'],
                   'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                   'post_content' => '',
                   'post_status' => 'inherit',
                   'guid' => $file_return['url']
               );

               $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );

               require_once(ABSPATH . 'wp-admin/includes/image.php');
               $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
               wp_update_attachment_metadata( $attachment_id, $attachment_data );

               if( 0 < intval( $attachment_id ) ) {
                 return $attachment_id;
               }
           }

           return false;
     }


     function yp_get_image_id($image_url) {
         global $wpdb;
         $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
             return $attachment[0];
     }

function change_cover_yp(){

  if(isset($_POST['chk_cover_input'])){
             $files = $_FILES['cover_input'];

             $current_user_id = get_current_user_id();
             $cover_profile = get_field('cover_profile','user_'.$current_user_id);

             if ($cover_profile['url']) {
               $old_image_id = yp_get_image_id( $cover_profile['url'] );
               wp_delete_attachment( $old_image_id, true );
             }

             $attachment_id = upload_user_file($files);
             if ($attachment_id) {
               update_field('cover_profile',$attachment_id,'user_'.get_current_user_id());

               wp_redirect( home_url('my-profile') );
               exit;
             }

     }
     // remove_role( 'super_admin' );

}
add_action('init','change_cover_yp');




 if (class_exists('ACF')) {
	// require_once('bottom-banner/report.php');
	require_once('theme-core/theme-core.php');
  require_once('auto-delete-file.php');
  require('auto-send-mail.php');
}

function hex_to_base64($hex) {
  $return = '';
  foreach(str_split($hex, 2) as $pair) {
    $return .= chr(hexdec($pair));
  }
  return base64_encode($return);
}

function yp_user_data_api(){
  global $wpdb;
  $empId = get_field('empid','user_'.get_current_user_id());
  if (!empty($empId)) {
    $table_name = "{$wpdb->prefix}vc_pt_user";
    $table_name = str_replace("_".get_current_blog_id(),"",$table_name);
    $userdata = $wpdb->get_results( "SELECT * FROM $table_name WHERE codEmpId = '$empId'");
    $data = $userdata[0];
  }
  return $data;
  // $curl = curl_init();
  //
  // curl_setopt_array($curl, array(
  //   CURLOPT_URL => 'https://ptg-apim-services.pt.co.th/prd-provisioning/keycloak/api/openid-login',
  //   CURLOPT_RETURNTRANSFER => true,
  //   CURLOPT_ENCODING => '',
  //   CURLOPT_MAXREDIRS => 10,
  //   CURLOPT_TIMEOUT => 0,
  //   CURLOPT_FOLLOWLOCATION => true,
  //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //   CURLOPT_CUSTOMREQUEST => 'POST',
  //   CURLOPT_POSTFIELDS => $user_postfields,
  //   CURLOPT_HTTPHEADER => array(
  //     'accept: application/json;charset=UTF-8',
  //     'Authorization: Basic cHJvQWRtaW46N0pCdE54YklkNnZaQWlGQw==',
  //     'req-key: 99b659a2939d42a49978709b6ee46050',
  //     'Content-Type: application/json'
  //   ),
  // ));
  //
  // $response = curl_exec($curl);
  //
  // curl_close($curl);
  //
  // $JSON = json_decode($response);
  // $JSON = json_decode($JSON->body);
  // $token = $JSON->access_token;
  // $token = str_replace("_","/",$token);
  // $token = str_replace("-","+",$token);
  //
  // $token = explode(".",$token);
  // // $token = base64_decode($token);
  // // print_r( $token );
  // $header = base64_decode($token[0]);
  // $payload = base64_decode($token[1]);
  // $signature = base64_decode($token[2]);
  //
  //
  // // print_r($payload);
  //
  // $data = json_decode($payload);

}



function login_api_yp()
{

  if (isset($_POST['vc_signin'])) {
      $key = "C121AE44D47DBB51A22EC6BAA6F682881A6E3D36DD97569BC2E0223AD62D8986";
      $iv  = "DB7C0580855D198B87EB2DE78B71B7B5";

      $employee_id = $_POST['employee_id'];
      $user_password = $_POST['vc_user_password'];


      $keyBase64 = hex_to_base64($key);
      $ivBase64  = hex_to_base64($iv);


      $json = '{
         "realmName": "PTGroup",
         "appCode": "EPPT",
         "username": "'.$employee_id.'",
         "password": "'.$user_password.'"
      }';

      $plainText = $json;
      $algor = "aes-256-cbc";

      $POSTFIELDS = base64_encode(openssl_encrypt($plainText, $algor, base64_decode($keyBase64), OPENSSL_RAW_DATA, base64_decode($ivBase64)));


      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ptg-apim-services.pt.co.th/prd-provisioning/keycloak/api/openid-login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $POSTFIELDS,
        CURLOPT_HTTPHEADER => array(
          'accept: application/json;charset=UTF-8',
          'Authorization: Basic cHJvQWRtaW46N0pCdE54YklkNnZaQWlGQw==',
          'req-key: 99b659a2939d42a49978709b6ee46050',
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $JSON = json_decode($response);
      $JSON = json_decode($JSON->body);
      $token = $JSON->access_token;
      $token = str_replace("_","/",$token);
      $token = str_replace("-","+",$token);

      $token = explode(".",$token);

      $header = base64_decode($token[0]);
      $payload = base64_decode($token[1]);
      $signature = base64_decode($token[2]);


      // if no data
      if ($payload == '') {

        wp_redirect( home_url('login/?code=0') );
        exit;

      }
      else {
          $data = json_decode($payload);
          $username = $data->preferred_username;
          $email    =   $data->email;
          $firstName = $data->given_name;
          $lastName = $data->family_name;
          $password = $user_password;
          $company_name_en = $data->company_name_en;
          // $username = '593511';
          $user = get_user_by('login', $username );

          // if have user
          if ( !empty($user) ){

              wp_clear_auth_cookie();
              wp_set_current_user($user->ID,true);
              wp_set_auth_cookie($user->ID,true);
              update_field('user_postfields',$POSTFIELDS,'user_'.$user->ID);

              // if (!empty($POSTFIELDS)) {
              //   update_field('user_postfields',$POSTFIELDS,'user_'.$user->ID);
              // }
              // if (!empty($company_name_en)) {
              //   update_field('company_name',$company_name_en,'user_'.$user->ID);
              // }
              // if (!empty($data->company_code)) {
              //   update_field('company_code',$data->company_code,'user_'.$user->ID);
              // }
              // if (!empty($data->departement_name_en)) {
              //   update_field('departement',$data->departement_name_en,'user_'.$user->ID);
              // }
              // if (!empty($data->department_code)) {
              //   update_field('departement_code',$data->department_code,'user_'.$user->ID);
              // }
              // if (!empty($data->division_name_en)) {
              //   update_field('division',$data->division_name_en,'user_'.$user->ID);
              // }
              // if (!empty($data->division_code)) {
              //   update_field('division_code',$data->division_code,'user_'.$user->ID);
              // }
              // if (!empty($data->section_name_en)) {
              //   update_field('section_name',$data->section_name_en,'user_'.$user->ID);
              // }
              // if (!empty($data->section_code)) {
              //   update_field('section_code',$data->section_code,'user_'.$user->ID);
              // }

              // if (!empty($data->gender)) {
              //   update_field('gender',$data->gender,'user_'.$user->ID);
              // }
              //
              // if (!empty($data->birthday)) {
              //   update_field('birthday',$data->birthday,'user_'.$user->ID);
              // }
              //
              // if (!empty($data->level)) {
              //   update_field('level',$data->level,'user_'.$user->ID);
              // }

              wp_redirect( home_url() );
              exit;
          } else {
          // if don't have
          wp_redirect( home_url('login/?code=01') );
          exit;
            //   $role = $data->resource_access->EPPT->roles;
            //   $role = str_replace("EPPT_","",$role[0]);
            //   $role = str_replace("_","-",$role);
            //   $role = strtolower($role);
            //
            // $args = array (
            //       'user_login'     => $username,
            //       'user_pass'      => $password, //send as plain text password string
            //       'user_email'     => $email,
            //       'first_name'     => $firstName,
            //       'last_name'      => $lastName,
            //       'nickname'       => $firstName,
            //       'display_name'   => $firstName,
            //       'role'           => $role,
            //   );
            //
            //   $user_id =  wp_insert_user( $args); //on success, it will return user id
            //
            //
            //   if ( !is_wp_error( $user_id ) ){
            //     wp_clear_auth_cookie();
            //     wp_set_current_user($user_id,true);
            //     wp_set_auth_cookie($user_id,true);
            //
            //     update_field('empid',$username,'user_'.$user_id);
            //     update_field('user_postfields',$POSTFIELDS,'user_'.$user_id);
            //
            //     update_field('company_name',$company_name_en,'user_'.$user_id);
            //     update_field('company_code',$data->company_code,'user_'.$user_id);
            //     update_field('departement',$data->division_name_en,'user_'.$user_id);
            //     update_field('departement_code',$data->division_code,'user_'.$user_id);
            //
            //     update_field('section_name',$data->section_name_en,'user_'.$user_id);
            //     update_field('section_code',$data->section_code,'user_'.$user_id);
            //
            //     update_field('gender',$data->gender,'user_'.$user_id);
            //     update_field('birthday',$data->birthday,'user_'.$user_id);
            //     update_field('level',$data->level,'user_'.$user_id);
            //
            //     wp_redirect( home_url() );
            //     exit;
            //   }
            //   else {
            //     wp_redirect( home_url('login/?code=01') );
            //     exit;
            //   }
          }
      }
  }
}
add_action('init','login_api_yp');

function yp_event_nav($active){
  ?>
  <div class="mec-totalcal-box">
          <div class="mec-totalcal-view">
              <span class="mec-totalcal-monthlyview <?php if ($active == 'month') { echo 'mec-totalcalview-selected'; } ?>" data-skin="monthly">
                  <a href="<?php echo home_url(); ?>/full-calendar">Monthly</a>
              </span>
              <span class="mec-totalcal-yearlyview <?php if ($active == 'year') { echo 'mec-totalcalview-selected'; } ?>" data-skin="yearly">
                <a href="<?php echo home_url(); ?>/full-calendar/yearly">
                  Yearly
                </a>
              </span>
              <span class="mec-totalcal-weeklyview <?php if ($active == 'week') { echo 'mec-totalcalview-selected'; } ?>" data-skin="weekly">
                <a href="<?php echo home_url(); ?>/full-calendar/weekly">
                  Weekly
                </a>
              </span>
              <span class="mec-totalcal-dailyview <?php if ($active == 'daily') { echo 'mec-totalcalview-selected'; } ?>" data-skin="daily">
                  <a href="<?php echo home_url(); ?>/full-calendar/daily">
                  Daily
                </a>
              </span>
            </div>
      </div>
  <?php
}

function complaint_box(){
	ob_start();
  ?>
    <div class="wrap-complaint_box">
      <h2>เรื่องร้องเรียนของฉัน</h2>
    <ul id="yp-accordion" class="accordionjs complaint_box">
      <?php

      global $wp_query;
      // $curauth = $wp_query->get_queried_object();
      $current_user_id = get_current_user_id();

      // $formApi = fluentFormApi('forms')->entryInstance($formId = 4);
      //   $atts = [
      //      'per_page' => 99999,
      //      'page' => 1,
      //      'search' => '',
      //      'sort_by' => 'DESC',
      //      'entry_type' => 'all'
      // ];
      // $entries = $formApi->entries($atts , $includeFormats = false);
      // print_r($entries);

      $args = array(
      'post_type'      => 'vc_complaint',
      'posts_per_page'  => -1,
      'orderby' => 'date',
      'meta_key'		=> 'user_id',
	    'meta_value'	=> $current_user_id,
      'order' => 'DESC'
    );
    query_posts( $args );
    if ( have_posts() ) : while ( have_posts() ) : the_post();

    $subject = get_field('subject');
    $c_detail = get_field('c_detail');
    $cstatus = get_field('c_status');
    $user_id = get_field('user_id');

    if ($cstatus == 'status_01') {
      $cstatus = 'รอรับเรื่อง';
    }
    if ($cstatus == 'status_02') {
      $cstatus = 'กำลังดำเนินการ';
    }
    if ($cstatus == 'status_03') {
      $cstatus = 'เสร็จสิ้น';
    }

    // if ($current_user_id != $user_id) {
    //   continue;
    // }
    $created_at = get_the_date('d/m/Y เวลา h:i น.');
     ?>
      <li class="acc_section">
        <h3 class="acc_head">
          <div class="left">

            <div class="icon">
              <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
            <div class="subject">
              <div class="sTitle">
                <span><?php echo $subject; ?></span>
                <span class="date"><?php echo $created_at; ?></span>
              </div>
            </div>

          </div>

          <div class="right">
            <div class="status">
              <div class="item-status <?php echo get_field('c_status'); ?>">
                <?php echo $cstatus; ?>
              </div>
            </div>
          </div>
        </h3>
        <div class="acc_content">
              <?php echo $c_detail; ?>
        </div>
         </li>
    <?php endwhile; ?>

    <?php else: ?>
      <p class="complaint_not_found">ยังไม่มีข้อมูล</p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>



    </ul>
  </div>
  <?php
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('complaint_box','complaint_box');

function current_name(){
	ob_start();

    $user_info = yp_user_data_api();

  if (!empty($user_info)) {
    $first_name = $user_info->nameFirstT;
    echo 'สวัสดีคุณ '.$first_name;
  }
  else {
    echo 'ยินดีต้อนรับ';
  }




	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('current_name','current_name');


add_action('fluentform_before_insert_submission', 'complaint_chk', 10, 3);
function complaint_chk($insertData, $data, $form){
  if($data['form_type'] != 'complaint') {
     return;
  }

  date_default_timezone_set("Asia/Bangkok");
  $status = $data['cstatus'];
  $subject = $data['csubject'];
  $user_phone = $data['cph'];
  $user_email = $data['cem'];
  $user_id = $data['user_id'];
  $username = $data['username'];
  $full_name = $data['cfn'];
  $c_detail = $data['c_detail'];
  $created_at = date('d/m/Y H:i:s');

  $post_id = wp_insert_post(array(
    'post_type' =>'vc_complaint',
    'post_title' => $subject.' แจ้งเรื่องเมื่อ '.$created_at,
    // 'post_date'  => $post_date.' 00:00:00',
    'post_status' =>  'publish'
  ));

  if ($subject) {
    update_field('subject',$subject,$post_id);
  }

  if ($status) {
    update_field('c_status',$status,$post_id);
  }

  if ($c_detail) {
    update_field('c_detail',$c_detail,$post_id);
  }

  if ($full_name) {
    update_field('full_name',$full_name,$post_id);
  }

  if ($user_phone) {
    update_field('user_phone',$user_phone,$post_id);
  }

  if ($user_email) {
    update_field('user_email',$user_email,$post_id);
  }
  if ($user_id) {
    update_field('user_id',$user_id,$post_id);
  }

  if ($username) {
    update_field('username',$username,$post_id);
  }



}

add_filter('fluentform_all_editor_shortcodes',function($data){

	$customShortCodes = [
		     'title'=>'Custom',
                     'shortcodes' => ['{complaint_link}' => 'complaint_link',]
		];
	$data[] = $customShortCodes;
	return $data;

},10,1);

/*
 * To replace dynamic new smartcode the filter hook will be
 * fluentform_editor_shortcode_callback_{your_smart_code_name}
 */
 add_filter('fluentform_shortcode_parser_callback_complaint_link', function ($value, $parser) {

     // If you need $submittedData
     $entry = $parser::getEntry();
     $submittedData = \json_decode($entry->response, true);


     // ob_start();
     // print_r();
     //
     //
     // $output_string = ob_get_contents();
     // ob_end_clean();
     //
     // $to = 'sendto2@example.com';
     // $subject = 'The subjects';
     // $body =  $output_string;
     // $headers = array('Content-Type: text/html; charset=UTF-8');
     // wp_mail( $to, $subject, $body, $headers );


     // if you need form ID
     $csubject = get_page_by_title($submittedData['csubject'] , OBJECT, 'vc_complaint' );
     $csubject = site_url().'/wp-admin/post.php?post='.$csubject->ID.'&action=edit';


     return $csubject;
 }, 10, 2);







function request_sentmail($sent_to,$subj,$body_data){
    $to = $sent_to;
    $subject = $subj;
    $body =  $body_data;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $to, $subject, $body, $headers );
}


 add_action('fluentform_before_insert_submission', 'request_content_chk', 10, 3);
 function request_content_chk($insertData, $data, $form){
   if($data['form_type'] != 'request_content') {
      return;
   }
   $reCat = $data['reCat'];
   $reSubject = $data['reSubject'];
   $reObj = $data['reObj'];
   $reDetail = $data['reDetail'];
   $reDate_start = $data['reDate_start'];
   $reDate_end = $data['reDate_end'];
   $reChannel = $data['reChannel'];
   $file_work = $data['file_work'];
   $er_box = $data['er_box'];
   $user_id = $data['user_id'];
   $current_post_id = $data['current_post_id'];
   $reDetailUser = $data['reDetailUser'];


   $files = $file_work;
     $uploadDir = str_replace('/', '\/', FLUENTFORM_UPLOAD_DIR );
     $pattern = "/(?<=${uploadDir}\/).*$/";
     preg_match($pattern, $files[0], $match);
     if (!empty($match)) {
       $file = str_replace($match[0], \FluentForm\App\Helpers\Protector::decrypt($match[0]), $files[0]);
      $file_work = $file;
     }


   if ($current_post_id == '') {

     $output_string = ob_get_contents();
     ob_end_clean();

     // $to = 'sendto2@example.com';
     // $subject = 'The subjects';
     // $body =  $output_string;
     // $headers = array('Content-Type: text/html; charset=UTF-8');
     // wp_mail( $to, $subject, $body, $headers );

     $post_id = wp_insert_post(array(
       'post_type' =>'vc_request_content',
       'post_title' => $reSubject,
       // 'post_date'  => $post_date.' 00:00:00',
       'post_status' =>  'publish'
     ));
     $data = array(
       'ID' => $post_id,
       'post_name' => $post_id,
      );
      wp_update_post( $data );

     update_field('reStatus','status_01',$post_id);

     if ($reCat) {
       update_field('reCat',$reCat,$post_id);
     }

     if ($reSubject) {
       update_field('reSubject',$reSubject,$post_id);
     }

     if ($reObj) {
       update_field('reObj',$reObj,$post_id);
     }

     if ($reDetail) {
       update_field('reDetail',$reDetail,$post_id);
     }

     if ($reDate_start) {
       update_field('reDate_start',$reDate_start,$post_id);
     }

     if ($reDate_end) {
       update_field('reDate_end',$reDate_end,$post_id);
     }

     if ($reChannel) {
       update_field('reChannel',$reChannel,$post_id);
     }
     if ($file_work) {
       update_field('file_work',$file_work,$post_id);
     }
     if ($er_box) {
       update_field('er_box',$er_box,$post_id);
     }

     if ($user_id) {
       update_field('reuser_id',$user_id,$post_id);
     }


     require('request-content/flow-1.php');


   }
   else {

     date_default_timezone_set("Asia/Bangkok");

      if (get_field('reuser_id',$current_post_id) == get_current_user_id() && get_field('reStatus',$current_post_id)['value'] == 'status_02') {
          require('request-content/user-sent-to-manager.php');
      }

      if ($data['reStatus'] == 'status_02') {
          require('request-content/manager-sent-to-user.php');
      }

      if ($data['reStatus'] == 'status_04') {
          require('request-content/manager-sent-to-er.php');
      }

      if ($data['reStatus'] == 'status_05') {
          require('request-content/er-sent-to-user.php');
      }

      if ($data['reStatus'] == 'status_06') {
          require('request-content/user-sent-to-er.php');
      }

      if ($data['reStatus'] == 'status_07') {
          require('request-content/user-sent-to-erc.php');
      }
      if ($data['reStatus'] == 'status_08') {
          require('request-content/er-sent-to-userc.php');
      }

      if ($data['reStatus'] == 'status_09') {
          require('request-content/manager-sent-to-cancel.php');
      }






   }

 }

 // add_filter('fluentform_all_editor_shortcodes',function($smartCodes){
 // 	$smartCodes = [
 // 		     'title'=>'reCat',
 //          'shortcodes' => ['{reCat}' => 'reCat',]
 // 		];
 // 	$data[] = $customShortCodes;
 // 	return $data;
 //
 // },10,1);

 add_filter('fluentform_editor_shortcodes', function ($smartCodes) {
    $smartCodes[1]['shortcodes']['{reCat}'] = 'reCat';
    $smartCodes[1]['shortcodes']['{reSubject}'] = 'reSubject';
    $smartCodes[1]['shortcodes']['{reObj}'] = 'reObj';
    $smartCodes[1]['shortcodes']['{reDetail}'] = 'reDetail';
    $smartCodes[1]['shortcodes']['{reDate_start}'] = 'reDate_start';
    $smartCodes[1]['shortcodes']['{reDate_end}'] = 'reDate_end';
    $smartCodes[1]['shortcodes']['{reChannel}'] = 'reChannel';
    $smartCodes[1]['shortcodes']['{current_post_id}'] = 'current_post_id';
    $smartCodes[1]['shortcodes']['{reStatus}'] = 'reStatus';
    $smartCodes[1]['shortcodes']['{er_box}'] = 'er_box';



    // $smartCodes[1]['shortcodes']['{file_work}'] = 'file_work';
    return $smartCodes;
});



add_filter('fluentform_editor_shortcode_callback_reStatus', function ($value, $form) {
  if (is_singular('vc_request_content')) {
    $data = get_field('reStatus')['value'];
  }
  return $data;
}, 10, 2);


add_filter('fluentform_editor_shortcode_callback_current_post_id', function ($value, $form) {
  if (is_singular('vc_request_content')) {
    $data = get_the_ID();
  }
  return $data;
}, 10, 2);

  add_filter('fluentform_editor_shortcode_callback_reCat', function ($value, $form) {
    if (is_singular('vc_request_content')) {
      $value = get_field('reCat',get_the_ID());
      $data = $value['value'];
    }
    return $data;
  }, 10, 2);


   add_filter('fluentform_editor_shortcode_callback_reSubject', function ($value, $form) {
     if (is_singular('vc_request_content')) {
       $value = get_field('reSubject',get_the_ID());
       $data = $value;
     }
     return $data;
   }, 10, 2);


   add_filter('fluentform_editor_shortcode_callback_reObj', function ($value, $form) {
     if (is_singular('vc_request_content')) {
       $value = get_field('reObj',get_the_ID());
       $data = $value;
     }
     return $data;
   }, 10, 2);

   add_filter('fluentform_editor_shortcode_callback_reDetail', function ($value, $form) {
     if (is_singular('vc_request_content')) {
       $value = get_field('reDetail',get_the_ID());
       $data = $value;
     }
     return $data;
   }, 10, 2);

   add_filter('fluentform_editor_shortcode_callback_reDate_start', function ($value, $form) {
     if (is_singular('vc_request_content')) {
       $value = get_field('reDate_start',get_the_ID());
       $data = $value;
     }
     return $data;
   }, 10, 2);

   add_filter('fluentform_editor_shortcode_callback_reDate_end', function ($value, $form) {
     if (is_singular('vc_request_content')) {
      $value = get_field('reDate_end',get_the_ID());
       $data = $value;
     }
     return $data;
   }, 10, 2);

   add_filter('fluentform_editor_shortcode_callback_reChannel', function ($value, $form) {
     if (is_singular('vc_request_content')) {

        $data = get_field('reChannel',get_the_ID());
        $array = array();
        foreach ($data as $value) {
          $array[] = $value['value'];
        }
        $List = implode(',', $array);
        $data = $List;

     }
     return $data;
   }, 10, 2);





   // add_filter('fluentform_editor_shortcode_callback_file_work', function ($value, $form) {
   //   if (is_singular('vc_request_content')) {
   //    $value = get_field('file_work',get_the_ID());
   //     $data = $value['value'];
   //   }
   //   return $data;
   // }, 10, 2);







   add_filter('fluentform_rendering_field_data_select', function ($data, $form) {


       // check if the name attriibute is 'dynamic_dropdown'
       if (\FluentForm\Framework\Helpers\ArrayHelper::get($data, 'attributes.name') != 'er_box') {
           return $data;
       }

       $data_set = array();
       if( have_rows('email_group_list','option') ):
         while( have_rows('email_group_list','option') ) : the_row();
        // Load sub field value.
          $group_name = get_sub_field('group_name','option');
          $group_id = get_sub_field('group_id','option');

          $data_set[] = array(
            "label"	=> $group_name,
            "value"	=> $group_id,
            "calc_value" => ""
          );
            endwhile;
            else :
              $data_set[] = array(
                "label"	=> 'ไม่มีข้อมูล',
                "value"	=> '',
                "calc_value" => ""
              );
        endif;


       $data['settings']['advanced_options'] = array_merge($data['settings']['advanced_options'], $data_set);

       return $data;
   }, 10, 2);



   // $data = get_field('er_box',84003);
   //
   // if (is_array($data)) {
   //   foreach ($data as $value) {
   //     $array[] = $value;
   //   }
   //   $List = implode(',', $data);
   //   $data = $List;
   // }
   // else {
   //   $data = json_decode($data);
   //   foreach ($data as $value) {
   //     $array[] = $value;
   //   }
   //   $List = implode(',', $data);
   //   $data = $List;
   // }
   //
   // print_r($data);

   add_filter('fluentform_editor_shortcode_callback_er_box', function ($value, $form) {
     if (is_singular('vc_request_content')) {
       $data = get_field('er_box',get_the_ID());

       if (!empty($data)) {
         if (is_array($data)) {
           foreach ($data as $value) {
             $array[] = $value;
           }
           $List = implode(',', $data);
           $data = $List;
         }
         else {
           $data = json_decode($data);
           foreach ($data as $value) {
             $array[] = $value;
           }
           $List = implode(',', $data);
           $data = $List;
         }
       }


     }
     return $data;
   }, 10, 2);






// add_action('fluentform_email_template_after_footer', function ( $form, $notification)
// {
//   // ob_start();
//   // echo $notification['subject'];
//   //
//   //
//   // $output_string = ob_get_contents();
//   // ob_end_clean();
//   //
//   // $to = 'sendto2@example.com';
//   // $subject = 'The subjects';
//   // $body =  $output_string;
//   // $headers = array('Content-Type: text/html; charset=UTF-8');
//   // wp_mail( $to, $subject, $body, $headers );
//
//   $text = substr($notification['subject'], strpos($notification['subject'], ": ") + 1);
//   echo $text;
//
// }, 10, 2);




add_action('fluentform_before_insert_submission', 'chk_vote_ip', 10, 3);
function chk_vote_ip($insertData, $data, $form){

  // ob_start();
  // print_r($data);
  //
  // $output_string = ob_get_contents();
  // ob_end_clean();
  //
  // $to = 'sendto2@example.com';
  // $subject = 'The subjects';
  // $body =  $output_string;
  // $headers = array('Content-Type: text/html; charset=UTF-8');
  // wp_mail( $to, $subject, $body, $headers );


  if($data['form_type'] != 'vote') {
     return;
  }

    $id = $form->id;

    if (!empty($id)) {

      // ob_start();
      // print_r($data);
      //
      // $output_string = ob_get_contents();
      // ob_end_clean();
      //
      // $to = 'sendto2@example.com';
      // $subject = 'The subjects';
      // $body =  $output_string;
      // $headers = array('Content-Type: text/html; charset=UTF-8');
      // wp_mail( $to, $subject, $body, $headers );


        $formApi = fluentFormApi('forms')->entryInstance($formId = $id);
          $atts = [
             'per_page' => 999999,
             'page' => 1,
             'search' => '',
             'sort_by' => 'DESC',
             'entry_type' => 'all'
        ];
        $entries = $formApi->entries($atts , $includeFormats = false);


        if ($entries['data']) {
          foreach ($entries['data'] as $value) {

            // $loop_id = $value->serial_number;
            $old_id = $value->user_id;

            if ($value->status == 'trashed') {
              continue;
            }

            // if ($data['user_ip'] == $old_ip) {
            if ($data['user_id'] == $old_id) {
                // $form->settings['confirmation']['messageToShow'] = 'คุณโหวตแล้ว !!';
                wp_send_json_error('คุณโหวตแล้ว');
                // return;
            }

          }
        }



      } // check id



}



add_action("wp_ajax_update_vote_action", "update_vote");
add_action("wp_ajax_nopriv_update_vote_action", "update_vote");

function update_vote($id){
	ob_start();
  if ($_POST['vform_ID']) {
    $id = $_POST['vform_ID'];
  }
  require('content-vote.php');
  exit();

  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}


add_action("wp_ajax_save_news_most_action", "save_news_most");
add_action("wp_ajax_nopriv_save_news_most_action", "save_news_most");
function save_news_most(){
  if (!empty($_POST['per_posts'])) {
    update_field('per_posts_news_most',$_POST['per_posts'],'user_'.get_current_user_id());
    echo "Updated";
  }
die();
}


add_action("wp_ajax_save_favorite_action", "save_favorite");
add_action("wp_ajax_nopriv_save_favorite_action", "save_favorite");

function save_favorite($id){
	ob_start();
    parse_str($_POST['form_data'], $form_data);
?>
  <?php
  if (!empty($form_data['post_category'])) {
    update_field('favorite_news', $form_data['post_category'],'user_'.get_current_user_id());
    $userData =array(
        "status" => 'ok', //username
    );
    echo json_encode($userData);
  }
  else {
    $userData =array(
        "status" => 'empty', //username
    );
    echo json_encode($userData);
  }

  ?>

<?php
  exit();

  $output_string = ob_get_contents();
  ob_end_clean();
  return $output_string;
}









add_filter( 'wp_nav_menu_items', 'yp_logout_menu_link', 10, 2 );

function yp_logout_menu_link( $menu_items, $args ) {
   if ($args->theme_location == 'mobile') {
      if (is_user_logged_in()) {
         $menu_items .= '<li><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
      }
   }
   return $menu_items;
}

add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}






// if (get_current_blog_id() != 1) {
//   add_filter( 'show_admin_bar', '__return_false' );
// }
// require_once('ultimate-member/remove-css.php');
// require_once('ultimate-member/custom-file/custom-userform.php');




function goto_term(){

  if (get_current_blog_id() != 1) {
      switch_to_blog(get_current_blog_id());
  }



  if ($_GET['go_posts_terms']) {
    $term_id = $_GET['go_posts_terms'];
    $term_ini = (int) $term_id;
    $term_link = get_term_link($term_ini,'category');
    wp_safe_redirect($term_link);
    exit();
  }

  if (get_current_blog_id() != 1) {
  restore_current_blog();
  }
}
add_action('template_redirect','goto_term');



function goto_edit_profile_elementor(){

  if (!empty($_GET['edit_profile'])) {

  $user_id = get_current_user_id();
  $profile_template = get_field('profile_template_id','user_'.$user_id);

      if ($profile_template == '') {

          $user_info = get_userdata($user_id);

          $post_id = wp_insert_post(array(
          'post_type' =>'vc_profile',
          'post_title' => 'Profile for : '.$user_info->user_login,
          // 'post_date'  => $post_date.' 00:00:00',
          'post_status' =>  'publish'
          ));

          update_field('profile_template_id',$post_id,'user_'.$user_id);
          wp_safe_redirect(admin_url().'post.php?post='.$post_id.'&action=elementor');
          exit();


      }
      else {
        wp_safe_redirect(admin_url().'post.php?post='.$profile_template.'&action=elementor');
        exit();
      }

    }



}
add_action('template_redirect','goto_edit_profile_elementor');


function check_login(){

    if (!is_user_logged_in() && !is_page(80920) && !is_page(80925) ) {
      wp_safe_redirect(home_url('login'));
      exit();
    }

    if ( is_user_logged_in() && is_page(80920) && !is_page(81215)) {
      wp_safe_redirect(home_url('my-profile'));
      exit();
    }

}
add_action('template_redirect','check_login');


function social_box() {
	ob_start();
  $facebook = get_field('facebook_link', 'option');
  $twitter = get_field('twitter_link', 'option');
  $youtube = get_field('youtube_link', 'option');
  $line = get_field('line_link', 'option');
  $instagram = get_field('instagram_link', 'option');
  $tiktok = get_field('tiktok_link', 'option');

	?>
  <div class="social-box">

    <?php if ($facebook): ?>
      <a href="<?php echo $facebook; ?>">
        <div class="icon-in facebook">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 50 50" width="50px" height="50px">    <path d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z"/></svg>											 </div>
      </a>
    <?php endif; ?>

    <?php if ($twitter): ?>
      <a href="<?php echo $twitter; ?>">
        <div class="icon-in twitter">
           <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 30 30" width="50px" height="50px">    <path d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z"/></svg>
         </div>
      </a>
    <?php endif; ?>

    <?php if ($line): ?>
      <a href="<?php echo $line; ?>">
        <div class="icon-in line">
           <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 48 48" width="50px" height="50px"><path d="M25.12,44.521c-2.114,1.162-2.024-0.549-1.933-1.076c0.054-0.314,0.3-1.787,0.3-1.787c0.07-0.534,0.144-1.36-0.067-1.887 c-0.235-0.58-1.166-0.882-1.85-1.029C11.48,37.415,4.011,30.4,4.011,22.025c0-9.342,9.42-16.943,20.995-16.943S46,12.683,46,22.025 C46,32.517,34.872,39.159,25.12,44.521z M18.369,25.845c0-0.56-0.459-1.015-1.023-1.015h-2.856v-6.678 c0-0.56-0.459-1.015-1.023-1.015c-0.565,0-1.023,0.455-1.023,1.015v7.694c0,0.561,0.459,1.016,1.023,1.016h3.879 C17.91,26.863,18.369,26.406,18.369,25.845z M21.357,18.152c0-0.56-0.459-1.015-1.023-1.015c-0.565,0-1.023,0.455-1.023,1.015 v7.694c0,0.561,0.459,1.016,1.023,1.016c0.565,0,1.023-0.456,1.023-1.016V18.152z M30.697,18.152c0-0.56-0.459-1.015-1.023-1.015 c-0.565,0-1.025,0.455-1.025,1.015v4.761l-3.978-5.369c-0.192-0.254-0.499-0.406-0.818-0.406c-0.11,0-0.219,0.016-0.325,0.052 c-0.419,0.139-0.7,0.526-0.7,0.963v7.694c0,0.561,0.46,1.016,1.025,1.016c0.566,0,1.025-0.456,1.025-1.016v-4.759l3.976,5.369 c0.192,0.254,0.498,0.406,0.818,0.406c0.109,0,0.219-0.018,0.325-0.053c0.42-0.137,0.7-0.524,0.7-0.963V18.152z M36.975,20.984 h-2.856v-1.817h2.856c0.566,0,1.025-0.455,1.025-1.015c0-0.56-0.46-1.015-1.025-1.015h-3.879c-0.565,0-1.023,0.455-1.023,1.015 c0,0.001,0,0.001,0,0.003v3.842v0.001c0,0,0,0,0,0.001v3.845c0,0.561,0.46,1.016,1.023,1.016h3.879 c0.565,0,1.025-0.456,1.025-1.016c0-0.56-0.46-1.015-1.025-1.015h-2.856v-1.817h2.856c0.566,0,1.025-0.455,1.025-1.015 c0-0.561-0.46-1.016-1.025-1.016V20.984z"/></svg>
        </div>
      </a>
    <?php endif; ?>


    <?php if ($youtube): ?>
      <a href="<?php echo $youtube; ?>">
       <div class="icon-in youtube">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 24 24" width="50px" height="50px">    <path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4S5.746,4,4.186,4.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.861-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,14.598V9.402c0-0.385,0.417-0.625,0.75-0.433l4.5,2.598c0.333,0.192,0.333,0.674,0,0.866l-4.5,2.598 C10.417,15.224,10,14.983,10,14.598z"/></svg>
       </div>
     </a>
    <?php endif; ?>

    <?php if ($tiktok): ?>
      <a href="<?php echo $tiktok; ?>">
        <div class="icon-in tiktok">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 50 50" width="50px" height="50px">    <path d="M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z M37.006,22.323 c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527 s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053 c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016 c0.378,3.591,3.277,6.425,6.901,6.685V22.323z"/></svg>
        </div>
      </a>
    <?php endif; ?>

     <?php if ($instagram): ?>
            <a href="<?php echo $instagram; ?>">
              <div class="icon-in">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 24 24" width="50px" height="50px">    <path d="M 8 3 C 5.239 3 3 5.239 3 8 L 3 16 C 3 18.761 5.239 21 8 21 L 16 21 C 18.761 21 21 18.761 21 16 L 21 8 C 21 5.239 18.761 3 16 3 L 8 3 z M 18 5 C 18.552 5 19 5.448 19 6 C 19 6.552 18.552 7 18 7 C 17.448 7 17 6.552 17 6 C 17 5.448 17.448 5 18 5 z M 12 7 C 14.761 7 17 9.239 17 12 C 17 14.761 14.761 17 12 17 C 9.239 17 7 14.761 7 12 C 7 9.239 9.239 7 12 7 z M 12 9 A 3 3 0 0 0 9 12 A 3 3 0 0 0 12 15 A 3 3 0 0 0 15 12 A 3 3 0 0 0 12 9 z"/></svg>
              </div>
            </a>
     <?php endif; ?>
  </div>

	<?php
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode('social_box','social_box');


function footer_report(){
  ?>

  <?php if ($_GET['data-title']): ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('.report-depart').prop('selectedIndex',4);
        $('.report-message').val('Broken file report\nFile name: '+'<?php echo $_GET['data-title']; ?>\nFile url :'+'<?php echo $_GET['data-url']; ?>');
      });
    </script>
  <?php endif; ?>


  <?php
  $userdata = yp_user_data_api();
  $company_name = $userdata->nameComp;
  if ($company_name && is_front_page()): ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $element = $('#mec_sf_tag_1163');
          $options = $element.find('option');
          $wanted_element = $options.filter(function () {
            return  $(this).text() == "<?php echo $company_name; ?>";
          });
          $wanted_element.prop('selected', true);
          setTimeout(function () {
            $element.change();
          }, 10);
        });
    </script>
    <?php else: ?>
      <style media="screen">
        #mec_sf_tag_81034{
          display: none;
        }
      </style>
    <?php
     if (is_single() != 1): ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
              $element = $('#mec_sf_tag_81034,#mec_sf_tag_1456,#mec_sf_tag_81027,#mec_sf_tag_81031');
              $options = $element.find('option');
              $wanted_element = $options.filter(function () {
                return  $(this).text() == "<?php echo $company_name; ?>";
              });
              $wanted_element.prop('selected', true);
              setTimeout(function () {
                $element.niceSelect('update');
                $element.change();
              }, 5);
            });
        </script>
      <?php endif; ?>
  <?php endif; ?>



<?php if (get_field('favorite_news_enable','option') && is_user_logged_in()): ?>

  <?php if (empty(get_field('favorite_news','user_'.get_current_user_id()))): ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('form.yp-favorite-form ul li label').append('<span class="switch close"></span>');
        setTimeout(function () {
          $('.wrap-all-favorite').addClass('active');
        }, 500);
      });
    </script>
    <div class="wrap-all-favorite">
      <div class="yp-favorite-overlay"></div>
        <form class="yp-favorite-form" action="" method="post">
          <div class="favorite_close">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </div>
          <h4>กรุณาเลือกสิ่งที่สนใจ</h4>
        <ul>
            <?php
              // wp_category_checklist(array(
              //     'depth' => 0
              // ));

              $myterms = get_terms( array( 'taxonomy' => 'category', 'parent' => 0 ) );
              // print_r(  $myterms);
            ?>
            <?php foreach ($myterms as $value): ?>
              <li id='category-<?php echo $value->term_id; ?>' class="popular-category">
                <label class="selectit">
                  <input value="<?php echo $value->term_id; ?>" type="checkbox" name="post_category[]" id="in-category-<?php echo $value->term_id; ?>"/>
                  <?php echo $value->name; ?>
                </label>
                </li>
            <?php endforeach; ?>

        </ul>


        <button type="submit" name="button">บันทึก</button>
      </form>
    </div>


    <script type="text/javascript">

    jQuery(document).ready(function($) {
      $('.yp-favorite-form').submit(function(e) {
         e.preventDefault();
          // $('.loading').removeClass('hide');
         var submit_data = jQuery(this).serialize();
         // console.log(submit_data);
         $('.yp-favorite-form button').text('กำลังบันทึก...');

         var data = {
          form_data: submit_data,
          action: 'save_favorite_action'
        };

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            data: data,
            success: function (code) {
                console.log(code);
              if (code.status == 'ok') {
                    $('.yp-favorite-form button').text('บันทึกแล้ว');
                    setTimeout(function () {
                          $('.wrap-all-favorite').removeClass('active');
                    }, 1000);
              }
              else if (code.status == 'empty'){
                $('.yp-favorite-form button').text('กรุณาเลือกตัวเลือก');
                // setTimeout(function () {
                //     $('.yp-favorite-form button').text('บันทึก');
                // }, 1000);
              }
              else {
                  $('.yp-favorite-form button').text('ผิดพลาด');
                alert('Error');
                setTimeout(function () {
                      $('.wrap-all-favorite').removeClass('active');
                }, 500);
              }
            },
            dataType: 'JSON'
         });


      });
    });
    </script>
  <?php endif; ?>

<?php endif; ?>

  <?php
}
add_action('wp_footer','footer_report');

function yp_popup_search(){
  ?>

  <div class="overlay-popup_search"></div>
  <div class="popup_search">
    <h4>การค้นหา</h4>
        <div class="x-close">
            <span class="btn-close">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </div>
		<div class="box-search">
        <div class="sec-search_box">
            <h3><?php yp_text( 'กรุณากรอกคำที่ต้องการค้นหา', 'Please enter a search term' ); ?></h3>
                        <form action="<?php echo home_url(); ?>/search-result/" id="search-h_box" class="search-h_box" method="GET">
                            <div class="main-object_s">
                                <div class="s-object object-1">
																	<label for="s-text">
                                    <input type="text" name="_sf_s" id="s-text" class="input-s_box input-s_text" value="<?php echo $_GET['_sf_s']; ?>" placeholder="<?php yp_text( 'ค้นหาข้อมูล', 'Search...' ); ?>">
																		</label>
                                </div>
																<div class="s-object object-2">
																		<button type="submit" class="btn-search_h btn-sh"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
																</div>
                            </div>
                        </form>
                    </div>
		</div>
	</div>
  <?php
}

function in_thumb(){
  $hide = 0;
  ?>
  <?php if ($hide == 1): ?>
    <div class="in-thumb-overlay">
      <a href="<?php the_permalink(); ?>" class="" title="<?php the_title(); ?>">
        <span class="in-view-more icon"><i aria-hidden="true" class="flaticon-plus"></i></span>
      </a>
      </div>
  <?php endif;
}

function overwrite_shortcode() {

    function wpdm_package($atts) {
        extract(shortcode_atts(array('id' => ''), $atts));
				ob_start();
			    $ID = $id;
			    $package = WPDM()->package->init($ID);
			      $fileinfo = maybe_unserialize(get_post_meta($ID, '__wpdm_fileinfo', true));
			    $files = maybe_unserialize($package->files);
			    $allfiles = $files;
			    $count = count($allfiles);

			    $permalink = get_permalink($ID);
			    $sap = strpos($permalink, '?') ? '&' : '?';
			    $download_all_url = $permalink . $sap . "wpdmdl={$ID}";
			    $package_download_url = $package->getDownloadURL($ID);
			    ?>


			<div class="list-download wpdm_package">
			  <div class="menu">
			    <div class="date-public">
			      <i class="far fa-calendar"></i>
			      <p><?php yp_text('วันที่เผยแพร่','Publish Date'); ?></p>
			      <h4><?php the_date('d M y') ?></h4>
			    </div>
			    <div class="file-count">
			      <i class="fas fa-file-download"></i>
			      <p><?php yp_text('จำนวนไฟล์','Number of files'); ?></p>
			      <h4><?php echo $count; ?></h4>
			    </div>
			  </div>
			  <div class="list">


			    <ul>
			    <?php
			    foreach ($allfiles as $fileID => $sfile) {
			    // $filePass = wpdm_valueof($fileinfo, "{$fileID}/password");
			    $fileTitle = wpdm_valueof($fileinfo, "{$fileID}/title");
			    $fileTitle = $fileTitle ?: preg_replace("/([0-9]+)_/", "", wpdm_basename($sfile));
			    $fileTitle = wpdm_escs($fileTitle);
			    $ind = $fileID; //\WPDM_Crypt::Encrypt($sfile);
			    $download_url = add_query_arg(['ind' => $ind, 'filename' => wp_basename($sfile)], $package_download_url);


			    $ext = pathinfo($sfile, PATHINFO_EXTENSION);

			    if ($ext == 'pdf') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/pdf.svg';
			    }

			   else if ($ext == 'xlsx') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/xls.svg';
			    }

			    else if ($ext == 'xls') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/xls.svg';
			    }

			    else if ($ext == 'doc') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/doc.svg';
			    }

			   else if ($ext == 'docx') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/doc.svg';
			    }

			   else if ($ext == 'ppt') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/pptx.svg';
			    }

			   else if ($ext == 'pptx') {
			        $file_icon_type = get_stylesheet_directory_uri().'/img/pptx.svg';
			    }
			    else {
			         $file_icon_type = get_stylesheet_directory_uri().'/img/log.svg';
			     }
			    ?>


			    <li class="file">
			    <img src="<?php echo $file_icon_type; ?>" alt="<?php echo $fileTitle; ?>">
			      <div class="detail"><?php echo $fileTitle; ?></div>
			      <a target="_blank" href="<?php echo $download_url; ?>">
			        <i class="fas fa-download fa-fw"></i> <?php yp_text('ดาวน์โหลด','Download'); ?>
			      </a>
			    </li>

			  <?php } ?>
			</ul>

			    <div class="detail-button">
			      <a href="<?php echo $download_all_url; ?>" class="download-all">
			        <i class="fas fa-download"></i> <?php yp_text('ดาวน์โหลดทั้งหมด','Download All'); ?>
			      </a>
			      <a href="#" class="report">
			        <i class="fas fa-exclamation-circle fa-lg"></i> <?php yp_text('แจ้งไฟล์เสีย','Report'); ?>
			      </a>
			    </div>
			  </div>


			</div>



			<?php
			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;
    }

    remove_shortcode('wpdm_package');
    add_shortcode('wpdm_package', 'wpdm_package');
}

add_action('wp_loaded', 'overwrite_shortcode');

function v_page_title(){
  // $setting_theme = get_field('setting_theme', 'option');

      get_template_part( 'template-parts/page-title-archive-s2');

  // if (is_archive()) {
    // switch ($setting_theme) {
    //   case 'one':
    //       get_template_part( 'template-parts/page-title-archive-s2');
    //     break;
    //   case 'two':
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //     break;
    //   case 'three':
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //       break;
    //   case 'four':
    //       get_template_part( 'template-parts/page-title-archive-s2');
    //   break;
    //   case 'five':
    //       get_template_part( 'template-parts/page-title-archive-s2');
    //   break;
    //   case 'six':
    //       get_template_part( 'template-parts/page-title-archive-s2');
    //   break;
    //   case 'seven':
    //       get_template_part( 'template-parts/page-title-archive-s2');
    //   break;
    //   case 'eight':
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //   break;
    //   case 'nine':
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //   break;
    //   case 'ten':
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //   break;
    //   case 'eleven':
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //   break;
    //   default:
    //       get_template_part( 'template-parts/page-title-archive-s1');
    //     break;
    // }
  // }

}

add_filter( 'body_class', 'yp_add_theme_class' );
function yp_add_theme_class( $classes ) {

		if ( get_field('setting_theme','option') ) {
			$classes[] = 'theme-'.get_field('setting_theme','option').' lang-'.get_locale();
		}
    	return $classes;

}

// function set_primary_on_publish ($post_ID) {
//     global $post;
//
// 				// Only set for post_type = post!
// 		 if ( 'post' !== $post->post_type ) {
// 				 return;
// 		 }
//
//     $categories = get_the_terms( $post->ID, 'category' );
//
//     // wrapper to hide any errors from top level categories or products without category
//     if ( $categories && ! is_wp_error( $category ) ) :
//
//         // loop through each cat
//         foreach($categories as $category) :
//
//           // get the children (if any) of the current cat
//           $children = get_categories( array ('taxonomy' => 'category', 'parent' => $category->term_id ));
//
//           if ( count($children) == 0 ) {
//                 $childid = $category->term_id;
//                 update_post_meta($post->ID,'_yoast_wpseo_primary_category',$childid);
//           }
//         endforeach;
//     endif;
// }
//
// add_action( 'save_post', 'set_primary_on_publish', 10, 2 );
// add_action( 'edit', 'set_primary_on_publish', 10, 2 );
// add_action( 'wp_insert_post', 'set_primary_on_publish', 10, 2 );


// function set_post_year_on_publish ($post_ID) {
//     global $post;
//
// 				// Only set for post_type = post!
// 		 if ( 'post' !== $post->post_type ) {
// 				 return;
// 		 }
//
// 		$post_year = get_the_date('Y',$post->ID);
// 		$term_id = term_exists( $post_year, 'post_year' );
//
//
// 		if (!empty($term_id)) {
// 			$post_id = $post->ID;
// 			$category_id = $term_id['term_id'];
// 			$taxonomy = 'post_year';
//
// 			wp_set_object_terms( $post_id, intval( $category_id ), $taxonomy );
// 		}
// 		else {
// 				$term_id =  wp_insert_term(
// 					$post_year,
// 					'post_year',
// 					array(
// 						'description' => '',
// 						'slug'        => $post_year
// 					)
// 			);
//
// 			$post_id = get_the_ID();
// 			$category_id = $term_id['term_id'];
// 			$taxonomy = 'post_year';
//
// 			wp_set_object_terms( $post_id, intval( $category_id ), $taxonomy );
// 		}
//
// }
//
// add_action( 'save_post', 'set_post_year_on_publish', 10, 2 );
// add_action( 'edit', 'set_post_year_on_publish', 10, 2 );
// add_action( 'wp_insert_post', 'set_post_year_on_publish', 10, 2 );



// function yp_add_year(){
//
//   if ($_GET['run'] == 1) {
//
//     $args = array(
//     'post_type' => array( 'post'),
//     'posts_per_page'  =>  300,
//      // 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
//     'orderby'    => 'date',
//     'order'    => 'DESC'
//     );
//                 // $args['search_filter_id'] = 3567;
//     query_posts( $args );
//
//     while ( have_posts() ) :
//       the_post();
//
//         $post_year = get_the_date('Y',get_the_ID());
//         $term_id = term_exists( $post_year, 'post_year' );
//         echo   $post_year;
//
//         if (!empty($term_id)) {
//           $post_id = get_the_ID();
//           $category_id = $term_id['term_id'];
//           $taxonomy = 'post_year';
//
//           wp_set_object_terms( $post_id, intval( $category_id ), $taxonomy );
//         }
//         else {
//             $term_id =  wp_insert_term(
//               $post_year,
//               'post_year',
//               array(
//                 'description' => '',
//                 'slug'        => $post_year
//               )
//           );
//
//           $post_id = get_the_ID();
//           $category_id = $term_id['term_id'];
//           $taxonomy = 'post_year';
//
//           wp_set_object_terms( $post_id, intval( $category_id ), $taxonomy );
//         }
//     endwhile;
//
//   }
//
// }
// add_action('init','yp_add_year');




function set_front_page_template() {
	$screen = get_current_screen();
	if (strpos($screen->id, "theme-general-settings") == true) {

		$values = $_POST['acf']['field_61c4896edaa1b'];

    if( isset($values) ) {
			if ($values == 'one') {
        $page = get_page_by_path('main-1');
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
          }
       }
			if ($values == 'two') {
        $page = get_page_by_path('main-2');
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
          }
       }
			if ($values == 'three') {
        $page = get_page_by_path('main-3');
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
          }
       }
			if ($values == 'four') {
        $page = get_page_by_path('sub-1');
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
          }
       }
			if ($values == 'five') {
        $page = get_page_by_path('sub-2');
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
			   }
      }
			if ($values == 'six') {
        $page = get_page_by_path('sub-3');
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
        }
     }
			update_option( 'show_on_front', 'page' );
    }
	}
}
add_action('acf/save_post', 'set_front_page_template', 20);



//Save our extra registration user meta.
// add_action('init', 'save_edit_profile_yp');
// function save_edit_profile_yp () {
//
//
// 	if (isset( $_POST['act_eProfile_ID'] )) {
//
// 		$user_id = $_POST['act_eProfile_ID'];
//
// 		if (isset( $_POST['first_name'] )) {
// 		  update_user_meta($user_id, 'first_name', $_POST['first_name']);
// 		}
//
// 		if (isset( $_POST['last_name'] )) {
// 			update_user_meta($user_id, 'last_name', $_POST['last_name']);
// 		}
//
// 		if (isset( $_POST['user_email'] )) {
// 			update_user_meta($user_id, 'user_email', $_POST['user_email']);
// 		}
//
// 		if (isset( $_POST['acf'] )) {
// 		update_field('field_617faf150d8af', $_POST['acf']['field_617faf150d8af'], 'user_'.$user_id);
// 		}
//
// 		if ($_POST['confirm_password'] != '' && $_POST['user_password'] != '') {
// 			wp_set_password( $_POST['confirm_password'], $user_id );
// 		}
//
// 		wp_redirect(home_url('/edit-profile?update=true#message'));
// 		exit();
// 	}
//
//
// 	// wp_set_password( 'd%FxL#DG6Xv4td!', 1 );
// }


	add_filter( 'single_template','single_poll_template2',9999);

	function single_poll_template2( $single_template ) {

		$original_template = $single_template;

		if ( is_singular( 'poll' ) ) {
			$single_template =   get_template_directory().'/wp-poll/templates/single-poll.php';
		}

		return apply_filters( 'wpp_filters_single_poll_template', $single_template, $original_template );
	}


  function yp_text($text_th,$text_eng){
    if (get_locale() == 'th') {
      echo $text_th;
    }
    if (get_locale() != 'th') {
      echo $text_eng;
    }

  }

  function yp_text_get($text_th,$text_eng){
    if (get_locale() == 'th') {
        $text_th;
    }
    if (get_locale() != 'th') {
       $text_eng;
    }
  }


add_action( 'admin_enqueue_scripts', 'yp_load_admin_styles' );
function yp_load_admin_styles() {
  wp_enqueue_script( 'admin_script_yp', get_template_directory_uri() . '/js/admin_script_yp.js', false, '1.0.0' );
  wp_enqueue_style( 'admin_css_yp', get_template_directory_uri() . '/css/admin_css_yp.css', false, '1.0.0' );
}






 add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
 function prefix_disable_gutenberg($current_status, $post_type)
 {
     // Use your post type key instead of 'product'
     // if ($post_type != 'vc_photo')

     return false;
     return $current_status;
 }





function add_single_event(){
?>
<div class="row yp-breadcrumb">
  <div class="col-md-8">
    <?php if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
} ?>
  </div>
</div>
<?php
}
add_action('mec_before_main_content','add_single_event');







//  function um_feed_setting_add_tab( $tabs ) {
//  	$tabs[ 'feed_setting' ] = array(
//  		'name'   => 'ตั้งค่าสมัครรับข้อมูล',
//  		'icon'   => 'um-faicon-pencil',
//  		'custom' => true
//  	);
// 	// if (um_is_myprofile()) {
//  	UM()->options()->options[ 'profile_tab_' . 'feed_setting' ] = true;
// 	// }
//
//  	return $tabs;
//
// }
//
//  add_filter( 'um_profile_tabs', 'um_feed_setting_add_tab', 1000 );





if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function is_elementor() {
	if ( function_exists( 'elementor_load_plugin_textdomain' ) )
	{
	    global $post;
	    // return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
      // return \Elementor\Plugin::$instance->documents->get( $post->ID )->is_built_with_elementor();
      if (!empty($post->ID)) {
        return Elementor\Plugin::$instance->documents->get( $post->ID )->is_built_with_elementor();
      }
      // Elementor\Plugin::instance()->db->is_built_with_elementor( $post->ID  );
	}
}
// add_action( 'init', 'is_elementor' );


function rocket_lazyload_exclude_class( $attributes ) {
	$attributes[] = 'class="custom-logo"';
	return $attributes;
}
add_filter( 'rocket_lazyload_excluded_attributes', 'rocket_lazyload_exclude_class' );

function add_head_style(){
  ?>
  <!-- yp style -->
  <style media="screen">


  @media (min-width: 1200px) {
    .elementor-section.elementor-section-boxed > .elementor-container ,.v-container{
        max-width: 1180px;
    }
    .applist-wrap .wrap-in .ob1 h3 {
    font-size: 28px;
    }
  }
  @media (min-width: 1400px) {
    .elementor-section.elementor-section-boxed > .elementor-container,.v-container {
        max-width: 1280px;
    }
    .applist-wrap .wrap-in .ob1 h3 {
    font-size: 35px;
    }
  }

  table.rwd-table h4 {
      line-height: 22px;
          margin-bottom: 4px;
  }
  </style>
    <link rel='stylesheet' id='vc-fontawesome-solid-2' href='<?php echo site_url(); ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css' media='all' />
  <link rel='stylesheet' id='vc-fontawesome-2' href='<?php echo site_url(); ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css' media='all' />

  <?php if ($_GET['_sft_company']): ?>
    <style media="screen">
      li.sf-field-category{display: none!important;}
    </style>
  <?php endif; ?>
  <?php
}
add_action('wp_head','add_head_style');

add_action('wp_head', function() { echo '<script type="text/javascript"> if (typeof(wp) == "undefined") { window.wp = { i18n: { setLocaleData: (function() { return false; })} }; } </script>'; });

function vecular_prefix_menu_arrow($item_output, $item, $depth, $args) {
		if (in_array('menu-item-has-children', $item->classes)) {
				$arrow = '<div class="wrap-toggle-mobile"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg></div>'; // Change the class to your font icon
				$item_output = str_replace('</a>', '</a>'. $arrow .'', $item_output);
		}
		return $item_output;
}
add_filter('walker_nav_menu_start_el', 'vecular_prefix_menu_arrow', 10, 4);


if ( ! function_exists( 'fluffy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fluffy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fluffy, use a find and replace
		 * to change 'fluffy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fluffy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'fluffy' ),
        'menu-topbar' => esc_html__( 'Top Bar', 'fluffy' ),
				'mobile' => esc_html__( 'Mobile Menu', 'fluffy' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'fluffy_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'fluffy_setup' );





/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fluffy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fluffy_content_width', 640 );
}
add_action( 'after_setup_theme', 'fluffy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fluffy_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fluffy' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fluffy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

  register_sidebar(
    array(
      'name'          => esc_html__( 'Footer Widget 1', 'fluffy' ),
      'id'            => 'footer-widget-1',
      'description'   => esc_html__( 'Add widgets here.', 'fluffy' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );

  register_sidebar(
    array(
      'name'          => esc_html__( 'Footer Widget 2', 'fluffy' ),
      'id'            => 'footer-widget-2',
      'description'   => esc_html__( 'Add widgets here.', 'fluffy' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );

  register_sidebar(
    array(
      'name'          => esc_html__( 'Footer Widget 3', 'fluffy' ),
      'id'            => 'footer-widget-3',
      'description'   => esc_html__( 'Add widgets here.', 'fluffy' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );

  register_sidebar(
    array(
      'name'          => esc_html__( 'Footer Widget 4', 'fluffy' ),
      'id'            => 'footer-widget-4',
      'description'   => esc_html__( 'Add widgets here.', 'fluffy' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );

  register_sidebar(
    array(
      'name'          => esc_html__( 'Footer Widget 5', 'fluffy' ),
      'id'            => 'footer-widget-5',
      'description'   => esc_html__( 'Add widgets here.', 'fluffy' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    )
  );


}
add_action( 'widgets_init', 'fluffy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fluffy_scripts() {
	// wp_enqueue_script( 'yp_chart', get_template_directory_uri() . '/js/chart.js','','',true );

	wp_enqueue_style( 'fluffy-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fluffy-style', 'rtl', 'replace' );
	wp_enqueue_style( 'fluffy-main', get_template_directory_uri(). '/css/main.css', array(), _S_VERSION );
	wp_enqueue_style( 'fluffy-child-style', get_template_directory_uri(). '/css/child-style.css', array(), _S_VERSION );
	wp_enqueue_script( 'jsxp-script', get_template_directory_uri() . '/js/style.js', array('jquery'), true );
	wp_enqueue_script( 'vecular-script', get_template_directory_uri() . '/js/vecular.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_style( 'sarabun-font', get_template_directory_uri(). '/fonts/sarabun/stylesheet.css', array(), _S_VERSION );
  wp_enqueue_script( 'wow-script', get_template_directory_uri() . '/js/wow.min.js', _S_VERSION, true );
  wp_enqueue_style( 'animated-style', get_template_directory_uri(). '/css/animate.min.css', array(), _S_VERSION );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fluffy_scripts' );


function get_excerpt($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    // $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">'.esc_html__( 'Read More', 'fluffy' ).'</a>';
		  $excerpt = $excerpt.'...';
    return $excerpt;
}




//
//
//
// new yp_featured_post;
//  class yp_featured_post {
//  	private $config = '{"title":"ปักหมุด","prefix":"yp_featured_post_key_","domain":"vc-core","class_name":"yp_featured_post","post-type":["post"],"context":"side","priority":"high","cpt":"post","fields":[{"type":"checkbox","label":"ปักหมุด","id":"yp_featured_post"}]}';
//  	public function __construct() {
//  		$this->config = json_decode( $this->config, true );
//  		$this->process_cpts();
//
//  		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
//  		add_action( 'admin_head', [ $this, 'admin_head' ] );
//     add_action( 'save_post', [ $this, 'save_post' ] );
//  	}
//  	public function process_cpts() {
//  		if ( !empty( $this->config['cpt'] ) ) {
//  			if ( empty( $this->config['post-type'] ) ) {
//  				$this->config['post-type'] = [];
//  			}
//  			$parts = explode( ',', $this->config['cpt'] );
//  			$parts = array_map( 'trim', $parts );
//  			$this->config['post-type'] = array_merge( $this->config['post-type'], $parts );
//  		}
//  	}
//
//  	public function add_meta_boxes() {
//  		foreach ( $this->config['post-type'] as $screen ) {
//  			add_meta_box(
//  				sanitize_title( $this->config['title'] ),
//  				$this->config['title'],
//  				[ $this, 'add_meta_box_callback' ],
//  				$screen,
//  				$this->config['context'],
//  				$this->config['priority']
//  			);
//  		}
//  	}
//
//  	public function admin_head() {
//  		global $typenow;
//  		if ( in_array( $typenow, $this->config['post-type'] ) ) {
//  			><?php
//  		}
//  	}
//
//  	public function save_post( $post_id ) {
//     // Do nothing during a bulk edit
//        if (isset($_REQUEST['bulk_edit']))
//            return;
//
//
//         if (!isset($_POST['_inline_edit'])) {
//
//           foreach ( $this->config['fields'] as $field ) {
//             switch ( $field['type'] ) {
//               case 'checkbox':
//                 update_post_meta( $post_id, $field['id'], isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : '' );
//                 break;
//               default:
//                 if ( isset( $_POST[ $field['id'] ] ) ) {
//                   $sanitized = sanitize_text_field( $_POST[ $field['id'] ] );
//                   update_post_meta( $post_id, $field['id'], $sanitized );
//                 }
//             }
//           }
//
//         }
//
//
//  	}
//
//  	public function add_meta_box_callback() {
//  		$this->fields_div();
//  	}
//
//  	private function fields_div() {
//  		foreach ( $this->config['fields'] as $field ) {
//  			><div class="components-base-control">
//  				<div class="components-base-control__field"><?php
//  					$this->field( $field );
//            $this->label( $field );
//            // echo get_post_meta( 3280, 'yp_featured_post',true);x
//  				></div>
//  			</div><?php
//  		}
//  	}
//
//  	private function label( $field ) {
//  		switch ( $field['type'] ) {
//  			default:
//  				printf(
//  					'<label class="components-base-control__label" for="%s">%s</label>',
//  					$field['id'], $field['label']
//  				);
//  		}
//  	}
//
//  	private function field( $field ) {
//  		switch ( $field['type'] ) {
//  			case 'checkbox':
//  				$this->checkbox( $field );
//  				break;
//  			default:
//  				$this->input( $field );
//  		}
//  	}
//
//  	private function checkbox( $field ) {
//  		printf(
//  			'<label class="rwp-checkbox-label"><input %s id="%s" name="%s" type="checkbox"> %s</label>',
//  			$this->checked( $field ),
//  			$field['id'], $field['id'],
//  			isset( $field['description'] ) ? $field['description'] : ''
//  		);
//  	}
//
//  	private function input( $field ) {
//  		printf(
//  			'<input class="components-text-control__input %s" id="%s" name="%s" %s type="%s" value="%s">',
//  			isset( $field['class'] ) ? $field['class'] : '',
//  			$field['id'], $field['id'],
//  			isset( $field['pattern'] ) ? "pattern='{$field['pattern']}'" : '',
//  			$field['type'],
//  			$this->value( $field )
//  		);
//  	}
//
//  	private function value( $field ) {
//  		global $post;
//  		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
//  			$value = get_post_meta( $post->ID, $field['id'], true );
//  		} else if ( isset( $field['default'] ) ) {
//  			$value = $field['default'];
//  		} else {
//  			return '';
//  		}
//  		return str_replace( '\u0027', "'", $value );
//  	}
//
//  	private function checked( $field ) {
//  		global $post;
//  		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
//  			$value = get_post_meta( $post->ID, $field['id'], true );
//  			if ( $value === 'on' ) {
//  				return 'checked';
//  			}
//  			return '';
//  		} else if ( isset( $field['checked'] ) ) {
//  			return 'checked';
//  		}
//  		return '';
//  	}
//  }
//  new yp_featured_post;


// Enable media_library_infinite_scrolling
class Enable_Media_Library_Infinite_Scrolling {
	public function __construct() {
		$this->add_hooks();
	}
	public function add_hooks() {
		add_filter( 'media_library_infinite_scrolling', '__return_true' );
	}
}
new Enable_Media_Library_Infinite_Scrolling();

 // Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/customize.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



add_filter('acf/settings/save_json', 'yp_acf_json_save_point');

function yp_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/acf-json';

    // return
    return $path;

}



add_filter('acf/settings/load_json', 'yp_acf_json_load_point');

function yp_acf_json_load_point( $paths ) {

   // remove original path (optional)
   unset($paths[0]);


   // append path
   $paths[] = get_stylesheet_directory() . '/acf-json';


   // return
   return $paths;

}


add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

add_filter( 'big_image_size_threshold', '__return_false' );


function yp_html_capability_add( $caps, $cap, $user_id ) {
	if ( 'unfiltered_html' === $cap ) {
		$caps = array( 'unfiltered_html' );
	}
	return $caps;
}
add_filter( 'map_meta_cap', 'yp_html_capability_add', 1, 3 );



function mec_redirect_1() {
  if (!empty($_GET['page'])) {
    if ( 'mec-intro' === $_GET['page'] ) {
      wp_redirect( get_option('siteurl') . '/wp-admin/' . 'edit.php?post_type=mec-events' );
   }
  }
}
add_action( 'admin_init', 'mec_redirect_1' );
