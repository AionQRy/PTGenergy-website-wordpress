<?php
// $key = "C121AE44D47DBB51A22EC6BAA6F682881A6E3D36DD97569BC2E0223AD62D8986";
// $iv  = "DB7C0580855D198B87EB2DE78B71B7B5";
//
// $employee_id = "520163";
// $user_password = "dikmeeDikm33";
//
// $keyBase64 = hex_to_base64($key);
// $ivBase64  = hex_to_base64($iv);
//
// $json = '{
//    "realmName": "PTGroup",
//    "appCode": "EPPT",
//    "username": "'.$employee_id.'",
//    "password": "'.$user_password.'"
// }';
//
// $plainText = $json;
// $algor = "aes-256-cbc";
// $POSTFIELDS = base64_encode(openssl_encrypt($plainText, $algor, base64_decode($keyBase64), OPENSSL_RAW_DATA, base64_decode($ivBase64)));
//
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
//   CURLOPT_POSTFIELDS => $POSTFIELDS,
//   CURLOPT_HTTPHEADER => array(
//     'accept: application/json;charset=UTF-8',
//     'Authorization: Basic cHJvQWRtaW46N0pCdE54YklkNnZaQWlGQw==',
//     'req-key: 99b659a2939d42a49978709b6ee46050',
//     'Cookie: ApplicationGatewayAffinity=22e2bb0671199705d3b9eec4be222429; ApplicationGatewayAffinityCORS=22e2bb0671199705d3b9eec4be222429',
//     'Content-Type: application/json'
//   ),
// ));
//
// $response = curl_exec($curl);
// curl_close($curl);
//
//
// // print_r($response);
//
//
// $JSON = json_decode($response);
// $JSON = json_decode($JSON->body);
// $token = $JSON->access_token;
// $token = str_replace("-","+",$token);
// $token = str_replace("_","+",$token);
//
// $token = explode(".",$token);
//
// $header = base64_decode($token[0]);
// $payload = base64_decode($token[1]);
// $signature = base64_decode($token[2]);
//
// $data = json_decode($payload);

// print_r($data);
// echo "string";

?>

<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/css/flatpickr.min.css">
<script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/js/flatpickr.js"></script>

<div class="wrap-add-request kanit-font">
  <div class="col-md-12">
    <div class="card">
        <div class="card-body p-4">
          <div class="user_form">
            <h4>ยื่นคำร้องประกาศ</h4>
            <!-- <php
            date_default_timezone_set("Asia/Bangkok");

            $todatDate = date('Y-m-d H:i:s');
            $todatDate = date('Y-m-d H:i:s', strtotime($todatDate));
            $post_start = '31/10/2022';
            $post_start = str_replace('/', '-', $post_start );
            $post_start = date("Y-m-d", strtotime($post_start));

            $todatChk = date('Y-m-d');
            $todatChk = date('Y-m-d', strtotime($todatChk));
              // $date1 = new DateTime($todatChk);
              //  $date2 = new DateTime("2022-10-31");
              //  $interval = $date1->diff($date2);
              //  echo $interval->d;

            $day = date('w');
            $friday = date('Y-m-d 11:59:59', strtotime('+'.(5-$day).' days'));
            $friday_next = date('Y-m-d', strtotime('+'.(12-$day).' days'));

            $monday_next_week = date('d/m/Y', strtotime('+'.(15-$day).' days'));
            $tuesday_next_week = date('d/m/Y', strtotime('+'.(16-$day).' days'));
            // $wednesday_next_week = date('d/m/Y', strtotime('+'.(17-$day).' days'));
            $thursday_next_week = date('d/m/Y', strtotime('+'.(18-$day).' days'));
            // $friday_next_week = date('d/m/Y', strtotime('+'.(19-$day).' days'));
            $category = get_field('reCat',84951);


            if ($todatDate > $friday && $post_start <= $friday_next) {
              if ($category['value'] == 'cat_01' || $category['value'] == 'cat_02' ) {
                update_field('reDate_start',$monday_next_week,84951);
              }
              if ($category['value'] == 'cat_03' || $category['value'] == 'cat_04' ) {
                update_field('reDate_start',$tuesday_next_week,84951);
              }
              if ($category['value'] == 'cat_05' || $category['value'] == 'cat_06' ) {
                update_field('reDate_start',$thursday_next_week,84951);
              }
            }
             > -->
              <?php
              if (get_current_blog_id() == 1) {
                $form_id = 10;
                echo do_shortcode('[fluentform id="10"]');
              }
              else {
                $form_id = 4;
                echo do_shortcode('[fluentform id="4"]');
              }
               ?>
          </div>
        </div>
      </div>
  </div>
