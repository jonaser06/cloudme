<?php

// Buttons

add_shortcode('button', 'button_func');
function button_func($atts, $content = null){

	extract(shortcode_atts(array(
		'btntext' 	=> '',
		'btnlink' 	=> '',
		'color'		  => '',
		'type'		  => '',
    'size'      => '',
		'radius'		=> '',
	), $atts));
	ob_start(); ?>
	<?php 
    $type1 = '';
    $size2 = '';
    $rad = '';
    if($type == 'info'){
      $type1 = ' btn-info';
    }elseif($type == 'success'){
      $type1 = ' btn-success';
    }elseif($type == 'warning'){
      $type1 = ' btn-warning';
    }elseif($type == 'danger'){
      $type1 = ' btn-danger';
    }elseif($type == 'primary'){
      $type1 = ' btn-primary';
    }else{
      $type1 = ' btn-default';
    }

    if($size == 'small'){
      $size2 = ' btn-sm';
    }elseif($size == 'large'){
      $size2 = ' btn-lg';
    }
    if($radius == 'true'){
      $rad = ' no-radius';
    }
  ?>
  <a href="<?php echo esc_url($btnlink); ?>" class="btn<?php echo esc_attr($size2.$type1.$rad); ?>"><?php echo esc_attr($btntext); ?></a>
  
  <?php return ob_get_clean();
}


// Header Home Image
add_shortcode('homeimage','homeimage_func');
function homeimage_func($atts, $content = null){
    extract( shortcode_atts( array(
      'title'         => '',  
      'slide'         => '',  
      'btn'           => '',  
      'link'          => '',  
      'mheight'       => '',
      'bg'            => '',
   ), $atts ) );

    $bg2 = wp_get_attachment_image_src($bg,'full');
    $bg2 = $bg2[0];

    ob_start(); ?>
    <div class="page-top page-880" style="<?php if($bg) { echo 'background-image:url('.esc_url($bg2).');'; } if($mheight) { echo 'min-height: '.esc_attr($mheight).';'; } ?>">
      <div class="message container">
            <?php if($title) { ?>
            <div class="message-intro">
              <span class="message-line"></span>
              <p><?php echo htmlspecialchars_decode($title); ?></p>
              <span class="message-line"></span>
            </div>
            <?php } if($slide) { ?>
            <h1><span id="js-rotating"><?php echo htmlspecialchars_decode($slide); ?></span></h1>
            <?php } if($btn) { ?><a href="<?php echo esc_url($link); ?>" class="small radius btn scroll"><?php echo htmlspecialchars_decode($btn); ?></a><?php } ?>
      </div>
    </div>
    
<?php
    return ob_get_clean();
}

// Home Slider

$GLOBALS['slides'] = array();

add_shortcode('homeslide', 'homeslide_func');
 function homeslide_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'css_class' => '',
   'cloud'     => '',
   'speed'     => '1000'
  ), $atts );

   $GLOBALS['slides'] = array();
  do_shortcode( $content );

  if ( empty( $GLOBALS['slides'] ) ) {
   return '';
  }

  $tabs_panel   = array();
  $total = count($GLOBALS['slides']);
  $img = wp_get_attachment_image_src($atts['cloud'],'full');
  $img = $img[0];

  if ( ! $total ) {
   return '';
  }
  $i = 0;
  foreach( $GLOBALS['slides'] as $slide ) {
    $image_src = '';
    if($slide['image']){
      $image_src = wp_get_attachment_image_src($slide['image'],'');
      if($image_src){
        $image_src = sprintf('<img src="%s" alt="" />', esc_url($image_src[0]));
      }
    }
   $tabs_panel[] = sprintf(
            '<div class="item">
                <div class="slidercaption">
                    <h3>%s</h3>
                    <p>%s</p>
                    <div class="viewplans hidden-sm"><a class="btn btn-slide scroll" href="%s">%s</a></div>
                </div>
                %s
            </div>',
    $slide['btext'],
    $slide['stext'],
    esc_url($slide['link']),
    $slide['btn'],
    $image_src
   );
  
  }

  return sprintf(
    '<div id="slider-container">
        
    <div id="home-slider" data-speed="%s" class="owl-carousel">%s</div>
    </div><div class="clouds hidden-xs"><img src="%s" alt=""/></div>',
    esc_attr($atts['speed']),
    implode('', $tabs_panel),
    esc_url($img)
    );
 }


 //Slide Items

 add_shortcode('slide_item', 'slide_item_func');
 function slide_item_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'image'      => '',
   'btext'      => '',
   'stext'      => '',
   'btn'        => '',
   'link'       => '',
  ), $atts );

  $GLOBALS['slides'][] = array(
   'btext'      => $atts['btext'],
   'stext'      => $atts['stext'],
   'btn'        => $atts['btn'],
   'link'       => $atts['link'],
   'image'      => $atts['image']
  );

  return '';
 }

