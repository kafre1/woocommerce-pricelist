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

        $tables = array(
                'pricelist' => '
                CREATE TABLE %s (
                uid int(11) NOT NULL,
                code varchar(45) NOT NULL,
                description varchar(255) NOT NULL,
                comments varchar(1500) NOT NULL,
                pre_selected tinyint(1) NOT NULL,
                priority int(11) NOT NULL,
                last_modified datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\')',
                'pricelist_data' => '
                CREATE TABLE %s (
                uid int(11) NOT NULL,
                pricelist int(11) NOT NULL,
                sku varchar(50) NOT NULL,
                from_quantity float NOT NULL,
                percent float NOT NULL,
                price float NOT NULL,
                last_modified datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\')'
        );
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        foreach ($tables as $tablename => $table) {
                dbDelta(sprintf($table,$wpdb->prefix . $tablename));
        }
}

/**
*  Run on activation.
**/
register_activation_hook(__FILE__,'pricelist_install');


/**
* Check if WooCommerce is active
**/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        add_action( 'woocommerce_api_loaded', function(){
                include_once( 'includes/class-wc-api-pricelist.php' );
        });
        add_filter( 'woocommerce_api_classes', function( $classes ){
                $classes[] = 'WC_API_Pricelist';
                return $classes;
        });
}
