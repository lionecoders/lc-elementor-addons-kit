<?php
/**
 * Admin Settings Page
 * 
 * @package LC_Elementor_Addons_Kit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin Settings Class
 */
class LC_Kit_Admin_Settings {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'init_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            esc_html__('LC Kit', 'lc-elementor-addons-kit'),
            esc_html__('LC Kit', 'lc-elementor-addons-kit'),
            'manage_options',
            'lc-kit-settings',
            [$this, 'settings_page'],
            'dashicons-admin-plugins',
            30
        );
    }

    /**
     * Initialize settings
     */
    public function init_settings() {
        register_setting('lc_kit_settings', 'lc_kit_widgets', [
            'type' => 'array',
            'default' => $this->get_default_widget_settings(),
            'sanitize_callback' => [$this, 'sanitize_widget_settings']
        ]);
    }

    /**
     * Get default widget settings
     */
    private function get_default_widget_settings() {
        $lc_kit_widgets = [
            'image-accordion', 'accordion', 'button', 'heading', 'blog-posts', 
            'icon-box', 'image-box', 'countdown-timer', 'client-logo', 'faq', 
            'funfact', 'image-comparison', 'lottie', 'testimonial', 'pricing-table', 
            'team', 'social-icons', 'progress-bar', 'mailchimp', 'pie-chart', 
            'tab', 'contact-form-7', 'video', 'business-hours', 'drop-caps', 
            'social-share', 'dual-button', 'caldera-forms', 'we-forms', 'wp-forms', 
            'ninja-forms', 'tablepress', 'fluent-forms'
        ];

        $lc_header_footer_widgets = [
            'category-list', 'page-list', 'post-grid', 'post-list', 'post-tab', 
            'elementskit-nav-menu', 'header-info', 'header-search', 'header-offcanvas'
        ];

        $defaults = [];
        
        foreach ($lc_kit_widgets as $widget) {
            $defaults['lc-kit'][$widget] = 'enabled';
        }
        
        foreach ($lc_header_footer_widgets as $widget) {
            $defaults['lc-header-footer'][$widget] = 'enabled';
        }

        return $defaults;
    }

    /**
     * Sanitize widget settings
     */
    public function sanitize_widget_settings($input) {
        $sanitized = [];
        
        if (isset($input['lc-kit']) && is_array($input['lc-kit'])) {
            foreach ($input['lc-kit'] as $widget => $status) {
                $sanitized['lc-kit'][sanitize_key($widget)] = 
                    ($status === 'enabled') ? 'enabled' : 'disabled';
            }
        }
        
        if (isset($input['lc-header-footer']) && is_array($input['lc-header-footer'])) {
            foreach ($input['lc-header-footer'] as $widget => $status) {
                $sanitized['lc-header-footer'][sanitize_key($widget)] = 
                    ($status === 'enabled') ? 'enabled' : 'disabled';
            }
        }
        
        return $sanitized;
    }

    /**
     * Settings page HTML
     */
    public function settings_page() {
        $widgets_settings = get_option('lc_kit_widgets', $this->get_default_widget_settings());
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('LC Kit Settings', 'lc-elementor-addons-kit'); ?></h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('lc_kit_settings'); ?>
                
                <div class="lc-kit-settings-container">
                    <!-- LC Kit Widgets -->
                    <div class="lc-kit-section">
                        <h2><?php echo esc_html__('LC Kit Widgets', 'lc-elementor-addons-kit'); ?></h2>
                        <p><?php echo esc_html__('Enable or disable individual widgets from the LC Kit category.', 'lc-elementor-addons-kit'); ?></p>
                        
                        <div class="lc-kit-widgets-grid">
                            <?php
                            $lc_kit_widgets = [
                                'image-accordion' => 'Image Accordion',
                                'accordion' => 'Accordion',
                                'button' => 'Button',
                                'heading' => 'Heading',
                                'blog-posts' => 'Blog Posts',
                                'icon-box' => 'Icon Box',
                                'image-box' => 'Image Box',
                                'countdown-timer' => 'Countdown Timer',
                                'client-logo' => 'Client Logo',
                                'faq' => 'FAQ',
                                'funfact' => 'Funfact',
                                'image-comparison' => 'Image Comparison',
                                'lottie' => 'Lottie',
                                'testimonial' => 'Testimonial',
                                'pricing-table' => 'Pricing Table',
                                'team' => 'Team',
                                'social-icons' => 'Social Icons',
                                'progress-bar' => 'Progress Bar',
                                'mailchimp' => 'MailChimp',
                                'pie-chart' => 'Pie Chart',
                                'tab' => 'Tab',
                                'contact-form-7' => 'Contact Form 7',
                                'video' => 'Video',
                                'business-hours' => 'Business Hours',
                                'drop-caps' => 'Drop Caps',
                                'social-share' => 'Social Share',
                                'dual-button' => 'Dual Button',
                                'caldera-forms' => 'Caldera Forms',
                                'we-forms' => 'We Forms',
                                'wp-forms' => 'WP Forms',
                                'ninja-forms' => 'Ninja Forms',
                                'tablepress' => 'TablePress',
                                'fluent-forms' => 'Fluent Forms'
                            ];

                            foreach ($lc_kit_widgets as $widget_key => $widget_name) {
                                $status = isset($widgets_settings['lc-kit'][$widget_key]) 
                                    ? $widgets_settings['lc-kit'][$widget_key] 
                                    : 'enabled';
                                ?>
                                <div class="lc-kit-widget-item">
                                    <label class="lc-kit-toggle">
                                        <input type="checkbox" 
                                               name="lc_kit_widgets[lc-kit][<?php echo esc_attr($widget_key); ?>]" 
                                               value="enabled" 
                                               <?php checked($status, 'enabled'); ?>>
                                        <span class="lc-kit-toggle-slider"></span>
                                    </label>
                                    <span class="lc-kit-widget-name"><?php echo esc_html($widget_name); ?></span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <!-- LC Header & Footer Widgets -->
                    <div class="lc-kit-section">
                        <h2><?php echo esc_html__('LC Header & Footer Kit Widgets', 'lc-elementor-addons-kit'); ?></h2>
                        <p><?php echo esc_html__('Enable or disable individual widgets from the LC Header & Footer kit category.', 'lc-elementor-addons-kit'); ?></p>
                        
                        <div class="lc-kit-widgets-grid">
                            <?php
                            $lc_header_footer_widgets = [
                                'category-list' => 'Category List',
                                'page-list' => 'Page List',
                                'post-grid' => 'Post Grid',
                                'post-list' => 'Post List',
                                'post-tab' => 'Post Tab',
                                'elementskit-nav-menu' => 'ElementsKit Nav Menu',
                                'header-info' => 'Header Info',
                                'header-search' => 'Header Search',
                                'header-offcanvas' => 'Header Offcanvas'
                            ];

                            foreach ($lc_header_footer_widgets as $widget_key => $widget_name) {
                                $status = isset($widgets_settings['lc-header-footer'][$widget_key]) 
                                    ? $widgets_settings['lc-header-footer'][$widget_key] 
                                    : 'enabled';
                                ?>
                                <div class="lc-kit-widget-item">
                                    <label class="lc-kit-toggle">
                                        <input type="checkbox" 
                                               name="lc_kit_widgets[lc-header-footer][<?php echo esc_attr($widget_key); ?>]" 
                                               value="enabled" 
                                               <?php checked($status, 'enabled'); ?>>
                                        <span class="lc-kit-toggle-slider"></span>
                                    </label>
                                    <span class="lc-kit-widget-name"><?php echo esc_html($widget_name); ?></span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Enqueue admin scripts and styles
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'toplevel_page_lc-kit-settings') {
            return;
        }

        wp_enqueue_style(
            'lc-kit-admin',
            LC_ELEMENTOR_ADDONS_KIT_URL . 'assets/css/admin.css',
            [],
            LC_ELEMENTOR_ADDONS_KIT_VERSION
        );

        wp_enqueue_script(
            'lc-kit-admin',
            LC_ELEMENTOR_ADDONS_KIT_URL . 'assets/js/admin.js',
            ['jquery'],
            LC_ELEMENTOR_ADDONS_KIT_VERSION,
            true
        );
    }

    /**
     * Get widget status
     */
    public static function get_widget_status($category, $widget) {
        $widgets_settings = get_option('lc_kit_widgets', []);
        return isset($widgets_settings[$category][$widget]) 
            ? $widgets_settings[$category][$widget] 
            : 'enabled';
    }
} 