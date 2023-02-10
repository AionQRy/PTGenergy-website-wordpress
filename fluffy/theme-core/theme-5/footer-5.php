<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fluffy
 */
?>
<footer id="footer-yp_2" class="footer footer-yp">
    <div class="main-footer">
        <div class="v-container">
            <div class="main-object-f">
                <div class="object-grid object-1 footer-address">
                    <div class="image">
                      <?php if (get_field('footer_logo','option')): ?>
                        <img src="<?php echo get_field('footer_logo','option')['url']; ?>" alt="logo-footer">
                        <?php else: ?>
                          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumb.jpg" alt="logo-footer">
                      <?php endif; ?>
                    </div>
                    <div class="detail">
                      <h5><?php the_field('company_name','option'); ?></h5>
                      <div class="wrap-address">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                          <path d="M4.8692 3.80665C7.70287 0.972978 12.2972 0.972978 15.1308 3.80665C17.9645 6.64033 17.9645 11.2347 15.1308 14.0683L14.1417 15.0466C13.4127 15.7621 12.4667 16.6821 11.3035 17.8067C10.5766 18.5095 9.42342 18.5094 8.69667 17.8065L5.78742 14.9766C5.42179 14.6176 5.11573 14.3148 4.8692 14.0683C2.03552 11.2347 2.03552 6.64033 4.8692 3.80665ZM14.2469 4.69054C11.9014 2.34501 8.09861 2.34501 5.75308 4.69054C3.40757 7.03605 3.40757 10.8389 5.75308 13.1844L6.99231 14.4073C7.67473 15.0752 8.53259 15.9088 9.56567 16.908C9.80792 17.1422 10.1923 17.1423 10.4346 16.9081L13.2637 14.1568C13.6545 13.7732 13.9823 13.4491 14.2469 13.1844C16.5925 10.8389 16.5925 7.03605 14.2469 4.69054ZM10 6.66553C11.3814 6.66553 12.5013 7.78539 12.5013 9.16683C12.5013 10.5482 11.3814 11.6681 10 11.6681C8.61859 11.6681 7.49873 10.5482 7.49873 9.16683C7.49873 7.78539 8.61859 6.66553 10 6.66553ZM10 7.91553C9.30892 7.91553 8.74876 8.47574 8.74876 9.16683C8.74876 9.85791 9.30892 10.4181 10 10.4181C10.6911 10.4181 11.2513 9.85791 11.2513 9.16683C11.2513 8.47574 10.6911 7.91553 10 7.91553Z" fill="#FF8855"/>
                          </svg>

    <?php the_field('footer_address_s3','option'); ?>
                      </div>

                        <div class="footer-contact">
                          <div class="obj1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M5.88038 2.01528L6.85288 1.72215C7.95497 1.38995 9.1325 1.92681 9.60442 2.97667L10.3558 4.6481C10.7581 5.54296 10.5461 6.59463 9.82858 7.26376L8.58333 8.425C8.54692 8.45892 8.52383 8.50475 8.51833 8.55425C8.48142 8.88517 8.70575 9.52967 9.22258 10.4249C9.5985 11.076 9.93867 11.5325 10.2283 11.7893C10.43 11.9683 10.5411 12.0069 10.5884 11.9928L12.2637 11.4807C13.2017 11.1939 14.2182 11.5358 14.7921 12.3313L15.8593 13.8104C16.5311 14.7414 16.4103 16.0258 15.5768 16.8153L14.8381 17.5148C14.0411 18.2696 12.9064 18.5508 11.8492 18.2558C9.55408 17.6152 7.49633 15.6783 5.6531 12.4858C3.80731 9.28883 3.15965 6.5351 3.75669 4.22528C4.02992 3.16821 4.83503 2.33038 5.88038 2.01528ZM6.24113 3.21209C5.61392 3.40115 5.13085 3.90385 4.96692 4.53809C4.46471 6.48102 5.03876 8.92175 6.73563 11.8608C8.43025 14.7959 10.2543 16.5128 12.1853 17.0518C12.8196 17.2288 13.5003 17.0601 13.9786 16.6072L14.7172 15.9077C15.0961 15.5488 15.151 14.965 14.8457 14.5418L13.7784 13.0627C13.5175 12.7012 13.0555 12.5457 12.6291 12.6761L10.9497 13.1895C9.97492 13.4801 9.09017 12.6955 8.14009 11.0499C7.49983 9.941 7.20143 9.08375 7.27607 8.4155C7.31473 8.06927 7.47604 7.74835 7.73081 7.51078L8.97608 6.34957C9.30225 6.04542 9.39858 5.56738 9.21575 5.16063L8.46433 3.4892C8.24981 3.01199 7.71458 2.76796 7.21363 2.91896L6.24113 3.21209Z" fill="#FF8855"/>
