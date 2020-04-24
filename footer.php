<?php
/**
 * The template for displaying the footer
 */
?>

    <?php //if(cloudme_theme_option('topfooter')) { ?>
    
    <footer>
        <div class="container">
            <?php if(cloudme_theme_option('topfooter')) { ?>
            <div class="row">
                <div class="contacts">
                    <?php if(cloudme_theme_option('address')) { ?>
                    <div class="col-sm-3 columns">
                        <i class="fa fa-map-marker"></i>
                        <?php echo wp_kses(cloudme_theme_option('address'), wp_kses_allowed_html('post')); ?>
                    </div>
                    <?php }if(cloudme_theme_option('phone')) { ?>
                    <div class="col-sm-3 columns">
                        <i class="fa fa-mobile"></i>
                        <?php echo wp_kses(cloudme_theme_option('phone'), wp_kses_allowed_html('post')); ?>
                    </div>
                    <?php }if(cloudme_theme_option('livechat')) { ?>
                    <div class="col-sm-3 columns">
                        <a href="<?php echo esc_url(cloudme_theme_option('livechat')) ?>"><i class="fa fa-comments"></i></a>
                        <?php esc_html_e('LIVE CHAT', 'cloudme') ?>
                    </div>
                    <?php }if(cloudme_theme_option('email')) { ?>
                    <div class="col-sm-3 columns">
                        <a href="mailto:<?php echo cloudme_theme_option('email') ?>"><i class="fa fa-envelope-o"></i></a>
                        <?php esc_html_e('E-MAIL US', 'cloudme') ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="footerlinks">
                    <?php get_sidebar('footer');?>
                </div>
            </div>
            <!--SOCIAL LINKS -->
            <div class="social">
                <div class="row">
                    <div class="small-12 columns">
                        <ul class="small-block-grid-1 large-block-grid-5 medium-block-grid-5">

                            <?php cloudme_socials(); ?>
                    
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END OF SOCIAL LINKS -->
        </div>

        <p class="copyright"><?php echo wp_kses(cloudme_theme_option('copyr'), wp_kses_allowed_html('post')); ?></p>
    </footer>
    <a href="#toptop" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<?php wp_footer(); ?>
    
</body>
</html>