// Header Home Video
add_shortcode('bgvideo','bgvideo_func');
function bgvideo_func($atts, $content = null){
    extract( shortcode_atts( array(
      'title'         =>  '',  
      'slide'         =>  '',  
      'btn'           =>  '',
      'image'         =>  '', 
      'link'          =>  '',
      'mp4'           =>  '',
      'webm'          =>  '',
      'ogv'           =>  '',
      'mute'          =>  '',
   ), $atts ) );

    $bg2 = wp_get_attachment_image_src($image,'full');
    $bg2 = $bg2[0];

    ob_start(); ?>

    <div id="video-container" class="page-top">
      <div class="message container">
            <?php if($title) { ?>
            <div class="message-intro">
              <span class="message-line"></span>
              <p><?php echo htmlspecialchars_decode($title); ?></p>
              <span class="message-line"></span>
            </div>
            <?php } if($slide) { ?>
            <h1><span id="js-rotating"><?php echo htmlspecialchars_decode($slide); ?></span></h1>
            <?php } if($btn) { ?><a href="<?php echo esc_url($link); ?>" class="small radius btn scroll"><?php echo htmlspecialchars_decode($btn); ?></a><?php } ?>
      </div>
      <video id='video-player' autoplay loop<?php if($mute) { ?> muted<?php } ?>>
          <source src="<?php echo esc_url($mp4); ?>" type="video/mp4">
          <source src="<?php echo esc_url($webm); ?>" type="video/webm">
          <source src="<?php echo esc_url($ogv); ?>" type="video/ogg">
      </video>
      <div class="clouds hidden-xs"><img src="<?php echo esc_url($bg2) ?>" alt=""/></div>
    </div>

    
<?php
    return ob_get_clean();
}

// Form search domain
add_shortcode('cloudme_search_domain','cloudme_search_domain_func');
function cloudme_search_domain_func($atts, $content = null){
    extract( shortcode_atts( array(
      'title'         => '',  
      'subt'          => '',  
      'domain'        => '',  
      'actionlink'    => '',  
      'mheight'       => '',
      'image'         => '',
      'bg'            => '',
      'bridge'        => '',
   ), $atts ) );

    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
    $bg2 = wp_get_attachment_image_src($bg,'full');
    $bg2 = $bg2[0];
    if(!$img){ $img = get_template_directory_uri().'/images/loading.gif'; }

    ob_start(); ?>
    <div class="page-top page-580" style="<?php if($bg) { echo 'background-image:url('.esc_url($bg2).');'; } if($mheight) { echo 'min-height: '.esc_attr($mheight).';'; } ?>">
      <div class="message container">
            <?php if($title) { ?>
            <div class="message-intro">
              <span class="message-line"></span>
              <p><?php echo htmlspecialchars_decode($title); ?></p>
              <span class="message-line"></span>
            </div>
            <?php } if($subt) { ?>
            <h1><?php echo htmlspecialchars_decode($subt); ?></h1>
            <?php } ?>
            <div class="domainsearch">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">

                  <form method="post" action="">
                    <div class="row">
                      <div class="col-sm-8 padd-0">
                        <input type="text" name="domain" class="form-control" placeholder="<?php esc_html_e('Enter your domain','cloudme') ?>"/>
                      </div>
                      <div class="col-sm-2 padd-0">
                        <?php 
                          $output = array();
                          if( $domain ) {
                            $output[] = '<select class="form-control">';
                             $domain = explode( "|", $domain );
                             if( $domain ) {
                              foreach ( $domain as $label ) {
                               if( $label ) {
                                 $output[] = sprintf( '<option>%s</option>', $label );
                               }
                              }
                            $output[] = '</select>';
                           }
                          }
                          echo implode( '', $output );
                        ?>
                      </div>
                      <div class="col-sm-2 padd-0">
                        <input class="btn-wide" type="submit" value="<?php esc_html_e('Search','cloudme') ?>" name="submit">
                      </div>
                    </div>
                  </form>
                  <div class="text-center" id="message"><img src="<?php echo esc_url($img); ?>" alt="">
                    <div class="mess"></div><a href="javascript:void(0)" class="ot-btn"><?php esc_html_e('ORDER NOW','cloudme'); ?></a>
                    <?php if($bridge) { ?>
                    <form target="_blank" method="post" name="whmcs_com" id="whmcs" action="<?php echo esc_url($actionlink); ?>/?ccce=cart&amp;a=add&amp;domain=register">
                    <?php }else{ ?>
                    <form target="_blank" method="post" name="whmcs_com" id="whmcs" action="<?php echo esc_url($actionlink); ?>/cart.php?a=add&amp;domain=register">
                    <?php } ?>
                      <input class="otdomain1" type="hidden" name="domains[]" value="">
                      <input class="otdomain2" type="hidden" name="" value="1">
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
    
<?php
    return ob_get_clean();
}


