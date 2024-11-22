<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package villoz
 */

get_header();


?>

<?php if ('yes' == get_theme_mod('error_custom')) : ?>
    <?php echo do_shortcode(\Elementor\Plugin::$instance->frontend->get_builder_content(get_theme_mod('error_custom_post'))); ?>
<?php else : ?>
    <main id="primary" class="site-main">
        <section class="error-404 default">
            <div class="container">
                <h2 class="error-404__title wow fadeInUp" data-wow-duration="1500ms">
                    <?php esc_html_e('4', 'villoz'); ?><span><?php esc_html_e('0', 'villoz'); ?></span><?php esc_html_e('4', 'villoz'); ?>
                </h2><!-- /.error-404__title -->
                <h3 class="error-404__sub-title"><?php esc_html_e('Oops! Page Not Found', 'villoz'); ?></h3><!-- /.error-404__title -->
                <p class="error-404__text"><?php esc_html_e('The page you are looking for is not exist.', 'villoz'); ?></p><!-- /.error-404__text -->
                <form action="<?php echo esc_url(home_url()); ?>" class="error-404__search">
                    <input type="text" id="error-search" placeholder="<?php esc_attr_e('Search Here...', 'villoz'); ?>" />
                    <button type="submit" class="error-404__search__btn">
                        <span><i class="icon-magnifying-glass"></i></span>
                    </button>
                </form><!-- /.error-404__search -->
                <div class="error-404__btns">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="villoz-btn">
                        <i><?php esc_html_e('Back to Home ', 'villoz'); ?></i>
                        <span><?php esc_html_e('Back to Home ', 'villoz'); ?></span>
                    </a>
                </div><!-- /.error-404__btns -->
            </div><!-- /.container -->
        </section><!-- /.error-404 -->
    </main><!-- #main -->
<?php endif; ?>

<?php
get_footer();
