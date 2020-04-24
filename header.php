<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

	<!-- Page Title 
	================================================== -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    
    <?php if(cloudme_theme_option('icon_ipad_retina')) { ?>
    <link rel="apple-touch-icon" href="<?php echo esc_url(cloudme_theme_option('icon_ipad_retina')); ?>">
    <?php }if(cloudme_theme_option('icon_ipad')) { ?>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(cloudme_theme_option('icon_ipad')); ?>">
    <?php }if(cloudme_theme_option('icon_iphone_retina')) { ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(cloudme_theme_option('icon_iphone_retina')); ?>">
    <?php }if(cloudme_theme_option('icon_iphone')) { ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(cloudme_theme_option('icon_iphone')); ?>">
    <?php } ?>

<?php wp_head(); ?>



</head>

<body <?php body_class( ); ?>>

    <header id="toptop">
        <div class="top<?php if(cloudme_theme_option('stickymenu')) echo ' sticky'; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="logo">
                            <a href="<?php echo esc_url( home_url('/') ); ?>">
                                <?php if(cloudme_theme_option('logo')) { ?>
                                <img src="<?php echo esc_url(cloudme_theme_option('logo')); ?>" alt="">
                                <?php }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="">
                                <?php } ?>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-9">

                        <!--  NAVIGATION MENU AREA -->
                        <nav class="desktop-menu">
                            <?php
                                $topmenu = array(
                                'theme_location'  => 'primary',
                                'menu'            => '',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'sf-menu',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                'walker'          => new wp_bootstrap_navwalker(),
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                            );
                            if ( has_nav_menu( 'primary' ) ) {
                                wp_nav_menu( $topmenu );
                            }
                            ?>
                      </nav>
                        <!--  END OF NAVIGATION MENU AREA -->

                        <!--  MOBILE MENU AREA -->
                        <nav class="mobile-menu">
                            <?php
                                $topmenu = array(
                                'theme_location'  => 'primary',
                                'menu'            => '',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => '',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                'walker'          => new wp_bootstrap_navwalker(),
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                            );
                            if ( has_nav_menu( 'primary' ) ) {
                                wp_nav_menu( $topmenu );
                            }
                            ?>
                        </nav>
                        <!--  END OF MOBILE MENU AREA -->


                    </div>
                </div>
            </div>
        </div>
    </header>
