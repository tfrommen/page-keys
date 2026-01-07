<?php

namespace tf\PageKeys\Models\SettingsErrors;

/**
 * Class InvalidPageKey
 *
 * @package tf\PageKeys\Models\SettingsErrors
 */
class InvalidPageKey extends SettingsError {

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param string $page_key Page key.
	 */
	public function __construct( $page_key ) {

		$this->set_slug( 'Invalid Page Key' );

		$this->set_code( 'invalid-page-key' );

		/* translators: 1: page key. */
		$message = _x( 'Page key "%s" invalid!', 'Settings error message', 'page-keys' );
		$message = sprintf( $message, $page_key );
		$this->set_message( $message );
	}

}
