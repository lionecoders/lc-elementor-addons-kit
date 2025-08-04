/**
 * LC Kit Admin JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Initialize admin functionality
        initLCKitAdmin();
        
    });

    function initLCKitAdmin() {
        
        // Toggle switch functionality
        $('.lc-kit-toggle input').on('change', function() {
            var $toggle = $(this);
            var $widgetItem = $toggle.closest('.lc-kit-widget-item');
            
            if ($toggle.is(':checked')) {
                $widgetItem.removeClass('disabled').addClass('enabled');
            } else {
                $widgetItem.removeClass('enabled').addClass('disabled');
            }
            
            // Show save notification
            showSaveNotification();
        });
        
        // Bulk actions
        initBulkActions();
        
        // Search functionality
        initSearchFunctionality();
        
        // Form validation
        initFormValidation();
        
    }

    function initBulkActions() {
        
        // Add bulk action buttons
        var $sections = $('.lc-kit-section');
        
        $sections.each(function() {
            var $section = $(this);
            var $grid = $section.find('.lc-kit-widgets-grid');
            
            // Add bulk action buttons
            var $bulkActions = $('<div class="lc-kit-bulk-actions">' +
                '<button type="button" class="button lc-kit-enable-all">Enable All</button>' +
                '<button type="button" class="button lc-kit-disable-all">Disable All</button>' +
                '<button type="button" class="button lc-kit-toggle-all">Toggle All</button>' +
                '</div>');
            
            $grid.before($bulkActions);
            
            // Enable all
            $section.find('.lc-kit-enable-all').on('click', function() {
                $section.find('.lc-kit-toggle input').prop('checked', true).trigger('change');
            });
            
            // Disable all
            $section.find('.lc-kit-disable-all').on('click', function() {
                $section.find('.lc-kit-toggle input').prop('checked', false).trigger('change');
            });
            
            // Toggle all
            $section.find('.lc-kit-toggle-all').on('click', function() {
                var $checkboxes = $section.find('.lc-kit-toggle input');
                var allChecked = $checkboxes.length === $checkboxes.filter(':checked').length;
                
                $checkboxes.prop('checked', !allChecked).trigger('change');
            });
        });
        
    }

    function initSearchFunctionality() {
        
        // Add search input
        var $searchInput = $('<input type="text" class="lc-kit-search" placeholder="Search widgets..." />');
        $('.lc-kit-settings-container').prepend($searchInput);
        
        $searchInput.on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            
            $('.lc-kit-widget-item').each(function() {
                var $item = $(this);
                var widgetName = $item.find('.lc-kit-widget-name').text().toLowerCase();
                
                if (widgetName.includes(searchTerm)) {
                    $item.show();
                } else {
                    $item.hide();
                }
            });
        });
        
    }

    function initFormValidation() {
        
        // Form submission handling
        $('form').on('submit', function(e) {
            
            // Check if at least one widget is enabled
            var enabledWidgets = $('.lc-kit-toggle input:checked').length;
            
            if (enabledWidgets === 0) {
                e.preventDefault();
                showError('Please enable at least one widget.');
                return false;
            }
            
            // Show success message
            showSuccess('Settings saved successfully!');
            
        });
        
    }

    function showSaveNotification() {
        
        // Create notification element
        var $notification = $('<div class="lc-kit-notification">' +
            '<span>Settings changed. Remember to save!</span>' +
            '</div>');
        
        // Remove existing notification
        $('.lc-kit-notification').remove();
        
        // Add notification
        $('.lc-kit-settings-container').prepend($notification);
        
        // Auto-hide after 3 seconds
        setTimeout(function() {
            $notification.fadeOut(function() {
                $(this).remove();
            });
        }, 3000);
        
    }

    function showError(message) {
        
        var $error = $('<div class="notice notice-error is-dismissible">' +
            '<p>' + message + '</p>' +
            '</div>');
        
        $('.wrap h1').after($error);
        
        // Auto-dismiss after 5 seconds
        setTimeout(function() {
            $error.fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
        
    }

    function showSuccess(message) {
        
        var $success = $('<div class="notice notice-success is-dismissible">' +
            '<p>' + message + '</p>' +
            '</div>');
        
        $('.wrap h1').after($success);
        
        // Auto-dismiss after 3 seconds
        setTimeout(function() {
            $success.fadeOut(function() {
                $(this).remove();
            });
        }, 3000);
        
    }

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
            e.preventDefault();
            $('form input[type="submit"]').click();
        }
        
        // Ctrl/Cmd + A to select all
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 65) {
            e.preventDefault();
            $('.lc-kit-toggle input').prop('checked', true).trigger('change');
        }
        
    });

    // Export/Import functionality
    window.LCKitAdmin = {
        
        exportSettings: function() {
            var settings = {};
            
            $('.lc-kit-toggle input').each(function() {
                var $input = $(this);
                var name = $input.attr('name');
                var value = $input.is(':checked') ? 'enabled' : 'disabled';
                
                // Parse the name to get category and widget
                var matches = name.match(/\[([^\]]+)\]\[([^\]]+)\]/);
                if (matches) {
                    var category = matches[1];
                    var widget = matches[2];
                    
                    if (!settings[category]) {
                        settings[category] = {};
                    }
                    settings[category][widget] = value;
                }
            });
            
            // Create download link
            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(settings, null, 2));
            var downloadAnchorNode = document.createElement('a');
            downloadAnchorNode.setAttribute("href", dataStr);
            downloadAnchorNode.setAttribute("download", "lc-kit-settings.json");
            document.body.appendChild(downloadAnchorNode);
            downloadAnchorNode.click();
            downloadAnchorNode.remove();
        },
        
        importSettings: function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                try {
                    var settings = JSON.parse(e.target.result);
                    
                    // Apply settings
                    Object.keys(settings).forEach(function(category) {
                        Object.keys(settings[category]).forEach(function(widget) {
                            var selector = 'input[name="lc_kit_widgets[' + category + '][' + widget + ']"]';
                            var $input = $(selector);
                            var isEnabled = settings[category][widget] === 'enabled';
                            
                            $input.prop('checked', isEnabled).trigger('change');
                        });
                    });
                    
                    showSuccess('Settings imported successfully!');
                    
                } catch (error) {
                    showError('Invalid settings file.');
                }
            };
            reader.readAsText(file);
        }
        
    };

})(jQuery); 