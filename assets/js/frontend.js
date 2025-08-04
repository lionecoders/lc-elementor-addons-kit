/**
 * LC Kit Frontend JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Initialize frontend functionality
        initLCKitFrontend();
        
    });

    function initLCKitFrontend() {
        
        // Button widget functionality
        initButtonWidgets();
        
        // Category list widget functionality
        initCategoryListWidgets();
        
        // Add animation classes
        addAnimationClasses();
        
        // Initialize tooltips
        initTooltips();
        
    }

    function initButtonWidgets() {
        
        // Add click tracking for buttons
        $('.lc-kit-button').on('click', function(e) {
            var $button = $(this);
            var buttonText = $button.text().trim();
            var buttonUrl = $button.attr('href');
            
            // Add click animation
            $button.addClass('lc-kit-button-clicked');
            
            setTimeout(function() {
                $button.removeClass('lc-kit-button-clicked');
            }, 200);
            
            // Track button clicks (if analytics is available)
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'LC Kit Button',
                    'event_label': buttonText,
                    'value': buttonUrl
                });
            }
            
        });
        
        // Add hover effects
        $('.lc-kit-button').hover(
            function() {
                $(this).addClass('lc-kit-button-hover');
            },
            function() {
                $(this).removeClass('lc-kit-button-hover');
            }
        );
        
    }

    function initCategoryListWidgets() {
        
        // Add lazy loading for category lists
        $('.lc-category-list').each(function() {
            var $list = $(this);
            var $items = $list.find('.lc-category-item');
            
            // Show items with delay for better UX
            $items.each(function(index) {
                var $item = $(this);
                setTimeout(function() {
                    $item.addClass('lc-kit-fade-in');
                }, index * 50);
            });
        });
        
        // Add category count animations
        $('.lc-category-count').each(function() {
            var $count = $(this);
            var countText = $count.text();
            var countNumber = parseInt(countText.replace(/[^0-9]/g, ''));
            
            if (countNumber > 0) {
                // Animate count on hover
                $count.parent().hover(
                    function() {
                        $count.addClass('lc-kit-count-highlight');
                    },
                    function() {
                        $count.removeClass('lc-kit-count-highlight');
                    }
                );
            }
        });
        
    }

    function addAnimationClasses() {
        
        // Add animation classes based on scroll position
        $(window).on('scroll', function() {
            $('.lc-kit-button-wrapper, .lc-category-list-widget').each(function() {
                var $element = $(this);
                var elementTop = $element.offset().top;
                var elementBottom = elementTop + $element.outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                
                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $element.addClass('lc-kit-in-viewport');
                }
            });
        });
        
        // Trigger scroll event on load
        $(window).trigger('scroll');
        
    }

    function initTooltips() {
        
        // Add tooltips to buttons
        $('.lc-kit-button').each(function() {
            var $button = $(this);
            var buttonText = $button.text().trim();
            var buttonUrl = $button.attr('href');
            
            if (buttonUrl && buttonUrl !== '#') {
                $button.attr('title', 'Click to visit: ' + buttonUrl);
            }
        });
        
        // Add tooltips to category links
        $('.lc-category-item a').each(function() {
            var $link = $(this);
            var categoryName = $link.text().trim();
            var postCount = $link.find('.lc-category-count').text();
            
            if (postCount) {
                $link.attr('title', categoryName + ' - ' + postCount + ' posts');
            }
        });
        
    }

    // Utility functions
    window.LCKit = {
        
        // Debounce function
        debounce: function(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        },
        
        // Throttle function
        throttle: function(func, limit) {
            var inThrottle;
            return function() {
                var args = arguments;
                var context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(function() {
                        inThrottle = false;
                    }, limit);
                }
            };
        },
        
        // Smooth scroll to element
        scrollToElement: function(element, duration) {
            duration = duration || 500;
            $('html, body').animate({
                scrollTop: $(element).offset().top - 50
            }, duration);
        },
        
        // Add loading state to button
        setButtonLoading: function(button, loading) {
            var $button = $(button);
            
            if (loading) {
                $button.addClass('lc-kit-button-loading');
                $button.attr('disabled', true);
                $button.data('original-text', $button.text());
                $button.text('Loading...');
            } else {
                $button.removeClass('lc-kit-button-loading');
                $button.attr('disabled', false);
                $button.text($button.data('original-text'));
            }
        },
        
        // Show notification
        showNotification: function(message, type) {
            type = type || 'info';
            
            var $notification = $('<div class="lc-kit-notification lc-kit-notification-' + type + '">' +
                '<span>' + message + '</span>' +
                '<button class="lc-kit-notification-close">&times;</button>' +
                '</div>');
            
            $('body').append($notification);
            
            // Auto-hide after 5 seconds
            setTimeout(function() {
                $notification.fadeOut(function() {
                    $(this).remove();
                });
            }, 5000);
            
            // Close button
            $notification.find('.lc-kit-notification-close').on('click', function() {
                $notification.fadeOut(function() {
                    $(this).remove();
                });
            });
        }
        
    };

    // Performance optimization
    var scrollHandler = LCKit.throttle(function() {
        // Handle scroll events efficiently
    }, 100);
    
    $(window).on('scroll', scrollHandler);
    
    // Resize handler
    var resizeHandler = LCKit.debounce(function() {
        // Handle resize events
        $('.lc-kit-widget-wrapper').each(function() {
            var $wrapper = $(this);
            var $button = $wrapper.find('.lc-kit-button');
            
            // Adjust button size on mobile
            if ($(window).width() < 768) {
                $button.addClass('lc-kit-button-mobile');
            } else {
                $button.removeClass('lc-kit-button-mobile');
            }
        });
    }, 250);
    
    $(window).on('resize', resizeHandler);
    
    // Initialize on load
    resizeHandler();

})(jQuery); 