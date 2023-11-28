<?php defined('WPINC') || exit; ?>

<label for="profile_name"><?php _e('Name', 'ikimiz'); ?>:</label>
<input type="text" name="profile_name" id="profile_name" value="<?php echo esc_attr($name); ?>" />

<label for="profile_description"><?php _e('Description', 'ikimiz'); ?>:</label>
<textarea name="profile_description" id="profile_description"><?php echo esc_attr($description); ?></textarea>

<label for="profile_gender"><?php _e('Gender', 'ikimiz'); ?>:</label>
<select name="profile_gender" id="profile_gender">
    <option value="male" <?php selected($gender, 'male'); ?>><?php _e('Male', 'ikimiz'); ?></option>
    <option value="female" <?php selected($gender, 'female'); ?>><?php _e('Female', 'ikimiz'); ?></option>
</select>

<label for="profile_age"><?php _e('Age', 'ikimiz'); ?>:</label>
<input type="number" name="profile_age" id="profile_age" value="<?php echo esc_attr($age); ?>" />

<label for="profile_location"><?php _e('Location', 'ikimiz'); ?>:</label>
<input type="text" name="profile_location" id="profile_location" value="<?php echo esc_attr($location); ?>" />

<label for="profile_availability"><?php _e('Availability', 'ikimiz'); ?>:</label>
<input type="text" name="profile_availability" id="profile_availability" value="<?php echo esc_attr($availability); ?>" />

<label for="profile_services"><?php _e('Services', 'ikimiz'); ?>:</label>
<textarea name="profile_services" id="profile_services"><?php echo esc_attr(implode(', ', $services)); ?></textarea>

<label for="profile_images"><?php _e('Images', 'ikimiz'); ?>:</label>
<input type="text" name="profile_images" id="profile_images" value="<?php echo esc_attr($images); ?>" />

<label for="profile_videos"><?php _e('Videos', 'ikimiz'); ?>:</label>
<input type="text" name="profile_videos" id="profile_videos" value="<?php echo esc_attr($videos); ?>" />

<label for="profile_reviews"><?php _e('Reviews', 'ikimiz'); ?>:</label>
<textarea name="profile_reviews" id="profile_reviews"><?php echo esc_attr($reviews); ?></textarea>

<label for="profile_phone_number"><?php _e('Phone Number', 'ikimiz'); ?>:</label>
<input type="text" name="profile_phone_number" id="profile_phone_number" value="<?php echo esc_attr($phone_number); ?>" />

<label for="profile_whatsapp"><?php _e('WhatsApp', 'ikimiz'); ?>:</label>
<input type="text" name="profile_whatsapp" id="profile_whatsapp" value="<?php echo esc_attr($whatsapp); ?>" />

<label for="profile_nationality"><?php _e('Nationality', 'ikimiz'); ?>:</label>
<input type="text" name="profile_nationality" id="profile_nationality" value="<?php echo esc_attr($nationality); ?>" />

<label for="profile_length"><?php _e('Length', 'ikimiz'); ?>:</label>
<input type="number" name="profile_length" id="profile_length" value="<?php echo esc_attr($length); ?>" />

<label for="profile_extra_services"><?php _e('Extra Services', 'ikimiz'); ?>:</label>
<textarea name="profile_extra_services" id="profile_extra_services"><?php echo esc_attr($extra_services); ?></textarea>
<?php
?>