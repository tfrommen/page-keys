<?php # -*- coding: utf-8 -*-

namespace tf\PageKeys\Controllers;

use tf\PageKeys\Models\TextDomain as Model;

/**
 * Class TextDomain
 *
 * @package tf\PageKeys\Controllers
 */
class TextDomain {

	/**
	 * @var Model
	 */
	private $model;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param Model $model Model.
	 */
	public function __construct( Model $model ) {

		$this->model = $model;
	}

	/**
	 * Wire up all functions.
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'init', array( $this->model, 'load' ) );
	}

}
