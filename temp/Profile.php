<?php

namespace Ikimiz;

class Profile
{

    const COLUMNS = [
        'name',
        'description',
        'gender',
        'age',
        'location',
        'availability',
        'services',
        'images',
        'videos',
        'reviews',
        'phoneNumber',
        'nationality',
        'length',
        'weight',
        'cupSize',
        'hairColor',
        'eyeColor',
        'prices',
        'extraServices'
    ];

    public $name;
    public $description;
    public $gender;
    public $age; // Numeric
    public $location;
    public $availability; // Time
    public $services; // Array of services (checkbox list)
    public $images; // Array of image URLs
    public $videos; // Array of video URLs
    public $reviews; // Array of review texts or objects
    public $phoneNumber;
    public $whatsapp;
    public $nationality; // Selected from a list of countries
    public $length; // Numeric
    public $weight; // Numeric
    public $cupSize; // Letter (select list)
    public $hairColor; // Selected from options
    public $eyeColor; // Selected from options
    public $prices; // Associative array, e.g., ['1 hour' => price, '2 hours' => price, ...]
    public $extraServices; // Associative array, e.g., ['service' => price, ...]

    public function __construct($name, $description, $gender, $age, $location, $availability, $services, $images, $videos, $reviews, $phoneNumber, $whatsapp, $nationality, $length, $weight, $cupSize, $hairColor, $eyeColor, $prices, $extraServices) {
        $this->name = $name;
        $this->description = $description;
        $this->gender = $gender;
        $this->age = $age;
        $this->location = $location;
        $this->availability = $availability;
        $this->services = $services;
        $this->images = $images;
        $this->videos = $videos;
        $this->reviews = $reviews;
        $this->phoneNumber = $phoneNumber;
        $this->whatsapp = $whatsapp;
        $this->nationality = $nationality;
        $this->length = $length;
        $this->weight = $weight;
        $this->cupSize = $cupSize;
        $this->hairColor = $hairColor;
        $this->eyeColor = $eyeColor;
        $this->prices = $prices;
        $this->extraServices = $extraServices;

        
    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('add_meta_boxes', [__CLASS__, 'addCustomFields']);
        add_action('save_post', [__CLASS__, 'saveCustomFields']);
    }

    public static function registerPostType()
    {
        $labels = [
            'name'               => __('Profiles', 'textdomain'),
            'singular_name'      => __('Profile', 'textdomain'),
            'menu_name'          => __('Profiles', 'textdomain'),
            'name_admin_bar'     => __('Profile', 'textdomain'),
            'add_new'            => __('Add New', 'textdomain'),
            'add_new_item'       => __('Add New Profile', 'textdomain'),
            'new_item'           => __('New Profile', 'textdomain'),
            'edit_item'          => __('Edit Profile', 'textdomain'),
            'view_item'          => __('View Profile', 'textdomain'),
            'all_items'          => __('All Profiles', 'textdomain'),
            'search_items'       => __('Search Profiles', 'textdomain'),
            'parent_item_colon'  => __('Parent Profiles:', 'textdomain'),
            'not_found'          => __('No profiles found.', 'textdomain'),
            'not_found_in_trash' => __('No profiles found in Trash.', 'textdomain')
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'profile'],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'thumbnail'],
            'menu_icon'          => 'dashicons-id',
        ];

        register_post_type('profile', $args);
    }

    public static function addCustomFields()
    {
        add_meta_box(
            'profile_fields',
            __('Profile Fields', 'textdomain'),
            [__CLASS__, 'renderCustomFields'],
            'profile',
            'normal',
            'default'
        );
    }

    public static function renderCustomFields($post)
    {
        $fields = [
            'name' => ['type' => 'text', 'label' => __('Name', 'ikimiz')],
            'description' => ['type' => 'textarea', 'label' => __('Description', 'ikimiz')],
            'gender' => ['type' => 'radio', 'label' => __('Gender', 'ikimiz'), 'options' => ['Male', 'Female']],
            // Add the rest of the fields here...
        ];

        foreach ($fields as $key => $field) {
            echo '<label for="' . $key . '">' . $field['label'] . '</label>';
    
            switch ($field['type']) {
                case 'text':
                case 'number':
                    echo '<input type="' . $field['type'] . '" id="' . $key . '" name="' . $key . '">';
                    break;
                case 'textarea':
                    echo '<textarea id="' . $key . '" name="' . $key . '"></textarea>';
                    break;
                case 'radio':
                case 'checkbox':
                    foreach ($field['options'] as $option) {
                        echo '<input type="' . $field['type'] . '" id="' . $option . '" name="' . $key . '[]">' . $option;
                    }
                    break;
                // Handle other field types here...
            }
    
            echo '<br>';
        }

        $profile_data = get_post_meta($post->ID, '_profile_data', true);

        $name = isset($profile_data['name']) ? $profile_data['name'] : '';
        $description = isset($profile_data['description']) ? $profile_data['description'] : '';
        $gender = isset($profile_data['gender']) ? $profile_data['gender'] : '';
        $age = isset($profile_data['age']) ? $profile_data['age'] : '';
        $location = isset($profile_data['location']) ? $profile_data['location'] : '';
        $availability = isset($profile_data['availability']) ? $profile_data['availability'] : '';
        $services = isset($profile_data['services']) ? $profile_data['services'] : [];
        $images = isset($profile_data['images']) ? $profile_data['images'] : '';
        $videos = isset($profile_data['videos']) ? $profile_data['videos'] : '';
        $reviews = isset($profile_data['reviews']) ? $profile_data['reviews'] : '';
        $phone_number = isset($profile_data['phone_number']) ? $profile_data['phone_number'] : '';
        $whatsapp = isset($profile_data['whatsapp']) ? $profile_data['whatsapp'] : '';
        $nationality = isset($profile_data['nationality']) ? $profile_data['nationality'] : '';
        $length = isset($profile_data['length']) ? $profile_data['length'] : '';
        $weight = isset($profile_data['weight']) ? $profile_data['weight'] : '';
        $cupsize = isset($profile_data['cupsize']) ? $profile_data['cupsize'] : '';
        $haircolor = isset($profile_data['haircolor']) ? $profile_data['haircolor'] : '';
        $eyecolor = isset($profile_data['eyecolor']) ? $profile_data['eyecolor'] : '';
        $prices = isset($profile_data['prices']) ? $profile_data['prices'] : '';
        $extra_services = isset($profile_data['extra_services']) ? $profile_data['extra_services'] : '';

        

    }

    function add_profile_meta_boxes() {
        add_meta_box('profile_details', 'Profile Details', 'profile_details_meta_box_callback', 'profile');
    }
    add_action('add_meta_boxes', 'add_profile_meta_boxes');
    
    function profile_details_meta_box_callback($post) {
        // Create form fields here
        // Use get_post_meta($post->ID, 'meta_key', true) to retrieve saved values
        // Use wp_nonce_field() for security
    }

    public static function saveCustomFields($post_id)
    {
        // Save custom field data when the post is saved.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if (isset($_POST['profile_name'])) {
            $profile_data = [
                'name' => sanitize_text_field($_POST['profile_name']),
                // Add more fields as needed.
            ];

            update_post_meta($post_id, '_profile_data', $profile_data);
        }
    }

    // Register a custom post type
    function register_custom_post_type() {
        register_post_type('your_custom_post_type', array(
            'labels' => array(
                'name' => __('Custom Post Types', 'wp-ikimiz'),
                'singular_name' => __('Custom Post Type', 'wp-ikimiz'),
            ),
            // Add other arguments and options as needed
        ));
    }

    add_action('init', 'register_custom_post_type');

}