// Pricing Table

add_shortcode('pricingtable', 'pricingtable_func');
function pricingtable_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'    => '',
    'price'    => '',
    'per'      => '',
    'btn'      => '',
    'link'     => '',
  ), $atts));
  ob_start(); ?>

  <div class="pricingboxes">
    <div class="title"><?php echo htmlspecialchars_decode($title); ?></div>
    <div class="pricing-table">
      <?php echo htmlspecialchars_decode($content); ?>
      <div class="price"><span><?php echo htmlspecialchars_decode($price); ?></span><?php echo htmlspecialchars_decode($per); ?></div>
      <div class="cta-button"><p><span><a href="<?php echo esc_url($link); ?>"><?php echo htmlspecialchars_decode($btn); ?></a></span></p></div>
    </div>
  </div>

  <?php
    return ob_get_clean();
}


// Pricing Table 2

add_shortcode('pricingtable2', 'pricingtable2_func');
function pricingtable2_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'    => '',
    'price'    => '',
    'per'      => '',
    'head'     => '',
    'btn'      => '',
    'link'     => '',
  ), $atts));
  $hea = '';
  if($head == 'true'){
    $hea = ' hostingfeatures hidden-xs';
  }
  ob_start(); ?>

  <div class="comparison <?php echo esc_attr($hea); ?>">
    <div class="title-<?php if($head == 'true') echo 'features'; else echo 'alt'; ?>"><?php echo htmlspecialchars_decode($title); ?></div>
    <div class="pricing-table alter <?php if($head == 'true') echo 'features'; ?>">
    <?php echo htmlspecialchars_decode($content); ?>
    <?php if($price) { ?><div class="price"><span><?php echo htmlspecialchars_decode($price); ?> <sub><?php echo htmlspecialchars_decode($per); ?></sub></span></div><?php } ?>
    <?php if($btn) { ?><li class="cta-button"><p><span><a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($btn); ?></a></span></p></li><?php } ?>
    </div>
  </div>

  <?php
    return ob_get_clean();
}

// Domains Price

add_shortcode('domainprice', 'domainprice_func');
function domainprice_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'    => '',
    'head'     => '',
  ), $atts));
  $hea = '';
  if($head == 'true'){
    $hea = ' hostingfeatures';
  }
  ob_start(); ?>

  <div class="domain-prices">
    <div class="title-<?php if($head) echo 'features'; else echo 'alt'; ?>"><?php echo htmlspecialchars_decode($title); ?></div>
    <div class="pricing-table domains <?php if($head) echo 'tld'; ?>">
      <?php echo htmlspecialchars_decode($content); ?>
    </div>
  </div>

  <?php
    return ob_get_clean();
}


// Features Shared

