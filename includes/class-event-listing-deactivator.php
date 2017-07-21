<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com
 * @since      1.0.0
 *
 * @package    Event_Listing
 * @subpackage Event_Listing/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Event_Listing
 * @subpackage Event_Listing/includes
 * @author     A <A>
 */
class Event_Listing_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		global $wpdb;
     	$table_name = $wpdb->prefix . 'posts';
     	$sql = "DELETE FROM $table_name WHERE post_type='event_listing'";
     	$wpdb->query($sql);


        // clear the permalinks to remove our post type's rules
        flush_rewrite_rules();
	}

}
