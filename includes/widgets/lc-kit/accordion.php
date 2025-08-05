<?php
/**
 * Accordion Widget
 * 
 * @package LC_Elementor_Addons_Kit
 */

if (!defined('ABSPATH')) {
    exit;
}

class LC_Kit_Accordion extends \Elementor\Widget_Base {

    public function get_name() {
        return 'lc-kit-accordion';
    }

    public function get_title() {
        return esc_html__('Accordion', 'lc-elementor-addons-kit');
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['lc-page-kit'];
    }

    public function get_keywords() {
        return ['accordion', 'tabs', 'toggle', 'collapsible', 'faq'];
    }

    // ✅ FIXED: Register content and style controls here
    protected function register_controls() {
        $this->add_content_controls();
        $this->add_style_controls();
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
            'title',
            [
                'label' => esc_html__('Title', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Accordion Title', 'lc-elementor-addons-kit'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lc-elementor-addons-kit'),
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
            'accordion_items',
            [
                'label' => esc_html__('Accordion Items', 'lc-elementor-addons-kit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Accordion #1', 'lc-elementor-addons-kit'),
                        'content' => esc_html__('Content for Accordion #1', 'lc-elementor-addons-kit'),
                    ],
                    [
                        'title' => esc_html__('Accordion #2', 'lc-elementor-addons-kit'),
                        'content' => esc_html__('Content for Accordion #2', 'lc-elementor-addons-kit'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
                'description' => esc_html__('Enter the item number to open by default.', 'lc-elementor-addons-kit'),
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
        // Skip here for brevity (you already have all style controls correct)
        // Just paste your `add_style_controls()` method from your earlier code
    }

    public function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['accordion_items'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'lc-accordion');
        $this->add_render_attribute('wrapper', 'data-multiple', $settings['multiple']);

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

        foreach ($settings['accordion_items'] as $index => $item) {
            $item_class = 'lc-accordion-item';
            if ($index + 1 == $settings['active_item']) {
                $item_class .= ' active';
            }

            echo '<div class="' . esc_attr($item_class) . '">';

            echo '<div class="lc-accordion-header">';
            echo '<div class="lc-accordion-title">' . esc_html($item['title']) . '</div>';

            if (!empty($item['icon']['value']) || !empty($item['active_icon']['value'])) {
                echo '<div class="lc-accordion-icon">';
                if (!empty($item['icon']['value'])) {
                    \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                }
                if (!empty($item['active_icon']['value'])) {
                    echo '<span class="lc-accordion-icon-active">';
                    \Elementor\Icons_Manager::render_icon($item['active_icon'], ['aria-hidden' => 'true']);
                    echo '</span>';
                }
                echo '</div>';
            }

            echo '</div>'; // .lc-accordion-header

            echo '<div class="lc-accordion-content">';
            echo '<div class="lc-accordion-body">';
            echo wp_kses_post($item['content']);
            echo '</div>';
            echo '</div>'; // .lc-accordion-content

            echo '</div>'; // .lc-accordion-item
        }

        echo '</div>'; // .lc-accordion
    }

    protected function content_template() {
        ?>
        <# if (settings.accordion_items && settings.accordion_items.length) { #>
            <div class="lc-accordion" data-multiple="{{ settings.multiple }}">
                <# _.each(settings.accordion_items, function(item, index) { #>
                    <div class="lc-accordion-item<# if (index + 1 == settings.active_item) { #> active<# } #>">
                        <div class="lc-accordion-header">
                            <div class="lc-accordion-title">{{{ item.title }}}</div>
                            <# if (item.icon && item.icon.value || item.active_icon && item.active_icon.value) { #>
                                <div class="lc-accordion-icon">
                                    <# if (item.icon && item.icon.value) { #>
                                        <i class="{{ item.icon.value }}" aria-hidden="true"></i>
                                    <# } #>
                                    <# if (item.active_icon && item.active_icon.value) { #>
                                        <span class="lc-accordion-icon-active">
                                            <i class="{{ item.active_icon.value }}" aria-hidden="true"></i>
                                        </span>
                                    <# } #>
                                </div>
                            <# } #>
                        </div>
                        <div class="lc-accordion-content">
                            <div class="lc-accordion-body">
                                {{{ item.content }}}
                            </div>
                        </div>
                    </div>
                <# }); #>
            </div>
        <# } #>
        <?php
    }
}