<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Crafter
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'crafter_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new crafter_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => QL_STORE_URL, // Site where EDD is hosted
		'item_name' => QL_THEME_NAME, // Name of theme
		'theme_slug' => QL_THEME_SLUG, // Theme slug
		'version' => QL_THEME_VERSION, // The current version of this theme
		'author' => QL_THEME_AUTHOR, // The author of this theme
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'crafter' ),
		'enter-key' => __( 'Enter your theme license key.', 'crafter' ),
		'license-key' => __( 'License Key', 'crafter' ),
		'license-action' => __( 'License Action', 'crafter' ),
		'deactivate-license' => __( 'Deactivate License', 'crafter' ),
		'activate-license' => __( 'Activate License', 'crafter' ),
		'status-unknown' => __( 'License status is unknown.', 'crafter' ),
		'renew' => __( 'Renew?', 'crafter' ),
		'unlimited' => __( 'unlimited', 'crafter' ),
		'license-key-is-active' => __( 'License key is active.', 'crafter' ),
		'expires%s' => __( 'Expires %s.', 'crafter' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'crafter' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'crafter' ),
		'license-key-expired' => __( 'License key has expired.', 'crafter' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'crafter' ),
		'license-is-inactive' => __( 'License is inactive.', 'crafter' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'crafter' ),
		'site-is-inactive' => __( 'Site is inactive.', 'crafter' ),
		'license-status-unknown' => __( 'License status is unknown.', 'crafter' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'crafter' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'crafter' )
	)

);