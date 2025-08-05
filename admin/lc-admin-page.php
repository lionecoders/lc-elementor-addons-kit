<?php

if (!defined('ABSPATH')) exit;

class LC_Kit_Admin_Settings {

    private $widgets = [];

    public function __construct() {
        $this->load_widget_classes();
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    private function load_widget_classes() {
        $widget_dirs = [
            'lc-kit' => 'LC_Kit_',
            'lc-header-footer' => 'LC_Header_Footer_',
        ];

        foreach ($widget_dirs as $folder => $prefix) {
            $path = LC_EAK_PATH . 'includes/widgets/' . $folder . '/';
            if (!is_dir($path)) continue;

            foreach (glob($path . '*.php') as $file) {
                $base = basename($file, '.php');
                $class = $prefix . $this->format_class_name($base);
                $label = ucwords(str_replace(['-', '_'], ' ', $base));
                $this->widgets[$class] = $label;
            }
        }
    }

    private function format_class_name($filename) {
        $parts = explode('-', $filename);
        $parts = array_map('ucfirst', $parts);
        return implode('_', $parts);
    }

    public function add_settings_page() {
        add_menu_page(
            __('LC Kit', 'lc-elementor-addons-kit'),
            __('LC Kit', 'lc-elementor-addons-kit'),
            'manage_options',
            'lc-kit-settings',
            [$this, 'render_settings_page'],
            'dashicons-screenoptions',
            56
        );
    }

    public function register_settings() {
        register_setting('lc_kit_settings_group', 'lc_kit_enabled_widgets');
    }

    public function enqueue_admin_styles($hook) {
        if ($hook !== 'toplevel_page_lc-kit-settings') return;

        // Load Tailwind CSS via CDN
        wp_enqueue_style('lc-kit-tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css', [], null);
    }

    public function render_settings_page() {
        $enabled_widgets = get_option('lc_kit_enabled_widgets', []);
        ?>
        <div class="wrap">
            <h1 class="text-3xl font-bold mb-6"><?php _e('LC Elementor Addons Kit Settings', 'lc-elementor-addons-kit'); ?></h1>

            <form method="post" action="options.php">
                <?php settings_fields('lc_kit_settings_group'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($this->widgets as $class => $label): 
                        $is_enabled = isset($enabled_widgets[$class]) ? (bool) $enabled_widgets[$class] : true;
                        ?>
                        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
                            <label class="text-lg font-medium"><?php echo esc_html($label); ?></label>
                            <label class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" name="lc_kit_enabled_widgets[<?php echo esc_attr($class); ?>]" value="1" class="sr-only" <?php checked($is_enabled); ?>>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 transition-all"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transform peer-checked:translate-x-5 transition-all"></div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        <?php _e('Save Settings', 'lc-elementor-addons-kit'); ?>
                    </button>
                </div>
            </form>
        </div>
        <?php
    }
}