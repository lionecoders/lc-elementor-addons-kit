<?php
/**
 * Testimonial Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_Testimonial extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lc-kit-testimonial';
    }

    public function get_title() {
        return esc_html__('Testimonial', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['lc-page-kit'];
    }

    public function get_keywords() {
        return ['testimonial', 'review', 'quote', 'customer', 'feedback'];
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
            'content',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'position',
            [
                'label' => esc_html__('Position', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'company',
            [
                'label' => esc_html__('Company', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Company Name', 'lc-elementor-addons-kit'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 0.5,
                'default' => 5,
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

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lc-elementor-addons-kit'),
                        'name' => esc_html__('John Doe', 'lc-elementor-addons-kit'),
                        'position' => esc_html__('CEO', 'lc-elementor-addons-kit'),
                        'company' => esc_html__('Company Name', 'lc-elementor-addons-kit'),
                    ],
                    [
                        'content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'lc-elementor-addons-kit'),
                        'name' => esc_html__('Jane Smith', 'lc-elementor-addons-kit'),
                        'position' => esc_html__('Manager', 'lc-elementor-addons-kit'),
                        'company' => esc_html__('Company Name', 'lc-elementor-addons-kit'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'lc-elementor-addons-kit'),
                    'carousel' => esc_html__('Carousel', 'lc-elementor-addons-kit'),
                    'list' => esc_html__('List', 'lc-elementor-addons-kit'),
                ],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label' => esc_html__('Show Image', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label' => esc_html__('Show Rating', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_quote_icon',
            [
                'label' => esc_html__('Show Quote Icon', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Carousel Settings
        $this->start_controls_section(
            'carousel_section',
            [
                'label' => esc_html__('Carousel Settings', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('No', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__('Show Arrows', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'lc-elementor-addons-kit'),
                'label_off' => esc_html__('Hide', 'lc-elementor-addons-kit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => esc_html__('Show Dots', 'lc-elementor-addons-kit'),
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
            'section_style_testimonial',
            [
                'label' => esc_html__('Testimonial', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testimonial_background_color',
            [
                'label' => esc_html__('Background Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_border',
                'selector' => '{{WRAPPER}} .lc-testimonial-item',
            ]
        );

        $this->add_control(
            'testimonial_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label' => esc_html__('Padding', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .lc-testimonial-content',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Margin', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_quote_icon',
            [
                'label' => esc_html__('Quote Icon', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quote_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-quote-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_size',
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
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_author',
            [
                'label' => esc_html__('Author', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_name_color',
            [
                'label' => esc_html__('Name Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-author-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typography',
                'selector' => '{{WRAPPER}} .lc-testimonial-author-name',
            ]
        );

        $this->add_control(
            'author_position_color',
            [
                'label' => esc_html__('Position Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-author-position' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_position_typography',
                'selector' => '{{WRAPPER}} .lc-testimonial-author-position',
            ]
        );

        $this->add_control(
            'author_company_color',
            [
                'label' => esc_html__('Company Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-author-company' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_company_typography',
                'selector' => '{{WRAPPER}} .lc-testimonial-author-company',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-author-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-author-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_rating',
            [
                'label' => esc_html__('Rating', 'lc-elementor-addons-kit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_rating' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label' => esc_html__('Color', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-rating' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rating_size',
            [
                'label' => esc_html__('Size', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lc-testimonial-rating' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['testimonials'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'lc-testimonial-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'lc-testimonial--' . $settings['layout']);

        if ($settings['layout'] === 'carousel') {
            $this->add_render_attribute('wrapper', 'data-autoplay', $settings['autoplay']);
            $this->add_render_attribute('wrapper', 'data-autoplay-speed', $settings['autoplay_speed']);
            $this->add_render_attribute('wrapper', 'data-show-arrows', $settings['show_arrows']);
            $this->add_render_attribute('wrapper', 'data-show-dots', $settings['show_dots']);
        } else {
            $this->add_render_attribute('wrapper', 'data-columns', $settings['columns']);
        }

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

        if ($settings['layout'] === 'carousel' && $settings['show_arrows'] === 'yes') {
            echo '<div class="lc-testimonial-arrow lc-testimonial-arrow-prev">&lt;</div>';
        }

        echo '<div class="lc-testimonial-container">';
        
        foreach ($settings['testimonials'] as $testimonial) {
            echo '<div class="lc-testimonial-item">';
            
            if ($settings['show_quote_icon'] === 'yes') {
                echo '<div class="lc-testimonial-quote-icon">❝</div>';
            }

            echo '<div class="lc-testimonial-content">' . esc_html($testimonial['content']) . '</div>';

            if ($settings['show_rating'] === 'yes' && !empty($testimonial['rating'])) {
                echo '<div class="lc-testimonial-rating">';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $testimonial['rating']) {
                        echo '<span class="lc-testimonial-star lc-testimonial-star-filled">★</span>';
                    } else {
                        echo '<span class="lc-testimonial-star lc-testimonial-star-empty">☆</span>';
                    }
                }
                echo '</div>';
            }

            echo '<div class="lc-testimonial-author">';
            
            if ($settings['show_image'] === 'yes' && !empty($testimonial['image']['url'])) {
                echo '<div class="lc-testimonial-author-image">';
                echo '<img src="' . esc_url($testimonial['image']['url']) . '" alt="' . esc_attr($testimonial['name']) . '">';
                echo '</div>';
            }

            echo '<div class="lc-testimonial-author-info">';
            
            if (!empty($testimonial['name'])) {
                echo '<div class="lc-testimonial-author-name">' . esc_html($testimonial['name']) . '</div>';
            }

            if (!empty($testimonial['position'])) {
                echo '<div class="lc-testimonial-author-position">' . esc_html($testimonial['position']) . '</div>';
            }

            if (!empty($testimonial['company'])) {
                echo '<div class="lc-testimonial-author-company">' . esc_html($testimonial['company']) . '</div>';
            }

            echo '</div>';
            echo '</div>';
            
            echo '</div>';
        }

        echo '</div>';

        if ($settings['layout'] === 'carousel' && $settings['show_arrows'] === 'yes') {
            echo '<div class="lc-testimonial-arrow lc-testimonial-arrow-next">&gt;</div>';
        }

        if ($settings['layout'] === 'carousel' && $settings['show_dots'] === 'yes') {
            echo '<div class="lc-testimonial-dots"></div>';
        }

        echo '</div>';
    }

    protected function content_template() {
        ?>
        <# if (settings.testimonials.length > 0) { #>
            <div class="lc-testimonial-wrapper lc-testimonial--{{ settings.layout }}" 
                 data-autoplay="{{ settings.autoplay }}"
                 data-autoplay-speed="{{ settings.autoplay_speed }}"
                 data-show-arrows="{{ settings.show_arrows }}"
                 data-show-dots="{{ settings.show_dots }}"
                 data-columns="{{ settings.columns }}">
                
                <# if (settings.layout === 'carousel' && settings.show_arrows === 'yes') { #>
                    <div class="lc-testimonial-arrow lc-testimonial-arrow-prev">&lt;</div>
                <# } #>
                
                <div class="lc-testimonial-container">
                    <# _.each(settings.testimonials, function(testimonial) { #>
                        <div class="lc-testimonial-item">
                            <# if (settings.show_quote_icon === 'yes') { #>
                                <div class="lc-testimonial-quote-icon">❝</div>
                            <# } #>
                            
                            <div class="lc-testimonial-content">{{{ testimonial.content }}}</div>
                            
                            <# if (settings.show_rating === 'yes' && testimonial.rating) { #>
                                <div class="lc-testimonial-rating">
                                    <# for (var i = 1; i <= 5; i++) { #>
                                        <# if (i <= testimonial.rating) { #>
                                            <span class="lc-testimonial-star lc-testimonial-star-filled">★</span>
                                        <# } else { #>
                                            <span class="lc-testimonial-star lc-testimonial-star-empty">☆</span>
                                        <# } #>
                                    <# } #>
                                </div>
                            <# } #>
                            
                            <div class="lc-testimonial-author">
                                <# if (settings.show_image === 'yes' && testimonial.image.url) { #>
                                    <div class="lc-testimonial-author-image">
                                        <img src="{{ testimonial.image.url }}" alt="{{ testimonial.name }}">
                                    </div>
                                <# } #>
                                
                                <div class="lc-testimonial-author-info">
                                    <# if (testimonial.name) { #>
                                        <div class="lc-testimonial-author-name">{{{ testimonial.name }}}</div>
                                    <# } #>
                                    <# if (testimonial.position) { #>
                                        <div class="lc-testimonial-author-position">{{{ testimonial.position }}}</div>
                                    <# } #>
                                    <# if (testimonial.company) { #>
                                        <div class="lc-testimonial-author-company">{{{ testimonial.company }}}</div>
                                    <# } #>
                                </div>
                            </div>
                        </div>
                    <# }); #>
                </div>
                
                <# if (settings.layout === 'carousel' && settings.show_arrows === 'yes') { #>
                    <div class="lc-testimonial-arrow lc-testimonial-arrow-next">&gt;</div>
                <# } #>
                
                <# if (settings.layout === 'carousel' && settings.show_dots === 'yes') { #>
                    <div class="lc-testimonial-dots"></div>
                <# } #>
                
            </div>
        <# } #>
        <?php
    }
} 