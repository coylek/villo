<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package villoz
 */

get_header();
?>


<!--Blog Sidebar Start-->
<section class="blog-one blog-one--page">
	<div class="container">
		<div class="row gutter-y-60 <?php echo esc_attr('full-width' == villoz_blog_layout() ? 'justify-content-center' : ""); ?>">
			<?php $villoz_content_class = (is_active_sidebar('sidebar-1')) ? "col-xl-8 col-lg-7" : "col-xl-12 col-lg-12" ?>
			<div class="<?php echo esc_attr($villoz_content_class); ?>">
				<div class="blog-details__left blog-details">
					<?php
					while (have_posts()) :
						the_post();

						get_template_part('template-parts/content', 'page');

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
			</div>
			<?php if (is_active_sidebar('sidebar-1') &&  'full-width' != villoz_blog_layout()) : ?>
				<div class="col-xl-4 col-lg-5 <?php echo esc_attr(villoz_blog_layout()); ?>">
					<div class="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<!--Blog Sidebar End-->

<?php
get_footer();
