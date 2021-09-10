<?php


/**
 * Plugin Name:       Salesforce iframes
 * Description:       Allows Salesforce forms to be added as iframes to a WordPress page or post
 * Version:           1.0.0
 * Author:            sunny
 */


class SalesforceiFrames
{

    function __construct()
    {
        add_action('init', [$this, 'registerPostType']);
        add_action('init', [$this, 'registerAcfFields']);
        add_action('admin_menu', function () {
            add_submenu_page('edit.php?post_type=salesforce-iframe', 'Options', 'Options', 'edit_posts', 'rafawp-salesforce-iframe-options', [$this, 'optionsPage']);
        });

        add_action('add_meta_boxes', function () {

            add_meta_box('rafa-salesforce-iframe-displayshortcode', __('Shortcode', 'rafawp-wordpress'), [$this, 'displayShortcode'], 'salesforce-iframe', 'side', 'high');

        });

        add_shortcode('salesforce_iframe', [$this, 'iFrameShortcode']);

    }


    function registerPostType()
    {
        $labels = [
            'name' => _x('Salesforce iFrames', 'post type general name', 'rafabasechild_rafa'),
            'singular_name' => _x('Salesforce iFrame', 'post type singular name', 'rafabasechild_rafa'),
            'menu_name' => _x('Salesforce iFrames', 'admin menu', 'rafabasechild_rafa'),
            'name_admin_bar' => _x('Salesforce iFrame', 'add new on admin bar', 'rafabasechild_rafa'),
            'add_new' => _x('Add iFrames', 'iFrame', 'rafabasechild_rafa'),
            'add_new_item' => __('Add iFrame', 'rafabasechild_rafa'),
            'new_item' => __('New iFrame', 'rafabasechild_rafa'),
            'edit_item' => __('Edit iFrame', 'rafabasechild_rafa'),
            'view_item' => __('View iFrame', 'rafabasechild_rafa'),
            'all_items' => __('All iFrames', 'rafabasechild_rafa'),
            'search_items' => __('Search iFrames', 'rafabasechild_rafa'),
            'parent_item_colon' => __('Parent  iFrame:', 'rafabasechild_rafa'),
            'not_found' => __('No iFrames found.', 'rafabasechild_rafa'),
            'not_found_in_trash' => __('No iFrames found in Trash.', 'rafabasechild_rafa')
        ];

        $args = [
            'labels' => $labels,
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => false,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => 32,
            'menu_icon' => get_template_directory_uri() . '/assets/rafa_icon.png',
            'supports' => ['title']
        ];

        register_post_type('salesforce-iframe', $args);
    }

    function registerAcfFields()
    {

        if (function_exists("register_field_group")) {
            register_field_group([
                'id' => 'acf_salesforce-iframe-settings',
                'title' => 'Salesforce iFrame Settings',
                'fields' => [
                    [
                        'key' => 'field_58da50eec6d35',
                        'label' => 'Development Sandbox Source URL',
                        'name' => 'development_sandbox_source_url',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_58da5108c6d36',
                        'label' => 'Testing Sandbox Source URL',
                        'name' => 'testing_sandbox_source_url',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_58da5115c6d37',
                        'label' => 'Staging Sandbox Source URL',
                        'name' => 'staging_sandbox_source_url',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_58da5126c6d38',
                        'label' => 'Production Source URL',
                        'name' => 'production_source_url',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'salesforce-iframe',
                            'order_no' => 0,
                            'group_no' => 0,
                        ],
                    ],
                ],
                'options' => [
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => [
                    ],
                ],
                'menu_order' => 0,
            ]);
        }

        if(function_exists("register_field_group"))
        {
            register_field_group(array (
                'id' => 'acf_newsletter-signup-salesforce-iframe',
                'title' => 'Newsletter Signup Salesforce iFrame',
                'fields' => array (
                    array (
                        'key' => 'field_58da5d86213b0',
                        'label' => 'Newsletter Signup Salesforce iFrame',
                        'name' => 'newsletter_signup_salesforce_iframe',
                        'type' => 'post_object',
                        'required' => 1,
                        'post_type' => array (
                            0 => 'salesforce-iframe',
                        ),
                        'taxonomy' => array (
                            0 => 'all',
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'page_type',
                            'operator' => '==',
                            'value' => 'front_page',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
            ));
        }

    }

    function optionsPage()
    {
        if (isset($_POST['update-rafa-iframe-options'])) {
            update_option('salesforce_env', sanitize_text_field($_POST['salesforce_env']));
        }

        $current_salesforce_env = get_option('salesforce_env');
        $salesforce_envs = ['development_sandbox' => 'Development Sandbox', 'testing_sandbox' => 'Testing Sandbox', 'staging_sandbox' => 'Staging Sandbox', 'production' => 'Production'];
        ?>

        <div class="wrap">
            <h2>Options</h2>
            <form method="post">

                <label>Salesforce Environment</label>
                <select name="salesforce_env">
                    <?php
                    foreach ($salesforce_envs as $salesforce_env => $salesforce_env_label) {
                        ?>
                        <option
                                value="<?php echo $salesforce_env; ?>"<?php if ($salesforce_env == $current_salesforce_env) {
                            echo ' selected';
                        } ?>><?php echo $salesforce_env_label; ?></option>
                        <?php
                    }
                    ?>
                </select>

                <br/>
                <input type="submit" name="update-rafa-iframe-options" value="Update" class="button button-primary">
            </form>
        </div>
        <?php
    }

    function displayShortcode()
    {
        if (get_post_status(get_the_ID()) !== 'publish') {
            echo 'Publish this form to get shortcode';
            return;
        }

        echo 'To use this form cut and past the following shortcode into any page or post content area:<br /><br />[salesforce_iframe id="' . get_the_ID() . '"]';
    }

    function iFrameShortcode($atts)
    {
        $atts = shortcode_atts([
            'id' => false,
        ], $atts, 'salesforce_iframe');

        if (!$atts['id']) {
            return '';
        }

        ob_start();
        self::displayiFrame($atts['id']);
        $return = ob_get_clean();

        return $return;
    }

    public static function displayiFrame($iframe_id)
    {

        $salesforce_env = get_option('salesforce_env');

        if (!$salesforce_env) {
            $salesforce_env = 'development_sandbox';
        }

        $iframe_source = get_field("{$salesforce_env}_source_url", $iframe_id);

        if (!$iframe_source) {
            return;
        }

        ?>
        <iframe src="<?php echo $iframe_source; ?>" frameborder="0" width="100%" class="salesforce-iframe">

        </iframe>
        <?php

    }

}

new SalesforceiFrames();
