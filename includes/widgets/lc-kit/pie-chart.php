<?php
/**
 * Pie Chart Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_Pie_Chart extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lc-kit-pie-chart';
    }

    public function get_title() {
        return esc_html__('Pie Chart', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-pie-chart';
    }

    public function get_categories() {
        return ['lc-page-kit'];
    }

    public function get_keywords() {
        return ['pie', 'chart', 'graph', 'data', 'visualization'];
    }

    public function get_script_depends() {
        return ['lc-pie-chart'];
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
            'label',
            [
                'label' => esc_html__('Label', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Data Label', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'value',
            [
                'label' => esc_html__('Value', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 25,
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#61ce70',
            ]
        );

        $this->add_control(
            'chart_data',
            [
                'label' => esc_html__('Chart Data', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'label' => esc_html__('Data 1', 'lc-elementor-addons-kit'),
                        'value' => 30,
                        'color' => '#61ce70',
                    ],
                    [
                        'label' => esc_html__('Data 2', 'lc-elementor-addons-kit'),
                        'value' => 25,
                        'color' => '#4054b2',
                    ],
                    [
                        'label' => esc_html__('Data 3', 'lc-elementor-addons-kit'),
                        'value' => 20,
                        'color' => '#f39c12',
                    ],
                    [
                        'label' => esc_html__('Data 4', 'lc-elementor-addons-kit'),
                        'value' => 25,
                        'color' => '#e74c3c',
                    ],
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->add_control(
            'chart_title',
            [
                'label' => esc_html__('Chart Title', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter chart title', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'show_legend',
            [
                'label' => esc_html__('Show Legend', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_percentage',
            [
                'label' => esc_html__('Show Percentage', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'chart_size',
            [
                'label' => esc_html__('Chart Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function add_style_controls() {
        $this->start_controls_section(
            'section_style_chart',
            [
                'label' => esc_html__('Chart', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'chart_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'chart_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'chart_border',
                'selector' => '{{WRAPPER}} .lc-pie-chart',
            ]
        );

        $this->add_control(
            'chart_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'chart_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .lc-pie-chart-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .lc-pie-chart-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_legend',
            [
                'label' => esc_html__('Legend', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_legend' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'legend_color',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart-legend-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'legend_typography',
                'selector' => '{{WRAPPER}} .lc-pie-chart-legend-item',
            ]
        );

        $this->add_responsive_control(
            'legend_spacing',
            [
                'label' => esc_html__('Item Spacing', 'lc-elementor-addons-kit'),
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
                    '{{WRAPPER}} .lc-pie-chart-legend-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'legend_marker_size',
            [
                'label' => esc_html__('Marker Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-pie-chart-legend-marker' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['chart_data'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'lc-pie-chart-wrapper');
        $this->add_render_attribute('chart', 'class', 'lc-pie-chart');
        $this->add_render_attribute('chart', 'data-size', $settings['chart_size']['size']);
        $this->add_render_attribute('chart', 'data-unit', $settings['chart_size']['unit']);

        // Prepare chart data
        $chart_data = [];
        $total = 0;
        
        foreach ($settings['chart_data'] as $item) {
            $total += $item['value'];
            $chart_data[] = [
                'label' => $item['label'],
                'value' => $item['value'],
                'color' => $item['color'],
            ];
        }

        $this->add_render_attribute('chart', 'data-chart', json_encode($chart_data));
        $this->add_render_attribute('chart', 'data-show-legend', $settings['show_legend']);
        $this->add_render_attribute('chart', 'data-show-percentage', $settings['show_percentage']);

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

        if (!empty($settings['chart_title'])) {
            echo '<h3 class="lc-pie-chart-title">' . esc_html($settings['chart_title']) . '</h3>';
        }

        echo '<div ' . $this->get_render_attribute_string('chart') . '>';
        echo '<canvas class="lc-pie-chart-canvas"></canvas>';
        
        if ($settings['show_legend'] === 'yes') {
            echo '<div class="lc-pie-chart-legend">';
            foreach ($chart_data as $item) {
                $percentage = $total > 0 ? round(($item['value'] / $total) * 100, 1) : 0;
                echo '<div class="lc-pie-chart-legend-item">';
                echo '<span class="lc-pie-chart-legend-marker" style="background-color: ' . esc_attr($item['color']) . ';"></span>';
                echo '<span class="lc-pie-chart-legend-label">' . esc_html($item['label']);
                if ($settings['show_percentage'] === 'yes') {
                    echo ' (' . $percentage . '%)';
                }
                echo '</span>';
                echo '</div>';
            }
            echo '</div>';
        }
        
        echo '</div>';

        echo '</div>';
    }

    protected function content_template() {
        ?>
        <# if (settings.chart_data.length > 0) { #>
            <div class="lc-pie-chart-wrapper">
                <# if (settings.chart_title) { #>
                    <h3 class="lc-pie-chart-title">{{{ settings.chart_title }}}</h3>
                <# } #>
                
                <div class="lc-pie-chart" 
                     data-size="{{ settings.chart_size.size }}"
                     data-unit="{{ settings.chart_size.unit }}"
                     data-show-legend="{{ settings.show_legend }}"
                     data-show-percentage="{{ settings.show_percentage }}">
                    <canvas class="lc-pie-chart-canvas"></canvas>
                    
                    <# if (settings.show_legend === 'yes') { #>
                        <div class="lc-pie-chart-legend">
                            <# _.each(settings.chart_data, function(item) { #>
                                <div class="lc-pie-chart-legend-item">
                                    <span class="lc-pie-chart-legend-marker" style="background-color: {{ item.color }};"></span>
                                    <span class="lc-pie-chart-legend-label">{{{ item.label }}}</span>
                                </div>
                            <# }); #>
                        </div>
                    <# } #>
                </div>
            </div>
        <# } #>
        <?php
    }
} 