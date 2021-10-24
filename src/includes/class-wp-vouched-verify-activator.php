<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/bcolemutech
 * @since      1.0.0
 *
 * @package    Wp_Vouched_Verify
 * @subpackage Wp_Vouched_Verify/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Vouched_Verify
 * @subpackage Wp_Vouched_Verify/includes
 * @author     Brian Cole <https://github.com/bcolemutech>
 */
class Wp_Vouched_Verify_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        $roles = get_editable_roles();
        foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
            if (isset($roles[$key]) && $role->has_cap('read')) {
                $role->add_cap('place_orders', false);
            }
        }
	}

}
