<?php # -*- coding: utf-8 -*-

use tf\PageKeys\Models\Option;

if ( ! function_exists( 'get_page_by_key' ) ) :

	/**
	 * Return the page for the given key, if it exists.
	 *
	 * @param string $key Page key.
	 *
	 * @return \WP_Post
	 */
	function get_page_by_key( $key ) {

		$pages = Option::get();
		if ( ! empty( $pages[ $key ][ 'page_id' ] ) ) {
			return get_post( $pages[ $key ][ 'page_id' ] );
		}

		return NULL;
	}

endif;
