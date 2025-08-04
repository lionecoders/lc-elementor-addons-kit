<?php
/**
 * Widget Loader Class
 * 
 * @package LC_Elementor_Addons_Kit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget Loader Class
 */
class LC_Kit_Widget_Loader {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    /**
     * Register widgets
     */
    public function register_widgets($widgets_manager) {
        // Load LC Kit widgets
        $this->load_lc_kit_widgets($widgets_manager);
        
        // Load LC Header & Footer widgets
        $this->load_lc_header_footer_widgets($widgets_manager);
    }

    /**
     * Load LC Kit widgets
     */
    private function load_lc_kit_widgets($widgets_manager) {
        $lc_kit_widgets = [
            'image-accordion' => 'LC_Kit_Image_Accordion',
            'accordion' => 'LC_Kit_Accordion',
            'button' => 'LC_Kit_Button',
            'heading' => 'LC_Kit_Heading',
            'blog-posts' => 'LC_Kit_Blog_Posts',
            'icon-box' => 'LC_Kit_Icon_Box',
            'image-box' => 'LC_Kit_Image_Box',
            'countdown-timer' => 'LC_Kit_Countdown_Timer',
            'client-logo' => 'LC_Kit_Client_Logo',
            'faq' => 'LC_Kit_FAQ',
            'funfact' => 'LC_Kit_Funfact',
            'image-comparison' => 'LC_Kit_Image_Comparison',
            'lottie' => 'LC_Kit_Lottie',
            'testimonial' => 'LC_Kit_Testimonial',
            'pricing-table' => 'LC_Kit_Pricing_Table',
            'team' => 'LC_Kit_Team',
            'social-icons' => 'LC_Kit_Social_Icons',
            'progress-bar' => 'LC_Kit_Progress_Bar',
            'mailchimp' => 'LC_Kit_MailChimp',
            'pie-chart' => 'LC_Kit_Pie_Chart',
            'tab' => 'LC_Kit_Tab',
            'contact-form-7' => 'LC_Kit_Contact_Form_7',
            'video' => 'LC_Kit_Video',
            'business-hours' => 'LC_Kit_Business_Hours',
            'drop-caps' => 'LC_Kit_Drop_Caps',
            'social-share' => 'LC_Kit_Social_Share',
            'dual-button' => 'LC_Kit_Dual_Button',
            'caldera-forms' => 'LC_Kit_Caldera_Forms',
            'we-forms' => 'LC_Kit_We_Forms',
            'wp-forms' => 'LC_Kit_WP_Forms',
            'ninja-forms' => 'LC_Kit_Ninja_Forms',
            'tablepress' => 'LC_Kit_TablePress',
            'fluent-forms' => 'LC_Kit_Fluent_Forms'
        ];

        foreach ($lc_kit_widgets as $widget_key => $widget_class) {
            if ($this->is_widget_enabled('lc-kit', $widget_key)) {
                $this->load_widget($widgets_manager, 'lc-kit', $widget_key, $widget_class);
            }
        }
    }

    /**
     * Load LC Header & Footer widgets
     */
    private function load_lc_header_footer_widgets($widgets_manager) {
        $lc_header_footer_widgets = [
            'category-list' => 'LC_Header_Footer_Category_List',
            'page-list' => 'LC_Header_Footer_Page_List',
            'post-grid' => 'LC_Header_Footer_Post_Grid',
            'post-list' => 'LC_Header_Footer_Post_List',
            'post-tab' => 'LC_Header_Footer_Post_Tab',
            'elementskit-nav-menu' => 'LC_Header_Footer_ElementsKit_Nav_Menu',
            'header-info' => 'LC_Header_Footer_Header_Info',
            'header-search' => 'LC_Header_Footer_Header_Search',
            'header-offcanvas' => 'LC_Header_Footer_Header_Offcanvas'
        ];

        foreach ($lc_header_footer_widgets as $widget_key => $widget_class) {
            if ($this->is_widget_enabled('lc-header-footer', $widget_key)) {
                $this->load_widget($widgets_manager, 'lc-header-footer', $widget_key, $widget_class);
            }
        }
    }

    /**
     * Load individual widget
     */
    private function load_widget($widgets_manager, $category, $widget_key, $widget_class) {
        $widget_file = LC_ELEMENTOR_ADDONS_KIT_PATH . "includes/widgets/{$category}/{$widget_key}.php";
        
        if (file_exists($widget_file)) {
            require_once $widget_file;
            
            if (class_exists($widget_class)) {
                $widgets_manager->register(new $widget_class());
            }
        }
    }

    /**
     * Check if widget is enabled
     */
    private function is_widget_enabled($category, $widget) {
        return LC_Kit_Admin_Settings::get_widget_status($category, $widget) === 'enabled';
    }
} 