add_shortcode('shared', 'shared_func');
function shared_func($atts, $content = null){
  extract(shortcode_atts(array(
    'icon'      =>  '',
    'lr'        =>  '',
  ), $atts));

  ob_start(); ?>

  <?php if($lr) { ?>
  <div class="shared sharedfeatures-even">
    <div class="row">
      <div class="col-sm-4 col-sm-push-8">
        <div class="circle"><i class="<?php echo esc_attr($icon); ?>"></i></div>
      </div>
      <div class="col-sm-8 col-sm-pull-4">
        <?php echo htmlspecialchars_decode($content); ?>
      </div>
    </div>
  </div>
  <?php }else{ ?>
  <div class="shared sharedfeatures-odd">
    <div class="row">
      <div class="col-sm-4">
        <div class="circle"><i class="<?php echo esc_attr($icon); ?>"></i></div>
      </div>
      <div class="col-sm-8">
        <?php echo htmlspecialchars_decode($content); ?>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php

  return ob_get_clean();
}


// Services
add_shortcode('services', 'services_func');
function services_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   =>  '',
    'icon'    =>  '',
    'image'   =>  '',
    'bg'      =>  '',
    'type'    =>  '',
  ), $atts));
  $img = wp_get_attachment_image_src($image,'full');
  $img = $img[0];
  ob_start(); ?>

  <?php if($type == 'type2'){ ?>
    <div class="row dedicated-servers-features" style="<?php if($bg) echo 'background: '.esc_attr($bg).';'; ?>">
      <div class="col-sm-3">
        <img src="<?php echo esc_url($img); ?>" alt=""/>
      </div>
      <div class="col-sm-9">
        <h3><?php echo htmlspecialchars_decode($title); ?></h3>
        <p><?php echo htmlspecialchars_decode($content); ?></p>
      </div>
    </div>
  <?php }else{ ?>
    <div class="domainfeatures-list dedicated-servers-features" style="<?php if($bg) echo 'background: '.esc_attr($bg).';'; ?>">
    <div class="row">
      <div class="col-sm-3">
        <div class="circle"><i class="<?php echo esc_attr($icon); ?>"></i></div>
      </div>
      <div class="col-sm-9">
        <h3><?php echo htmlspecialchars_decode($title); ?></h3>
        <p><?php echo htmlspecialchars_decode($content); ?></p>
      </div>
    </div></div>
  <?php } ?>     

  <?php

    return ob_get_clean();
}

// Features Box
add_shortcode('featurebox', 'featurebox_func');
function featurebox_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   =>  '',
    'icon'    =>  '',
    'photo'   =>  '',
    'type'    =>  '',
    'btn'     =>  '',
    'link'    =>  '',
  ), $atts));
  $img_icon = wp_get_attachment_image_src($photo,'full');
  $img_icon = $img_icon[0];
  ob_start(); ?>

  <div class="about-us-links">
    <?php if($icon) { ?><i class="<?php echo esc_attr($icon); ?>"></i><?php } ?>
    <?php if($photo) { ?><img src="<?php echo esc_url($img_icon); ?>"><?php } ?>
    <h3><?php echo htmlspecialchars_decode($title); ?></h3>
    <p><?php echo htmlspecialchars_decode($content); ?></p>
    <?php if($link) { ?><div class="cta-button"><p><span><a href="<?php echo esc_url($link); ?>"><?php echo htmlspecialchars_decode($btn); ?></a></span></p></div><?php } ?>
  </div>    

  <?php

    return ob_get_clean();
}

// Support Box
add_shortcode('supportbox', 'support_func');
function support_func($atts, $content = null){
  extract(shortcode_atts(array(
    'image'   =>  '',
    'icon'    =>  '',
    'right'   =>  '',
  ), $atts));
  $img_icon = wp_get_attachment_image_src($icon,'full');
  $img_icon = $img_icon[0];
  $big_img = wp_get_attachment_image_src($image,'full');
  $big_img = $big_img[0];
  ob_start(); ?>

  <?php if($right) { ?>
  <div class="row supportchannels" data-equalizer>
    
    <div class="col-md-offset-1 col-sm-5 col-md-4 right-box" data-equalizer-watch>
      <div data-wow-delay="0.3s" class="timeline-content wow fadeInLeft"><img src="<?php echo esc_url($big_img); ?>" alt="" class="imgpaddingright" /></div>
    </div>

    <div class="col-sm-offset-1 col-sm-1 hidden-xs line center-box" data-equalizer-watch>
      <div class="roundimg wow fadeInUp"><img src="<?php echo esc_url($img_icon); ?>" alt=""/></div>
    </div>

    <div class="col-md-offset-1 col-sm-5 col-md-4 left-box" data-equalizer-watch>

      <div data-wow-delay="0.3s" class="timeline-content wow fadeInRight">
        <?php echo htmlspecialchars_decode($content); ?>
      </div>

    </div>

  </div>
  <?php }else{ ?>
  <div class="row supportchannels" data-equalizer>
    <div class="col-md-offset-1 col-sm-5 col-md-4 left-box" data-equalizer-watch>

      <div data-wow-delay="0.3s" class="timeline-content wow fadeInLeft">
        <?php echo htmlspecialchars_decode($content); ?>
      </div>

    </div>

    <div class="col-sm-offset-1 col-sm-1 hidden-xs line center-box" data-equalizer-watch>
      <div class="roundimg wow fadeInUp"><img src="<?php echo esc_url($img_icon); ?>" alt=""/></div>
    </div>

    <div class="col-md-offset-1 col-sm-5 col-md-4 right-box" data-equalizer-watch>
      <div data-wow-delay="0.3s" class="timeline-content wow fadeInRight"><img src="<?php echo esc_url($big_img); ?>" alt="" class="imgpaddingright" /></div>
    </div>

  </div>
  <?php } ?>  

  <?php

    return ob_get_clean();
}

