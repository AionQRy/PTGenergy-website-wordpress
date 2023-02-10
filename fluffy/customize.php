<?php
function app_grid(){

    ob_start();

    $key = "C121AE44D47DBB51A22EC6BAA6F682881A6E3D36DD97569BC2E0223AD62D8986";
  	$iv  = "DB7C0580855D198B87EB2DE78B71B7B5";

    /////login
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
  		CURLOPT_POSTFIELDS => get_field('user_postfields','user_'.get_current_user_id()),
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

    if ($JSON->statusCode != 'ok' && $JSON->statusCodeValue != '200') {
  		wp_logout();
  	}

  	$JSON = json_decode($JSON->body);
  	$token = $JSON->access_token;
    $token = str_replace("_","/",$token);
    $token = str_replace("-","+",$token);

  	$token = explode(".",$token);

  	$header = base64_decode($token[0]);
  	$payload = base64_decode($token[1]);
  	$signature = base64_decode($token[2]);

  	$data = json_decode($payload);
    $realmAccess = $data->realm_access->roles;
  	if (!empty(	$realmAccess )) {
  		$realmAccess = implode( ',', $realmAccess );
  		$realmAccess = str_replace(",",'","',$realmAccess);
  		$realmAccess = '"'.$realmAccess.'"';
  	}
  	//////


  	$keyBase64 = hex_to_base64($key);
  	$ivBase64  = hex_to_base64($iv);
    $empid = get_field('empid','user_'.get_current_user_id());

  	// $plainText = '{"realmName":"PTGroup","userName":"'.$empid.'","realmAccess":["PCCA","HRIS","offline_access"]}';
    $plainText = '{"realmName":"PTGroup","userName":"'.$empid.'",  "realmAccess": ['.$realmAccess.']}';

    $algor = "aes-256-cbc";
    $cipher = base64_encode(openssl_encrypt($plainText, $algor, base64_decode($keyBase64), OPENSSL_RAW_DATA, base64_decode($ivBase64)));
    // echo $cipher;

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://ptg-apim-services.pt.co.th/prd-provisioning/keycloak/api/findRealmRoleAttributes',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $cipher,
      CURLOPT_HTTPHEADER => array(
        'accept: application/json;charset=UTF-8',
        'Authorization: Basic cHJvQWRtaW46N0pCdE54YklkNnZaQWlGQw==',
        'req-key: 99b659a2939d42a49978709b6ee46050',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $json = json_decode($response);

      //echo base64_encode(openssl_encrypt($plainText, $algor, base64_decode($keyBase64), OPENSSL_RAW_DATA, base64_decode($ivBase64)));
      // echo "\n Encrypt Text ... \n";
      // echo $cipher;
      //
      // echo "\n Decrypt Text ... \n";
      // $cipher = 'gKGZoJycApF39FNi1ripw8LBIoMMzeGT4dAaZhLYhMQxBuTKffZDTUlSBdoEbc4MG3BmvQcn+jNb1ESxf7K0gICqyH+UXlUjkw5C/0g38AiXnFjN5fbic6Fg5mx6wldzMIS22gKdqXq3DBPM8Fmb4APHqF2cGNu9UoJWN/GMf2M=';
      $decryptText =  openssl_decrypt(base64_decode($json->body), $algor, base64_decode($keyBase64), OPENSSL_RAW_DATA, base64_decode($ivBase64));
      $app_list = json_decode($decryptText);
      // print_r($app_list);
   ?>
      <div class="yp-row applist-wrap  theme-<?php echo get_field('setting_theme', 'option'); ?> applist-grid">
     <div class="x-container">
      <div class="wrap-in">

       <div class="ob2">
        <div class="carousel_applist appgrid">

            <div class="appgrid-post">
           <?php if (!empty($app_list)) : ?>
            <?php
                     $i = 0;
                 $link_img = '';
                 foreach ($app_list as $value):
                     $i++;

                     foreach ($value->roleAttributes as $item) {
                     $link_img = $link_img.$item->value.'*';
                     }
                       $link_img = explode("*",$link_img);
                       $link_app = str_replace("Array","",$link_img[0]);
                       // echo $link_app;
                     ?>
                     <div class="item-quick-links swiper-slide">

                         <a href="<?php echo $link_app; ?>" target="_blank">
                           <div class="thumbnail-link">
                              <?php
                              $curl_svg = curl_init();
                                curl_setopt_array($curl_svg, array(
                                  CURLOPT_URL => $link_img[1],
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => '',
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 0,
                                  CURLOPT_FOLLOWLOCATION => true,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => 'GET',
                                ));

                                $response = curl_exec($curl_svg);

                                curl_close($curl_svg);
                                if (!empty($response)) {
                                  if (str_contains($response, 'Error')) {
                                    ?>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 134 127" style="enable-background:new 0 0 134 127;" xml:space="preserve">
                                  <style type="text/css">
                                    .st0{fill:#39B54A;}
                                  </style>
                                  <g>
                                    <g>
                                      <path class="st0" d="M40.4,41.1c-8.1,0-14.7,6.6-14.7,14.7s6.6,14.7,14.7,14.7c5.3,0,9.9-2.8,12.5-7c-2-3.3-4.7-9.3-1.6-17.5
                                        C48.7,43,44.8,41.1,40.4,41.1z"></path>
                                      <path class="st0" d="M50.5,68.4c-0.2,0.1-0.4,0.3-0.6,0.5c-1.4,3.8-5.1,6.5-9.4,6.5s-8-2.8-9.5-6.6c-0.5-0.3-0.8-0.6-1-0.8
                                        c-0.1-0.1-0.2-0.1-0.2-0.2l-0.1,0.1c-9.1,7.9-9,21.7-9,22.3v0.5h23.2c0.4-5.4,1.9-14.9,8.3-21.9c-0.5-0.4-0.9-0.7-1.1-0.9
                                        c-0.1,0.1-0.3,0.2-0.4,0.3C50.6,68.2,50.6,68.3,50.5,68.4z"></path>
                                    </g>
                                    <g>
                                      <path class="st0" d="M80.6,67.3c-0.1,0.1-0.3,0.3-0.4,0.4s-0.1,0.1-0.2,0.2c-1.4,1.1-4.7,3.3-9.1,4C70.4,72,70,72,69.6,72
                                        s-0.7,0-1.1,0c-1.4,0-2.7-0.2-4-0.5c-4-1-7.1-3.4-8-4.2c-0.1-0.1-0.2-0.1-0.3-0.2L56,67.4c-10.4,9-10.3,24.8-10.3,25.5v0.6h44.7
                                        v-0.6C89.7,74.6,82.4,68.6,80.6,67.3z M74.4,79.7l-6.3-3.2l-6.3,3.2v-7.8l6.3,3.4l6.3-3.4V79.7z"></path>
                                    </g>
                                    <g>
                                      <g>
                                        <path class="st0" d="M51.7,53.3c0,9.3,7.5,16.8,16.8,16.8l0,0c4.5,0,8.7-1.8,11.9-4.9c3.2-3.2,4.9-7.4,4.9-11.9
                                          c0-9.3-7.5-16.8-16.8-16.8C59.3,36.5,51.7,44,51.7,53.3z"></path>
                                      </g>
                                    </g>
                                    <path class="st0" d="M92.1,89.8h18.8v-0.4c0-0.5-0.2-12.3-8.4-19.3l-0.1-0.1c-0.3,0.2-0.5,0.5-0.8,0.7L95.9,82l-1-6.7l1.7-2.7
                                      c-1.1,0.3-2.2,0.4-3.3,0.4c-0.3,0-0.6,0-0.9,0c-0.5,0-1.1-0.1-1.6-0.2c-0.2,0-0.4-0.1-0.6-0.1l1.6,2.6l-1.1,6.3
                                      C91.6,84.8,92,87.8,92.1,89.8z"></path>
                                    <path class="st0" d="M93.8,71.2c7.3,0,13.2-5.9,13.2-13.2s-5.9-13.2-13.2-13.2c-3,0-5.7,1-7.9,2.6c0.7,1.9,1.1,3.9,1.1,6
                                      c0,4.4-1.6,8.4-4.3,11.5C85,68.8,89.1,71.2,93.8,71.2z"></path>
                                  </g>
                                  </svg>
                                    <?php
                                  }
                                  else {
                                    echo $response;
                                  }
                                }
                              ?>
                           </div>
                           <div class="title-link" x-show="open">
                             <h3><?php echo $value->roleName; ?></h3>
                           </div>
                         </a>

                     </div>
                   <?php endforeach; ?>
             <?php else: ?>
              ไม่มีข้อมูล
           <?php endif; ?>


          </div>

         </div>
       </div>
      </div>


     </div>
   </div>

   <?php
   }
   add_shortcode('app_grid', 'app_grid');


function job_grid($atts){

  	extract(shortcode_atts(array(
  		"per_posts" => -1
  	), $atts));



    $EMPID = get_field('empid','user_'.get_current_user_id()); ///// Employee ID

    // $EMPID = '10002840'; ///// Employee ID
    define('AES_256_CBC', 'aes-256-cbc');

    $key = 'YegPfmseowTdfeoAeriq4E0o6Wdktvmw';
    $iv  = '0deTdeolsBtw9sLp';

    $Jsondata = '{"userId":"'.$EMPID.'"}';

    $entityBody = $Jsondata;
    $ciphertext_raw = openssl_encrypt($entityBody, AES_256_CBC, $key, 0 , $iv);
    // $decrypted = openssl_decrypt($ciphertext_raw, AES_256_CBC, $key, 0, $iv);
    // echo 'decrypted : '.$decrypted ;

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://stationwarpad.pt.co.th/authorize/api/Authen/generateToken',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "userId": "'.$EMPID.'"
    }',
    CURLOPT_HTTPHEADER => array(
      'AuthData: '.$ciphertext_raw,
      'Content-Type: application/json',
      'Cookie: ApplicationGatewayAffinity=0980722a9a327ef3d7952444dbabbbb9; ApplicationGatewayAffinityCORS=0980722a9a327ef3d7952444dbabbbb9'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);


    $data = json_decode($response, true);
    $tokendata = $data['resultData']['accessToken'];

    $setting_theme = get_field('setting_theme', 'option');

    // if ($tokendata) {


        $Taskcurl = curl_init();
        $token = 'Bearer '.$tokendata;
        curl_setopt_array($Taskcurl, array(
        CURLOPT_URL => 'https://stationwarpad.pt.co.th/tasks/api/TrnTask/getToDoTask',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "UserId": "'.$EMPID.'"
        }',
        CURLOPT_HTTPHEADER => array(
          'authorization: '.$token,
          'Content-Type: application/json',
          'Cookie: ApplicationGatewayAffinity=0980722a9a327ef3d7952444dbabbbb9; ApplicationGatewayAffinityCORS=0980722a9a327ef3d7952444dbabbbb9'
        ),
        ));

        $Taskresponse = curl_exec($Taskcurl);

        curl_close($Taskcurl);
        // echo $Taskresponse;
        $json = json_decode($Taskresponse, true);


        if($json['resultCode'] == '40401' || $tokendata == ''){
        ?>
        <div class="vc_posts card style-1 v2 job_today job_grid">
          <div class="vc_posts-wrapper">
          <?php
            global $wpdb;
            $user_id = get_current_user_id();
            $prefix = $wpdb->prefix;
            $prefix = str_replace("_".get_current_blog_id(),"",$prefix);
            $table_view = "{$prefix}vc_post_view";
            $blog_id = get_current_blog_id();

            $most_view = $wpdb->get_results( "SELECT post_id, COUNT(*) FROM $table_view WHERE blog_id = $blog_id AND post_type = 'post' AND user_id = $user_id GROUP BY post_id ORDER BY `COUNT(*)` DESC LIMIT 2");
            $most_view = json_decode(json_encode($most_view), true);
            $most_array = array();
            foreach ($most_view as $key => $value) {
              $most_array[] = get_the_category( $value['post_id'] )[0]->term_id;
            }

            $userdata = yp_user_data_api();
            $company_name = $userdata->nameComp;
            $favorite_news = get_field('favorite_news','user_'.$user_id);
            if (!empty($favorite_news)) {
              if (!empty($company_name)) {
                $args = array(
                'post_type' => 'post',
                'tax_query' => array(
                     'relation' => 'AND',
                         array(
                           'taxonomy'  => 'category',
                           'field'     => 'term_id',
                           'terms'     => $favorite_news
                             ),
                         array(
                             'taxonomy' => 'company',
                             'field'    => 'name',
                             'terms'    => $company_name,
                             ),
                         ),
                'posts_per_page'  => $per_posts,
                'orderby'    => 'ID',
                'order'    => 'DESC'
                );
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts,
                'tax_query' => array(
                      array(
                        'taxonomy'  => 'category',
                        'field'     => 'term_id',
                        'terms'     => $favorite_news
                      )
                    ),
                    'orderby'    => 'ID',
                    'order'    => 'DESC'
                );
              }
              $query = query_posts( $args );
              if ( have_posts() )  {
                while ( have_posts() ) : the_post();
                $favorite_id[] = get_the_ID();
                require('favorite-list.php');
                endwhile;
              }
              else {

                if (!empty($company_name)) {
                  $args = array(
                  'post_type' => 'post',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'company',
                      'field'    => 'name',
                      'terms'    => $company_name,
                    )
                  ),
                  'posts_per_page'  => $per_posts,
                  'orderby'    => 'rand',
                  'order'    => 'DESC'
                  );
                }
                else {
                  $args = array(
                  'post_type' => 'post',
                  'posts_per_page'  => $per_posts,
                  'orderby'    => 'rand',
                  'order'    => 'DESC'
                  );
                }

                $query = query_posts( $args );
                if ( have_posts() )  {
                  while ( have_posts() ) : the_post();
                        $favorite_id[] = get_the_ID();
                  require('favorite-list.php');
                  endwhile;
                }
                else {
                  $args = array(
                  'post_type' => 'post',
                  'posts_per_page'  => $per_posts,
                      'orderby'    => 'rand',
                      'order'    => 'DESC'
                  );
                  $query = query_posts( $args );
                  while ( have_posts() ) : the_post();
                        $favorite_id[] = get_the_ID();
                  require('favorite-list.php');
                  endwhile;
                }


              }
            }
            else{
              if (!empty($company_name)) {
                  $args = array(
                  'post_type' => 'post',
                  'posts_per_page'  => $per_posts,
                  'orderby'    => 'rand',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'company',
                      'field'    => 'name',
                      'terms'    => $company_name,
                    )
                  ),
                  'order'    => 'DESC'
                  );
                }
                else {
                  $args = array(
                  'post_type' => 'post',
                  'posts_per_page'  => $per_posts,
                  'orderby'    => 'rand',
                  'order'    => 'DESC'
                  );
                }

                  $query = query_posts( $args );
                  while ( have_posts() ) : the_post();
                        $favorite_id[] = get_the_ID();
                    require('favorite-list.php');
                  endwhile;
            }
            wp_reset_query();
           ?>
          </div>
        </div>
        <?php
        }else{
        ?>
        <div class="vc_posts card style-1 v2 job_today">
          <div class="vc_posts-wrapper">
          <?php foreach ($json['resultData'] as $item): ?>
          <article class="card-today today-grid_card">
            <a class="link-all" target="_blank" href="<?php echo $item['Link']; ?>"></a>
            <div class="grid-column">
              <div class="grid-list-1">
                <h4><?php echo $item['TaskName']; ?></h4>
                <p><?php echo esc_attr_e( 'กำหนดส่งงาน', 'yp-core'); ?>
                  <!-- <span class="first-date">02/10/2556</span> -->
                  <span class="last-date">
                    <?php
                    $EndDate = date("d/m/Y", strtotime($item['EndDate']));
                    echo $EndDate.' '.$item['EndTime'];
                     ?>
                  </span>
                </p>
              </div>
              <div class="grid-list-2">
                <!-- <span class="checkbox-today check-pass"></span> -->
                <span class="checkbox-today"></span>
              </div>
            </div>
          </article>
  <?php endforeach; ?>
          </div>
        </div>
        <?php
        }
    // }

   }
   add_shortcode('job_grid', 'job_grid');

   function news_most_view(){
     	// extract(shortcode_atts(array(
     	// 	"per_posts" => 6
     	// ), $atts));

      $per_posts = get_field('per_posts_news_most','user_'.get_current_user_id());
      if (empty($per_posts)) {
        $per_posts = 3;
      }

      if ($per_posts == 3) {
        $per_posts_1 = 2;
        $per_posts_2 = 1;
      }

      if ($per_posts == 6) {
        $per_posts_1 = 3;
        $per_posts_2 = 3;
      }

      if ($per_posts == 9) {
        $per_posts_1 = 5;
        $per_posts_2 = 4;
      }

      if ($per_posts == 12) {
        $per_posts_1 = 6;
        $per_posts_2 = 6;
      }
      ?>
      <div class="news_most_view-title">
        <h4>ข่าวที่เกี่ยวข้องกับคุณ</h4>
        <label for="m_per_posts">
          <span>จำนวนที่แสดง</span>
        <select class="m_per_posts">
          <option <?php if ($per_posts == 3) { echo "selected"; } ?> value="3">3</option>
          <option <?php if ($per_posts == 6) { echo "selected"; } ?> value="6">6</option>
          <option <?php if ($per_posts == 9) { echo "selected"; } ?> value="9">9</option>
          <option <?php if ($per_posts == 12) { echo "selected"; } ?> value="12">12</option>
        </select>
       </label>
      </div>
      <div class="vc_posts card style-1 v2 job_today job_grid">
        <div class="vc_posts-wrapper">
        <?php
          global $wpdb;
          $user_id = get_current_user_id();
          $prefix = $wpdb->prefix;
          $prefix = str_replace("_".get_current_blog_id(),"",$prefix);
          $table_view = "{$prefix}vc_post_view";
          $blog_id = get_current_blog_id();

          $most_view = $wpdb->get_results( "SELECT post_id, COUNT(*) FROM $table_view WHERE blog_id = $blog_id AND post_type = 'post' AND user_id = $user_id GROUP BY post_id ORDER BY `COUNT(*)` DESC LIMIT 2");
          $most_view = json_decode(json_encode($most_view), true);
          $most_array = array();
          foreach ($most_view as $key => $value) {
            $most_array[] = get_the_category( $value['post_id'] )[0]->term_id;
          }

          $userdata = yp_user_data_api();
          $company_name = $userdata->nameComp;
          $favorite_news = get_field('favorite_news','user_'.$user_id);
          if (!empty($favorite_news)) {
            if (!empty($company_name)) {
              $args = array(
              'post_type' => 'post',
              'tax_query' => array(
                   'relation' => 'AND',
                       array(
                         'taxonomy'  => 'category',
                         'field'     => 'term_id',
                         'terms'     => $favorite_news
                           ),
                       array(
                           'taxonomy' => 'company',
                           'field'    => 'name',
                           'terms'    => $company_name,
                           ),
                       ),
              'posts_per_page'  => $per_posts_1,
              'orderby'    => 'ID',
              'order'    => 'DESC'
              );
            }
            else {
              $args = array(
              'post_type' => 'post',
              'posts_per_page'  => $per_posts,
              'tax_query' => array(
                    array(
                      'taxonomy'  => 'category',
                      'field'     => 'term_id',
                      'terms'     => $per_posts_1
                    )
                  ),
                  'orderby'    => 'ID',
                  'order'    => 'DESC'
              );
            }
            $query = query_posts( $args );
            if ( have_posts() )  {
              while ( have_posts() ) : the_post();
              $favorite_id[] = get_the_ID();
              require('favorite-list.php');
              endwhile;
            }
            else {

              if (!empty($company_name)) {
                $args = array(
                'post_type' => 'post',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'company',
                    'field'    => 'name',
                    'terms'    => $company_name,
                  )
                ),
                'posts_per_page'  => $per_posts_1,
                'orderby'    => 'rand',
                'order'    => 'DESC'
                );
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_1,
                'orderby'    => 'rand',
                'order'    => 'DESC'
                );
              }

              $query = query_posts( $args );
              if ( have_posts() )  {
                while ( have_posts() ) : the_post();
                      $favorite_id[] = get_the_ID();
                require('favorite-list.php');
                endwhile;
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_1,
                    'orderby'    => 'rand',
                    'order'    => 'DESC'
                );
                $query = query_posts( $args );
                while ( have_posts() ) : the_post();
                      $favorite_id[] = get_the_ID();
                require('favorite-list.php');
                endwhile;
              }


            }
          }
          else{
            if (!empty($company_name)) {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_1,
                'orderby'    => 'rand',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'company',
                    'field'    => 'name',
                    'terms'    => $company_name,
                  )
                ),
                'order'    => 'DESC'
                );
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_1,
                'orderby'    => 'rand',
                'order'    => 'DESC'
                );
              }

                $query = query_posts( $args );
                while ( have_posts() ) : the_post();
                      $favorite_id[] = get_the_ID();
                  require('favorite-list.php');
                endwhile;
          }
          wp_reset_query();


          ////


          if (!empty($most_array)) {
            if (!empty($company_name)) {
              $args = array(
              'post_type' => 'post',
              'tax_query' => array(
                   'relation' => 'AND',
                       array(
                         'taxonomy'  => 'category',
                         'field'     => 'term_id',
                         'terms'     => $most_array
                           ),
                       array(
                           'taxonomy' => 'company',
                           'field'    => 'name',
                           'terms'    => $company_name,
                           ),
                       ),
              'post__not_in' => $favorite_id,
              'posts_per_page'  => $per_posts_2,
              'orderby'    => 'ID',
              'order'    => 'DESC'
              );
            }
            else {
              $args = array(
              'post_type' => 'post',
              'posts_per_page'  => $per_posts_2,
              'post__not_in' => $favorite_id,
              'tax_query' => array(
                    array(
                      'taxonomy'  => 'category',
                      'field'     => 'term_id',
                      'terms'     => $most_array
                    )
                  ),
                  'orderby'    => 'ID',
                  'order'    => 'DESC'
              );
          }
          $query = query_posts( $args );
            if ( have_posts() )  {
              while ( have_posts() ) : the_post();
              require('favorite-list.php');
              endwhile;
            }
            else {


              if (!empty($company_name)) {
                $args = array(
                'post_type' => 'post',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'company',
                    'field'    => 'name',
                    'terms'    => $company_name,
                  )
                ),
                'post__not_in' => $favorite_id,
                'posts_per_page'  => $per_posts_2,
                'orderby'    => 'rand',
                'order'    => 'DESC'
                );
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_2,
                'orderby'    => 'rand',
                'post__not_in' => $favorite_id,
                'order'    => 'DESC'
                );
            }

              $query = query_posts( $args );
              if ( have_posts() )  {
                while ( have_posts() ) : the_post();
                require('favorite-list.php');
                endwhile;
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_2,
                'post__not_in' => $favorite_id,
                    'orderby'    => 'rand',
                    'order'    => 'DESC'
                );
                $query = query_posts( $args );
                while ( have_posts() ) : the_post();
                require('favorite-list.php');
                endwhile;
              }


            }
          }
          else{
            if (!empty($company_name)) {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_2,
                'orderby'    => 'rand',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'company',
                    'field'    => 'name',
                    'terms'    => $company_name,
                  )
                ),
                'post__not_in' => $favorite_id,
                'order'    => 'DESC'
                );
              }
              else {
                $args = array(
                'post_type' => 'post',
                'posts_per_page'  => $per_posts_2,
                'orderby'    => 'rand',
                'post__not_in' => $favorite_id,
                'order'    => 'DESC'
                );
              }

                $query = query_posts( $args );
                while ( have_posts() ) : the_post();
                  require('favorite-list.php');
                endwhile;
          }
          wp_reset_query();
         ?>
        </div>
      </div>
      <script type="text/javascript">

      jQuery(document).ready(function($) {
        $('.m_per_posts').change(function(event) {
          var per_posts = $(this).val();
          var data = {
           per_posts: per_posts,
           action: 'save_news_most_action'
         };
         $('.news_most_view-title label span').text('กำลังบันทึก...');

         jQuery.ajax({
             type: 'POST',
             url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
             data: data,
             success: function (code) {
               console.log(code);
               window.location.reload();
             }
             // dataType: 'HTML'
          });


        });
            // $('.loading').removeClass('hide');
           // console.log(submit_data);






      });
      </script>
      <?php
      }
      add_shortcode('news_most_view', 'news_most_view');
   ?>
