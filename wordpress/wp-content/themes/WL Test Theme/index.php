<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>

    <div class="wrap">
        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php else : ?>
            <header class="page-header">
                <h2 class="page-title"><?php _e('Posts', 'twentyseventeen'); ?></h2>
            </header>
        <?php endif; ?>

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php
                $my_posts = array(
                    'numberposts' => -1,
                    'post_type' => 'car',
                    'post_status' => 'publish',
                    'posts_per_page' => 10,
                );

                $result = new WP_Query($my_posts);
                $result = $result->posts;

                foreach ($result as $row) : ?>
                    <a href="?car=<?php echo $row->post_title; ?>" class="item-post">
                        <h3><?php echo $row->post_title; ?></h3>
                        <div class="img">
                            <img alt="" src="<?php echo get_the_post_thumbnail($row->ID, [260, 412]); ?>">
                        </div>
                        <br/>
                        <p><?php echo $row->post_content; ?></p>
                    </a>
                <?php endforeach; ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php
get_footer();