// Call To Action
add_shortcode('ctabox', 'ctabox_func');
function ctabox_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title1'   =>  '',
    'title2'   =>  '',
    'stitle'   =>  '',
    'btn'      =>  '',
    'link'     =>  '',
  ), $atts));

  ob_start(); ?>

  <div class="calltoaction">
    <div class="longshadow"><?php echo htmlspecialchars_decode($title1); ?></div>
    <div class="calltoactioninfo">
    <h2><?php echo htmlspecialchars_decode($title2); ?></h2>
    <h3><?php echo htmlspecialchars_decode($stitle); ?></h3>
    <a href="<?php echo esc_url($link); ?>" class="small radius btn"><?php echo htmlspecialchars_decode($btn); ?></a>
    </div>
  </div>    

  <?php

    return ob_get_clean();
}

// VPS Order
add_shortcode('vpsorder', 'vpsorder_func');
function vpsorder_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   =>  '',
    'image'   =>  '',
    'number'  =>  '',
  ), $atts));

  $img = wp_get_attachment_image_src($image,'full');
  $img = $img[0];

  ob_start(); ?>

 <div class="vps-order-steps">
      <?php if($image) { ?><img class="img-responsive center-block smscrimg" src="<?php echo esc_url($img); ?>" alt="" /><?php } ?>
      <?php if($number) { ?>
      <div class="order-circle">
        <div class="line hidden-xs"></div>
        <span><?php echo htmlspecialchars_decode($number); ?></span>
      </div>
      <?php } ?>
      <div class="padd-15">
        <h3><?php echo htmlspecialchars_decode($title); ?></h3>
        <?php echo htmlspecialchars_decode($content); ?>
      </div>
  </div>

  <?php

    return ob_get_clean();
}

// VPS Plans

$GLOBALS['plans'] = array();

