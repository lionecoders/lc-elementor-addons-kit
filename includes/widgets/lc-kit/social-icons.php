<?php
/**
 * Social Icons Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_Social_Icons extends LC_Kit_Base_Widget {

    public function get_name() {
        return 'lc-kit-social-icons';
    }

    public function get_title() {
        return esc_html__('Social Icons', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }

    public function get_keywords() {
        return ['social', 'icons', 'facebook', 'twitter', 'instagram', 'linkedin'];
    }

    protected function add_content_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_platform',
            [
                'label' => esc_html__('Platform', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'facebook',
                'options' => [
                    'facebook' => esc_html__('Facebook', 'lc-elementor-addons-kit'),
                    'twitter' => esc_html__('Twitter', 'lc-elementor-addons-kit'),
                    'instagram' => esc_html__('Instagram', 'lc-elementor-addons-kit'),
                    'linkedin' => esc_html__('LinkedIn', 'lc-elementor-addons-kit'),
                    'youtube' => esc_html__('YouTube', 'lc-elementor-addons-kit'),
                    'pinterest' => esc_html__('Pinterest', 'lc-elementor-addons-kit'),
                    'tiktok' => esc_html__('TikTok', 'lc-elementor-addons-kit'),
                    'snapchat' => esc_html__('Snapchat', 'lc-elementor-addons-kit'),
                    'whatsapp' => esc_html__('WhatsApp', 'lc-elementor-addons-kit'),
                    'telegram' => esc_html__('Telegram', 'lc-elementor-addons-kit'),
                    'discord' => esc_html__('Discord', 'lc-elementor-addons-kit'),
                    'github' => esc_html__('GitHub', 'lc-elementor-addons-kit'),
                    'email' => esc_html__('Email', 'lc-elementor-addons-kit'),
                    'phone' => esc_html__('Phone', 'lc-elementor-addons-kit'),
                    'website' => esc_html__('Website', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'custom_icon',
            [
                'label' => esc_html__('Custom Icon', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'social_platform' => 'custom',
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Social Platform', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'social_icons',
            [
                'label' => esc_html__('Social Icons', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_platform' => 'facebook',
                        'link' => [
                            'url' => 'https://facebook.com',
                        ],
                    ],
                    [
                        'social_platform' => 'twitter',
                        'link' => [
                            'url' => 'https://twitter.com',
                        ],
                    ],
                    [
                        'social_platform' => 'instagram',
                        'link' => [
                            'url' => 'https://instagram.com',
                        ],
                    ],
                ],
                'title_field' => '{{{ social_platform }}}',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'lc-elementor-addons-kit'),
                    'vertical' => esc_html__('Vertical', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $this->add_control(
            'alignment',
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
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icons' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    protected function add_style_controls() {
        $this->start_controls_section(
            'section_style_icons',
            [
                'label' => esc_html__('Icons', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .lc-social-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .lc-social-icon',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_hover',
            [
                'label' => esc_html__('Hover', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .lc-social-icon-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-social-icon-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_social_icon_class($platform) {
        $icons = [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin-in',
            'youtube' => 'fab fa-youtube',
            'pinterest' => 'fab fa-pinterest-p',
            'tiktok' => 'fab fa-tiktok',
            'snapchat' => 'fab fa-snapchat-ghost',
            'whatsapp' => 'fab fa-whatsapp',
            'telegram' => 'fab fa-telegram-plane',
            'discord' => 'fab fa-discord',
            'github' => 'fab fa-github',
            'email' => 'fas fa-envelope',
            'phone' => 'fas fa-phone',
            'website' => 'fas fa-globe',
        ];

        return isset($icons[$platform]) ? $icons[$platform] : 'fas fa-link';
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['social_icons'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'lc-social-icons');
        $this->add_render_attribute('wrapper', 'class', 'lc-social-icons--' . $settings['layout']);

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';
        
        foreach ($settings['social_icons'] as $icon) {
            if (empty($icon['link']['url'])) {
                continue;
            }

            $icon_class = $this->get_social_icon_class($icon['social_platform']);
            
            echo '<div class="lc-social-icon">';
            
            $this->add_link_attributes('link_' . $icon['_id'], $icon['link']);
            echo '<a ' . $this->get_render_attribute_string('link_' . $icon['_id']) . '>';
            
            if (!empty($icon['custom_icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($icon['custom_icon'], ['aria-hidden' => 'true']);
            } else {
                echo '<i class="' . esc_attr($icon_class) . '"></i>';
            }
            
            if ($settings['show_title'] === 'yes' && !empty($icon['title'])) {
                echo '<span class="lc-social-icon-title">' . esc_html($icon['title']) . '</span>';
            }
            
            echo '</a>';
            echo '</div>';
        }

        echo '</div>';
    }

    protected function content_template() {
        ?>
        <# if (settings.social_icons.length > 0) { #>
            <div class="lc-social-icons lc-social-icons--{{ settings.layout }}">
                <# _.each(settings.social_icons, function(icon) { #>
                    <# if (icon.link.url) { #>
                        <div class="lc-social-icon">
                            <a href="{{ icon.link.url }}">
                                <# if (icon.custom_icon.value) { #>
                                    <i class="{{ icon.custom_icon.value }}"></i>
                                <# } else { #>
                                    <i class="fab fa-{{ icon.social_platform }}"></i>
                                <# } #>
                                <# if (settings.show_title === 'yes' && icon.title) { #>
                                    <span class="lc-social-icon-title">{{{ icon.title }}}</span>
                                <# } #>
                            </a>
                        </div>
                    <# } #>
                <# }); #>
            </div>
        <# } #>
        <?php
    }
} 