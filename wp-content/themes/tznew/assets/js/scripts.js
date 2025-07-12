/**
 * TZnew Theme Scripts
 * 
 * Main JavaScript file for the TZnew theme with enhanced animations and interactions
 */

(function($) {
    'use strict';

    // Global variables
    let isScrolling = false;
    let lastScrollTop = 0;
    
    // Document ready
    $(document).ready(function() {
        
        // Initialize all functions
        initMobileMenu();
        initSmoothScrolling();
        initBackToTop();
        initScrollReveal();
        initParallax();
        initSearchEnhancements();
        initLiveSearch();
        initFilterSystem();
        initAnimations();
        initHeaderScroll();
        initImageLazyLoading();
        initializeBookingForm();
        initializeInquiryForm();
        
    });
    
    /**
     * Initialize mobile menu functionality
     */
    function initMobileMenu() {
        const $mobileMenuToggle = $('#mobile-menu-toggle');
        const $mobileMenu = $('#mobile-menu');
        const $body = $('body');
        
        if ($mobileMenuToggle.length && $mobileMenu.length) {
            // Toggle mobile menu
            $mobileMenuToggle.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isOpen = $mobileMenu.hasClass('active');
                
                if (isOpen) {
                    closeMobileMenu();
                } else {
                    openMobileMenu();
                }
            });
            
            // Close menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#mobile-menu, #mobile-menu-toggle').length) {
                    closeMobileMenu();
                }
            });
            
            // Close menu on escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeMobileMenu();
                }
            });
            
            // Close menu when clicking on menu links
            $mobileMenu.find('a').on('click', function() {
                closeMobileMenu();
            });
            
            // Handle window resize
            $(window).on('resize', debounce(function() {
                if ($(window).width() >= 1024) { // lg breakpoint
                    closeMobileMenu();
                }
            }, 250));
        }
        
        function openMobileMenu() {
            $mobileMenu.addClass('active');
            $mobileMenuToggle.addClass('active');
            $body.addClass('mobile-menu-open');
            
            // Update aria attributes
            $mobileMenuToggle.attr('aria-expanded', 'true');
            $mobileMenu.attr('aria-hidden', 'false');
            
            // Focus management
            $mobileMenu.find('a:first').focus();
        }
        
        function closeMobileMenu() {
            $mobileMenu.removeClass('active');
            $mobileMenuToggle.removeClass('active');
            $body.removeClass('mobile-menu-open');
            
            // Update aria attributes
            $mobileMenuToggle.attr('aria-expanded', 'false');
            $mobileMenu.attr('aria-hidden', 'true');
        }
    }
    
    /**
     * Initialize smooth scrolling
     */
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'easeInOutCubic');
            }
        });
    }
    
    /**
     * Initialize back to top functionality
     */
    function initBackToTop() {
        $('body').append('<button class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>');
        
        const $backToTop = $('.back-to-top');
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 500) {
                $backToTop.addClass('visible');
            } else {
                $backToTop.removeClass('visible');
            }
        });
        
        $backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 800);
        });
    }
    
    /**
     * Initialize scroll reveal animations
     */
    function initScrollReveal() {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        $('.scroll-reveal').each(function() {
            observer.observe(this);
        });
    }
    
    /**
     * Initialize parallax effects
     */
    function initParallax() {
        if (window.innerWidth > 768) {
            $('.parallax').each(function() {
                const $element = $(this);
                const speed = $element.data('speed') || 0.5;
                
                $(window).on('scroll', function() {
                    const scrolled = $(window).scrollTop();
                    const elementTop = $element.offset().top;
                    const elementHeight = $element.outerHeight();
                    const windowHeight = $(window).height();
                    
                    if (scrolled + windowHeight > elementTop && scrolled < elementTop + elementHeight) {
                        const yPos = -(scrolled - elementTop) * speed;
                        $element.css('transform', 'translateY(' + yPos + 'px)');
                    }
                });
            });
        }
    }
    
    /**
     * Initialize search enhancements
     */
    function initSearchEnhancements() {
        const $searchForm = $('.search-form');
        const $searchInput = $('.search-input');
        
        // Add search suggestions
        $searchInput.on('focus', function() {
            $(this).closest('.search-form').addClass('focused');
        });
        
        $searchInput.on('blur', function() {
            setTimeout(() => {
                $(this).closest('.search-form').removeClass('focused');
            }, 200);
        });
    }
    
    /**
     * Initialize live search
     */
    function initLiveSearch() {
        const $searchInput = $('.search-input');
        const $searchResults = $('<div class="search-results"></div>');
        
        if ($searchInput.length) {
            $searchInput.closest('.search-form').append($searchResults);
            
            let searchTimeout;
            $searchInput.on('input', function() {
                const query = $(this).val().trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length >= 3) {
                    searchTimeout = setTimeout(function() {
                        performLiveSearch(query, $searchResults);
                    }, 300);
                } else {
                    $searchResults.hide().empty();
                }
            });
        }
    }
    
    /**
     * Initialize filter system
     */
    function initFilterSystem() {
        $('.filter-form').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $container = $('.posts-container');
            
            $.ajax({
                url: tznew_ajax.ajax_url,
                type: 'POST',
                data: $form.serialize() + '&action=tznew_filter_posts&nonce=' + tznew_ajax.nonce,
                beforeSend: function() {
                    $container.addClass('loading');
                },
                success: function(response) {
                    if (response.success) {
                        $container.html(response.data).removeClass('loading');
                        initScrollReveal();
                    }
                },
                error: function() {
                    $container.removeClass('loading');
                }
            });
        });
    }
    
    /**
     * Initialize animations
     */
    function initAnimations() {
        // Stagger animations for cards
        $('.card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
            $(this).addClass('animate-fade-in-up');
        });
        
        // Hero animations
        $('.hero-title').addClass('animate-fade-in-up');
        $('.hero-subtitle').addClass('animate-fade-in-up');
        $('.hero-cta').addClass('animate-fade-in-up');
    }
    
    /**
     * Initialize header scroll effects
     */
    function initHeaderScroll() {
        const $header = $('.site-header');
        
        $(window).on('scroll', throttle(function() {
            if ($(this).scrollTop() > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        }, 100));
    }
    
    /**
     * Initialize image lazy loading
     */
    function initImageLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });
            
            $('img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        }
    }
    
    /**
      * Trigger scroll reveal for elements in view
      */
     function triggerScrollReveal() {
         $('.scroll-reveal').each(function() {
             const elementTop = $(this).offset().top;
             const elementBottom = elementTop + $(this).outerHeight();
             const viewportTop = $(window).scrollTop();
             const viewportBottom = viewportTop + $(window).height();
             
             if (elementBottom > viewportTop && elementTop < viewportBottom) {
                 $(this).addClass('revealed');
             }
         });
     }
     
     // Window load
     $(window).on('load', function() {
        console.log('Window loaded, hiding preloader');
        // Hide preloader with animation
        $('#preloader').addClass('fade-out');
        setTimeout(function() {
            $('#preloader').remove();
            console.log('Preloader removed');
        }, 600); // Increased timeout to match CSS transition
        
        // Trigger scroll reveal for elements in view
        triggerScrollReveal();
    });
    
    // Fallback: Hide preloader after 2 seconds regardless
    setTimeout(function() {
        if ($('#preloader').length) {
            console.log('Fallback: Removing preloader after timeout');
            $('#preloader').addClass('fade-out');
            setTimeout(function() {
                $('#preloader').remove();
            }, 600);
        }
    }, 2000); // Reduced timeout for faster loading

    /**
     * Main theme initialization
     */
    function initializeTheme() {
        initializeNavigation();
        initializeSearch();
        initializeCards();
        initializeForms();
        initializeModals();
        initializeCounters();
        initializeParallax();
        initializeImageLightbox();
        initializeFilterSystem();
        initializeSmoothScroll();
        initializeBackToTop();
    }

    /**
     * Navigation functionality
     */
    function initializeNavigation() {
        const $header = $('.site-header');
        const $menuToggle = $('.menu-toggle');
        const $mobileMenu = $('.primary-menu-container');

        // Header scroll effect
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        });

        // Mobile menu toggle
        $menuToggle.on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
            $mobileMenu.toggleClass('active');
            $('body').toggleClass('menu-open');
        });

        // Close mobile menu on link click
        $('.primary-menu a').on('click', function() {
            $menuToggle.removeClass('active');
            $mobileMenu.removeClass('active');
            $('body').removeClass('menu-open');
        });

        // Close mobile menu on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length) {
                $menuToggle.removeClass('active');
                $mobileMenu.removeClass('active');
                $('body').removeClass('menu-open');
            }
        });
    }

    /**
     * Enhanced search functionality
     */
    function initializeSearch() {
        const $searchForm = $('.search-form');
        const $searchInput = $('.search-input');
        const $searchResults = $('<div class="search-results"></div>');

        // Add search results container
        $searchForm.append($searchResults);

        // Live search functionality
        let searchTimeout;
        $searchInput.on('input', function() {
            const query = $(this).val().trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length >= 3) {
                searchTimeout = setTimeout(function() {
                    performLiveSearch(query, $searchResults);
                }, 300);
            } else {
                $searchResults.hide().empty();
            }
        });

        // Hide results on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-form').length) {
                $searchResults.hide();
            }
        });
    }

    /**
     * Perform live search
     */
    function performLiveSearch(query, $resultsContainer) {
        $.ajax({
            url: tznew_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'tznew_live_search',
                query: query,
                nonce: tznew_ajax.nonce
            },
            beforeSend: function() {
                $resultsContainer.html('<div class="search-loading">Searching...</div>').show();
            },
            success: function(response) {
                if (response.success && response.data.length > 0) {
                    let html = '<div class="search-results-list">';
                    response.data.forEach(function(item) {
                        html += `
                            <div class="search-result-item">
                                <a href="${item.url}">
                                    <div class="search-result-content">
                                        <h4>${item.title}</h4>
                                        <p>${item.excerpt}</p>
                                        <span class="search-result-type">${item.type}</span>
                                    </div>
                                </a>
                            </div>
                        `;
                    });
                    html += '</div>';
                    $resultsContainer.html(html).show();
                } else {
                    $resultsContainer.html('<div class="search-no-results">No results found</div>').show();
                }
            },
            error: function() {
                $resultsContainer.html('<div class="search-error">Search error occurred</div>').show();
            }
        });
    }

    /**
     * Card hover effects and interactions
     */
    function initializeCards() {
        $('.card').each(function() {
            const $card = $(this);
            const $image = $card.find('.card-image img');
            
            $card.on('mouseenter', function() {
                $(this).addClass('hovered');
                $image.addClass('zoomed');
            });
            
            $card.on('mouseleave', function() {
                $(this).removeClass('hovered');
                $image.removeClass('zoomed');
            });
        });
    }

    /**
     * Form enhancements
     */
    function initializeForms() {
        // Floating labels
        $('.form-input').on('focus blur', function() {
            const $this = $(this);
            const $label = $this.siblings('.form-label');
            
            if ($this.val() !== '' || $this.is(':focus')) {
                $label.addClass('floating');
            } else {
                $label.removeClass('floating');
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            const $form = $(this);
            let isValid = true;

            $form.find('.form-input[required]').each(function() {
                const $input = $(this);
                const value = $input.val().trim();
                
                if (value === '') {
                    $input.addClass('error');
                    isValid = false;
                } else {
                    $input.removeClass('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showNotification('Please fill in all required fields', 'error');
            }
        });
    }

    /**
     * Modal functionality
     */
    function initializeModals() {
        // Open modal
        $('[data-modal]').on('click', function(e) {
            e.preventDefault();
            const modalId = $(this).data('modal');
            const $modal = $('#' + modalId);
            
            if ($modal.length) {
                $modal.addClass('active');
                $('body').addClass('modal-open');
            }
        });

        // Close modal
        $('.modal-close, .modal-overlay').on('click', function(e) {
            e.preventDefault();
            $(this).closest('.modal').removeClass('active');
            $('body').removeClass('modal-open');
        });

        // Close modal on escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) {
                $('.modal.active').removeClass('active');
                $('body').removeClass('modal-open');
            }
        });
    }

    /**
     * Animated counters
     */
    function initializeCounters() {
        $('.counter').each(function() {
            const $counter = $(this);
            const target = parseInt($counter.data('target'));
            const duration = parseInt($counter.data('duration')) || 2000;
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter($counter, target, duration);
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe($counter[0]);
        });
    }

    /**
     * Animate counter
     */
    function animateCounter($element, target, duration) {
        let start = 0;
        const increment = target / (duration / 16);
        
        const timer = setInterval(function() {
            start += increment;
            $element.text(Math.floor(start));
            
            if (start >= target) {
                $element.text(target);
                clearInterval(timer);
            }
        }, 16);
    }

    /**
     * Parallax effects
     */
    function initializeParallax() {
        if (window.innerWidth > 768) {
            $('.parallax').each(function() {
                const $element = $(this);
                const speed = $element.data('speed') || 0.5;
                
                $(window).on('scroll', function() {
                    const scrolled = $(window).scrollTop();
                    const elementTop = $element.offset().top;
                    const elementHeight = $element.outerHeight();
                    const windowHeight = $(window).height();
                    
                    if (scrolled + windowHeight > elementTop && scrolled < elementTop + elementHeight) {
                        const yPos = -(scrolled - elementTop) * speed;
                        $element.css('transform', 'translateY(' + yPos + 'px)');
                    }
                });
            });
        }
    }

    /**
     * Image lightbox
     */
    function initializeImageLightbox() {
        $('body').append('<div class="lightbox"><div class="lightbox-content"><img src="" alt=""><button class="lightbox-close">&times;</button></div></div>');
        
        const $lightbox = $('.lightbox');
        const $lightboxImg = $('.lightbox img');
        
        $('.gallery img, .lightbox-trigger').on('click', function(e) {
            e.preventDefault();
            const src = $(this).attr('src') || $(this).attr('href');
            const alt = $(this).attr('alt') || '';
            
            $lightboxImg.attr('src', src).attr('alt', alt);
            $lightbox.addClass('active');
            $('body').addClass('lightbox-open');
        });
        
        $('.lightbox-close, .lightbox').on('click', function(e) {
            if (e.target === this) {
                $lightbox.removeClass('active');
                $('body').removeClass('lightbox-open');
            }
        });
    }

    /**
     * Filter system for tours and treks
     */
    function initializeFilterSystem() {
        $('.filter-form').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $container = $('.posts-container');
            
            $.ajax({
                url: tznew_ajax.ajax_url,
                type: 'POST',
                data: $form.serialize() + '&action=tznew_filter_posts&nonce=' + tznew_ajax.nonce,
                beforeSend: function() {
                    $container.addClass('loading');
                },
                success: function(response) {
                    if (response.success) {
                        $container.html(response.data).removeClass('loading');
                        initializeScrollReveal();
                    }
                },
                error: function() {
                    showNotification('Filter error occurred', 'error');
                    $container.removeClass('loading');
                }
            });
        });
        
        // Reset filters
        $('.filter-reset').on('click', function(e) {
            e.preventDefault();
            $('.filter-form')[0].reset();
            $('.filter-form').trigger('submit');
        });
    }

    /**
     * Smooth scrolling
     */
    function initializeSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'easeInOutCubic');
            }
        });
    }

    /**
     * Back to top button
     */
    function initializeBackToTop() {
        $('body').append('<button class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>');
        
        const $backToTop = $('.back-to-top');
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 500) {
                $backToTop.addClass('visible');
            } else {
                $backToTop.removeClass('visible');
            }
        });
        
        $backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 800);
        });
    }



    /**
     * Initialize animations
     */
    function initializeAnimations() {
        // Stagger animations for cards
        $('.card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
            $(this).addClass('animate-fade-in-up');
        });
        
        // Hero animations
        $('.hero-title').addClass('animate-fade-in-up');
        $('.hero-subtitle').addClass('animate-fade-in-up');
        $('.hero-cta').addClass('animate-fade-in-up');
    }

    /**
     * Scroll reveal animations
     */
    function initializeScrollReveal() {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        $('.scroll-reveal').each(function() {
            observer.observe(this);
        });
    }

    /**
     * Show notification
     */
    function showNotification(message, type = 'info') {
        const $notification = $(`
            <div class="notification notification-${type}">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `);
        
        $('body').append($notification);
        
        setTimeout(function() {
            $notification.addClass('show');
        }, 100);
        
        setTimeout(function() {
            $notification.removeClass('show');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 5000);
        
        $notification.find('.notification-close').on('click', function() {
            $notification.removeClass('show');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        });
    }

    /**
     * Utility functions
     */
    
    // Debounce function
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
    
    // Throttle function
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    // Custom easing for jQuery animations
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };

    /**
      * Initialize booking form functionality
      */
     function initializeBookingForm() {
         const $bookingForm = $('#booking-form');
         if ($bookingForm.length === 0) return;
         
         // Real-time validation
         $bookingForm.find('input, select, textarea').on('blur', function() {
             validateField($(this));
         });
         
         // Form submission
         $bookingForm.on('submit', function(e) {
             e.preventDefault();
             const $form = $(this);
             
             // Show loading state
             showFormLoading($form, true);
             
             // Validate form
             if (!validateBookingForm($form)) {
                 showFormLoading($form, false);
                 return;
             }
             
             // Prepare form data
             const formData = new FormData(this);
             
             $.ajax({
                 url: tznew_ajax.ajax_url,
                 type: 'POST',
                 data: formData,
                 processData: false,
                 contentType: false,
                 success: function(response) {
                     if (response.success) {
                         showFormMessage($form, response.data.message, 'success');
                         $form[0].reset();
                         // Remove any error states
                         $form.find('.form-group').removeClass('error success');
                         $form.find('.error-message').addClass('hidden');
                     } else {
                         showFormMessage($form, response.data.message || 'Booking submission failed', 'error');
                     }
                 },
                 error: function() {
                     showFormMessage($form, 'An error occurred. Please try again.', 'error');
                 },
                 complete: function() {
                     showFormLoading($form, false);
                 }
             });
         });
     }
    
    /**
      * Initialize inquiry form functionality
      */
     function initializeInquiryForm() {
         const $inquiryForm = $('#inquiry-form');
         if ($inquiryForm.length === 0) return;
         
         // Real-time validation
         $inquiryForm.find('input, select, textarea').on('blur', function() {
             validateField($(this));
         });
         
         // Message character counter
         const $messageField = $inquiryForm.find('#inquiry_message');
         if ($messageField.length) {
             $messageField.on('input', function() {
                 const length = $(this).val().length;
                 const $counter = $(this).siblings('.character-counter');
                 if ($counter.length === 0) {
                     $(this).after('<div class="character-counter text-sm text-gray-500 mt-1"></div>');
                 }
                 $(this).siblings('.character-counter').text(length + ' characters');
                 
                 if (length < 10) {
                     $(this).addClass('border-red-300').removeClass('border-green-300');
                 } else {
                     $(this).addClass('border-green-300').removeClass('border-red-300');
                 }
             });
         }
         
         // Form submission
         $inquiryForm.on('submit', function(e) {
             e.preventDefault();
             const $form = $(this);
             
             // Show loading state
             showFormLoading($form, true);
             
             // Validate form
             if (!validateInquiryForm($form)) {
                 showFormLoading($form, false);
                 return;
             }
             
             // Prepare form data
             const formData = new FormData(this);
             
             $.ajax({
                 url: tznew_ajax.ajax_url,
                 type: 'POST',
                 data: formData,
                 processData: false,
                 contentType: false,
                 success: function(response) {
                     if (response.success) {
                         showFormMessage($form, response.data.message, 'success');
                         $form[0].reset();
                         // Remove any error states
                         $form.find('.form-group').removeClass('error success');
                         $form.find('.error-message').addClass('hidden');
                         // Reset character counter
                         $form.find('.character-counter').text('0 characters');
                     } else {
                         showFormMessage($form, response.data.message || 'Inquiry submission failed', 'error');
                     }
                 },
                 error: function() {
                     showFormMessage($form, 'An error occurred. Please try again.', 'error');
                 },
                 complete: function() {
                     showFormLoading($form, false);
                 }
             });
         });
     }
    
    /**
      * Validate booking form
      */
     function validateBookingForm($form) {
         let isValid = true;
         
         // Clear previous messages
         $form.find('.form-messages').empty();
         
         // Required fields validation
         $form.find('[required]').each(function() {
             if (!validateField($(this))) {
                 isValid = false;
             }
         });
         
         // Terms agreement validation
         const $termsCheckbox = $form.find('#terms_agreement');
         if ($termsCheckbox.length && !$termsCheckbox.is(':checked')) {
             showFieldError($termsCheckbox, 'You must agree to the terms and conditions');
             isValid = false;
         }
         
         // Date validation (must be at least 1 week from now)
         const $dateField = $form.find('#preferred_date');
         if ($dateField.length && $dateField.val()) {
             const selectedDate = new Date($dateField.val());
             const minDate = new Date();
             minDate.setDate(minDate.getDate() + 7);
             
             if (selectedDate < minDate) {
                 showFieldError($dateField, 'Please select a date at least one week from today');
                 isValid = false;
             }
         }
         
         return isValid;
     }
    
    /**
      * Validate inquiry form
      */
     function validateInquiryForm($form) {
         let isValid = true;
         
         // Clear previous messages
         $form.find('.form-messages').empty();
         
         // Required fields validation
         $form.find('[required]').each(function() {
             if (!validateField($(this))) {
                 isValid = false;
             }
         });
         
         // Message length validation
         const $messageField = $form.find('#inquiry_message');
         if ($messageField.length && $messageField.val().trim().length < 10) {
             showFieldError($messageField, 'Please provide a more detailed message (minimum 10 characters)');
             isValid = false;
         }
         
         return isValid;
     }
    
    /**
      * Validate individual field
      */
     function validateField($field) {
         const value = $field.val().trim();
         const fieldType = $field.attr('type');
         const fieldName = $field.attr('name');
         const isRequired = $field.prop('required');
         
         // Clear previous error state
         clearFieldError($field);
         
         // Required field validation
         if (isRequired && !value) {
             showFieldError($field, 'This field is required');
             return false;
         }
         
         // Skip validation if field is empty and not required
         if (!value && !isRequired) {
             return true;
         }
         
         // Email validation
         if (fieldType === 'email' && !isValidEmail(value)) {
             showFieldError($field, 'Please enter a valid email address');
             return false;
         }
         
         // Phone validation
         if (fieldType === 'tel' && !isValidPhone(value)) {
             showFieldError($field, 'Please enter a valid phone number');
             return false;
         }
         
         // Date validation
         if (fieldType === 'date' && value) {
             const selectedDate = new Date(value);
             const today = new Date();
             today.setHours(0, 0, 0, 0);
             
             if (selectedDate < today) {
                 showFieldError($field, 'Please select a future date');
                 return false;
             }
         }
         
         // Show success state
         showFieldSuccess($field);
         return true;
     }
     
     /**
      * Show field error
      */
     function showFieldError($field, message) {
         const $formGroup = $field.closest('.form-group');
         const $errorMessage = $formGroup.find('.error-message');
         
         $formGroup.addClass('error').removeClass('success');
         $errorMessage.text(message).removeClass('hidden');
     }
     
     /**
      * Show field success
      */
     function showFieldSuccess($field) {
         const $formGroup = $field.closest('.form-group');
         $formGroup.addClass('success').removeClass('error');
         $formGroup.find('.error-message').addClass('hidden');
     }
     
     /**
      * Clear field error
      */
     function clearFieldError($field) {
         const $formGroup = $field.closest('.form-group');
         $formGroup.removeClass('error success');
         $formGroup.find('.error-message').addClass('hidden');
     }
     
     /**
      * Show form loading state
      */
     function showFormLoading($form, isLoading) {
         const $submitBtn = $form.find('button[type="submit"]');
         const $loadingDiv = $form.find('.form-loading');
         
         if (isLoading) {
             $submitBtn.prop('disabled', true);
             $loadingDiv.removeClass('hidden');
         } else {
             $submitBtn.prop('disabled', false);
             $loadingDiv.addClass('hidden');
         }
     }
     
     /**
      * Show form message
      */
     function showFormMessage($form, message, type) {
         const $messagesDiv = $form.find('.form-messages');
         const alertClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
         const iconClass = type === 'success' ? 'fas fa-circle-check' : 'fas fa-exclamation-circle';
         
         const messageHtml = `
             <div class="alert ${alertClass} border px-4 py-3 rounded-lg flex items-center space-x-2">
                 <i class="${iconClass}"></i>
                 <span>${message}</span>
             </div>
         `;
         
         $messagesDiv.html(messageHtml);
         
         // Auto-hide success messages after 5 seconds
         if (type === 'success') {
             setTimeout(() => {
                 $messagesDiv.fadeOut();
             }, 5000);
         }
     }
     
     /**
      * Email validation helper
      */
     function isValidEmail(email) {
         const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
         return emailRegex.test(email);
     }
     
     /**
      * Phone validation helper
      */
     function isValidPhone(phone) {
         const phoneRegex = /^[\+]?[1-9][\d\s\-\(\)]{7,}$/;
         return phoneRegex.test(phone.replace(/\s/g, ''));
     }

    // Expose functions globally if needed
    window.tznewTheme = {
        showNotification: showNotification,
        debounce: debounce,
        throttle: throttle
    };

})(jQuery);

/**
 * Vanilla JavaScript for critical functionality
 */

// Critical path CSS loading
function loadCSS(href) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);
}

// Lazy loading for images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(function(img) {
        imageObserver.observe(img);
    });
}

// Service Worker registration for PWA features
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('SW registered: ', registration);
            })
            .catch(function(registrationError) {
                console.log('SW registration failed: ', registrationError);
            });
    });
}