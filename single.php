<?php

get_header();

 $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);
 $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);
 $bg = 'style=background-image:url(' . cloudme_theme_option( "bg_head" ) . ');background-size:cover;';
?>

<div class="page-top" <?php if(cloudme_theme_option( "bg_head" )) echo esc_attr($bg); ?>>
<!--  MESSAGES ABOVE HEADER IMAGE -->
<div class="message blog-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 columns">
                <div class="message-intro">
                    <span class="message-line"></span>
                      <?php $title = cloudme_theme_option('title_single') ? cloudme_theme_option('title_single') : esc_html__('Single Blog', 'cloudme'); ?>
                        <p><?php echo esc_html( $title ); ?></p>
                    <span class="message-line"></span>
                </div>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>
<!--  END OF MESSAGES ABOVE HEADER IMAGE -->
</div>
<!--  END OF HEADER -->

<!-- CONTENT BLOG -->
<?php while (have_posts()) : the_post(); ?>
<!-- content begin -->

<div class="sectionarea blog">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
              <div class="entry">
                <div class="meta"><?php the_time( get_option( 'date_format' ) ); ?>, <?php esc_html_e('Written by','cloudme'); ?> <?php the_author_posts_link(); ?> <i class="fa fa-comment-o"></i><a href=""><?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a></div>
                <?php $format = get_post_format(); ?>
                <?php if($format=='video') { ?>

                <div class="embed-responsive embed-responsive-16by9">
                  <iframe src="<?php echo esc_url( $link_video ); ?>"></iframe>
                </div>

                <?php }elseif($format=='audio') {?>

                <iframe style="width:100%" src="<?php echo esc_url($link_audio); ?>"></iframe>

                <?php }elseif($format=='gallery'){ ?>
                  <?php
                    if ( function_exists('rwmb_meta') ) { 
                  ?>  
                  <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>
                  <?php if($images){ ?>
                    <div class="owl-carousel owl-theme owl-post">
                      <?php                                                        
                        foreach ( $images as $image ) {                              
                      ?>
                      <?php $img = $image['full_url']; ?>
                        <div><img src="<?php echo esc_url($img); ?>" alt=""></div> 
                      <?php } ?>                   
                    </div>
                  <?php } ?>
                <?php } ?>
  
                <?php }elseif($format=='image'){ ?>
                  <?php
                    if ( function_exists('rwmb_meta') ) { 
                  ?>
                    <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                    <?php if($images){ ?>
                    <?php                                                        
                      foreach ( $images as $image ) {                              
                      ?>
                      <?php $img = $image['full_url']; ?>
                      <img src="<?php echo esc_url($img); ?>" alt="">
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>

                <?php }else{ ?>
                  <?php if(has_post_thumbnail()) { ?><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" /><?php } ?>
                <?php } ?>

                <?php the_content(); ?>

                <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cloudme' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'cloudme' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                ?>

                <?php if(has_tag()) { ?>
                <div class="tagcloud">
                    <?php the_tags('','' ); ?>
                </div>
                <?php } ?>

              </div>
          
              <?php 
                the_post_navigation( array(
                  'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'cloudme' ) . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'cloudme' ) . '</span> ',
                  'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Post', 'cloudme' ) . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'cloudme' ) . '</span> ',
                ) ); 
              ?>

              <?php if(cloudme_theme_option('author_post')) { ?>
              <!-- AUTHOR BOX -->
              <div class="author-wrap">
                <div class="row">
                  <div class="col-sm-3 col-lg-2">
                    <div class="author-gravatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 117 ); ?></div>
                  </div>
                  <div class="col-sm-9 col-lg-10">
                    <div class="author-info">
                      <div class="author author-title"><h6><?php the_author(); ?></h6></div>
                      <div class="author-description"><p><?php the_author_meta('description'); ?></p></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END OF AUTHOR BOX -->
              <?php } ?>
              
              <?php
               if ( comments_open() || get_comments_number() ) :
                comments_template();
               endif;
              ?>

            </div>  
            <div class="col-md-3">
                <?php get_sidebar();?>
            </div>
        </div>
    </div>
 </div>

<?php endwhile;?>
  <!-- END CONTENT BLOG -->
<?php get_footer(); ?>	





  