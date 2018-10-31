<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.lovrohrust.com.hr
 * @since      1.0.0
 *
 * @package    Ntg_Cookie_Consent
 * @subpackage Ntg_Cookie_Consent/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ntg_Cookie_Consent
 * @subpackage Ntg_Cookie_Consent/public
 * @author     Lovro Hrust <hrustlovro@gmail.com>
 */
class Ntg_Cookie_Consent_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ntg-cookie-consent-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ntg-cookie-consent-public.js', array( 'jquery' ), $this->version, false );

	}

	
	public function enqueue_inline_scripts() {

		/**
		 * This function inlines required scripts.
		 *
		 */
		//stavlja kod u headeru
		$topo_home = home_url( '', 'relative' );
		if ($topo_home == '')
			$topo_home = '/';
		echo get_option( 'ntgccHeadCode' ) .
			'<script>var ntgCookieAccepted=(function(){var v=document.cookie.match(\'(^|;) ?\'+\'cookiesAccepted\'+\'=([^;]*)(;|$)\');return v ? v[2] : null;})();var ntgrootpath="'. $topo_home . '";function setCookie(cname, cvalue, exdays) {var d = new Date(); d.setTime(d.getTime() + (exdays*24*60*60*1000));var expires = "expires="+ d.toUTCString();document.cookie = cname + "=" + cvalue + ";" + expires + ";path=" + ntgrootpath;};
function acceptFnHead() { document.getElementById("cookies-background").style.display="none"; setCookie("cookiesAccepted", 1, 30); ntgExecuteCodeFunction(); };
function ntgExecuteCodeFunction() {window[\'ga-disable-UA-55646209-1\'] = false;' . get_option( 'ntgccExecuteHeadCode' ) . '};
if (ntgCookieAccepted==1) ntgExecuteCodeFunction();
function acceptCookies(acceptAll) {if (!acceptAll) {var c=document.cookie.split(";");for(var i=0;i<c.length;i++){var e=c[i].indexOf("=");var n=e>-1?c[i].substr(0,e):c[i];document.cookie=n+"=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/" + ntgrootpath;}};setCookie("cookiesAccepted", acceptAll ? 1 : 2, 30);if (acceptAll == 1) ntgExecuteCodeFunction();};
document.addEventListener("DOMContentLoaded", function(event) {if (!ntgCookieAccepted) document.getElementById("cookies-background").style.display="block";if (document.getElementById("btnAcceptCookies") != null) {document.getElementById("btnAcceptCookies").addEventListener("click", function(event){event.preventDefault();acceptCookies(true);});document.getElementById("btnRefuseCookies").addEventListener("click", function(event){event.preventDefault();acceptCookies(false);})};});
window.addEventListener("load", function(event) {if (!ntgCookieAccepted) {' . get_option( 'ntgccCustomCode' ) . '};});
if (ntgCookieAccepted==2) {' . get_option( 'ntgccGoogleOptOutCode' ) . '};
			</script>';
	}


	public function show_html() {
		// consider moving this to partials
		// places kod in gooter
		echo ((!is_admin() && !is_page( get_option( 'ntgccLearnmoreId' ) ) ) ? 
			'<!--googleoff: index-->
				<div id="cookies-background" style="display:none;">
					<div id="cookies-box">
						<div class="infoText">' . balanceTags( get_option('ntgccTexttoshow') ) . '</div>
						<div class="btnsCookie"><button id="btnAccept" class="btnCookie" onclick="acceptFnHead();acceptFnFooter()">' . get_option( 'ntgccBtnAcceptText' ) . '</button><a id="btnLearn-more" href="' . get_permalink( get_option('ntgccLearnmoreId') ) .'">' . get_option( 'ntgccBtnLearnMore' ) . '</a></div>
					</div>
				</div>
				<!--googleon: index-->' :
				'') . get_option( 'ntgccFooterCode' ) . 
				'<script>function acceptFnFooter(){' . get_option( 'ntgccExecuteFooterCode' ) . '};
				if (ntgCookieAccepted==1) acceptFnFooter();</script>';
	}

	public function youtube_nocookie($content) {
		$content = str_replace  ( 'https://www.youtube.com/embed' , 'https://www.youtube-nocookie.com/embed' , $content );
		$content = str_replace  ( 'https://youtu.be' , 'https://www.youtube-nocookie.com/embed' , $content );
/* 		echo $content;
		return ''; */
		return $content;
	}

}