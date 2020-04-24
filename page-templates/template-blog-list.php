<?php

/**
 * Template Name: Blog
 */

get_header();

$subtitle = get_post_meta(get_the_ID(),'_cmb_page_sub', true);

if(cloudme_theme_option( "bg_head" )) { $bg = 'style=background-image:url(' . cloudme_theme_option( "bg_head" ) . ');background-size:cover;'; }
?>

<div class="page-top" <?php echo esc_attr($bg); ?>>
<!--  MESSAGES ABOVE HEADER IMAGE -->
<div class="message blog-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 columns">
                <div class="message-intro">
                    <span class="message-line"></span>
                        <p><?php the_title(); ?></p>
                    <span class="message-line"></span>
                </div>
                <h1 style="<?php if($cl) echo 'color: '.esc_attr($cl).'; ';?>"><?php echo htmlspecialchars_decode($subtitle); ?></h1>
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