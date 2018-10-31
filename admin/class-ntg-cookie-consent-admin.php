<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.lovrohrust.com.hr
 * @since      1.0.0
 *
 * @package    Ntg_Cookie_Consent
 * @subpackage Ntg_Cookie_Consent/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ntg_Cookie_Consent
 * @subpackage Ntg_Cookie_Consent/admin
 * @author     Lovro Hrust <hrustlovro@gmail.com>
 */
class Ntg_Cookie_Consent_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ntg_Cookie_Consent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ntg_Cookie_Consent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ntg-cookie-consent-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ntg_Cookie_Consent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ntg_Cookie_Consent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ntg-cookie-consent-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function Ntg_Cookie_Consent_register_settings() {
		
		// register a new setting for "ntgcc" page
		register_setting( 'ntgcc', 'ntgccTexttoshow', ['sanitize_callback' => [$this, 'ntgsanitizeText'], 'type' => 'string'] );
		register_setting( 'ntgcc', 'ntgccBtnAcceptText', ['sanitize_callback' => [$this, 'ntgsanitizeText'], 'type' => 'string'] );
		register_setting( 'ntgcc', 'ntgccBtnLearnMore', ['sanitize_callback' => [$this, 'ntgsanitizeText'], 'type' => 'string'] );
		register_setting( 'ntgcc', 'ntgccLearnmoreId', ['sanitize_callback' => [$this, 'ntgsanitizeID'], 'type' => 'number']);
		register_setting( 'ntgcc', 'ntgccHeadCode' );
		register_setting( 'ntgcc', 'ntgccExecuteHeadCode' );
		register_setting( 'ntgcc', 'ntgccFooterCode' );
		register_setting( 'ntgcc', 'ntgccExecuteFooterCode' );
		register_setting( 'ntgcc', 'ntgccGoogleOptOutCode' );
		register_setting( 'ntgcc', 'ntgccCustomCode' );

		// register a new section in the "wporg" page
		add_settings_section(
		'ntgccoutParameters',
		__( 'Plugin settings', 'ntg-cookie-consent' ),
		'ntgccOutputsection1',
		'ntgcc'
		);
		
		// register a new field for showing text in window
		add_settings_field(
			'ntgccField_window_text', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Text in informative window (can be HTML)', 'ntg-cookie-consent' ),
			'ntgccShow_window_text',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgcctext'
			//'class' => 'ntgccTekst'
			]
		);

		add_settings_field(
			'ntgccField_BtnAccept', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Text on Accept button', 'ntg-cookie-consent' ),
			'ntgccShow_BtnAccept',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgcctext'
			//'class' => 'ntgccTekst'
			]
		);

		add_settings_field(
			'ntgccField_BtnLearnMore', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Text on Learn more button', 'ntg-cookie-consent' ),
			'ntgccShow_BtnLearnMore',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgcctext'
			//'class' => 'ntgccTekst'
			]
		);

		// register a new field for link
		add_settings_field(
			'ntgccField_link', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'ID of the more about cookies page', 'ntg-cookie-consent' ),
			'ntgccShow_ID',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccpageID'
			//'class' => 'ntgccTekst'
			]
			);

			// register an id field
		add_settings_field(
			'ntgccField_HeaderCode', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Scripts in &lt;head&gt; tag, without code that executes those scripts, enclosed with &lt;script> and &lt;/script&gt; other HTML is optional <b>*</b>', 'ntg-cookie-consent' ),
			'ntgccShow_APIId',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccAPIId'
			]
			);
		
		add_settings_field(
			'ntgccExecuteHeadCode', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Code that executes scripts in &lt;head&gt; tag, without any HTML <b>ǂ</b>', 'ntg-cookie-consent' ),
			'ntgccShow_functionHeaderCallCode',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccCallScript'
			]
			);	

		add_settings_field(
			'ntgccField_FooterCode', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Footer scripts in &lt;body&gt; tag, without code that executes those scripts, other HTML optional', 'ntg-cookie-consent' ),
			'ntgccShow_Footer',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccOptOutScript'
			]
			);

		add_settings_field(
			'ntgccExecuteFooterCode', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Code that executes scripts in &lt;body&gt; tag, without any HTML', 'ntg-cookie-consent' ),
			'ntgccShow_functionFooterCallCode',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccCallScript'
			]
			);

		add_settings_field(
			'ntgccGoogleOptOutCode', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Opt-out javascript code <b>§</b>', 'ntg-cookie-consent' ),
			'ntgccShow_OptOut',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccOptOutScript'
			]
			);

		add_settings_field(
			'ntgccCustomCode', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Custom javascript code, can be used for special effects like transitions &amp;', 'ntg-cookie-consent' ),
			'ntgccShow_CustomCode',
			'ntgcc',
			'ntgccoutParameters',
			[
			'label_for' => 'ntgccOptOutScript'
			]
			);
	
	
	

	}

	public function add_menu_entry() {
		// dodaje se stavka u Tools

		add_submenu_page(
			'tools.php',
			'Cookie consent',
			'Cookie consent for developers',
			'manage_options',
			'ntgcookie',
			'ntg_display_admin_html'
		);
	}


	public function ntgsanitizeText($input = NULL){
		if (isset($input))
			return wp_filter_post_kses( $input );
	}
	
	public function ntgsanitizeID($input = NULL){
		if (isset($input))
			return intval( $input );
	}
}