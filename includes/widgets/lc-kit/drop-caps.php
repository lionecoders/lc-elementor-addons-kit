<?php
/**
 * Drop Caps Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_Drop_Caps extends LC_Kit_Base_Widget {

    public function get_name() {
        return 'lc-kit-drop-caps';
    }

    public function get_title() {
        return esc_html__('Drop Caps', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-text';
    }

    public function get_keywords() {
        return ['drop', 'caps', 'text', 'typography', 'letter', 'initial'];
    }

    protected function add_content_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'lc-elementor-addons-kit'),
                'placeholder' => esc_html__('Enter your text here...', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'drop_cap_letter',
            [
                'label' => esc_html__('Drop Cap Letter', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'L',
                'placeholder' => esc_html__('Enter the letter for drop cap', 'lc-elementor-addons-kit'),
                'description' => esc_html__('Enter the letter that should be displayed as a drop cap. If left empty, the first letter of the text will be used.', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'drop_cap_position',
            [
                'label' => esc_html__('Drop Cap Position', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'lc-elementor-addons-kit'),
                    'right' => esc_html__('Right', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $this->add_control(
            'drop_cap_lines',
            [
                'label' => esc_html__('Drop Cap Lines', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3,
                'description' => esc_html__('Number of lines the drop cap should span', 'lc-elementor-addons-kit'),
            ]
        );

        $this->end_controls_section();
    }

    protected function add_style_controls() {
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Text', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .lc-drop-caps-text',
            ]
        );

        $this->add_responsive_control(
            'text_alignment',
            [
                'label' => esc_html__('Alignment', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'lc-elementor-addons-kit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'lc-elementor-addons-kit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'lc-elementor-addons-kit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'lc-elementor-addons-kit'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_drop_cap',
            [
                'label' => esc_html__('Drop Cap', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'drop_cap_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'drop_cap_typography',
                'selector' => '{{WRAPPER}} .lc-drop-caps-letter',
            ]
        );

        $this->add_control(
            'drop_cap_size',
            [
                'label' => esc_html__('Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'drop_cap_line_height',
            [
                'label' => esc_html__('Line Height', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'drop_cap_border',
                'selector' => '{{WRAPPER}} .lc-drop-caps-letter',
            ]
        );

        $this->add_control(
            'drop_cap_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'drop_cap_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'drop_cap_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-drop-caps-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'drop_cap_box_shadow',
                'selector' => '{{WRAPPER}} .lc-drop-caps-letter',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['text'])) {
            return;
        }

        $text = $settings['text'];
        $drop_cap_letter = !empty($settings['drop_cap_letter']) ? $settings['drop_cap_letter'] : substr($text, 0, 1);
        $drop_cap_position = $settings['drop_cap_position'];
        $drop_cap_lines = $settings['drop_cap_lines'];

        $this->add_render_attribute('wrapper', 'class', 'lc-drop-caps-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'lc-drop-caps--' . $drop_cap_position);
        $this->add_render_attribute('wrapper', 'data-lines', $drop_cap_lines);

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

        if ($drop_cap_position === 'left') {
            echo '<span class="lc-drop-caps-letter">' . esc_html($drop_cap_letter) . '</span>';
        }

        echo '<div class="lc-drop-caps-text">';
        echo wp_kses_post($text);
        echo '</div>';

        if ($drop_cap_position === 'right') {
            echo '<span class="lc-drop-caps-letter">' . esc_html($drop_cap_letter) . '</span>';
        }

        echo '</div>';
    }

    protected function content_template() {
        ?>
        <div class="lc-drop-caps-wrapper lc-drop-caps--{{ settings.drop_cap_position }}" data-lines="{{ settings.drop_cap_lines }}">
            <# if (settings.drop_cap_position === 'left') { #>
                <span class="lc-drop-caps-letter">{{{ settings.drop_cap_letter || settings.text.charAt(0) }}}</span>
            <# } #>
            
            <div class="lc-drop-caps-text">
                {{{ settings.text }}}
            </div>
            
            <# if (settings.drop_cap_position === 'right') { #>
                <span class="lc-drop-caps-letter">{{{ settings.drop_cap_letter || settings.text.charAt(0) }}}</span>
            <# } #>
        </div>
        <?php
    }
} 