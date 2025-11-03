<?php
/**
 * Single Property Template
 *
 * @package NadlanBakfar
 */

get_header();

while (have_posts()) :
    the_post();
    
    $meta = nadlan_get_property_meta(get_the_ID());
    $gallery = get_post_meta(get_the_ID(), 'property_gallery', true);
    $status_terms = get_the_terms(get_the_ID(), 'property-status');
    $location_terms = get_the_terms(get_the_ID(), 'property-location');
    $type_terms = get_the_terms(get_the_ID(), 'property-type');
    ?>

    <main id="main" class="site-main">
        
        <div class="section">
            <div class="container">
                
                <!-- Breadcrumbs -->
                <nav class="breadcrumbs" aria-label="ניווט דפים">
                    <a href="<?php echo esc_url(home_url('/')); ?>">דף הבית</a>
                    <span> / </span>
                    <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>">נכסים</a>
                    <span> / </span>
                    <span><?php the_title(); ?></span>
                </nav>

                <!-- Property Header -->
                <div class="property-single-header">
                    <h1><?php the_title(); ?></h1>
                    
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="property-location">
                            📍 
                            <?php
                            if ($location_terms && !is_wp_error($location_terms)) {
                                echo esc_html($location_terms[0]->name);
                            }
                            if ($meta['address']) {
                                echo ' - ' . esc_html($meta['address']);
                            }
                            ?>
                        </div>
                        
                        <?php if ($status_terms && !is_wp_error($status_terms)) : ?>
                            <span class="property-status"><?php echo esc_html($status_terms[0]->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex align-items-center gap-3" style="margin-top: 1rem;">
                        <div class="property-price">
                            <?php echo nadlan_get_property_price(); ?>
                        </div>
                        <?php if ($status_terms && !is_wp_error($status_terms)) : ?>
                            <div class="property-status-badge">
                                🏷️ <?php echo esc_html($status_terms[0]->name); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Property Gallery -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="property-gallery">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'property-large')); ?>" 
                             alt="<?php the_title_attribute(); ?>" 
                             class="gallery-main" 
                             id="mainImage">
                        
                        <?php
                        $attachment_ids = array(get_post_thumbnail_id());
                        
                        // Add gallery images if available
                        if ($gallery) {
                            $gallery_ids = explode(',', $gallery);
                            $attachment_ids = array_merge($attachment_ids, $gallery_ids);
                        }
                        
                        if (count($attachment_ids) > 1) :
                        ?>
                            <div class="gallery-thumbnails">
                                <?php foreach ($attachment_ids as $index => $attachment_id) : 
                                    $image_url = wp_get_attachment_image_url($attachment_id, 'property-gallery');
                                    $image_large = wp_get_attachment_image_url($attachment_id, 'property-large');
                                    if ($image_url) :
                                ?>
                                    <img src="<?php echo esc_url($image_url); ?>" 
                                         alt="תמונה <?php echo $index + 1; ?>" 
                                         class="gallery-thumbnail <?php echo $index === 0 ? 'active' : ''; ?>"
                                         data-large="<?php echo esc_url($image_large); ?>">
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Property Details Grid -->
                <div class="property-details-grid">
                    
                    <!-- Main Content -->
                    <div class="property-main-content">
                        
                        <!-- Description -->
                        <div class="property-description">
                            <h2>תיאור הנכס</h2>
                            <?php the_content(); ?>
                        </div>

                        <!-- Property Features -->
                        <div class="property-description mt-3">
                            <h2>מאפייני הנכס</h2>
                            
                            <div class="meta-grid">
                                <?php if ($meta['rooms']) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">חדרים</span>
                                        <span class="meta-value">🛏️ <?php echo esc_html($meta['rooms']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($meta['bathrooms']) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">חדרי רחצה</span>
                                        <span class="meta-value">🚿 <?php echo esc_html($meta['bathrooms']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($meta['built_area']) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">שטח בנוי</span>
                                        <span class="meta-value">📐 <?php echo esc_html($meta['built_area']); ?> מ"ר</span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($meta['land_area']) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">שטח מגרש</span>
                                        <span class="meta-value">🏞️ <?php echo esc_html($meta['land_area']); ?> מ"ר</span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($meta['parking']) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">חניות</span>
                                        <span class="meta-value">🚗 <?php echo esc_html($meta['parking']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($type_terms && !is_wp_error($type_terms)) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">סוג נכס</span>
                                        <span class="meta-value">
                                            🏘️ 
                                            <?php foreach ($type_terms as $index => $term) : ?>
                                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="term-link">
                                                    <?php echo esc_html($term->name); ?>
                                                </a><?php echo ($index < count($type_terms) - 1) ? ', ' : ''; ?>
                                            <?php endforeach; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($location_terms && !is_wp_error($location_terms)) : ?>
                                    <div class="meta-item">
                                        <span class="meta-label">אזור</span>
                                        <span class="meta-value">
                                            📍 
                                            <?php foreach ($location_terms as $index => $term) : ?>
                                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="term-link">
                                                    <?php echo esc_html($term->name); ?>
                                                </a><?php echo ($index < count($location_terms) - 1) ? ', ' : ''; ?>
                                            <?php endforeach; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Map (OpenStreetMap via Leaflet) -->
                        <?php if ($meta['latitude'] && $meta['longitude']) : ?>
                            <div class="property-description mt-3">
                                <h2>מיקום</h2>
                                <div id="property-map" dir="rtl" style="height: 400px; border-radius: 8px; overflow: hidden;"></div>
                                <p style="font-size: 0.875rem; color: #999; margin-top:0.5rem;">קואורדינטות: <?php echo esc_html($meta['latitude']); ?>, <?php echo esc_html($meta['longitude']); ?></p>
                                <script>
                                    (function(){
                                        // Wait until Leaflet is loaded
                                        function initPropertyMap(){
                                            if (typeof L === 'undefined') {
                                                setTimeout(initPropertyMap, 100);
                                                return;
                                            }

                                            var lat = parseFloat(<?php echo json_encode($meta['latitude']); ?>);
                                            var lng = parseFloat(<?php echo json_encode($meta['longitude']); ?>);
                                            if (isNaN(lat) || isNaN(lng)) return;

                                            // Disable default zoomControl so we can position it for RTL
                                            var map = L.map('property-map', { scrollWheelZoom: false, zoomControl: false }).setView([lat, lng], 15);

                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                maxZoom: 19,
                                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                            }).addTo(map);

                                            // Add zoom control on the right for RTL sites
                                            L.control.zoom({ position: 'topright' }).addTo(map);

                                            // Move attribution to bottom-left (mirror for RTL)
                                            if (map.attributionControl) {
                                                map.attributionControl.setPosition('bottomleft');
                                            }

                                            // Marker
                                            var marker = L.marker([lat, lng]).addTo(map);
                                            marker.bindPopup(<?php echo json_encode(get_the_title()); ?>);
                                        }

                                        initPropertyMap();
                                    })();
                                </script>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Sidebar -->
                    <aside class="property-sidebar">
                        
                        <!-- Contact Agent -->
                        <div class="contact-agent">
                            <h3>צור קשר</h3>
                            
                            <?php // Do NOT display agent private contact information publicly.
                            // Agent contact details are kept in the admin dashboard only and will be
                            // included in the email sent to the site admin (נדלן בכפר) when a visitor
                            // submits the inquiry form below.
                            ?>

                            <div class="agent-info-meta">
                                <div style="padding:0.5rem 0; color:#666; font-size:0.95rem;">
                                    פרטי איש הקשר נשמרים במערכת הניהול בלבד. כדי לקבל פרטים מלאים 
                                    אנא שלח/י פנייה בטופס שלמטה — הפנייה תגיע לצוות נדלן בכפר.
                                </div>
                            </div>

                            <a href="https://wa.me/972542623399?text=שלום, אני מעוניין/ת לקבל פרטים על הנכס: <?php echo urlencode(get_the_title()); ?>" 
                               class="btn btn-whatsapp btn-block btn-icon" 
                               target="_blank">
                                💬 שלח הודעה בוואטסאפ
                            </a>

                            <a href="tel:+972542623399" class="btn btn-primary btn-block btn-icon mt-2">
                                📞 התקשר עכשיו
                            </a>
                        </div>

                        <!-- Contact Form (Contact Form 7) -->
                        <div class="contact-form mt-3">
                            <h3>פנייה לגבי הנכס</h3>
                            <style>
                                .wpcf7-form label { display: block; margin-bottom: 0.5rem; }
                                .wpcf7-form input[type="text"],
                                .wpcf7-form input[type="tel"],
                                .wpcf7-form input[type="email"],
                                .wpcf7-form textarea { 
                                    width: 100%; 
                                    padding: 0.5rem; 
                                    margin-bottom: 1rem;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                }
                                .wpcf7-form input[type="submit"] {
                                    width: 100%;
                                    background: var(--color-primary);
                                    color: white;
                                    border: none;
                                    padding: 0.75rem;
                                    border-radius: 4px;
                                    cursor: pointer;
                                }
                                .wpcf7-form input[type="submit"]:hover {
                                    opacity: 0.9;
                                }
                            </style>
                            <?php
                            // Contact Form 7 shortcode ID
                            $contact_form_id = "1e763f1"; // Form ID
                            
                            // Provide only non-sensitive hidden values to CF7. Agent contact info
                            // is NOT exposed on the front-end. The server-side email filter will
                            // read agent metadata by post ID and include it only in the admin email.
                            add_filter('wpcf7_hidden_field_value', function($value, $name) {
                                switch ($name) {
                                    case 'property-id':
                                        return get_the_ID();
                                    case 'property-title':
                                        return get_the_title();
                                }
                                return $value;
                            }, 10, 2);

                            // Ensure the CF7 form inside this sidebar receives a property-id field
                            // if the form author didn't include it. We only inject the post ID
                            // (non-sensitive) client-side so the submission can be tied to the
                            // correct property. Agent contact remains server-side only.
                            ?>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    try {
                                        var container = document.querySelector('.contact-form');
                                        if (!container) return;
                                        var form = container.querySelector('form.wpcf7-form');
                                        if (!form) return;
                                        if (!form.querySelector('input[name="property-id"]')) {
                                            var input = document.createElement('input');
                                            input.type = 'hidden';
                                            input.name = 'property-id';
                                            input.value = <?php echo json_encode(get_the_ID()); ?>;
                                            form.appendChild(input);
                                        }
                                    } catch (e) {
                                        // No-op
                                    }
                                });
                            </script>

                            <?php
                            // Display the form more robustly and show a helpful message if CF7
                            // isn't active or the shortcode isn't processed.
                            $shortcode = '[contact-form-7 id="' . esc_attr($contact_form_id) . '"]';
                            $form_html = do_shortcode($shortcode);

                            // If the shortcode wasn't processed, do_shortcode returns the
                            // original string. Show a notice to the admin to check CF7.
                            if ($form_html === $shortcode) {
                                // Shortcode not processed - likely plugin inactive or wrong ID
                                echo '<div class="notice notice-error" style="margin:0;padding:12px;border-radius:6px;background:#fff6f6;color:#7a1f1f;">';
                                echo '<strong>טופס לא נטען:</strong> ודא שהתוסף Contact Form 7 פעיל ושה‑ID של הטופס נכון (כעת מוגדר: ' . esc_html($contact_form_id) . ').';
                                echo '<br/>כפתור בדיקה: <a href="' . esc_url(admin_url('admin.php?page=wpcf7')) . '">פתח את הגדרות Contact Form 7</a>';
                                echo '</div>';
                            } else {
                                echo $form_html;
                            }
                            ?>
                        </div>

                        <!-- Share -->
                        <div class="contact-agent mt-3">
                            <h3>שתף נכס</h3>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   class="btn btn-secondary"
                                   style="flex: 1;">
                                    📘 Facebook
                                </a>
                                <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                                   target="_blank" 
                                   class="btn btn-whatsapp"
                                   style="flex: 1;">
                                    💬 WhatsApp
                                </a>
                            </div>
                        </div>

                    </aside>

                </div>

            </div>
        </div>

        <!-- Related Properties -->
        <?php
        $related_args = array(
            'post_type' => 'property',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand',
        );

        if ($location_terms && !is_wp_error($location_terms)) {
            $related_args['tax_query'] = array(
                array(
                    'taxonomy' => 'property-location',
                    'field' => 'term_id',
                    'terms' => $location_terms[0]->term_id,
                ),
            );
        }

        $related_query = new WP_Query($related_args);

        if ($related_query->have_posts()) :
        ?>
            <section class="section section-alt">
                <div class="container">
                    <h2 class="text-center mb-3">נכסים דומים</h2>
                    
                    <div class="properties-grid">
                        <?php
                        while ($related_query->have_posts()) :
                            $related_query->the_post();
                            get_template_part('template-parts/content', 'property-card');
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </main>

    <?php
endwhile;

get_footer();
?>