</div>
<style media="screen">
.file_work span.rea_s {
  display: inline;
  color: #f56c6c;
}
/* #page .file_work input {
    display: block!important;
    width: 100%!important;
    height: 25px!important;
    position: relative!important;
    font-size: 12px;
    padding: 0!important;
    border-radius: 0!important;
}
#page .file_work .ff_upload_btn.ff-btn{
  display: none;
} */
</style>
<script type="text/javascript">
  jQuery(document).ready(function($) {

            window.fluent_form_ff_form_instance_<?php echo $form_id; ?>_1 = {"id":"<?php echo $form_id; ?>","settings":{"layout":{"labelPlacement":"top","helpMessagePlacement":"with_label","errorMessagePlacement":"inline","asteriskPlacement":"asterisk-right"},"restrictions":{"denyEmptySubmission":{"enabled":false}}},"form_instance":"ff_form_instance_<?php echo $form_id; ?>_1","form_id_selector":"fluentform_<?php echo $form_id; ?>","rules":{"reCat":{"required":{"value":true,"message":"This field is required"}},"reSubject":{"required":{"value":true,"message":"This field is required"}},"reObj":{"required":{"value":true,"message":"This field is required"}},"reDetail":{"required":{"value":true,"message":"This field is required"}},"reDate_start":{"required":{"value":true,"message":"This field is required"}},"reDate_end":{"required":{"value":true,"message":"This field is required"}},"reChannel":{"required":{"value":true,"message":"This field is required"}},"er_box":{"required":{"value":true,"message":"This field is required"}},"file_work":{"required":{"value":true,"message":"This field is required"},"max_file_size":{"value":10485760,"_valueFrom":"MB","message":"Maximum file size limit is 20MB"},"max_file_count":{"value":1,"message":"You can upload maximum 1 file"},"allowed_file_types":{"value":["avi|divx|flv|mov|ogv|mkv|mp4|m4v|divx|mpg|mpeg|mpe|video\/quicktime|qt","pdf","doc|ppt|pps|xls|mdb|docx|xlsx|pptx|odt|odp|ods|odg|odc|odb|odf|rtf|txt","jpg|jpeg|gif|png|bmp","mp3|wav|ogg|oga|wma|mka|m4a|ra|mid|midi|mpga","exe","zip|gz|gzip|rar|7z"],"message":"Invalid file type"}},"reDetailUser":{"required":{"value":false,"message":"This field is required"}}},"conditionals":{"ff_cn_id_1":{"type":"any","status":true,"conditions":[{"field":"reCat","value":"","operator":"!="}]},"reDate_start":{"conditions":[],"status":false,"type":"any","container_condition":{"type":"any","status":true,"conditions":[{"field":"reCat","value":"","operator":"!="}]}},"reDate_end":{"conditions":[],"status":false,"type":"any","container_condition":{"type":"any","status":true,"conditions":[{"field":"reCat","value":"","operator":"!="}]}},"er_box":{"type":"any","status":true,"conditions":[{"field":"reChannel","value":"Email","operator":"="}]}}};


    // $('.file_work input').attr('required', true);
  });
</script>

<script src="<?php echo get_template_directory_uri(); ?>/request-content/config-date.js"></script>
