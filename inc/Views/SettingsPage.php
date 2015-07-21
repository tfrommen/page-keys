<?php # -*- coding: utf-8 -*-

namespace tf\PageKeys\Views;

use tf\PageKeys\Controllers;
use tf\PageKeys\ListTable;
use tf\PageKeys\Models;

/**
 * Class SettingsPage
 *
 * @package tf\PageKeys\Views
 */
class SettingsPage {

	/**
	 * @var Models\SettingsPage
	 */
	private $model;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param Models\SettingsPage $model Settings page model.
	 */
	public function __construct( Models\SettingsPage $model ) {

		$this->model = $model;

		$this->title = _x( 'Page Keys', 'Settings page title', 'page-keys' );
	}

	/**
	 * Add the settings page to the Pages menu.
	 *
	 * @wp-hook admin_menu
	 *
	 * @return void
	 */
	public function add() {

		$menu_title = _x( 'Page Keys', 'Menu item title', 'page-keys' );
		add_pages_page(
			$this->title,
			$menu_title,
			$this->model->get_capability( 'list' ),
			$this->model->get_slug(),
			array( $this, 'render' )
		);
	}

	/**
	 * Render the HTML.
	 *
	 * @return void
	 */
	public function render() {

		$current_user_can_edit = $this->model->current_user_can( 'edit' );

		$option_name = Models\Option::get_name();

		$list_table = new ListTable( $this->model );
		$list_table->prepare_items();
		?>
		<div class="wrap">
			<h2>
				<?php esc_html_e( $this->title ); ?>
				<?php if ( $current_user_can_edit ) : ?>
					<a href="<?php echo $this->model->get_add_page_key_url(); ?>" class="add-new-h2">
						<?php esc_html_e( 'Add New' ); ?>
					</a>
				<?php endif; ?>
			</h2>
			<?php settings_errors(); ?>
			<form action="<?php echo admin_url( 'options.php' ); ?>" method="post" id="page-keys-form">
				<?php settings_fields( $option_name ); ?>
				<?php $list_table->display(); ?>

				<?php if ( $current_user_can_edit ) : ?>
					<?php submit_button(); ?>
					<div class="error inline">
						<p>
							<?php _e( '<strong>Warning:</strong> Duplicate page keys found!', 'page-keys' ); ?>
						</p>
					</div>
				<?php endif; ?>
			</form>
		</div>
	<?php
	}

}