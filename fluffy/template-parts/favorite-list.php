        <article class="card-today">
          <a class="link-all" target="_blank" href="<?php the_permalink(); ?>"></a>
          <div class="grid-column">
            <div class="grid-list-1">
              <h4><?php the_title(); ?></h4>
              <p>
                <!-- <span class="first-date">02/10/2556</span> -->
                <span class="last-date">
                  <?php
                    // echo date("d/m/Y", strtotime(get_the_date()));
                    echo get_the_date();
                   ?>
                </span>
              </p>
            </div>
            <div class="grid-list-2">
              <!-- <span class="checkbox-today check-pass"></span> -->
              <!-- <span class="checkbox-today"></span> -->
            </div>
          </div>
        </article>
