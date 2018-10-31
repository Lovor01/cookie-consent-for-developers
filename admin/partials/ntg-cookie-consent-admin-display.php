<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.lovrohrust.com.hr
 * @since      1.0.0
 *
 * @package    Ntg_Cookie_Consent
 * @subpackage Ntg_Cookie_Consent/admin/partials
 */

//<!-- This file should primarily consist of HTML with a little bit of PHP. -->
function ntg_display_admin_html() {
	// check user capabilities
	if (!current_user_can('manage_options')) {
		return;
	};
	
	 // add error/update messages
 
	// check if the user have submitted the settings
	// wordpress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'ntgcc_messages', 'ntgcc_message', __( 'Settings Saved', 'Ntg_Cookie_Consent' ), 'updated' );
	}
	
	// show error/update messages
	settings_errors( 'wporg_messages' );
	?>
	<div class="wrap">
		<div style="margin-bottom:40px;">
			<img id="ntg-logo" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/03GO_logo.png' ?>" style="height:40px;margin-right:20px;display:inline;vertical-align:bottom;">
			<h1 style="display:inline;">Cookie consent for developers<?php esc_html(get_admin_page_title()); ?></h1>
		</div>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "wporg_options"
			settings_fields('ntgcc');
			// output setting sections and their fields
			// (sections are registered for "ntgcc", each field is registered to a specific section)
			do_settings_sections('ntgcc');
			// output save settings button
			submit_button('Save Settings');
			?>
		</form>
		<p><b>*</b>&nbsp;<?php _e('example', 'ntg-cookie-consent') ?>:</p>
		<code>&lt;!-- Global Site Tag (gtag.js) - Google Analytics --&gt;<br>
		&lt;script async src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"&gt;<br>&lt;/script&gt;
		</code>
		<p><b>ǂ</b>&nbsp;<?php _e('example', 'ntg-cookie-consent') ?>:</p>
		<code>
			window['ga-disable-UA-xxxxx'] = false;
			window.dataLayer = window.dataLayer || [];<br>
			function gtag(){dataLayer.push(arguments);}<br>
			gtag('js', new Date());<br>
			gtag('config', 'GA_TRACKING_ID');
		</code>
		<p><b>§</b>&nbsp;<?php _e('example', 'ntg-cookie-consent') ?>:</p>
		<code>
			window['ga-disable-UA-xxxxx'] = true;
		</code>
		<p><b>&amp;</b>&nbsp;<?php _e('example', 'ntg-cookie-consent') ?>:</p>
		<code>
		document.getElementById("cookies-background").style.opacity="1";
		document.getElementById("cookies-box").style.opacity="1";
		</code>
		<p><?php _e('And you have to set transitions in your css, e.g.', 'ntg-cookie-consent') ?>:</p>
		<code>
		#cookies-background {<br>
			&emsp;&emsp;opacity: 0;<br>
			&emsp;&emsp;transition: opacity 200ms linear;<br>
		}
		</code>
	</div>
	<?php
	}

function ntgccOutputsection1($args){
}

function ntgccShow_window_text( $args ) {

	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccTexttoshow" rows="4" cols="78"><?php echo get_option( 'ntgccTexttoshow' ) ?></textarea>
	<?php
}

function ntgccShow_BtnAccept( $args ) {

	// output the field
	?>
	<input id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccBtnAcceptText" value="<?php echo get_option( 'ntgccBtnAcceptText' ) ?>" type="text" size="80">
	<?php
}

function ntgccShow_BtnLearnMore( $args ) {

	// output the field
	?>
	<input id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccBtnLearnMore" value="<?php echo get_option( 'ntgccBtnLearnMore' ) ?>" type="text" size="80">
	<?php
}


function ntgccShow_ID( $args ) {
	// output the field
	?>
	<input id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccLearnmoreId" value="<?php echo get_option( 'ntgccLearnmoreId' ) ?>" type="number" size="12">
	<?php
}

function ntgccShow_APIId( $args ) {
	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccHeadCode" rows="4" cols="78"><?php echo get_option( 'ntgccHeadCode' ) ?></textarea>
	<?php
}

function ntgccShow_functionHeaderCallCode( $args ) {
	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccExecuteHeadCode" rows="4" cols="78"><?php echo get_option( 'ntgccExecuteHeadCode' ) ?></textarea>
	<?php
}

function ntgccShow_functionFooterCallCode( $args ) {
	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccExecuteFooterCode" rows="4" cols="78"><?php echo get_option( 'ntgccExecuteFooterCode' ) ?></textarea>
	<?php
}


function ntgccShow_Footer( $args ) {
	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccFooterCode" rows="4" cols="78"><?php echo get_option( 'ntgccFooterCode' ) ?></textarea>
	<?php
}

function ntgccShow_OptOut( $args ) {
	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccGoogleOptOutCode" rows="2" cols="78"><?php echo get_option( 'ntgccGoogleOptOutCode' ) ?></textarea>
	<?php
}

function ntgccShow_CustomCode( $args ) {
	// output the field
	?>
	<textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" name="ntgccCustomCode" rows="4" cols="78"><?php echo get_option( 'ntgccCustomCode' ) ?></textarea>
	<?php
}