add_shortcode('vpsplans', 'vpsplans_func');
 function vpsplans_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'el_class' => '',
   'point'     => '2',
   'title'     => '',
   'bg'        => '',
   'btn'       => 'ORDER VPS'
  ), $atts );

   $GLOBALS['plans'] = array();
   do_shortcode( $content );

  if ( empty( $GLOBALS['plans'] ) ) {
   return '';
  }

  $tabs_nav     = array();
  $total        = count( $GLOBALS['plans'] );
  $planval      = '';
  $cpuval       = '';
  $memoryval    = '';
  $diskspaceval = '';
  $bandwidthval = '';
  $priceval     = '';
  $urlval       = '';
  $width        = 100 / $total;

  $img = wp_get_attachment_image_src($atts['bg'],'full');
  $img = $img[0];

  if($img){ $bg_header = 'style="background-image: url('.esc_url($img).')"'; }

  if ( ! $total ) {
   return '';
  }
  $i = 0;
  foreach( $GLOBALS['plans'] as $index => $plan ) {
   $tabs_nav[] = sprintf(
    '%s',
    esc_attr( $i ) ,
    esc_attr( $width ) . '%',
    $plan['title']
   );

   $ext = '|';
   if( $i == 0 ) {
    $ext = '';
   }

   $planval      .= $ext .  $plan['title'];
   $cpuval       .= $ext .  $plan['cpu'];
   $memoryval    .= $ext .  $plan['ram'];
   $diskspaceval .= $ext .  $plan['disk'];
   $bandwidthval .= $ext .  $plan['band'];
   $priceval     .= $ext .  $plan['price'];
   $urlval       .= $ext .  $plan['link'];
   $i++;
  }

  return sprintf(
   '<div class="page-top vps-page" %s>
       <div class="container pricing-order-slider %s">
        <div class="row">
          <div class="col-md-12">
            <h1>%s</h1>
            <div class="vps-prices-container">
              <div class="vps-prices-panel">
                <div class="vps-prices-drag">
                  <div id="vps-slider" data-number="%s"></div>
                  <div id="sliderlines"></div>
                </div>
                <div class="row clearfix">
                  <div class="col-md-12">
                    <div id="vps_name_option"><h3><span class="how_much">%s</span></h3></div>
                    <ul class="row">
                      <li class="col-sm-3">
                        <div class="centralized"><div id="cpu_option"><h6>%s</h6><span class="how_much"></span></div></div>
                      </li>

                      <li class="col-sm-3">
                         <div class="centralized"><div id="memory_option"><h6>%s</h6><span class="how_much"></span></div></div>
                      </li>

                      <li class="col-sm-3">
                        <div class="centralized"><div id="disk_space_option"><h6>%s</h6><span class="how_much"></span></div></div>
                      </li>

                      <li class="col-sm-3">
                        <div class="centralized"><div id="bandwidth_option"><h6>%s</h6><span class="how_much"></span></div></div>
                      </li>
                    </ul>
                    <div class="total_amount"><h3><span id="price_amount"></span></h3></div>
                    <p class="text-center"><a class="btn medium order-vps" href="#">%s</a></p>
                  </div>
                </div>
              </div>
              <div class="footer-hide">
                <input type="hidden" value="%s" class="planval"/>
                <input type="hidden" value="%s" class="cpuval"/>
                <input type="hidden" value="%s" class="memoryval"/>
                <input type="hidden" value="%s" class="diskspaceval"/>
                <input type="hidden" value="%s" class="bandwidthval"/>
                <input type="hidden" value="%s" class="priceval"/>
                <input type="hidden" value="%s" class="urlval"/>
                <input type="hidden" value="%s" class="point"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>',

   esc_attr( $bg_header ),
   esc_attr($atts['el_class']),
   $atts['title'],
   esc_attr( $total ),
   implode( '', $tabs_nav ),
   esc_html__( 'CPU', 'cloudme' ),
   esc_html__( 'RAM', 'cloudme' ),
   esc_html__( 'Disk Space', 'cloudme' ),
   esc_html__( 'Bandwidth', 'cloudme' ),
   $atts['btn'],
   esc_attr( $planval ),
   esc_attr( $cpuval ),
   esc_attr( $memoryval ),
   esc_attr( $diskspaceval ),
   esc_attr( $bandwidthval ),
   esc_attr( $priceval ),
   esc_attr( $urlval ),
   $atts['point']
  );
 }


 //Single Plan

 add_shortcode('single_plan', 'single_plan_func');
 function single_plan_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'disk'  => '',
   'title' => '',
   'cpu'   => '',
   'ram'   => '',
   'band'  => '',
   'price' => '',
   'link'  => '',
  ), $atts );

  $GLOBALS['plans'][] = array(
   'disk'  => $atts['disk'],
   'title' => $atts['title'],
   'cpu'   => $atts['cpu'],
   'ram'   => $atts['ram'],
   'band'  => $atts['band'],
   'price' => $atts['price'],
   'link'  => $atts['link'],
  );

  return '';
 }


// Testimonial Silder

add_shortcode('testslide','testslide_func');

function testslide_func($atts, $content = null){

	extract(shortcode_atts(array(

		'number'	=>		'',

	), $atts));
	if(!$number){
		$number = -1;
	}

	ob_start(); ?>

  <div id="testimonials-carousel" class="owl-carousel">
    <?php

      $args = array(

        'post_type' => 'testimonial',

        'posts_per_page' => $number,

      );

      $testimonial = new WP_Query($args);

      if($testimonial->have_posts()) : while($testimonial->have_posts()) : $testimonial->the_post();
      $extra = get_post_meta(get_the_ID(),'_cmb_info', true);
    ?>

    <div class="item">
      <div class="whoclient"><span><?php echo htmlspecialchars_decode($extra); ?></span></div>
      <div class="testimonial-content">
        <?php if(has_post_thumbnail()) { ?>
        <div class="testimonialimg"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" /></div>
        <?php } the_content(); ?>
      </div>
    </div>
    <?php endwhile; endif; ?>
	</div>

	<?php

    return ob_get_clean();

}

// Testimonial Grid

