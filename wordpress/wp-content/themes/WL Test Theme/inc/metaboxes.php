<?php
function create_post_type()
{
    register_post_type('car',
        array(
            'labels' => array(
                'name' => __('Cars'),
                'singular_name' => __('Car'),
            ),
            'menu_position' => 5,
            'supports' => array('title', 'editor', 'thumbnail',),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array('category'),
        )
    );
}

add_action('init', 'create_post_type');
?>

<?php
function cars_add_meta_box()
{
    add_meta_box('car_metabox', esc_html__('Cars Setting'), 'cars_meta_box_html', 'car', 'normal');
}

add_action('add_meta_boxes', 'cars_add_meta_box');

function cars_meta_box_html($post)
{

    $car_color = get_post_meta($post->ID, 'car_color', true);
    $car_fuel  = get_post_meta($post->ID, 'car_fuel', true);
    $car_power = get_post_meta($post->ID, 'car_power', true);
    $car_price = get_post_meta($post->ID, 'car_price', true);

    wp_nonce_field('carcoursesrandomstring', '_carmetabox');

    ?>
    <p>
        <label for="car_color"><?php esc_html_e('Cars Color'); ?></label>
        <input type="color" id="car_color" name="car_color" value="<?php echo esc_attr($car_color); ?>">
    </p>
    <p>
        <label for="car_fuel"><?php esc_html_e('Cars Fuel'); ?></label>
        <select id="car_fuel" name="car_fuel">
            <option value="">Не выбрано.</option>
            <option value="fuel-80"><?php if ($car_fuel == 'fuel-80') {
                    echo 'selected';
                } ?>Нормаль – АИ-80.
            </option>
            <option value="fuel-92"><?php if ($car_fuel == 'fuel-92') {
                    echo 'selected';
                } ?>Регуляр – АИ-92.
            </option>
            <option value="fuel-95"><?php if ($car_fuel == 'fuel-95') {
                    echo 'selected';
                } ?>Премиум – АИ-95.
            </option>
            <option value="fuel-95top"><?php if ($car_fuel == 'fuel-95top') {
                    echo 'selected';
                } ?>Супер – АИ-95+.
            </option>
            <option value="fuel-98"><?php if ($car_fuel == 'fuel-98') {
                    echo 'selected';
                } ?>Экстра – АИ-98.
            </option>
            <option value="fuel-100"><?php if ($car_fuel == 'fuel-100') {
                    echo 'selected';
                } ?>ЭКТО – АИ-100.
            </option>
        </select>
    </p>
    <p>
        <label for="car_power"><?php esc_html_e('Cars Power'); ?></label>
        <input type="number" id="car_power" name="car_power" value="<?php echo esc_attr($car_power); ?>">
    </p>
    <p>
        <label for="car_price"><?php esc_html_e('Cars Price'); ?></label>
        <input type="number" id="car_price" name="car_price" value="<?php echo esc_attr($car_price); ?>">
    </p>
    <?php

}

function car_save_meta_box($post_id, $post)
{

    if (!isset($_POST['_carmetabox']) || !wp_verify_nonce($_POST['_carmetabox'], 'carcoursesrandomstring')) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ($post->post_type != 'car') {
        return $post_id;
    }

    $post_type = get_post_type_object($post->post_type);
    if (!current_user_can($post_type->cap->edit_post, $post_id)) {
        return $post_id;
    }

    if (isset($_POST['car_color'])) {
        update_post_meta($post_id, 'car_color', sanitize_text_field($_POST['car_color']));
    } else {
        delete_post_meta($post_id, 'car_color');
    }

    if (isset($_POST['car_fuel'])) {
        update_post_meta($post_id, 'car_fuel', sanitize_text_field($_POST['car_fuel']));
    } else {
        delete_post_meta($post_id, 'car_fuel');
    }

    if (isset($_POST['car_power'])) {
        update_post_meta($post_id, 'car_power', sanitize_text_field($_POST['car_power']));
    } else {
        delete_post_meta($post_id, 'car_power');
    }

    if (isset($_POST['car_price'])) {
        update_post_meta($post_id, 'car_price', sanitize_text_field($_POST['car_price']));
    } else {
        delete_post_meta($post_id, 'car_price');
    }

    return $post_id;
}

add_action('save_post', 'car_save_meta_box', 10, 2);
?>
