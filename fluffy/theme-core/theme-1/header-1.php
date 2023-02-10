<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fluffy
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fluffy' ); ?></a>

	<header id="main-header_4" class="main-header section-header box-header">
        <div class="top-object _desktop">
            <div class="v-container">
							<div class="wrap-topbar">
								<div class="left">
										<div class="top-bar">
											<?php
											wp_nav_menu(
													array(
															'theme_location' => 'menu-topbar',
															'menu_id'        => 'menu-topbar',
													)
											);
											?>
										</div>
								</div>
								<div class="right">
									<?php echo do_shortcode('[social_box]'); ?>
								</div>

							</div>
            </div>
        </div>
        <div class="main-object _desktop">
            <div class="v-container">
							<div class="wrap-nav">
								<div class="left">
									<div class="site-branding">
											<?php the_custom_logo(); ?>
									</div><!-- .site-branding -->
									<div class="desktop_menu">
										<?php
										wp_nav_menu(
												array(
														'theme_location' => 'primary',
														'menu_id'        => 'primary-menu',
												)
										);
										?>
									</div>
								</div>
								<div class="right">
								 	 <?php my_profile_menu(); ?>
									<div class="toggle-search">
										<div class="toggle-icon">
												<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
										</div>
									</div>
								</div>
							</div>
            </div>
        </div>

        <div class="mobile-object _mobile">
            <div class="main-object">
							<div class="object-2">
									<nav id="site-navigation" class="main-navigation">
											<div class="main-tog">
													<div id="toggle-main-menu" class="hamburger hamburger--slider">
															<div class="hamburger-box">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"><path d="M16,11H2c-0.6,0-1,0.4-1,1s0.4,1,1,1h14c0.6,0,1-0.4,1-1S16.6,11,16,11z"></path><path d="M22,5H2C1.4,5,1,5.4,1,6s0.4,1,1,1h20c0.6,0,1-0.4,1-1S22.6,5,22,5z"></path><path d="M20,17H2c-0.6,0-1,0.4-1,1s0.4,1,1,1h18c0.6,0,1-0.4,1-1S20.6,17,20,17z"></path></svg>
															</div>
													</div>
											</div>

											<div class="overlay_menu_m"></div>
											<div id="mobile_menu_wrap">
													<div id="close-mobile-menu" class="hamburger hamburger--slider is-active">
														<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
													</div>

													<?php
													wp_nav_menu(
															array(
																	'theme_location' => 'mobile',
																	'menu_id'        => 'mobile-menu',
															)
													);
													?>
											</div>
									</nav><!-- #site-navigation -->
							</div>

                <div class="object-1">
                    <div class="site-branding">
                        <?php the_custom_logo(); ?>
                    </div>
                </div>

								<div class="toggle-search">
									<div class="toggle-icon">
											<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
									</div>
								</div>

            </div>
        </div>
	</header><!-- #masthead -->

<?php yp_popup_search(); ?>
