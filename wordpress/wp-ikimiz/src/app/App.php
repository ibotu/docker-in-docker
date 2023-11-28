<?php

namespace Ikimiz;

class App
{
    private $plugin_file;
    private $adminContext;

    public function init()
    {
        // Initialize your plugin's functionality
        // This could involve setting up hooks, loading other components, etc.

        // Set up activation and deactivation hooks
        //register_activation_hook($this->plugin_file, [$this, 'activate']);
        //register_deactivation_hook($this->plugin_file, [$this, 'deactivate']);

        // Register custom post type
        add_action('init', array($this, 'register_custom_post_type'));
        add_action('add_meta_boxes', array($this, 'add_and_render_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_box_data')); // Add this line
    }
    



    public function register_custom_post_type() {
        $labels = array(
            'name'                  => __('Profiles', 'Post type general name', 'textdomain'),
            'singular_name'         => __('Profile', 'Post type singular name', 'textdomain'),
            'menu_name'             => __('Profiles', 'Admin Menu text', 'textdomain'),
            'name_admin_bar'        => __('Profile', 'Add New on Toolbar', 'textdomain'),
            'add_new'               => __('Add New', 'textdomain'),
            'add_new_item'          => __('Add New Profile', 'textdomain'),
            'new_item'              => __('New Profile', 'textdomain'),
            'edit_item'             => __('Edit Profile', 'textdomain'),
            'view_item'             => __('View Profile', 'textdomain'),
            'all_items'             => __('All Profiles', 'textdomain'),
            'search_items'          => __('Search Profiles', 'textdomain'),
            'parent_item_colon'     => __('Parent Profiles:', 'textdomain'),
            'not_found'             => __('No profiles found.', 'textdomain'),
            'not_found_in_trash'    => __('No profiles found in Trash.', 'textdomain'),
            // Additional labels can be added here
        );
        $supports = array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments',
            'custom-fields', // If you plan to use custom fields
            // More features can be added here
        );

        $args = array(
            'labels'             => $labels,
            'supports'           => $supports,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-admin-post',
            'show_in_nav_menus'  => true,
            'publicly_queryable' => true,
            'rewrite'            => array('slug' => 'profile'),
            'has_archive'        => true,
            'hierarchical'       => false,
            'query_var'          => true,
            'capability_type'    => 'post',
            'show_in_rest'       => true, // For Gutenberg support
            // Additional args can be added here
        );

        register_post_type('profile', $args);
    }

    public function add_and_render_meta_boxes() {
        $meta_boxes = array(
            'profile_name_meta_box' => array('Name', 'text'),
            'profile_title_meta_box' => array('Title', 'text'),
            'profile_advertisement_text_meta_box' => array('Advertisement Text', 'textarea'),
            'profile_gender_meta_box' => array('Gender', 'select'),
            'profile_age_meta_box' => array('Age', 'number'),
            'profile_location_meta_box' => array('Location', 'text'),
            'profile_availability_meta_box' => array('Availability', 'text'),
            'profile_services_meta_box' => array('Services', 'textarea'),
            'profile_possibilities_meta_box' => array('Possibilities', 'textarea'),
            'profile_phone_number_meta_box' => array('Phone Number', 'text'),
            'profile_nationality_meta_box' => array('Nationality', 'text'),
            'profile_length_meta_box' => array('Length', 'number'),
            'profile_weight_meta_box' => array('Weight', 'number'),
            'profile_videos_meta_box' => array('Videos', 'text'),
            'profile_phone_number_meta_box' => array('Phone Number', 'text'),
            'profile_nationality_meta_box' => array('Nationality', 'text'),
            'profile_length_meta_box' => array('Length', 'number'),
            'profile_weight_meta_box' => array('Weight', 'number'),
            'profile_cupsize_meta_box' => array('Cup Size', 'text'),
            'profile_haircolor_meta_box' => array('Hair Color', 'text'),
            'profile_eyecolor_meta_box' => array('Eye Color', 'text'),
            'profile_prices_meta_box' => array('Prices', 'text')
        );
    
        foreach ($meta_boxes as $id => $details) {
            add_meta_box(
                $id,
                $details[0],
                function($post) use ($id, $details) {
                    $value = get_post_meta($post->ID, $id, true); // Removed underscore prefix
        
                    switch ($details[1]) {
                        case 'text':
                            echo '<input type="text" id="' . $id . '" name="' . $id . '" value="' . esc_attr($value) . '" />';
                            break;
                        case 'textarea':
                            echo '<textarea id="' . $id . '" name="' . $id . '">' . esc_textarea($value) . '</textarea>';
                            break;
                        case 'number':
                            echo '<input type="number" id="' . $id . '" name="' . $id . '" value="' . esc_attr($value) . '" min="0" />';
                            break;
                        case 'select':
                            echo '<select id="' . $id . '" name="' . $id . '">
                                    <option value="male" ' . selected($value, 'male', false) . '>Male</option>
                                    <option value="female" ' . selected($value, 'female', false) . '>Female</option>
                                  </select>';
                            break;
                    }
                },
                'profile',
                'normal',
                'default'
            );
        }
    }

    public function save_meta_box_data($post_id) {
        $meta_boxes = array(
            'profile_name_meta_box',
            'profile_title_meta_box',
            'profile_advertisement_text_meta_box',
            'profile_gender_meta_box',
            'profile_age_meta_box',
            'profile_location_meta_box',
            'profile_availability_meta_box',
            'profile_services_meta_box',
            'profile_possibilities_meta_box',
            'profile_phone_number_meta_box',
            'profile_nationality_meta_box',
            'profile_length_meta_box',
            'profile_weight_meta_box',
            'profile_videos_meta_box',
            'profile_phone_number_meta_box',
            'profile_nationality_meta_box',
            'profile_length_meta_box',
            'profile_weight_meta_box',
            'profile_cupsize_meta_box',
            'profile_haircolor_meta_box',
            'profile_eyecolor_meta_box',
            'profile_prices_meta_box'
            // Add the rest of your meta box IDs here
        );
    
        foreach ($meta_boxes as $meta_box_id) {
            if (isset($_POST[$meta_box_id])) {
                $meta_box_value = sanitize_text_field($_POST[$meta_box_id]);
                update_post_meta($post_id, $meta_box_id, $meta_box_value);
            }
        }
    }
}