add_shortcode('testigrid', 'testigrid_func');
function testigrid_func($atts, $content = null){
  extract(shortcode_atts(array(
    'number'      =>  '-1',
  ), $atts));

  ob_start(); ?>

  <ul class="testimonialsContainer">
    <?php

      $args = array(

        'post_type' => 'testimonial',

        'posts_per_page' => $number,

      );

      $testimonial = new WP_Query($args);

      if($testimonial->have_posts()) : while($testimonial->have_posts()) : $testimonial->the_post();
      $extra = get_post_meta(get_the_ID(),'_cmb_info', true);
      $testi_video = get_post_meta(get_the_ID(),'_cmb_testi_video', true);
    ?>
    <li class="testimonial-item col-md-4">
      <div class="testimonial-text">
        <?php
          if ( function_exists('rwmb_meta') ) { 
          ?>
          <?php $images = rwmb_meta( '_cmb_testi_image', "type=image" ); ?>

          <?php if($images){ ?>
          <?php foreach ( $images as $image ) { ?>
          <?php $img = $image['full_url']; ?>
          <img src="<?php echo esc_url($img); ?>" alt="" />
        <?php } } } ?>

        <?php if($testi_video) { ?>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe src="<?php echo esc_url( $testi_video ); ?>"></iframe>
          </div>
        <?php } ?>

        <?php the_content(); ?>
        <h6><?php echo htmlspecialchars_decode($extra); ?></h6>
      </div>
    </li>
    <?php endwhile; endif; ?>
  </ul>

  <?php

  return ob_get_clean();
}


// FAQs

add_shortcode('otfaqs', 'otfaqs_func');
function otfaqs_func($atts, $content = null){
  extract(shortcode_atts(array(
    'question'     =>  '',
  ), $atts));
  ob_start(); ?>

  <div class="faq-subheader">
    <div class="question"><?php echo htmlspecialchars_decode($question); ?></div>
    <p><?php echo htmlspecialchars_decode($content); ?></p>
  </div>
  
  <?php

  return ob_get_clean();
}


// Logos Client
add_shortcode('logos', 'logos_func');
function logos_func($atts, $content = null){
	extract(shortcode_atts(array(
    'gallery'   =>  '',
    'number'    =>  '',
    'speed'     =>  '',
		'type'		  => 	'',
	), $atts));
    if(!$number){
      $number = 6;
    }
    if(!$speed){
      $speed = 5000;
    }
	ob_start(); ?>

	<div class="logos">
    	<?php 
  		$img_ids = explode(",",$gallery);
  		foreach( $img_ids AS $img_id ){
  		$meta = wp_prepare_attachment_for_js($img_id);
  		$caption = $meta['caption'];
  		$title = $meta['title'];	
  		$description = $meta['description'];	
  		$image_src = wp_get_attachment_image_src($img_id,''); ?>
        <?php if(!empty($caption)){ ?> 
        	<div class="item"><a target="_blank" href="<?php echo esc_attr($caption); ?>">
	            <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>">
	        </a></div>
        <?php }else{ ?>         	
	        <div class="item"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>"></div>
        <?php } ?>
      <?php } ?>
  </div>

  <script type="text/javascript">
  (function($) {
  "use strict";
    $(".logos").owlCarousel({

        autoPlay: <?php echo esc_js($speed); ?>,
        items: <?php echo esc_js($number); ?>,
        itemsDesktop: [1199, <?php echo esc_js($number); ?>-1],
        itemsDesktopSmall: [979, <?php echo esc_js($number); ?>-2],
        pagination: false

    });
  })(jQuery);
  </script>     

	<?php

    return ob_get_clean();
}

//Compare Table
add_shortcode('compare_table', 'compare_table_func');
function compare_table_func( $atts, $content ) {
  $atts = shortcode_atts(array(
   'titles'         => '',
   'class_name'     => '',
   'sort'           => '',
  ), $atts );

  $output = array();
  if( $atts['titles'] ) {
   $titles = explode( "|", $atts['titles'] );
   $column = '';

   if( $titles ) {
    foreach ( $titles as $title ) {
     $column .= sprintf( '<th class="%s"><span>%s</span></th>', '', $title );
    }
   }
   $output[] = sprintf( '<thead><tr class="compare-title">%s</tr></thead>',  $column );
  }

  if( $content ) {
   $content = explode( "\n", $content );

   if( $content ) {
    $output[] = '<tbody>';
    foreach ( $content as $row ) {
     $row = explode( "|", $row );
     $column = '';
     $i = 0;

     if( $row ) {
      foreach ( $row as $label ) {
       $data = '';
       if( $label ) {    
         $column .= sprintf( '<td %s>%s</td>', $data, $label );
       }
       $i++;
      }
     }
     $output[] = sprintf( '<tr>%s</tr>',  $column );
    }
    $output[] = '</tbody>';
   }
  }
  return sprintf( '<table class="flat-table flat-table-1 responsive tablesaw tablesaw-stack %s" data-mode="stack">%s</table>',
  esc_attr( $atts['class_name'] ),
  implode( '', $output )
  );
   
}

