<?php
/**
 * Base Widget Class
 * 
 * @package LC_Elementor_Addons_Kit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Base Widget Class
 */
abstract class LC_Kit_Base_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['lc-kit'];
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-star';
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['lc', 'kit', 'widget'];
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
                'default' => esc_html__('Widget Title', 'lc-elementor-addons-kit'),
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
                    '{{WRAPPER}} .lc-kit-widget-title' => 'color: {{VALUE}};',
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
            echo '<h2 class="lc-kit-widget-title">' . esc_html($settings['title']) . '</h2>';
        }
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <# if (settings.title) { #>
            <h2 class="lc-kit-widget-title">{{{ settings.title }}}</h2>
        <# } #>
        <?php
    }
} 