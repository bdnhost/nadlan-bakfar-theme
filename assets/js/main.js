/**
 * Nadlan Bakfar Theme JavaScript
 * 
 * @package NadlanBakfar
 */

(function($) {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    $('.mobile-menu-toggle').on('click', function() {
        var $nav = $('.main-navigation');
        var expanded = $(this).attr('aria-expanded') === 'true';
        
        $nav.toggleClass('active');
        $(this).attr('aria-expanded', !expanded);
    });

    /**
     * Gallery Thumbnails Click Handler
     */
    $('.gallery-thumbnail').on('click', function() {
        var largeUrl = $(this).data('large');
        
        if (largeUrl) {
            $('#mainImage').attr('src', largeUrl);
            
            $('.gallery-thumbnail').removeClass('active');
            $(this).addClass('active');
        }
    });

    /**
     * Property Inquiry Form Handler
     */
    $('#property-contact-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $button = $form.find('button[type="submit"]');
        var originalText = $button.text();
        
        // Get form data
        var formData = {
            name: $form.find('input[name="name"]').val(),
            phone: $form.find('input[name="phone"]').val(),
            email: $form.find('input[name="email"]').val(),
            message: $form.find('textarea[name="message"]').val(),
            property_title: $form.find('input[name="property_title"]').val()
        };
        
        // Validate
        if (!formData.name || !formData.phone) {
            alert('אנא מלא את כל השדות החובה');
            return;
        }
        
        // Show loading state
        $button.text('שולח...').prop('disabled', true);
        
        // Create WhatsApp message
        var whatsappMessage = encodeURIComponent(
            'שלום, שמי ' + formData.name + '\n' +
            'טלפון: ' + formData.phone + '\n' +
            (formData.email ? 'אימייל: ' + formData.email + '\n' : '') +
            'נכס: ' + formData.property_title + '\n\n' +
            formData.message
        );
        
        // Open WhatsApp
        var whatsappUrl = 'https://wa.me/' + nadlanData.whatsappNumber + '?text=' + whatsappMessage;
        window.open(whatsappUrl, '_blank');
        
        // Reset form
        setTimeout(function() {
            $form[0].reset();
            $button.text(originalText).prop('disabled', false);
            alert('הפנייה נשלחה בהצלחה! נחזור אליך בהקדם.');
        }, 1000);
    });

    /**
     * Property Sort Handler
     */
    $('#property-sort').on('change', function() {
        var sortValue = $(this).val();
        var url = new URL(window.location.href);
        
        url.searchParams.set('orderby', sortValue);
        window.location.href = url.toString();
    });

    /**
     * Smooth Scroll for Anchor Links
     */
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 600);
        }
    });

    /**
     * Header Scroll State
     */
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });

    /**
     * Scroll Reveal Animation
     */
    function revealOnScroll() {
        $('.scroll-reveal').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            // Reveal when element is 80% visible in viewport
            if (elementTop < viewportBottom - 100 && elementBottom > viewportTop) {
                $(this).addClass('revealed');
            }
        });
    }

    /**
     * Fade In Animation on Scroll
     */
    function fadeInOnScroll() {
        $('.fade-in').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).css('opacity', '1');
            }
        });
    }

    // Initialize animations
    $('.fade-in').css('opacity', '0');
    fadeInOnScroll();
    revealOnScroll();

    $(window).on('scroll', function() {
        fadeInOnScroll();
        revealOnScroll();
    });

    /**
     * Lazy Load Images Enhancement
     */
    if ('loading' in HTMLImageElement.prototype) {
        // Browser supports lazy loading
        $('img[loading="lazy"]').each(function() {
            $(this).attr('loading', 'lazy');
        });
    } else {
        // Fallback for older browsers
        var lazyImages = document.querySelectorAll('img[loading="lazy"]');
        
        if ('IntersectionObserver' in window) {
            var imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        image.src = image.dataset.src || image.src;
                        imageObserver.unobserve(image);
                    }
                });
            });
            
            lazyImages.forEach(function(image) {
                imageObserver.observe(image);
            });
        }
    }

    /**
     * WhatsApp Float Button - Add Pulse Animation
     */
    setInterval(function() {
        $('.whatsapp-float').css('transform', 'scale(1.1)');
        setTimeout(function() {
            $('.whatsapp-float').css('transform', 'scale(1)');
        }, 200);
    }, 3000);

    /**
     * Phone Number Click Tracking
     */
    $('a[href^="tel:"]').on('click', function() {
        // Track phone clicks (can integrate with analytics)
        console.log('Phone number clicked:', $(this).attr('href'));
    });

    /**
     * Print Property Details
     */
    function printProperty() {
        window.print();
    }

    // Add print button functionality if exists
    $('.print-property').on('click', function(e) {
        e.preventDefault();
        printProperty();
    });

    /**
     * Share Button Handler
     */
    $('.share-button').on('click', function(e) {
        if (navigator.share) {
            e.preventDefault();
            
            navigator.share({
                title: document.title,
                text: $('meta[name="description"]').attr('content'),
                url: window.location.href
            }).catch(function(error) {
                console.log('Error sharing:', error);
            });
        }
    });

    /**
     * Cookie Consent (Simple Implementation)
     */
    if (!localStorage.getItem('cookieConsent')) {
        // Show cookie notice
        // This is a placeholder - implement based on requirements
    }

    /**
     * Hero Image Gallery
     */
    function initHeroGallery() {
        const images = [
            'https://source.unsplash.com/1600x900/?luxury,house',
            'https://source.unsplash.com/1600x900/?modern,apartment',
            'https://source.unsplash.com/1600x900/?villa,pool',
            'https://source.unsplash.com/1600x900/?cottage,garden'
        ];
        
        let currentIndex = 0;
        const $heroSection = $('.hero-section');
        
        // Create gallery container
        const $gallery = $('<div>').addClass('hero-gallery');
        
        // Add images to gallery
        images.forEach((src, index) => {
            $('<img>')
                .attr('src', src)
                .addClass(index === 0 ? 'active' : '')
                .appendTo($gallery);
        });
        
        // Insert gallery at the start of hero section
        $heroSection.prepend($gallery);
        
        // Change image every 5 seconds
        setInterval(() => {
            const $imgs = $gallery.find('img');
            $imgs.eq(currentIndex).removeClass('active');
            currentIndex = (currentIndex + 1) % images.length;
            $imgs.eq(currentIndex).addClass('active');
        }, 5000);
    }

    // Advanced search removed - handlers cleaned up

    /**
     * Initialize All Functions on Document Ready
     */
    $(document).ready(function() {
        // Initialize hero gallery if we're on the front page
        if ($('.hero-section').length) {
            initHeroGallery();
        }
    });

    /**
     * Back to Top Button
     */
    var $backToTop = $('<button>')
        .addClass('back-to-top')
        .html('↑')
        .css({
            position: 'fixed',
            bottom: '90px',
            left: '20px',
            width: '50px',
            height: '50px',
            backgroundColor: 'var(--color-secondary)',
            color: 'white',
            border: 'none',
            borderRadius: '50%',
            cursor: 'pointer',
            fontSize: '24px',
            display: 'none',
            zIndex: '998',
            boxShadow: 'var(--shadow-md)',
            transition: 'var(--transition)'
        })
        .appendTo('body');

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
    });

    $backToTop.on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 600);
    });

    /**
     * Form Validation Enhancement
     */
    $('input[type="tel"]').on('input', function() {
        // Basic phone validation for Israeli numbers
        var value = $(this).val().replace(/[^0-9]/g, '');
        
        if (value.length > 10) {
            value = value.substring(0, 10);
        }
        
        $(this).val(value);
    });

    /**
     * Prevent Form Double Submit
     */
    $('form').on('submit', function() {
        $(this).find('button[type="submit"]').prop('disabled', true);
    });

    /**
     * Initialize All Functions on Document Ready
     */
    $(document).ready(function() {
        console.log('Nadlan Bakfar Theme Loaded Successfully');
        
        // Add RTL support confirmation
        if ($('body').css('direction') === 'rtl') {
            console.log('RTL Mode Active');
        }
        
        // Accessibility: Add aria labels to important elements
        $('a[href^="tel:"]').attr('aria-label', 'התקשר אלינו');
        $('a[href^="mailto:"]').attr('aria-label', 'שלח אימייל');
        $('.whatsapp-float').attr('aria-label', 'פתח שיחה בוואטסאפ');
    });

})(jQuery);