// Socials item
add_shortcode('socialitem', 'socialitem_func');
function socialitem_func($atts, $content = null){
  extract(shortcode_atts(array(
    'link'   =>  '',
    'icon'   =>  '',
  ), $atts));

  ob_start(); ?>

  <ul class="connecticons">
    <li><a target="_blank" href="<?php echo esc_url($link); ?>"><i class="<?php echo esc_attr($icon); ?>"></i></a></li> 
  </ul>  

  <?php

    return ob_get_clean();
}


// Google Map

add_shortcode('ggmap','ggmap_func');
function ggmap_func($atts, $content = null){
    extract( shortcode_atts( array(
      'idmap'    => 'map-canvas',
      'height'   => '',	
      'lat'      => '',
      'long'     => '',
      'zoom'     => '',
      'mapcolor' => '',
      'icon'     => '',
   ), $atts ) );
   
   $icon1 = wp_get_attachment_image_src($icon,'full');
   $icon1 = $icon1[0];
   if(!$zoom){
   	$zoom = 13;
   }
   		
    ob_start(); ?>
    	 
    <div id="<?php echo esc_attr( $idmap ); ?>" class="contacts-map" style="<?php if($height) echo 'height: '.$height.'px;'; ?>"></div>

    <script type="text/javascript">
	
	  (function($) {
    "use strict"
    $(document).ready(function(){
        
        var locations = [
      ['', <?php echo esc_attr( $lat );?>, <?php echo esc_attr( $long );?>, 2]
        ];
    
    var map = new google.maps.Map(document.getElementById('<?php echo esc_attr( $idmap ); ?>'), {
      zoom: <?php echo esc_attr( $zoom );?>,
      scrollwheel: false,
      navigationControl: true,
      mapTypeControl: false,
      scaleControl: false,
      draggable: true,
      styles: [ { "stylers": [ { "hue": "<?php echo esc_attr( $mapcolor );?>" }, { "gamma": 1 } ] } ],
      center: new google.maps.LatLng(<?php echo esc_attr( $lat );?>, <?php echo esc_attr( $long );?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  
    var infowindow = new google.maps.InfoWindow();
  
    var marker, i;
  
    for (i = 0; i < locations.length; i++) {  
    
      marker = new google.maps.Marker({ 
      position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
      map: map ,
      icon: '<?php echo esc_url( $icon1 );?>'
      });
      
    }
        
        });
    })(jQuery);     
    </script>
<?php

    return ob_get_clean();

}

// Google Map

add_shortcode('ggmap2','ggmap2_func');
function ggmap2_func($atts, $content = null){
    extract( shortcode_atts( array(
      'height'   => '',
      'address'  => '',
      'zoom'     => '',
      'icon'     => '',
   ), $atts ) );
   
   $lls = (array) vc_param_group_parse_atts( $address );
   $icon1 = wp_get_attachment_image_src($icon,'full');
   $icon1 = $icon1[0];
   if(!$zoom){
    $zoom = 2;
   }
      
    ob_start(); ?>
       
    <div id="mmaps" class="contacts-map" style="<?php if($height) echo 'height: '.$height.'px;'; ?>"></div>

    <script type="text/javascript">
  
    (function($) {
    "use strict"
    $(document).ready(function(){
        
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap',
        styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("mmaps"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = [
      <?php foreach ( $lls as $ll ) { ?>
        ['', <?php echo esc_js($ll['llong']); ?>],
      <?php } ?>
    ];

    // Info Window Content
    var infoWindowContent = [
      <?php foreach ( $lls as $ll ) { ?>
        ['<div class="info_content"><?php echo esc_js($ll["info"]); ?></div>'],
      <?php } ?>
    ];

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0],
            icon: '<?php echo esc_url( $icon1 );?>'
        });

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(<?php echo esc_js($zoom); ?>);
        google.maps.event.removeListener(boundsListener);
    });
    });
    })(jQuery);     
    </script>
<?php

    return ob_get_clean();

}