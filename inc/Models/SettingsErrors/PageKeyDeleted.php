<?php

namespace tf\PageKeys\Models\SettingsErrors;

/**
 * Class PageKeyDeleted
 *
 * @package tf\PageKeys\Models\SettingsErrors
 */
class PageKeyDeleted extends SettingsError {

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param string $page_key Page key.
	 */
	public function __construct( $page_key ) {

		$this->set_slug( 'Page Key deleted' );

		$this->set_code( 'page-key-deleted' );

		/* translators: 1: page key. */
		$message = _x( 'Page key "%s" permanently deleted.', 'Settings error message', 'page-keys' );
		$message = sprintf( $message, $page_key );
		$this->set_message( $message );

		$this->set_type( 'updated' );
	}

}
