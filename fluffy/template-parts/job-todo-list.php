<?php
foreach ($json['resultData'] as $item): ?>
        <article class="card-today">
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
