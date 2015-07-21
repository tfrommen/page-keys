/* global tfPageKeysData */
;( function( Plugin, $, pluginData ) {
	"use strict";

	Plugin.Form = {
		initialize: function() {
			this.unsavedChanges = false;

			window.onbeforeunload = function() {
				if ( Plugin.Form.unsavedChanges ) {
					return pluginData.messages.unload;
				}
			};

			this.$form = $( '#page-keys-form' ).on( 'submit', function() {
				window.onbeforeunload = null;
			} );

			this.$submit = this.$form.find( '#submit' ).prop( 'disabled', true );

			this.$duplicatesNotice = this.$form.find( '.error.inline' ).hide();
		},
		reactOnChanges: function() {
			this.$submit.prop( 'disabled', false );
			this.unsavedChanges = true;
		}
	};

	$( function() {
		Plugin.Form.initialize();
	} );

} )( Plugin, jQuery, tfPageKeysData );
