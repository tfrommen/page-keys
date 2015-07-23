/* global jQuery, tfPageKeysData */
;( function( Plugin, $, pluginData ) {
	"use strict";

	Plugin.Button = {
		initialize: function() {
			$( 'a.add-new-h2' ).on( 'click', function( e ) {
				e.preventDefault();

				Plugin.Button.addPageKey();
			} );
		},
		addPageKey: function() {
			var data = {
				_wpnonce: pluginData.nonces.add,
				action  : pluginData.actions.add
			};

			$.post( pluginData.url, data, function( response ) {
				if ( response.success ) {
					var $tr = Plugin.ListTable.$listTable.find( 'tbody tr' ).last(),
						$row = $( response.data.row );

					if ( $tr.hasClass( 'alternate' ) ) {
						$row.removeClass( 'alternate' );
					}

					$tr.after( $row );
					$row.find( 'input.page-key' ).select();
					Plugin.Form.$submit.prop( 'disabled', false );
					Plugin.Form.unsavedChanges = true;
				} else {
					Plugin.Form.$form.before( response.data.errors );
				}
			} );
		}
	};

	$( function() {
		Plugin.Button.initialize();
	} );

} )( Plugin, jQuery, tfPageKeysData );
