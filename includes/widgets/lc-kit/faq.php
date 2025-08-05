<?php
/**
 * FAQ Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_FAQ extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lc-kit-faq';
    }

    public function get_title() {
        return esc_html__('FAQ', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-help-o';
    }

    public function get_categories() {
        return ['lc-page-kit'];
    }

    public function get_keywords() {
        return ['faq', 'questions', 'answers', 'accordion', 'help'];
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
            'question',
            [
                'label' => esc_html__('Question', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Frequently Asked Question', 'lc-elementor-addons-kit'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => esc_html__('Answer', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lc-elementor-addons-kit'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'active_icon',
            [
                'label' => esc_html__('Active Icon', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'faq_items',
            [
                'label' => esc_html__('FAQ Items', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question' => esc_html__('What is Lorem Ipsum?', 'lc-elementor-addons-kit'),
                        'answer' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'lc-elementor-addons-kit'),
                    ],
                    [
                        'question' => esc_html__('Why do we use it?', 'lc-elementor-addons-kit'),
                        'answer' => esc_html__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'lc-elementor-addons-kit'),
                    ],
                    [
                        'question' => esc_html__('Where does it come from?', 'lc-elementor-addons-kit'),
                        'answer' => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature.', 'lc-elementor-addons-kit'),
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->add_control(
            'active_item',
            [
                'label' => esc_html__('Active Item', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'default' => 1,
                'description' => esc_html__('Enter the number of the item that should be open by default. Leave empty to have all items closed.', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__('Icon Position', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'lc-elementor-addons-kit'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'lc-elementor-addons-kit'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'multiple',
            [
                'label' => esc_html__('Multiple Items Open', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('No', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    protected function add_style_controls() {
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => esc_html__('Border Width', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
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
                    '{{WRAPPER}} .lc-faq-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Question Style
        $this->start_controls_section(
            'question_style_section',
            [
                'label' => esc_html__('Question', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'question_typography',
                'selector' => '{{WRAPPER}} .lc-faq-question',
            ]
        );

        $this->start_controls_tabs('question_tabs');

        $this->start_controls_tab(
            'question_normal_tab',
            [
                'label' => esc_html__('Normal', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'question_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-question' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'question_color',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-question' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'question_hover_tab',
            [
                'label' => esc_html__('Hover', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'question_background_color_hover',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-question:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'question_color_hover',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-question:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'question_active_tab',
            [
                'label' => esc_html__('Active', 'lc-elementor-addons-kit'),
            ]
        );

        $this->add_control(
            'question_background_color_active',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-item.active .lc-faq-question' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'question_color_active',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-item.active .lc-faq-question' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'question_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-question' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Answer Style
        $this->start_controls_section(
            'answer_style_section',
            [
                'label' => esc_html__('Answer', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'answer_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-answer' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'answer_color',
            [
                'label' => esc_html__('Text Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-answer' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'answer_typography',
                'selector' => '{{WRAPPER}} .lc-faq-answer',
            ]
        );

        $this->add_responsive_control(
            'answer_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-answer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Style
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__('Icon', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_active_color',
            [
                'label' => esc_html__('Active Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-faq-item.active .lc-faq-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['faq_items'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'lc-faq');
        $this->add_render_attribute('wrapper', 'data-multiple', $settings['multiple']);

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';
        
        foreach ($settings['faq_items'] as $index => $item) {
            $item_class = 'lc-faq-item';
            if ($index + 1 == $settings['active_item']) {
                $item_class .= ' active';
            }

            echo '<div class="' . esc_attr($item_class) . '">';
            
            echo '<div class="lc-faq-question">';
            echo '<div class="lc-faq-question-text">' . esc_html($item['question']) . '</div>';
            
            if (!empty($item['icon']['value']) || !empty($item['active_icon']['value'])) {
                echo '<div class="lc-faq-icon">';
                if (!empty($item['icon']['value'])) {
                    \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                }
                if (!empty($item['active_icon']['value'])) {
                    echo '<span class="lc-faq-icon-active">';
                    \Elementor\Icons_Manager::render_icon($item['active_icon'], ['aria-hidden' => 'true']);
                    echo '</span>';
                }
                echo '</div>';
            }
            
            echo '</div>';
            
            echo '<div class="lc-faq-answer">';
            echo '<div class="lc-faq-answer-content">';
            echo wp_kses_post($item['answer']);
            echo '</div>';
            echo '</div>';
            
            echo '</div>';
        }

        echo '</div>';
    }

    protected function content_template() {
        ?>
        <# if (settings.faq_items.length > 0) { #>
            <div class="lc-faq" data-multiple="{{ settings.multiple }}">
                <# _.each(settings.faq_items, function(item, index) { #>
                    <div class="lc-faq-item<# if (index + 1 == settings.active_item) { #> active<# } #>">
                        <div class="lc-faq-question">
                            <div class="lc-faq-question-text">{{{ item.question }}}</div>
                            <# if (item.icon.value || item.active_icon.value) { #>
                                <div class="lc-faq-icon">
                                    <# if (item.icon.value) { #>
                                        <i class="{{ item.icon.value }}" aria-hidden="true"></i>
                                    <# } #>
                                    <# if (item.active_icon.value) { #>
                                        <span class="lc-faq-icon-active">
                                            <i class="{{ item.active_icon.value }}" aria-hidden="true"></i>
                                        </span>
                                    <# } #>
                                </div>
                            <# } #>
                        </div>
                        <div class="lc-faq-answer">
                            <div class="lc-faq-answer-content">
                                {{{ item.answer }}}
                            </div>
                        </div>
                    </div>
                <# }); #>
            </div>
        <# } #>
        <?php
    }
} 