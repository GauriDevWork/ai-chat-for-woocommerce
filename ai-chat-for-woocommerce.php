<?php
/**
 * Plugin Name: AI Chat for WooCommerce
 * Plugin URI:  https://github.com/GauriDevWork/ai-chat-for-woocommerce
 * Description: An AI-powered support chatbot for WooCommerce stores, powered by Claude.
 * Version:     1.0.0
 * Author:      Gauri
 * Author URI:  https://github.com/GauriDevWork
 * License:     GPL-2.0+
 * Text Domain: ai-chat-for-woocommerce
 */

// Exit if accessed directly — always, in every plugin file you ever write.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants — one place to change paths/versions.
define( 'AICFW_VERSION',     '1.0.0' );
define( 'AICFW_FILE',        __FILE__ );
define( 'AICFW_PATH',        plugin_dir_path( __FILE__ ) );
define( 'AICFW_URL',         plugin_dir_url( __FILE__ ) );

// Autoloader — maps namespaces to file paths automatically.
spl_autoload_register( function( $class ) {
    // Our namespace prefix.
    $prefix   = 'AIChatForWC\\';
    $base_dir = AICFW_PATH . 'src/';

    // Does the class use our namespace? If not, not our problem.
    if ( strncmp( $prefix, $class, strlen( $prefix ) ) !== 0 ) {
        return;
    }

    // Strip the namespace prefix, convert namespace separators to
    // directory separators, append .php.
    $relative_class = substr( $class, strlen( $prefix ) );
    $file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

    // Load the file if it exists.
    if ( file_exists( $file ) ) {
        require $file;
    }
} );

// Boot the plugin — only after WordPress and WooCommerce are ready.
add_action( 'plugins_loaded', function() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>AI Chat for WooCommerce</strong> requires WooCommerce to be installed and active.</p></div>';
        } );
        return;
    }

    \AIChatForWC\Plugin::get_instance()->init();
} );