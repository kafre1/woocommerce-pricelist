<?php
/**
 * Plugin Name: WooCommerce Pricelists
 * Plugin URI: http://www.fredlund.nu/pricelists
 * Description: Pricelists plugin for woocommerce.
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

function pricelist_install() {
	global $wpdb;

        $table_pricelist = $wpdb->prefix . 'pricelist';
        $table_pricelist_data = $wpdb->prefix . 'pricelist_data';

        $sql_pricelist = "CREATE TABLE $table_pricelist( 
    		id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    		pricelist_name INT NOT NULL,
		created_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL
		 
	)";


        $sql_pricelist_data = "CREATE TABLE $table_pricelist_data( 
    		id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    		price_list_id INT NOT NULL,
		product_sku string NULL,
		price numeric(19,4) NOT NULL
		 
	)";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql_pricelist );
	dbDelta( $sql_pricelist_data );
}

/**
 *  Run on activation.
 **/
register_activation_hook(__FILE__,'pricelist_install');


/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Put your plugin code here
}