<?php
/**
 * Button Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include base widget class
require_once LC_ELEMENTOR_ADDONS_KIT_PATH . 'includes/class-base-widget.php';

/**
 * Button Widget Class
 */
class LC_Kit_Button extends LC_Kit_Base_Widget {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'lc-kit-button';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Button', 'lc-elementor-addons-kit');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-button';
    }

    /**
     * Add content controls
     */
    protected function add_content_controls() {
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'lc-elementor-addons-kit'),
                'placeholder' => esc_html__('Enter button text', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'lc-elementor-addons-kit'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__('Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'medium',
                'options' => [
                    'small' => esc_html__('Small', 'lc-elementor-addons-kit'),
                    'medium' => esc_html__('Medium', 'lc-elementor-addons-kit'),
                    'large' => esc_html__('Large', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => esc_html__('Type', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => esc_html__('Primary', 'lc-elementor-addons-kit'),
                    'secondary' => esc_html__('Secondary', 'lc-elementor-addons-kit'),
                    'outline' => esc_html__('Outline', 'lc-elementor-addons-kit'),
                ],
            ]
        );
    }

    /**
     * Add style controls
     */
    protected function add_style_controls() {
        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .lc-kit-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .lc-kit-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    /**
     * Render widget
     */
    protected function render_widget($settings) {
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $button_size = $settings['button_size'];
        $button_type = $settings['button_type'];

        $button_classes = [
            'lc-kit-button',
            'lc-kit-button--' . $button_size,
            'lc-kit-button--' . $button_type,
        ];

        $this->add_render_attribute('button', [
            'class' => $button_classes,
            'href' => $button_link['url'],
        ]);

        if ($button_link['is_external']) {
            $this->add_render_attribute('button', 'target', '_blank');
        }

        if ($button_link['nofollow']) {
            $this->add_render_attribute('button', 'rel', 'nofollow');
        }

        ?>
        <div class="lc-kit-button-wrapper">
            <a <?php echo $this->get_render_attribute_string('button'); ?>>
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
        <?php
    }

    /**
     * Content template
     */
    protected function content_template() {
        ?>
        <div class="lc-kit-button-wrapper">
            <a class="lc-kit-button lc-kit-button--{{ settings.button_size }} lc-kit-button--{{ settings.button_type }}" 
               href="{{ settings.button_link.url }}"
               <# if (settings.button_link.is_external) { #>target="_blank"<# } #>
               <# if (settings.button_link.nofollow) { #>rel="nofollow"<# } #>>
                {{{ settings.button_text }}}
            </a>
        </div>
        <?php
    }
} 