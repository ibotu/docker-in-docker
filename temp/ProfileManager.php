<?php
namespace YourNamespace;

class ProfileManager
{
    public static function init()
    {
        add_action('init', [__CLASS__, 'registerPostType']);
        add_action('add_meta_boxes', [__CLASS__, 'addCustomFields']);
        add_action('save_post', [__CLASS__, 'saveCustomFields']);
    }

    public static function registerPostType()
    {
        $labels = [
            'name'               => __('Profiles', 'ikimiz'),
            'singular_name'      => __('Profile', 'ikimiz'),
            'menu_name'          => __('Profiles', 'ikimiz'),
            'name_admin_bar'     => __('Profile', 'ikimiz'),
            'add_new'            => __('Add New', 'ikimiz'),
            'add_new_item'       => __('Add New Profile', 'ikimiz'),
            'new_item'           => __('New Profile', 'ikimiz'),
            'edit_item'          => __('Edit Profile', 'ikimiz'),
            'view_item'          => __('View Profile', 'ikimiz'),
            'all_items'          => __('All Profiles', 'ikimiz'),
            'search_items'       => __('Search Profiles', 'ikimiz'),
            'parent_item_colon'  => __('Parent Profiles:', 'ikimiz'),
            'not_found'          => __('No profiles found.', 'ikimiz'),
            'not_found_in_trash' => __('No profiles found in Trash.', 'ikimiz')
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
        // You can add your custom fields here using HTML inputs or other form elements.
        // Example:
        $profile_data = get_post_meta($post->ID, '_profile_data', true);
        $name = isset($profile_data['name']) ? $profile_data['name'] : '';
        ?>
        <label for="profile_name"><?php _e('Name', 'ikimiz'); ?>:</label>
        <input type="text" name="profile_name" id="profile_name" value="<?php echo esc_attr($name); ?>" />
        <?php
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
}

// Initialize the class
ProfileManager::init();
