<?php
/**
 * Base Header Footer Widget Class
 * 
 * @package LC_Elementor_Addons_Kit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Base Header Footer Widget Class
 */
abstract class LC_Header_Footer_Base_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['lc-header-footer'];
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-header';
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['lc', 'header', 'footer', 'widget'];
    }

    /**
     * Get widget script dependencies
     */
    public function get_script_depends() {
        return [];
    }

    /**
     * Get widget style dependencies
     */
    public function get_style_depends() {
        return [];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_content_controls();

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_style_controls();

        $this->end_controls_section();
    }

    /**
     * Add content controls - to be overridden by child classes
     */
    protected function add_content_controls() {
        // Default content control
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Header/Footer Widget Title', 'lc-elementor-addons-kit'),
                'placeholder' => esc_html__('Enter your title', 'lc-elementor-addons-kit'),
            ]
        );
    }

    /**
     * Add style controls - to be overridden by child classes
     */
    protected function add_style_controls() {
        // Default style control
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-header-footer-widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->render_widget($settings);
    }

    /**
     * Render widget - to be overridden by child classes
     */
    protected function render_widget($settings) {
        // Default render
        if (!empty($settings['title'])) {
            echo '<h3 class="lc-header-footer-widget-title">' . esc_html($settings['title']) . '</h3>';
        }
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <# if (settings.title) { #>
            <h3 class="lc-header-footer-widget-title">{{{ settings.title }}}</h3>
        <# } #>
        <?php
    }
} 