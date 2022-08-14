<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        $my_posts = array(
            'numberposts' => -1,
            'post_type' => 'car',
            'post_status' => 'publish',
            'posts_per_page' => 1,
        );

        $result = new WP_Query($my_posts);
        $result = $result->post;

        foreach ($result as $row) : while($row < 1)  ?>
            <div class="item-post">
            <h3><?php echo get_the_title($row->post_title); ?></h3>
            <div class="categories"><?php echo get_the_category_list($row->ID); ?></div>
            <br/>
            <p><?php echo get_the_content($row->post_content); ?></p>
            <p class="color">Цвет: <input type="color" readonly value="<?php echo get_post_meta(get_the_ID(), 'car_color', true); ?>">
            </p>
            <p>Бензин: <?php echo get_post_meta(get_the_ID(), 'car_fuel', true); ?></p>
            <p>Мощность: <?php echo get_post_meta(get_the_ID(), 'car_power', true); ?></p>
            <p>Цена: <?php echo get_post_meta(get_the_ID(), 'car_price', true); ?></p>
            </div>
            <?php break; endforeach;?>
        <?php
        wp_link_pages(
            array(
                'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            )
        );
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