</svg>
                          <span><?php yp_text('โทรศัพท์ : ','Phone : '); ?> <?php the_field('footer_phone_s3','option'); ?></span>
                          </div>
                          <div class="obj2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M1.66667 4.37508C1.66667 2.87931 2.87923 1.66675 4.37501 1.66675H13.125C14.6208 1.66675 15.8333 2.87931 15.8333 4.37508V9.40266C15.5219 9.24925 15.1761 9.16675 14.8207 9.16675H14.5833V4.37508C14.5833 3.56966 13.9304 2.91675 13.125 2.91675H4.37501C3.56959 2.91675 2.91667 3.56966 2.91667 4.37508V13.9584C2.91667 14.7638 3.56959 15.4167 4.37501 15.4167H7.1834L6.13076 16.6667H4.37501C2.87924 16.6667 1.66667 15.4542 1.66667 13.9584V4.37508ZM5.62501 5.00008C5.27983 5.00008 5.00001 5.27991 5.00001 5.62508C5.00001 5.97026 5.27983 6.25008 5.62501 6.25008H11.875C12.2202 6.25008 12.5 5.97026 12.5 5.62508C12.5 5.27991 12.2202 5.00008 11.875 5.00008H5.62501ZM5.89166 10.3614C5.99421 10.141 6.21525 10.0001 6.45834 10.0001H14.8207C15.2508 10.0001 15.659 10.19 15.9362 10.5191L19.0198 14.1808C19.2157 14.4135 19.2157 14.7533 19.0198 14.986L15.9362 18.6477C15.659 18.9768 15.2508 19.1667 14.8207 19.1667H6.45834C6.21525 19.1667 5.99421 19.0258 5.89166 18.8054C5.78912 18.585 5.82368 18.3251 5.98027 18.1392L8.97459 14.5834L5.98027 11.0277C5.82368 10.8417 5.78912 10.5818 5.89166 10.3614ZM7.80174 11.2501L10.2698 14.1808C10.4657 14.4135 10.4657 14.7533 10.2698 14.986L7.80174 17.9167H14.8207C14.8821 17.9167 14.9404 17.8896 14.98 17.8426L17.7246 14.5834L14.98 11.3242C14.9404 11.2772 14.8821 11.2501 14.8207 11.2501H7.80174ZM5.62501 7.50008C5.27983 7.50008 5.00001 7.77991 5.00001 8.12508C5.00001 8.47025 5.27983 8.75008 5.62501 8.75008H9.37501C9.72017 8.75008 10 8.47025 10 8.12508C10 7.77991 9.72017 7.50008 9.37501 7.50008H5.62501Z" fill="#FF8855"/>
</svg>
                            <span><?php yp_text('โทรสาร : ','Fax : '); ?> <?php the_field('footer_fax_s3','option'); ?></span>
                          </div>
                        </div>
                        <!-- <span><php yp_text('อีเมล : ','Email : '); ?></span> <php the_field('footer_email_s3','option'); ?> -->
                    </div>


                </div>


                <?php if (is_active_sidebar('footer-widget-1')): ?>
                  <div class="object-grid object-1">
                      <div class="detail">
                          <nav class="footer-menu">
                              <?php dynamic_sidebar( 'footer-widget-1' ); ?>
                          </nav>
                      </div>
                  </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-widget-2')): ?>
                  <div class="object-grid object-2">
                      <div class="detail">
                          <nav class="footer-menu">
                              <?php dynamic_sidebar( 'footer-widget-2' ); ?>
                          </nav>
                      </div>
                  </div>
                <?php endif; ?>


                <?php if (is_active_sidebar('footer-widget-3')): ?>
                  <div class="object-grid object-3">
                      <div class="detail">
                          <nav id="knowledge-footer" class="footer-menu">
                                <?php dynamic_sidebar( 'footer-widget-3' ); ?>
                          </nav>
                      </div>
                  </div>
                <?php endif; ?>


                <?php if (is_active_sidebar('footer-widget-4')): ?>
                  <div class="object-grid object-4">
                      <div class="detail">
                          <nav id="report-footer" class="footer-menu">
                            <?php dynamic_sidebar( 'footer-widget-4' ); ?>
                          </nav>
                      </div>
                  </div>
                <?php endif; ?>

                  <?php if (is_active_sidebar('footer-widget-5')): ?>
                <div class="object-grid object-5">
                    <div class="detail">
                        <nav id="report-footer" class="footer-menu">
                          <?php dynamic_sidebar( 'footer-widget-5' ); ?>
                        </nav>
                    </div>
                </div>
              <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="v-container">
            <div class="main-object-f">
                <div class="object-grid object-1"><p><?php the_field('footer_copyright','option'); ?></p></div>
            </div>
        </div>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
