/* global jQuery, tfPageKeysData */
;( function( Plugin, $, pluginData ) {
	"use strict";

	Plugin.ListTable = {
		initialize: function() {
			this.$listTable = Plugin.Form.$form.find( '.wp-list-table.page-keys' )
				.on( 'change', 'input.page-key', function() {
					Plugin.ListTable.checkForDuplicates( $( this ).val() );
				} )
				.on( 'click', 'a.edit', function( e ) {
					e.preventDefault();

					$( this ).closest( 'td' ).find( 'input' ).prop( 'readonly', false ).select();
					Plugin.Form.reactOnChanges();
				} )
				.on( 'change', 'select', function() {
					Plugin.Form.reactOnChanges();
				} )
				.on( 'click', 'a.submitdelete', function( e ) {
					e.preventDefault();

					Plugin.ListTable.deletePageKey( this );
				} );

			this.$listTable.find( 'input.page-key' ).prop( 'readonly', true );
		},
		checkForDuplicates: function( pageKey ) {
			var $inputs = this.$listTable.find( 'input.page-key' ).filter( function() {
					return $( this ).val() === pageKey;
				} ),
				duplicatesFound = $inputs.length > 1;

			$inputs.toggleClass( 'duplicate', duplicatesFound );
			Plugin.Form.$submit.prop( 'disabled', duplicatesFound );
			Plugin.Form.$duplicatesNotice.toggle( duplicatesFound );
		},
		deletePageKey: function( link ) {
			if ( confirm( pluginData.messages.delete ) ) {
				var data = {
					_wpnonce: pluginData.nonces.delete,
					action  : pluginData.actions.delete,
					id      : $( link ).data( 'id' ),
					page_key: $( link ).closest( 'td' ).find( 'input.page-key' ).val()
				};

				$.post( pluginData.url, data, function( response ) {
					Plugin.Form.$form.before( response.data.errors );

					if ( response.success ) {
						Plugin.ListTable.$listTable.find( 'a.submitdelete-' + response.data.id ).closest( 'tr' ).hide( 'slow', function() {
							var pageKey = $( link ).val();

							$( link ).remove();
							Plugin.ListTable.checkForDuplicates( pageKey );
						} ).nextAll().toggleClass( 'alternate' );
					}
				} );
			}
		}
	};

	$( function() {
		Plugin.ListTable.initialize();
	} );

} )( Plugin, jQuery, tfPageKeysData );
