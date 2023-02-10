<article class="card-today today-grid_card">
      <a class="link-all" target="_blank" href="<?php the_permalink(); ?>"></a>
      <div class="grid-column">
        <div class="grid-list-1">
          <h4><?php the_title(); ?></h4>
          <p>
            <span class="last-date">
              <?php
                echo get_the_date();
               ?>
            </span>
          </p>
        </div>
        <div class="grid-list-2">
        </div>
      </div>
    </article>
