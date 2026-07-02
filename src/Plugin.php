<?php
namespace AIChatForWC;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main plugin class — singleton pattern.
 * Responsible only for bootstrapping other components.
 * It does not do settings, API calls, or UI itself — those
 * are separate classes. This is separation of concerns.
 */
class Plugin {

    /**
     * Single instance of this class.
     */
    private static ?Plugin $instance = null;

    /**
     * Private constructor — prevents direct instantiation.
     * Use get_instance() instead.
     */
    private function __construct() {}

    /**
     * Returns the single instance, creating it if needed.
     */
    public static function get_instance(): Plugin {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Boot all plugin components.
     * Each component will be added here as we build it.
     */
    public function init(): void {
        // Admin settings page — coming Day 6.
        // REST API endpoint — coming Day 8.
        // Frontend widget — coming Day 13.
    }
}