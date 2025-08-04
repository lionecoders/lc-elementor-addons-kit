/**
 * LC Kit Editor JavaScript
 */

(function($) {
    'use strict';

    // Wait for Elementor to be ready
    $(window).on('elementor/frontend/init', function() {
        
        // Initialize editor functionality
        initLCKitEditor();
        
    });

    function initLCKitEditor() {
        
        // Add custom controls to widgets
        addCustomControls();
        
        // Enhance widget previews
        enhanceWidgetPreviews();
        
        // Add widget templates
        addWidgetTemplates();
        
        // Initialize widget interactions
        initWidgetInteractions();
        
    }

    function addCustomControls() {
        
        // Add custom control to button widget
        elementor.hooks.addAction('panel/open_editor/widget/lc-kit-button', function(panel, model, view) {
            
            // Add custom section
            panel.content.currentView.collection.add([
                {
                    name: 'lc_kit_custom_section',
                    label: 'LC Kit Custom',
                    type: 'section',
                    tab: 'content',
                    controls: [
                        {
                            name: 'custom_animation',
                            label: 'Custom Animation',
                            type: 'select',
                            default: 'none',
                            options: [
                                { value: 'none', label: 'None' },
                                { value: 'fade-in', label: 'Fade In' },
                                { value: 'slide-in', label: 'Slide In' },
                                { value: 'bounce', label: 'Bounce' }
                            ]
                        },
                        {
                            name: 'custom_delay',
                            label: 'Animation Delay (ms)',
                            type: 'slider',
                            default: 0,
                            min: 0,
                            max: 2000,
                            step: 100
                        }
                    ]
                }
            ]);
            
        });
        
        // Add custom control to heading widget
        elementor.hooks.addAction('panel/open_editor/widget/lc-kit-heading', function(panel, model, view) {
            
            panel.content.currentView.collection.add([
                {
                    name: 'lc_kit_heading_effects',
                    label: 'LC Kit Effects',
                    type: 'section',
                    tab: 'content',
                    controls: [
                        {
                            name: 'text_effect',
                            label: 'Text Effect',
                            type: 'select',
                            default: 'none',
                            options: [
                                { value: 'none', label: 'None' },
                                { value: 'typewriter', label: 'Typewriter' },
                                { value: 'highlight', label: 'Highlight' }
                            ]
                        }
                    ]
                }
            ]);
            
        });
        
    }

    function enhanceWidgetPreviews() {
        
        // Enhance button widget preview
        elementor.hooks.addAction('frontend/element_ready/lc-kit-button.default', function($scope) {
            
            var $button = $scope.find('.lc-kit-button');
            var settings = $scope.data('settings');
            
            // Add animation class
            if (settings.custom_animation && settings.custom_animation !== 'none') {
                $button.addClass('lc-kit-animation-' + settings.custom_animation);
            }
            
            // Add delay
            if (settings.custom_delay && settings.custom_delay > 0) {
                $button.css('animation-delay', settings.custom_delay + 'ms');
            }
            
        });
        
        // Enhance heading widget preview
        elementor.hooks.addAction('frontend/element_ready/lc-kit-heading.default', function($scope) {
            
            var $heading = $scope.find('.lc-kit-heading');
            var settings = $scope.data('settings');
            
            // Add text effect
            if (settings.text_effect && settings.text_effect !== 'none') {
                $heading.addClass('lc-kit-text-effect-' + settings.text_effect);
            }
            
        });
        
        // Enhance category list widget preview
        elementor.hooks.addAction('frontend/element_ready/lc-header-footer-category-list.default', function($scope) {
            
            var $list = $scope.find('.lc-category-list');
            var $items = $list.find('.lc-category-item');
            
            // Add staggered animation
            $items.each(function(index) {
                var $item = $(this);
                $item.css('animation-delay', (index * 100) + 'ms');
                $item.addClass('lc-kit-staggered-animation');
            });
            
        });
        
    }

    function addWidgetTemplates() {
        
        // Add template for button widget
        elementor.hooks.addAction('editor/init', function() {
            
            // Button template
            var buttonTemplate = {
                elType: 'widget',
                widgetType: 'lc-kit-button',
                settings: {
                    button_text: 'Click Here',
                    button_link: {
                        url: '#',
                        is_external: false,
                        nofollow: false
                    },
                    button_size: 'medium',
                    button_type: 'primary'
                }
            };
            
            // Heading template
            var headingTemplate = {
                elType: 'widget',
                widgetType: 'lc-kit-heading',
                settings: {
                    heading_text: 'Your Heading Here',
                    heading_tag: 'h2',
                    heading_alignment: 'left'
                }
            };
            
            // Category list template
            var categoryListTemplate = {
                elType: 'widget',
                widgetType: 'lc-header-footer-category-list',
                settings: {
                    title: 'Categories',
                    number_of_categories: 10,
                    orderby: 'name',
                    order: 'ASC',
                    show_count: 'yes'
                }
            };
            
            // Store templates
            window.LCKitTemplates = {
                button: buttonTemplate,
                heading: headingTemplate,
                categoryList: categoryListTemplate
            };
            
        });
        
    }

    function initWidgetInteractions() {
        
        // Add drag and drop functionality for widgets
        elementor.hooks.addAction('editor/init', function() {
            
            // Make widgets draggable in editor
            $('.elementor-widget-lc-kit-button, .elementor-widget-lc-kit-heading, .elementor-widget-lc-header-footer-category-list').each(function() {
                var $widget = $(this);
                
                $widget.on('click', function() {
                    // Highlight widget when clicked
                    $('.elementor-widget').removeClass('lc-kit-widget-selected');
                    $widget.addClass('lc-kit-widget-selected');
                });
                
            });
            
        });
        
        // Add widget duplication functionality
        elementor.hooks.addAction('editor/init', function() {
            
            // Add duplicate button to widget controls
            $('.elementor-widget').each(function() {
                var $widget = $(this);
                var widgetType = $widget.data('widget-type');
                
                if (widgetType && widgetType.startsWith('lc-')) {
                    
                    var $duplicateButton = $('<button class="lc-kit-duplicate-widget" title="Duplicate Widget">' +
                        '<i class="eicon-copy"></i>' +
                        '</button>');
                    
                    $widget.find('.elementor-widget-controls').append($duplicateButton);
                    
                    $duplicateButton.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Duplicate widget
                        duplicateWidget($widget);
                        
                    });
                    
                }
                
            });
            
        });
        
    }

    function duplicateWidget($widget) {
        
        // Get widget model
        var model = $widget.data('model');
        
        if (model) {
            
            // Create new widget with same settings
            var newModel = model.clone();
            
            // Add to editor
            var parentModel = model.collection.parent;
            if (parentModel) {
                parentModel.addChild(newModel);
                
                // Show success message
                showEditorNotification('Widget duplicated successfully!', 'success');
                
            }
            
        }
        
    }

    function showEditorNotification(message, type) {
        
        type = type || 'info';
        
        var $notification = $('<div class="lc-kit-editor-notification lc-kit-editor-notification-' + type + '">' +
            '<span>' + message + '</span>' +
            '</div>');
        
        $('.elementor-panel').append($notification);
        
        // Auto-hide after 3 seconds
        setTimeout(function() {
            $notification.fadeOut(function() {
                $(this).remove();
            });
        }, 3000);
        
    }

    // Widget preview enhancements
    elementor.hooks.addAction('frontend/element_ready/global', function($scope) {
        
        // Add hover effects to all LC Kit widgets
        $scope.find('.lc-kit-button, .lc-kit-heading, .lc-category-item a').hover(
            function() {
                $(this).addClass('lc-kit-editor-hover');
            },
            function() {
                $(this).removeClass('lc-kit-editor-hover');
            }
        );
        
    });

    // Keyboard shortcuts for editor
    $(document).on('keydown', function(e) {
        
        // Only in Elementor editor
        if (!elementor || !elementor.isEditMode()) {
            return;
        }
        
        // Ctrl/Cmd + D to duplicate selected widget
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 68) {
            e.preventDefault();
            
            var $selectedWidget = $('.elementor-widget.elementor-widget-selected');
            if ($selectedWidget.length) {
                duplicateWidget($selectedWidget);
            }
            
        }
        
        // Ctrl/Cmd + Shift + C to copy widget settings
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.keyCode === 67) {
            e.preventDefault();
            
            var $selectedWidget = $('.elementor-widget.elementor-widget-selected');
            if ($selectedWidget.length) {
                var model = $selectedWidget.data('model');
                if (model) {
                    var settings = model.get('settings');
                    localStorage.setItem('lc-kit-copied-settings', JSON.stringify(settings));
                    showEditorNotification('Widget settings copied!', 'success');
                }
            }
            
        }
        
        // Ctrl/Cmd + Shift + V to paste widget settings
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.keyCode === 86) {
            e.preventDefault();
            
            var $selectedWidget = $('.elementor-widget.elementor-widget-selected');
            if ($selectedWidget.length) {
                var copiedSettings = localStorage.getItem('lc-kit-copied-settings');
                if (copiedSettings) {
                    var model = $selectedWidget.data('model');
                    if (model) {
                        var settings = JSON.parse(copiedSettings);
                        model.set('settings', settings);
                        showEditorNotification('Widget settings pasted!', 'success');
                    }
                }
            }
            
        }
        
    });

    // Widget performance optimization
    elementor.hooks.addAction('frontend/element_ready/global', function($scope) {
        
        // Lazy load widget content
        $scope.find('.lc-kit-widget').each(function() {
            var $widget = $(this);
            
            // Check if widget is in viewport
            if (isElementInViewport($widget[0])) {
                $widget.addClass('lc-kit-widget-loaded');
            }
            
        });
        
    });

    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Export widget data
    window.LCKitEditor = {
        
        exportWidgetData: function() {
            var widgets = [];
            
            $('.elementor-widget').each(function() {
                var $widget = $(this);
                var model = $widget.data('model');
                
                if (model) {
                    widgets.push({
                        type: model.get('widgetType'),
                        settings: model.get('settings')
                    });
                }
                
            });
            
            return widgets;
        },
        
        importWidgetData: function(data) {
            // Implementation for importing widget data
            console.log('Importing widget data:', data);
        }
        
    };

})(jQuery); 