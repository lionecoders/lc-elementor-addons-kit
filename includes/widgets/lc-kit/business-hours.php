<?php
/**
 * Business Hours Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_Business_Hours extends LC_Kit_Base_Widget {

    public function get_name() {
        return 'lc-kit-business-hours';
    }

    public function get_title() {
        return esc_html__('Business Hours', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-clock-o';
    }

    public function get_keywords() {
        return ['business', 'hours', 'time', 'schedule', 'opening', 'closing'];
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
            'title',
            [
                'label' => esc_html__('Title', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Business Hours', 'lc-elementor-addons-kit'),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'day',
            [
                'label' => esc_html__('Day', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'monday',
                'options' => [
                    'monday' => esc_html__('Monday', 'lc-elementor-addons-kit'),
                    'tuesday' => esc_html__('Tuesday', 'lc-elementor-addons-kit'),
                    'wednesday' => esc_html__('Wednesday', 'lc-elementor-addons-kit'),
                    'thursday' => esc_html__('Thursday', 'lc-elementor-addons-kit'),
                    'friday' => esc_html__('Friday', 'lc-elementor-addons-kit'),
                    'saturday' => esc_html__('Saturday', 'lc-elementor-addons-kit'),
                    'sunday' => esc_html__('Sunday', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $repeater->add_control(
            'open_time',
            [
                'label' => esc_html__('Opening Time', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '09:00',
                'placeholder' => esc_html__('09:00', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'close_time',
            [
                'label' => esc_html__('Closing Time', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '18:00',
                'placeholder' => esc_html__('18:00', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'closed',
            [
                'label' => esc_html__('Closed', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('No', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'closed_text',
            [
                'label' => esc_html__('Closed Text', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Closed', 'lc-elementor-addons-kit'),
                'condition' => [
                    'closed' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'business_hours',
            [
                'label' => esc_html__('Business Hours', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'day' => 'monday',
                        'open_time' => '09:00',
                        'close_time' => '18:00',
                    ],
                    [
                        'day' => 'tuesday',
                        'open_time' => '09:00',
                        'close_time' => '18:00',
                    ],
                    [
                        'day' => 'wednesday',
                        'open_time' => '09:00',
                        'close_time' => '18:00',
                    ],
                    [
                        'day' => 'thursday',
                        'open_time' => '09:00',
                        'close_time' => '18:00',
                    ],
                    [
                        'day' => 'friday',
                        'open_time' => '09:00',
                        'close_time' => '18:00',
                    ],
                    [
                        'day' => 'saturday',
                        'open_time' => '10:00',
                        'close_time' => '16:00',
                    ],
                    [
                        'day' => 'sunday',
                        'closed' => 'yes',
                        'closed_text' => esc_html__('Closed', 'lc-elementor-addons-kit'),
                    ],
                ],
                'title_field' => '{{{ day }}}',
            ]
        );

        $this->add_control(
            'highlight_today',
            [
                'label' => esc_html__('Highlight Today', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('No', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'time_format',
            [
                'label' => esc_html__('Time Format', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '24',
                'options' => [
                    '12' => esc_html__('12 Hour', 'lc-elementor-addons-kit'),
                    '24' => esc_html__('24 Hour', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function add_style_controls() {
        $this->start_controls_section(
            'section_style_container',
            [
                'label' => esc_html__('Container', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .lc-business-hours',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .lc-business-hours-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_hours',
            [
                'label' => esc_html__('Hours', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hours_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hours_color',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'hours_typography',
                'selector' => '{{WRAPPER}} .lc-business-hours-item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hours_border',
                'selector' => '{{WRAPPER}} .lc-business-hours-item',
            ]
        );

        $this->add_responsive_control(
            'hours_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hours_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_today',
            [
                'label' => esc_html__('Today Highlight', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'highlight_today' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'today_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-item.today' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'today_color',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-business-hours-item.today' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'today_border',
                'selector' => '{{WRAPPER}} .lc-business-hours-item.today',
            ]
        );

        $this->end_controls_section();
    }

    private function get_day_name($day) {
        $days = [
            'monday' => esc_html__('Monday', 'lc-elementor-addons-kit'),
            'tuesday' => esc_html__('Tuesday', 'lc-elementor-addons-kit'),
            'wednesday' => esc_html__('Wednesday', 'lc-elementor-addons-kit'),
            'thursday' => esc_html__('Thursday', 'lc-elementor-addons-kit'),
            'friday' => esc_html__('Friday', 'lc-elementor-addons-kit'),
            'saturday' => esc_html__('Saturday', 'lc-elementor-addons-kit'),
            'sunday' => esc_html__('Sunday', 'lc-elementor-addons-kit'),
        ];
        
        return isset($days[$day]) ? $days[$day] : $day;
    }

    private function format_time($time, $format = '24') {
        if ($format === '12') {
            return date('g:i A', strtotime($time));
        }
        return $time;
    }

    private function is_today($day) {
        $today = strtolower(date('l'));
        $day_map = [
            'monday' => 'monday',
            'tuesday' => 'tuesday',
            'wednesday' => 'wednesday',
            'thursday' => 'thursday',
            'friday' => 'friday',
            'saturday' => 'saturday',
            'sunday' => 'sunday',
        ];
        
        return isset($day_map[$day]) && $day_map[$day] === $today;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['business_hours'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'lc-business-hours');

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

        if (!empty($settings['title'])) {
            echo '<h3 class="lc-business-hours-title">' . esc_html($settings['title']) . '</h3>';
        }

        echo '<div class="lc-business-hours-list">';
        
        foreach ($settings['business_hours'] as $hour) {
            $item_class = 'lc-business-hours-item';
            
            if ($settings['highlight_today'] === 'yes' && $this->is_today($hour['day'])) {
                $item_class .= ' today';
            }

            echo '<div class="' . esc_attr($item_class) . '">';
            echo '<span class="lc-business-hours-day">' . esc_html($this->get_day_name($hour['day'])) . '</span>';
            
            if ($hour['closed'] === 'yes') {
                echo '<span class="lc-business-hours-time closed">' . esc_html($hour['closed_text']) . '</span>';
            } else {
                $open_time = $this->format_time($hour['open_time'], $settings['time_format']);
                $close_time = $this->format_time($hour['close_time'], $settings['time_format']);
                echo '<span class="lc-business-hours-time">' . esc_html($open_time) . ' - ' . esc_html($close_time) . '</span>';
            }
            
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
    }

    protected function content_template() {
        ?>
        <div class="lc-business-hours">
            <# if (settings.title) { #>
                <h3 class="lc-business-hours-title">{{{ settings.title }}}</h3>
            <# } #>
            
            <div class="lc-business-hours-list">
                <# _.each(settings.business_hours, function(hour) { #>
                    <div class="lc-business-hours-item">
                        <span class="lc-business-hours-day">{{{ hour.day }}}</span>
                        <# if (hour.closed === 'yes') { #>
                            <span class="lc-business-hours-time closed">{{{ hour.closed_text }}}</span>
                        <# } else { #>
                            <span class="lc-business-hours-time">{{{ hour.open_time }}} - {{{ hour.close_time }}}</span>
                        <# } #>
                    </div>
                <# }); #>
            </div>
        </div>
        <?php
    }
} 