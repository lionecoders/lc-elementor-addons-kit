<?php
/**
 * Plugin Name: LC Elementor Addons Kit
 * Plugin URI: https://lionescoders.com
 * Description: A powerful Elementor addon plugin that offers a wide range of widgets categorized into 'LC Kit' and 'LC Header & Footer kit'.
 * Version: 1.0.0
 * Author: Lionescoders
 * Author URI: https://lionescoders.com
 * Text Domain: lc-elementor-addons-kit
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('LC_ELEMENTOR_ADDONS_KIT_VERSION', '1.0.0');
define('LC_ELEMENTOR_ADDONS_KIT_FILE', __FILE__);
define('LC_ELEMENTOR_ADDONS_KIT_PATH', plugin_dir_path(__FILE__));
define('LC_ELEMENTOR_ADDONS_KIT_URL', plugin_dir_url(__FILE__));
define('LC_ELEMENTOR_ADDONS_KIT_BASENAME', plugin_basename(__FILE__));

/**
 * Main Plugin Class
 */
final class LC_Elementor_Addons_Kit {

    /**
     * Plugin instance
     */
    private static $_instance = null;

    /**
     * Get plugin instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Initialize plugin
     */
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Load plugin files
        $this->includes();
        
        // Initialize plugin
        $this->init_plugin();
    }

    /**
     * Include required files
     */
    private function includes() {
        // Admin settings
        require_once LC_ELEMENTOR_ADDONS_KIT_PATH . 'admin/settings-page.php';
        
        // Base widget classes
        require_once LC_ELEMENTOR_ADDONS_KIT_PATH . 'includes/class-base-widget.php';
        require_once LC_ELEMENTOR_ADDONS_KIT_PATH . 'includes/class-base-header-footer-widget.php';
        
        // Widget loader
        require_once LC_ELEMENTOR_ADDONS_KIT_PATH . 'includes/class-widget-loader.php';
    }

    /**
     * Initialize plugin functionality
     */
    private function init_plugin() {
        // Initialize admin settings
        new LC_Kit_Admin_Settings();
        
        // Initialize widget loader
        new LC_Kit_Widget_Loader();
        
        // Add widget categories
        add_action('elementor/elements/categories_registered', [$this, 'add_widget_categories']);
        
        // Enqueue scripts and styles
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
    }

    /**
     * Add custom widget categories
     */
    public function add_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'lc-kit',
            [
                'title' => esc_html__('LC Kit', 'lc-elementor-addons-kit'),
                'icon' => 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'lc-header-footer',
            [
                'title' => esc_html__('LC Header & Footer kit', 'lc-elementor-addons-kit'),
                'icon' => 'fa fa-header',
            ]
        );
    }

    /**
     * Enqueue frontend scripts and styles
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_style(
            'lc-elementor-addons-kit-frontend',
            LC_ELEMENTOR_ADDONS_KIT_URL . 'assets/css/frontend.css',
            [],
            LC_ELEMENTOR_ADDONS_KIT_VERSION
        );

        wp_enqueue_script(
            'lc-elementor-addons-kit-frontend',
            LC_ELEMENTOR_ADDONS_KIT_URL . 'assets/js/frontend.js',
            ['jquery'],
            LC_ELEMENTOR_ADDONS_KIT_VERSION,
            true
        );
    }

    /**
     * Enqueue editor scripts and styles
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_style(
            'lc-elementor-addons-kit-editor',
            LC_ELEMENTOR_ADDONS_KIT_URL . 'assets/css/editor.css',
            [],
            LC_ELEMENTOR_ADDONS_KIT_VERSION
        );

        wp_enqueue_script(
            'lc-elementor-addons-kit-editor',
            LC_ELEMENTOR_ADDONS_KIT_URL . 'assets/js/editor.js',
            ['jquery'],
            LC_ELEMENTOR_ADDONS_KIT_VERSION,
            true
        );
    }

    /**
     * Admin notice for missing Elementor
     */
    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'lc-elementor-addons-kit'),
            '<strong>' . esc_html__('LC Elementor Addons Kit', 'lc-elementor-addons-kit') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'lc-elementor-addons-kit') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'lc-elementor-addons-kit'),
            '<strong>' . esc_html__('LC Elementor Addons Kit', 'lc-elementor-addons-kit') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'lc-elementor-addons-kit') . '</strong>',
            '3.0.0'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

// Initialize the plugin
LC_Elementor_Addons_Kit::instance(); 