<?php

/**
 * Template Name: Full Width
 */

get_header();

$subtitle = get_post_meta(get_the_ID(),'_cmb_page_sub', true);
$cl = get_post_meta(get_the_ID(),'_cmb_color_sub', true);

?>

<?php
    $bg = '';
    if ( ! function_exists('rwmb_meta') ) { 
        $bg = '';
    }else{
        $images = rwmb_meta('_cmb_bg_header', "type=image" ); 
        if(!$images){
             $bg = '';
        } else {
             foreach ( $images as $image ) { 
                $bg = 'style=background-image:url(' . esc_url( $image['full_url'] ) . ');background-size:cover;'; 
                break;
            }
        }
    }
   
?>
<div class="page-top" <?php echo esc_attr($bg); ?>>
<!--  MESSAGES ABOVE HEADER IMAGE -->
<div class="message">
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
               
<?php while (have_posts()) : the_post()?>

    <?php the_content(); ?>
    
<?php endwhile; ?>

<!-- content close -->
<?php get_footer(); ?>