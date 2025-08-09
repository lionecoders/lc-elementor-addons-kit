<?php
/**
 * LC Kit Button Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) exit;

class LC_Kit_Button extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lc-kit-button';
    }

    public function get_title() {
        return esc_html__('Button', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return ['lc-page-kit'];
    }

    public function get_keywords() {
        return ['button', 'link', 'cta'];
    }

    public function register_controls() {
        // === Content Section ===
        $this->start_controls_section(
            'lc_button_content_section',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
            ]
        );

        // Label (with dynamic support)
        $this->add_control(
            'lc_button_text',
            [
                'label' => esc_html__('Label', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn more', 'lc-elementor-addons-kit'),
                'placeholder' => esc_html__('Learn more', 'lc-elementor-addons-kit'),
                'dynamic' => ['active' => true],
            ]
        );

        // URL (with dynamic support)
        $this->add_control(
            'lc_button_link',
            [
                'label' => esc_html__('URL', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_url('https://your-link.com'),
                'dynamic' => ['active' => true],
                'default' => ['url' => '#'],
            ]
        );

        // Section Heading
        $this->add_control(
            'lc_button_section_heading',
            [
                'label' => esc_html__('Settings', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Icon Toggle
        $this->add_control(
            'lc_button_icon_switch',
            [
                'label' => esc_html__('Add Icon?', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Yes', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('No', 'lc-elementor-addons-kit'),
            ]
        );

        // Icon Picker
        $this->add_control(
            'lc_button_icon',
            [
                'label' => esc_html__('Icon', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => ['value' => '', 'library' => 'solid'],
                'condition' => [
                    'lc_button_icon_switch' => 'yes',
                ],
            ]
        );

        // Icon Position
        $this->add_control(
            'lc_button_icon_position',
            [
                'label' => esc_html__('Icon Position', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Before', 'lc-elementor-addons-kit'),
                    'right' => esc_html__('After', 'lc-elementor-addons-kit'),
                ],
                'condition' => [
                    'lc_button_icon_switch' => 'yes',
                ],
            ]
        );

        // Responsive Alignment
        $this->add_responsive_control(
            'lc_button_align',
            [
                'label' => esc_html__('Alignment', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'center',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        // Custom Class
        $this->add_control(
            'lc_button_class',
            [
                'label' => esc_html__('Class', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('Custom class name', 'lc-elementor-addons-kit'),
            ]
        );

        // Custom ID
        $this->add_control(
            'lc_button_id',
            [
                'label' => esc_html__('ID', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('Custom ID', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'lc_button_badge',
            [
                'label' => esc_html__('Badge', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Optional badge text', 'lc-elementor-addons-kit'),
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'lc_btn_style_section',
            [
                'label' => esc_html__('Button', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'lc_btn_width',
            [
                'label'     => esc_html__( 'Width (%)', 'lc-elementor-addons-kit' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'width: {{SIZE}}%;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'lc_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'lc-elementor-addons-kit' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'lc_btn_typography',
                'label'    => esc_html__( 'Typography', 'lc-elementor-addons-kit' ),
                'selector' => '{{WRAPPER}} .lc-kit-button',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'lc_btn_text_shadow',
                'selector' => '{{WRAPPER}} .lc-kit-button',
            ]
        );
        
        // Start Tabs for Normal & Hover States
        $this->start_controls_tabs( 'lc_btn_tabs_style' );
        
        // Normal Tab
        $this->start_controls_tab(
            'lc_btn_tab_normal',
            [
                'label' => esc_html__( 'Normal', 'lc-elementor-addons-kit' ),
            ]
        );
        
        $this->add_control(
            'lc_btn_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'lc-elementor-addons-kit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'lc_btn_bg_color',
                'selector' => '{{WRAPPER}} .lc-kit-button',
            ]
        );
        
        $this->end_controls_tab();
        
        // Hover Tab
        $this->start_controls_tab(
            'lc_btn_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'lc-elementor-addons-kit' ),
            ]
        );
        
        $this->add_control(
            'lc_btn_hover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'lc-elementor-addons-kit' ),
                'type'      =>  \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'lc_btn_bg_hover_color',
                'selector' => '{{WRAPPER}} .lc-kit-button:hover',
            ]
        );
        
        $this->end_controls_tab(); // End Hover Tab
        $this->end_controls_tabs(); // End Tabs
        
        $this->end_controls_section();

        // Border Style Section
        $this->start_controls_section(
			'lc_btn_border_style_tabs',
			[
				'label' =>esc_html__( 'Border', 'lc-elementor-addons-kit' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'lc_btn_border_style',
            [
                'label' => esc_html__( 'Border Type', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none'   => esc_html__( 'None', 'lc-elementor-addons-kit' ),
                    'solid'  => esc_html__( 'Solid', 'lc-elementor-addons-kit' ),
                    'double' => esc_html__( 'Double', 'lc-elementor-addons-kit' ),
                    'dotted' => esc_html__( 'Dotted', 'lc-elementor-addons-kit' ),
                    'dashed' => esc_html__( 'Dashed', 'lc-elementor-addons-kit' ),
                    'groove' => esc_html__( 'Groove', 'lc-elementor-addons-kit' ),
                ],
                'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'lc_btn_border_width',
            [
                'label' => esc_html__( 'Border Width', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'lc_btn_border_style!' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'lc_btn_border_tabs' );
        
        $this->start_controls_tab(
            'lc_btn_border_normal',
            [
                'label' => esc_html__( 'Normal', 'lc-elementor-addons-kit' ),
            ]
        );
        
        $this->add_control(
            'lc_btn_border_color',
            [
                'label' => esc_html__( 'Border Color', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'lc_btn_border_hover',
            [
                'label' => esc_html__( 'Hover', 'lc-elementor-addons-kit' ),
            ]
        );
        
        $this->add_control(
            'lc_btn_hover_border_color',
            [
                'label' => esc_html__( 'Hover Border Color', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'lc_btn_border_hover_text_color',
            [
                'label' => esc_html__( 'Hover Text Color', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        // Border Radius Section
        $this->add_responsive_control(
            'lc_btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Shadow Style Section
        $this->start_controls_section(
            'lc_btn_shadow_style_tabs',
            [
                'label' => esc_html__( 'Shadow', 'lc-elementor-addons-kit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'lc_btn_box_shadow_group',
                'selector' => '{{WRAPPER}} .lc-kit-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'lc_btn_hover_box_shadow_group',
                'label'    => esc_html__( 'Hover Box Shadow', 'lc-elementor-addons-kit' ),
                'selector' => '{{WRAPPER}} .lc-kit-button:hover',
            ]
        );

        $this->end_controls_section();

        // icon Style Section
        $this->start_controls_section(
            'lc_btn_icon_style',
            [
                'label' => esc_html__( 'Icon', 'lc-elementor-addons-kit' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lc_button_icon_switch' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'lc_btn_icon_font_size',
            [
                'label' => esc_html__( 'Font Size', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [ 'min' => 1, 'max' => 100 ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button .lc-kit-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'lc_btn_icon_margin_right',
            [
                'label' => esc_html__( 'Add space after icon', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button-icon:first-child' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '.rtl {{WRAPPER}} .lc-kit-button-icon:first-child' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
                ],
                'condition' => [
                    'lc_button_icon_position' => 'left',
                ],
            ]
        );

        $this->add_responsive_control(
            'lc_btn_icon_margin_left',
            [
                'label' => esc_html__( 'Add space before icon', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button-icon:last-child' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '.rtl {{WRAPPER}} .lc-kit-button-icon:last-child' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: 0;',
                ],
                'condition' => [
                    'lc_button_icon_position' => 'right',
                ],
            ]
        );

        $this->add_responsive_control(
            'lc_btn_icon_vertical_align',
            [
                'label' => esc_html__( 'Move Icon Vertically', 'lc-elementor-addons-kit' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [ 'min' => -20, 'max' => 20 ],
                    'em' => [ 'min' => -5, 'max' => 5 ],
                    'rem' => [ 'min' => -5, 'max' => 5 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-kit-button-icon' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();


    }

 public function render() {
        $settings = $this->get_settings_for_display();

        // Sanitize class and id
        $custom_class = isset($settings['lc_button_class']) ? sanitize_html_class($settings['lc_button_class']) : '';
        $custom_id = isset($settings['lc_button_id']) ? sanitize_html_class($settings['lc_button_id']) : '';

        // Prepare link/button attributes
        $this->add_render_attribute(
            'button',
            [
                'class' => array_filter([
                    'lc-kit-button',
                    'elementor-button',
                    $custom_class,
                ]),
            ]
        );
        if (!empty($custom_id)) {
            $this->add_render_attribute('button', 'id', $custom_id);
        }

        // Accessibility: aria-label if set
        if (!empty($settings['lc_button_text'])) {
            $this->add_render_attribute('button', 'aria-label', esc_attr($settings['lc_button_text']));
        }

        $has_url = !empty($settings['lc_button_link']['url']);
        if ($has_url) {
            $this->add_render_attribute('button', 'href', esc_url($settings['lc_button_link']['url']));
            if (!empty($settings['lc_button_link']['is_external'])) {
                $this->add_render_attribute('button', 'target', '_blank');
            }
            if (!empty($settings['lc_button_link']['nofollow'])) {
                $this->add_render_attribute('button', 'rel', 'nofollow');
            }
        }

        // Icon (only if enabled)
        $icon_html = '';
        if ($settings['lc_button_icon_switch'] === 'yes' && !empty($settings['lc_button_icon']['value'])) {
            ob_start();
            \Elementor\Icons_Manager::render_icon(
                $settings['lc_button_icon'],
                [
                    'aria-hidden' => 'true',
                    'class'       => 'lc-kit-button-icon elementor-button-icon',
                ],
                'inline'
            );
            $icon_html = ob_get_clean();
        }

        // Badge
        $badge_html = '';
        if (!empty($settings['lc_button_badge'])) {
            $badge_html = sprintf(
                '<span class="lc-button-badge">%s</span>',
                esc_html($settings['lc_button_badge'])
            );
        }

        // Text
        $text = esc_html($settings['lc_button_text']);
        $position = $settings['lc_button_icon_position'] ?? 'left';
        ?>
        <div class="lc-kit-wid-con">
            <div class="lc-kit-button-wrapper">
                <?php if ($has_url): ?>
                    <a <?php echo $this->get_render_attribute_string('button'); ?>>
                        <?php if ($icon_html && $position === 'left') : ?>
                            <?php echo $icon_html; ?>
                        <?php endif; ?>

                        <?php echo $text; ?>
                        <?php echo $badge_html; ?>

                        <?php if ($icon_html && $position === 'right') : ?>
                            <?php echo $icon_html; ?>
                        <?php endif; ?>
                    </a>
                <?php else: ?>
                    <button type="button" <?php echo $this->get_render_attribute_string('button'); ?>>
                        <?php if ($icon_html && $position === 'left') : ?>
                            <?php echo $icon_html; ?>
                        <?php endif; ?>

                        <?php echo $text; ?>
                        <?php echo $badge_html; ?>

                        <?php if ($icon_html && $position === 'right') : ?>
                            <?php echo $icon_html; ?>
                        <?php endif; ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }    
}
