<?php
/**
 * Plugin Name: MB Relationship
 * Plugin URI: https://metabox.io/plugins/mb-relationship/
 * Description: Create many-to-many relationships between posts, users, terms, etc.
 * Version: 1.0.0
 * Author: MetaBox.io
 * Author URI: https://metabox.io
 * License: GPL2+
 * Text Domain: mb-relationship
 * Domain Path: /languages/
 *
 * @package    Meta Box
 * @subpackage MB Relationship
 */

// Prevent loading this file directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mb_relationship_load' ) ) {
	// Hook to 'init' with priority 5 to make sure all actions are registered before Meta Box runs.
	add_action( 'init', 'mb_relationship_load', 5 );
	/**
	 * Load plugin files after Meta Box is loaded.
	 */
	function mb_relationship_load() {
		if ( ! defined( 'RWMB_VER' ) || class_exists( 'MB_Relationship_Table' ) ) {
			return;
		}
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-table.php';
		require_once dirname( __FILE__ ) . '/inc/class-rwmb-relationship-table-storage.php';

		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-object-interface.php';
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-post.php';
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-term.php';
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-user.php';
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-object-factory.php';

		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-type.php';
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-api.php';
		require_once dirname( __FILE__ ) . '/inc/class-mb-relationship-loader.php';

		do_action( 'mb_relationship_pre_init' );

		global $wpdb;
		$table = new MB_Relationship_Table( $wpdb );
		$table->create_shared();

		$factory = new MB_Relationship_Object_Factory();
		$api     = new MB_Relationship_API( $wpdb, $factory );

		$loader = new MB_Relationship_Loader();
		$loader->init();

		// All registration code goes here.
		do_action( 'mb_relationship_init', $api );
	}
}
