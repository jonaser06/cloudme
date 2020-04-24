<?php
/*
 * Template Name: WHMCS
 * Description: A Page Template with a Page Builder design.
 */
get_header('whmcs'); ?>

<?php if (have_posts()){ ?>
	<div class="whmcs-content">
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
	<?php }else {
		_e('Page Canvas For Page Builder', 'cloudme'); 
	}?>

<?php get_footer(); ?>