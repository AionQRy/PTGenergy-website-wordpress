<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */
 $poll = wpp_get_poll( get_the_ID() );
 $seriesVotes  = array_values( $poll->get_poll_reports( 'counts' ) );

 $option_name   = $poll->get_poll_options();
 $color_1 = "#fb6121";
 $color_2 = "#637895";
 $color_3 = "#dbe8f9";
 $color_4 = "#a0aec0";
 $color_5 = "#ffb739";
 $color_6 = "#d3460b";
?>
<div class="procurement-archive poll-layout style-3 v-post-loop -list">
  <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <div class="post-header">
      <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
        <img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/theme-core/theme-3/img/icon-procurement.png" alt="icon-procurement">
      </a>
    </div><!-- .entry-header -->

    <div class="post-info">
      <?php
      the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			?>
			<div class="poll-toggle" data-id="<?php echo get_the_ID(); ?>">
				<span class="btn-report">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 19h-4v-8h4v8zm6 0h-4v-18h4v18zm6 0h-4v-12h4v12zm6 0h-4v-4h4v4zm1 2h-24v2h24v-2z"/></svg>
				</span>
				<?php yp_text('รายงานผลความคิดเห็น','Feedback Report'); ?>
				<span class="btn-down">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 12 15 18 9"></polyline></svg>
				</span>
			</div>

			<div class="poll-content-toggle" data-id="<?php echo get_the_ID(); ?>">
          <div class="yp_chart_wrap">
            <canvas id="yp_chart_<?php echo get_the_ID(); ?>" class="yp_chart" width="300" height="200"></canvas>
          </div>

            <script type="text/javascript">
            jQuery(document).ready(function($) {

              let myChart = document.getElementById("yp_chart_<?php echo get_the_ID(); ?>").getContext("2d");

                let massPopChart = new Chart(myChart, {
                  type: "doughnut", // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                  data: {
                    labels: [
                      <?php
                      foreach ($option_name as $value){
                        echo '"'.$value['label'].'",';
                      }
                       ?>
                   ],
                    datasets: [
                      {
                        data: [
                          <?php
                          foreach ($seriesVotes as $value){
                            if ( $value != '0') {
                              echo $value.',';
                            }
                          }
                           ?>
                        ],
                        backgroundColor:[
                          <?php
                          $i = 0;
                          foreach ($option_name as $value){
                              $i++;
                              if ($i == 1) {
                                  echo '"'.$color_1.'",';
                              }
                              elseif ($i == 2) {
                                  echo '"'.$color_2.'",';
                              }
                              elseif ($i == 3) {
                                  echo '"'.$color_3.'",';
                              }
                              elseif ($i == 4) {
                                  echo '"'.$color_4.'",';
                              }
                              elseif ($i == 5) {
                                  echo '"'.$color_5.'",';
                              }
                              elseif ($i == 6) {
                                  echo '"'.$color_6.'",';
                              }
                          }
                           ?>
                        ],
                        borderWidth: 0,
                      },
                    ],
                  },
                  options: {
                    tooltips: {
                           enabled: false
                      },
                    layout: {
                      padding: {
                        left: 200,
                        right: 200,
                        bottom: 0,
                        top: 0,
                      },
                    },
                    cutoutPercentage: 85,
                    plugins: {
                    legend: false,
                      tooltips: false,
                      datalabels:{
                          display:false
                      },
                      outlabels: {
                        backgroundColor: "#0000",
                        lineColor:"#0000",
                         text: '%p',
                         color: '#222',
                         stretch: 20,
                           // padding: 17,
                         // padding: {
                         //     top: 50,
                         // },
                         font: {

                             resizable: true,
                             minSize: 15,

                             // maxSize: 20,
                         }
                      }
                    }
                  },

                });





            });

            </script>
						<ul class="poll-option_name">
							<?php
              $i = 0;
							foreach ($option_name as $value):
                $i++;
                if ($i == 1) {
                  $color = $color_1;
                }
                elseif ($i == 2) {
                      $color = $color_2;
                }
                elseif ($i == 3) {
                    $color = $color_3;
                }
                elseif ($i == 4) {
                    $color = $color_4;
                }
                elseif ($i == 5) {
                    $color = $color_5;
                }
                elseif ($i == 6) {
                    $color = $color_6;
                }
                ?>

								<li><span style="background:<?php echo $color; ?>;" class="pointer-circle"></span> <?php echo $value['label'];  ?></li>
							<?php endforeach; ?>
						</ul>
            <div class="clearfix"></div>
			</div>



    </div>

		<div class="post-link-btn">
			<a href="<?php the_permalink(); ?>">
				<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
				<?php yp_text('ทำแบบสอบถาม','Take a survey'); ?>
			</a>
		</div>


  </article><!-- #post-<?php the_ID(); ?> -->
</div>
