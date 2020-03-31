<?php

/*
 * Fires when a user switches to another user account.
 */
if(!function_exists('ualSwitchToUser')) {
    function ualSwitchToUser($user_id, $old_user_id) {
        $user_info = get_userdata($user_id);
        $user_name = isset($user_info->display_name) ? $user_info->display_name : '';
        $old_user_info = get_userdata($old_user_id);
        $old_user_name = isset($old_user_info->display_name) ? $old_user_info->display_name : '';
        $obj_type = 'User Switching';
        $action = 'Switched to';
        $post_id = '';
        $post_title = ucfirst($old_user_name) .' Switched to '.ucfirst($user_name);
        ual_get_activity_function($action, $obj_type, $post_id, $post_title);
    }
}
add_action('switch_to_user','ualSwitchToUser',15,2);

/*
 * Fires when a user switches back to their originating account.
 */
if(!function_exists('ualSwitchBackUser')) {
    function ualSwitchBackUser($user_id, $old_user_id) {
        $user_info = get_userdata($user_id);
        $user_name = isset($user_info->display_name) ? $user_info->display_name : '';
        $old_user_info = get_userdata($old_user_id);
        $old_user_name = isset($old_user_info->display_name) ? $old_user_info->display_name : '';
        $obj_type = 'User Switching';
        $action = 'Switched back to';
        $post_id = '';
        $post_title = ucfirst($old_user_name) .' Switched back to '.ucfirst($user_name);
        ual_get_activity_function($action, $obj_type, $post_id, $post_title);
    }
}
add_action('switch_back_user','ualSwitchBackUser',15,2);

/*
 * Fires when a user switches off
 */
if(!function_exists('ualSwitchOffUser')) {
    function ualSwitchOffUser($old_user_id) {
        $old_user_info = get_userdata($old_user_id);
        $old_user_name = isset($old_user_info->display_name) ? $old_user_info->display_name : '';
        $obj_type = 'User Switching';
        $action = 'Switched off user';
        $post_id = '';
        $post_title = ucfirst($old_user_name) .' Switched off user';
        ual_get_activity_function($action, $obj_type, $post_id, $post_title);
    }
}
add_action('switch_off_user','ualSwitchOffUser',15,1);