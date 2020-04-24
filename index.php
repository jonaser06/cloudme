<?php

get_header();

if ( ! function_exists('rwmb_meta') ) {
    $images  = '';
    $subtext = '';
    $cl = '';
}else{  
    $images  = rwmb_meta('_cmb_bg_header', "type=image", get_option( 'page_for_posts' ));
    if(!$images){
         $bg = '';
    } else {
         foreach ( $images as $image ) { 
            $bg = $image['full_url']; 
            break;
        }
    }
    $subtext = rwmb_meta('_cmb_page_sub', "type=text", get_option( 'page_for_posts' ));
    $cl = rwmb_meta('_cmb_color_sub', "type=color", get_option( 'page_for_posts' ));
}

?>

<div class="page-top" <?php if($bg) { ?>style="background-image: url(<?php echo esc_url($bg); ?>); background-size: cover;"<?php } ?>>
<!--  MESSAGES ABOVE HEADER IMAGE -->
<div class="message blog-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 columns">
                <div class="message-intro">
                    <span class="message-line"></span>
                        <p><?php if( is_home() && is_front_page() ) echo esc_html__( 'Blog', 'cloudme' ); else echo get_the_title( get_option( 'page_for_posts' ) ); ?></p>
                    <span class="message-line"></span>
                </div>
                <h1 style="<?php if($cl) echo 'color: '.esc_attr($cl).'; ';?>"><?php echo esc_html($subtext); ?></h1>
            </div>
        </div>
    </div>
</div>
<!--  END OF MESSAGES ABOVE HEADER IMAGE -->
</div>
<!--  END OF HEADER -->

<div class="sectionarea blog">
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <?php if(have_posts()) : ?>  

                    <?php 

                    $args = array(    

                      'paged' => $paged,

                      'post_type' => 'post',

                    );

                    $wp_query = new WP_Query($args);

                    while ($wp_query -> have_posts()): $wp_query -> the_post();                        

                    get_template_part( 'content', get_post_format() ) ;

                    endwhile;?>

                    <?php else: ?>

                    <h1><?php esc_html_e('Nothing Found Here!', 'cloudme'); ?></h1>

                <?php endif ?>
                <nav>
                    <ul class="pagination">
                        <?php echo cloudme_pagination(); ?>
                    </ul>
                </nav>

            </div>

            <div class="col-md-3">
                <?php get_sidebar();?>
            </div>
        </div>
    </div>    
</div>
<!-- content close -->
<?php get_footer(); ?>