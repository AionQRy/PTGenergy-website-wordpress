<?php if ($hide_btn == 1): ?>
  <style media="screen">
    .vc_load_more{
      display: none!important;
    }
  </style>
<?php endif; ?>
<div class="wrap-people">
  <?php
  foreach ($all_user_com as $user):
      // $user = get_user_by('id', $value->ID);
      // $user_id = $user->ID;

      // $first_name = get_user_meta( $user_id, 'first_name', true );
      // $last_name = get_user_meta( $user_id, 'last_name', true );
      //
      // $empid = get_field('empid','user_'.$user_id);
      // $email = $user->user_email;
      // $work_started = get_field('work_started','user_'.$user_id);
      // $departement = get_field('departement','user_'.$user_id);
      // $u_position = get_field('u_position','user_'.$user_id);
      // $section_name = get_field('section_name','user_'.$user_id);

      $first_name = $user->nameFirstT;
      $last_name = $user->nameLastT;

      $empid = $user->codEmpId;
      $email = $user->email;
      if (empty($email)) {
        $email = $user->emailPerson;
      }

      $work_started = date('d/m', strtotime($user->dteEmpMt));
    	$work_started_y = date('Y', strtotime($user->dteEmpMt))+543;
    	$work_started = $work_started.'/'.$work_started_y;

      $departement = $user->departmentName;
      $u_position = $user->namePosT;
      $section_name = $user->sectionName;
    ?>
    <div class="item-employ">
              <!-- <a href="#" class="link-all"></a> -->
      <div class="profile">
        <img src="https://ptg-portal.com/employees-image/<?php
        $empid2 = sprintf("%08d", $empid); echo $empid2;?>.jpg" onerror="this.onerror=null;this.src='<?php echo site_url(); ?>/wp-content/themes/fluffy/img/user-thumb.jpg';" alt="employ-<?php echo $empid; ?>"/>
      </div>
      <div class="info e-<?php echo $empid2; ?>">
          <h4><?php echo $first_name.' '.$last_name; ?></h4>
          <h5>
          <?php if ($user->namePosT != '') { echo $user->namePosT; } else { echo "-"; } ?>
          </h5>
          <ul>
            <li><strong>รหัสผนักงาน</strong> : <?php if (!empty($empid)) { echo $empid; } else { echo "-"; } ?></li>
            <li><strong>อีเมล</strong> : <?php if (!empty($user->email)) { echo $user->email; } else { echo $user->emailPerson; } ?></li>
            <li><strong>บริษัท</strong> : <?php if ($user->nameComp != '') { echo $user->nameComp; } else { echo "-"; } ?></li>
            <li><strong>ฝ่าย</strong> : <?php if ($user->departmentName != '') { echo $user->departmentName; } else { echo "-"; } ?></li>
            <li><strong>ส่วน</strong> : <?php if ($user->sectionName != '') { echo $user->sectionName; } else { echo "-"; } ?></li>
            <li><strong>แผนก</strong> : <?php if ($user->divisionName != '') { echo $user->divisionName; } else { echo "-"; } ?></li>
            <li><strong>สาขา</strong> : <?php if ($user->subDivisionName != '') { echo $user->subDivisionName; } else { echo "-"; } ?></li>
          </ul>
      </div>
    </div>

  <?php endforeach; ?>


</div>
