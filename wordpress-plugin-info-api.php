<?php
/**
* Plugin Name: Wordpress plugin info API
* Plugin URI: http://www.fredlund.nu/plugininfo
* Description: Get a list of installed plugins via API.
* Version: 1.0.0
* Author: Kalle Fredlund
* Author URI: http://fredlund.nu/
* Developer: Kalle Fredlund
* Developer URI: http://fredlund.nu/
* Text Domain: woocommerce-extension
* Domain Path: /languages
*
* Copyright: © 2016 Kalle Fredlund.
* License: GNU General Public License v3.0
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

add_action( 'rest_api_init', function () {
	register_rest_route( 'plugininfo/v1', '/list', array(
		'methods' => 'GET',
		'callback' => 'plugininfo_get_plugins',
	) );
} );

function plugininfo_get_plugins() {
  $default_headers = array(
      'Name' => 'Plugin Name',
      'PluginURI' => 'Plugin URI',
      'Version' => 'Version',
      'Description' => 'Description',
      'Author' => 'Author',
      'AuthorURI' => 'Author URI',
      'TextDomain' => 'Text Domain',
      'DomainPath' => 'Domain Path',
      'Network' => 'Network',
      // Site Wide Only is deprecated in favor of Network.
      '_sitewide' => 'Site Wide Only',
  );

  $aryplugins = array();

  $aryplugins['is_ssl_active'] = is_ssl();
  foreach (get_option('active_plugins') as $plugin) {
    $aryplugins[] = get_file_data(ABSPATH . 'wp-content/plugins/' .$plugin,$default_headers);
  }
  return $aryplugins;
}

/**
* Check if WooCommerce is active
**/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  add_action( 'plugininfo_loaded', function(){
          include_once( 'includes/class-wc-api-plugininfo.php' );
  });
}
