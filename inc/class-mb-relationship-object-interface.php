<?php
/**
 * The interface for objects (posts, terms, users, etc.).
 *
 * @package    Meta Box
 * @subpackage MB Relationship
 */

/**
 * Object interface.
 */
interface MB_Relationship_Object_Interface {
	/**
	 * Get query arguments.
	 *
	 * @param array $settings Connection settings.
	 *
	 * @return array
	 */
	public function get_query_args( $settings );

	/**
	 * Get current object ID.
	 *
	 * @return int
	 */
	public function get_current_id();

	/**
	 * Get HTML link to the object.
	 *
	 * @param int $id Object ID.
	 *
	 * @return string
	 */
	public function get_link( $id );
}