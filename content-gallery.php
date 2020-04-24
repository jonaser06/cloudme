<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
      if ( function_exists('rwmb_meta') ) { 
      ?>
      <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>

      <?php if($images){ ?>
      <div class="owl-carousel owl-theme owl-post">
        <?php foreach ( $images as $image ) { ?>
        <?php $img = $image['full_url']; ?>
          <div><img src="<?php echo esc_url($img); ?>"></div>
        <?php } ?>
      </div>
    <?php } } ?>
    <p><?php echo cloudme_excerpt(); ?></p>

    <a href="<?php the_permalink(); ?>" class="small radius button"><?php esc_html_e('Read More','cloudme'); ?></a>

    <div class="meta"><?php the_time( get_option( 'date_format' ) ); ?>, <?php esc_html_e('Written by','cloudme'); ?> <?php the_author_posts_link(); ?> <i class="fa fa-comment-o"></i><a href=""><?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a></div>
  </div>
</div>