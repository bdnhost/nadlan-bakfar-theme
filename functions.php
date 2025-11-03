<?php
/**
 * Nadlan Bakfar Theme Functions
 * 
 * @package NadlanBakfar
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme Constants
define('NADLAN_THEME_VERSION', '1.0.0');
define('NADLAN_THEME_DIR', get_template_directory());
define('NADLAN_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function nadlan_bakfar_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 600, true);
    add_image_size('property-thumbnail', 400, 300, true);
    add_image_size('property-large', 1200, 800, true);
    add_image_size('property-gallery', 150, 150, true);

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('תפריט ראשי', 'nadlan-bakfar'),
        'footer' => __('תפריט תחתון', 'nadlan-bakfar'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Add theme support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'nadlan_bakfar_setup');

/**
 * Register Custom Post Type - Property
 */
function nadlan_register_property_post_type() {
    $labels = array(
        'name' => 'נכסים',
        'singular_name' => 'נכס',
        'menu_name' => 'נכסים',
        'add_new' => 'הוסף נכס',
        'add_new_item' => 'הוסף נכס חדש',
        'edit_item' => 'ערוך נכס',
        'new_item' => 'נכס חדש',
        'view_item' => 'צפה בנכס',
        'search_items' => 'חפש נכסים',
        'not_found' => 'לא נמצאו נכסים',
        'not_found_in_trash' => 'לא נמצאו נכסים בפח',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-home',
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'property'),
        'show_in_rest' => true,
    );

    register_post_type('property', $args);
}
add_action('init', 'nadlan_register_property_post_type');

/**
 * Register Property Taxonomies
 */
function nadlan_register_property_taxonomies() {
    // Property Type Taxonomy
    register_taxonomy('property-type', 'property', array(
        'label' => 'סוג נכס',
        'labels' => array(
            'name' => 'סוגי נכסים',
            'singular_name' => 'סוג נכס',
            'add_new_item' => 'הוסף סוג נכס',
        ),
        'rewrite' => array('slug' => 'property-type'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    // Property Location Taxonomy
    register_taxonomy('property-location', 'property', array(
        'label' => 'אזור',
        'labels' => array(
            'name' => 'אזורים',
            'singular_name' => 'אזור',
            'add_new_item' => 'הוסף אזור',
        ),
        'rewrite' => array('slug' => 'location'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    // Property Status Taxonomy
    register_taxonomy('property-status', 'property', array(
        'label' => 'סטטוס',
        'labels' => array(
            'name' => 'סטטוסים',
            'singular_name' => 'סטטוס',
            'add_new_item' => 'הוסף סטטוס',
        ),
        'rewrite' => array('slug' => 'status'),
        'hierarchical' => false,
        'show_in_rest' => true,
    ));
}
add_action('init', 'nadlan_register_property_taxonomies');

/**
 * Register Property Meta Fields
 */
function nadlan_register_property_meta() {
    // Price
    register_post_meta('property', 'property_price', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Rooms
    register_post_meta('property', 'property_rooms', array(
        'type' => 'number',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Bathrooms
    register_post_meta('property', 'property_bathrooms', array(
        'type' => 'number',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Built Area (sqm)
    register_post_meta('property', 'property_built_area', array(
        'type' => 'number',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Land Area (sqm)
    register_post_meta('property', 'property_land_area', array(
        'type' => 'number',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Address
    register_post_meta('property', 'property_address', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Parking
    register_post_meta('property', 'property_parking', array(
        'type' => 'number',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Agent Name
    register_post_meta('property', 'property_agent_name', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Agent Phone
    register_post_meta('property', 'property_agent_phone', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Latitude
    register_post_meta('property', 'property_latitude', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Longitude
    register_post_meta('property', 'property_longitude', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));

    // Gallery Images
    register_post_meta('property', 'property_gallery', array(
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'nadlan_register_property_meta');

/**
 * Enqueue Scripts and Styles
 */
function nadlan_enqueue_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;600;700&family=Heebo:wght@300;400;700;900&display=swap', array(), null);

    // Main Stylesheet
    wp_enqueue_style('nadlan-style', get_stylesheet_uri(), array(), NADLAN_THEME_VERSION);

    // Main JavaScript
    wp_enqueue_script('nadlan-script', NADLAN_THEME_URI . '/assets/js/main.js', array('jquery'), NADLAN_THEME_VERSION, true);

    // Localize script
    wp_localize_script('nadlan-script', 'nadlanData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('nadlan_nonce'),
        'whatsappNumber' => '972544995151', // אתי - WhatsApp number
    ));

    // Google Maps API (uncomment and add your API key)
    // wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&language=he', array(), null, true);
}
add_action('wp_enqueue_scripts', 'nadlan_enqueue_scripts');

/**
 * Enqueue OpenStreetMap (Leaflet) on single property pages
 */
function nadlan_enqueue_property_map_scripts() {
    if (!is_singular('property')) {
        return;
    }

    // Leaflet CSS & JS from CDN
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
}
add_action('wp_enqueue_scripts', 'nadlan_enqueue_property_map_scripts');

/**
 * Customize Contact Form 7 email for property inquiries
 */
/**
 * Filter Contact Form 7 Mail Components
 * This filter customizes the email content for property inquiries
 */
function nadlan_customize_property_contact_email($components, $cf7, $submission) {
    // Check if this is our property inquiry form
    if (!$submission || $cf7->id() !== "1e763f1") {
        return $components;
    }
    
    // Get submitted data
    $data = $submission->get_posted_data();
    
    // Get property details
    if (!empty($data['_post_id'])) {
        $property_id = intval($data['_post_id']);
        $meta = nadlan_get_property_meta($property_id);
        
        // Build email body with property details
        $property_id = isset($data['property-id']) ? intval($data['property-id']) : 0;
        if (!$property_id || !get_post($property_id)) {
            return $components;
        }

        $meta = nadlan_get_property_meta($property_id);
        
        $body = "פרטי הפונה:\n";
        $body .= "שם: " . $data['your-name'] . "\n";
        $body .= "טלפון: " . $data['your-phone'] . "\n";
        if (!empty($data['your-email'])) {
            $body .= "אימייל: " . $data['your-email'] . "\n";
        }
        $body .= "\nהודעה:\n" . $data['your-message'] . "\n";
        
        // Add property details
        $body .= "\n--- פרטי הנכס ---\n";
        $body .= "כותרת: " . get_the_title($property_id) . "\n";
        $body .= "מחיר: " . nadlan_get_property_price($property_id) . "\n";
        if ($meta['rooms']) $body .= "חדרים: " . $meta['rooms'] . "\n";
        if ($meta['bathrooms']) $body .= "חדרי רחצה: " . $meta['bathrooms'] . "\n";
        if ($meta['built_area']) $body .= "שטח בנוי: " . $meta['built_area'] . " מ\"ר\n";
        if ($meta['address']) $body .= "כתובת: " . $meta['address'] . "\n";
        
        // Add agent info
        if (!empty($meta['agent_name']) || !empty($meta['agent_phone'])) {
            $body .= "\n--- פרטי איש קשר ---\n";
            if (!empty($meta['agent_name'])) $body .= "שם: " . $meta['agent_name'] . "\n";
            if (!empty($meta['agent_phone'])) $body .= "טלפון: " . $meta['agent_phone'] . "\n";
        }
        
        $body .= "\nקישור לנכס: " . get_permalink($property_id);
        
        // Update components: send to site admin (נדלן בכפר) and add Reply-To
        $components['body'] = $body;
        $components['subject'] = 'פנייה חדשה - נדלן בכפר: ' . get_the_title($property_id);

        // Send to site admin email by default (this is the recipient for נדלן בכפר)
        $admin_email = get_option('admin_email');
        if ($admin_email) {
            $components['recipient'] = $admin_email;
        }

        // If visitor provided an email, set Reply-To so admin can reply directly
        if (!empty($data['your-email'])) {
            // preserve existing headers if present
            $headers = isset($components['additional_headers']) ? $components['additional_headers'] : '';
            $headers = $headers . '\r\n' . 'Reply-To: ' . sanitize_email($data['your-email']);
            $components['additional_headers'] = $headers;
        }
    }
    
    return $components;
}
add_filter('wpcf7_mail_components', 'nadlan_customize_property_contact_email', 10, 3);

/**
 * Register Widget Areas
 */
function nadlan_widgets_init() {
    register_sidebar(array(
        'name' => __('סרגל צדדי', 'nadlan-bakfar'),
        'id' => 'sidebar-1',
        'description' => __('הוסף ווידג׳טים כאן.', 'nadlan-bakfar'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('פוטר 1', 'nadlan-bakfar'),
        'id' => 'footer-1',
        'description' => __('אזור ווידג׳טים בפוטר', 'nadlan-bakfar'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('פוטר 2', 'nadlan-bakfar'),
        'id' => 'footer-2',
        'description' => __('אזור ווידג׳טים בפוטר', 'nadlan-bakfar'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('פוטר 3', 'nadlan-bakfar'),
        'id' => 'footer-3',
        'description' => __('אזור ווידג׳טים בפוטר', 'nadlan-bakfar'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'nadlan_widgets_init');

/**
 * Custom Excerpt Length
 */
function nadlan_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'nadlan_excerpt_length');

/**
 * Custom Excerpt More
 */
function nadlan_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'nadlan_excerpt_more');

/**
 * Get Property Price Formatted
 */
function nadlan_get_property_price($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $price = get_post_meta($post_id, 'property_price', true);
    
    if ($price) {
        return '₪' . number_format(floatval($price), 0, '.', ',');
    }
    
    return __('מחיר בהתאם', 'nadlan-bakfar');
}

/**
 * Get Property Meta Info
 */
function nadlan_get_property_meta($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return array(
        'price' => get_post_meta($post_id, 'property_price', true),
        'rooms' => get_post_meta($post_id, 'property_rooms', true),
        'bathrooms' => get_post_meta($post_id, 'property_bathrooms', true),
        'built_area' => get_post_meta($post_id, 'property_built_area', true),
        'land_area' => get_post_meta($post_id, 'property_land_area', true),
        'address' => get_post_meta($post_id, 'property_address', true),
        'parking' => get_post_meta($post_id, 'property_parking', true),
        'agent_name' => get_post_meta($post_id, 'property_agent_name', true),
        'agent_phone' => get_post_meta($post_id, 'property_agent_phone', true),
        'latitude' => get_post_meta($post_id, 'property_latitude', true),
        'longitude' => get_post_meta($post_id, 'property_longitude', true),
    );
}

/**
 * Add Meta Boxes for Property
 */
function nadlan_add_property_meta_boxes() {
    add_meta_box(
        'property_details',
        __('פרטי הנכס', 'nadlan-bakfar'),
        'nadlan_property_details_callback',
        'property',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'nadlan_add_property_meta_boxes');

/**
 * Property Details Meta Box Callback
 */
function nadlan_property_details_callback($post) {
    wp_nonce_field('nadlan_save_property_details', 'nadlan_property_nonce');
    
    $meta = nadlan_get_property_meta($post->ID);
    ?>
    <div class="nadlan-meta-box">
        <style>
            .nadlan-meta-box { padding: 10px; }
            .nadlan-meta-row { margin-bottom: 15px; display: flex; gap: 15px; }
            .nadlan-meta-field { flex: 1; }
            .nadlan-meta-field label { display: block; margin-bottom: 5px; font-weight: 600; }
            .nadlan-meta-field input, .nadlan-meta-field textarea { width: 100%; padding: 8px; }
        </style>
        
        <div class="nadlan-meta-row">
            <div class="nadlan-meta-field">
                <label for="property_price">מחיר (₪)</label>
                <input type="text" id="property_price" name="property_price" value="<?php echo esc_attr($meta['price']); ?>" />
            </div>
            <div class="nadlan-meta-field">
                <label for="property_rooms">מספר חדרים</label>
                <input type="number" id="property_rooms" name="property_rooms" value="<?php echo esc_attr($meta['rooms']); ?>" min="0" step="0.5" />
            </div>
            <div class="nadlan-meta-field">
                <label for="property_bathrooms">חדרי רחצה</label>
                <input type="number" id="property_bathrooms" name="property_bathrooms" value="<?php echo esc_attr($meta['bathrooms']); ?>" min="0" step="0.5" />
            </div>
        </div>

        <div class="nadlan-meta-row">
            <div class="nadlan-meta-field">
                <label for="property_built_area">שטח בנוי (מ״ר)</label>
                <input type="number" id="property_built_area" name="property_built_area" value="<?php echo esc_attr($meta['built_area']); ?>" min="0" />
            </div>
            <div class="nadlan-meta-field">
                <label for="property_land_area">שטח מגרש (מ״ר)</label>
                <input type="number" id="property_land_area" name="property_land_area" value="<?php echo esc_attr($meta['land_area']); ?>" min="0" />
            </div>
            <div class="nadlan-meta-field">
                <label for="property_parking">חניות</label>
                <input type="number" id="property_parking" name="property_parking" value="<?php echo esc_attr($meta['parking']); ?>" min="0" />
            </div>
        </div>

        <div class="nadlan-meta-row">
            <div class="nadlan-meta-field">
                <label for="property_address">כתובת מלאה</label>
                <input type="text" id="property_address" name="property_address" value="<?php echo esc_attr($meta['address']); ?>" />
            </div>
        </div>

        <div class="nadlan-meta-row">
            <div class="nadlan-meta-field">
                <label for="property_latitude">קו רוחב (Latitude)</label>
                <input type="text" id="property_latitude" name="property_latitude" value="<?php echo esc_attr($meta['latitude']); ?>" />
            </div>
            <div class="nadlan-meta-field">
                <label for="property_longitude">קו אורך (Longitude)</label>
                <input type="text" id="property_longitude" name="property_longitude" value="<?php echo esc_attr($meta['longitude']); ?>" />
            </div>
        </div>

        <div class="nadlan-meta-row">
            <div class="nadlan-meta-field">
                <label for="property_agent_name">שם הסוכן</label>
                <input type="text" id="property_agent_name" name="property_agent_name" value="<?php echo esc_attr($meta['agent_name']); ?>" />
            </div>
            <div class="nadlan-meta-field">
                <label for="property_agent_phone">טלפון סוכן</label>
                <input type="text" id="property_agent_phone" name="property_agent_phone" value="<?php echo esc_attr($meta['agent_phone']); ?>" />
            </div>
        </div>
    </div>
    <?php
}

/**
 * Save Property Details
 */
function nadlan_save_property_details($post_id) {
    // Check nonce
    if (!isset($_POST['nadlan_property_nonce']) || !wp_verify_nonce($_POST['nadlan_property_nonce'], 'nadlan_save_property_details')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save meta fields
    $fields = array(
        'property_price',
        'property_rooms',
        'property_bathrooms',
        'property_built_area',
        'property_land_area',
        'property_address',
        'property_parking',
        'property_agent_name',
        'property_agent_phone',
        'property_latitude',
        'property_longitude',
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_property', 'nadlan_save_property_details');

/**
 * AJAX Property Search Handler
 */
function nadlan_ajax_property_search() {
    check_ajax_referer('nadlan_nonce', 'nonce');

    $args = array(
        'post_type' => 'property',
        'posts_per_page' => 12,
        'post_status' => 'publish',
    );

    // Add search query
    if (!empty($_POST['search'])) {
        $args['s'] = sanitize_text_field($_POST['search']);
    }

    // Add location filter
    if (!empty($_POST['location']) && $_POST['location'] !== 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'property-location',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['location']),
        );
    }

    // Add property type filter
    if (!empty($_POST['type']) && $_POST['type'] !== 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'property-type',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['type']),
        );
    }

    // Add status filter
    if (!empty($_POST['status']) && $_POST['status'] !== 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'property-status',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['status']),
        );
    }

    $query = new WP_Query($args);
    
    ob_start();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'property-card');
        }
    } else {
        echo '<p class="no-results">לא נמצאו נכסים התואמים לחיפוש שלך.</p>';
    }
    
    wp_reset_postdata();
    
    $html = ob_get_clean();
    
    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_property_search', 'nadlan_ajax_property_search');
add_action('wp_ajax_nopriv_property_search', 'nadlan_ajax_property_search');

/**
 * Add Schema.org JSON-LD for Property
 */
function nadlan_add_property_schema() {
    if (is_singular('property')) {
        global $post;
        $meta = nadlan_get_property_meta($post->ID);
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'RealEstateListing',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'url' => get_permalink(),
            'image' => get_the_post_thumbnail_url($post->ID, 'large'),
        );

        if ($meta['price']) {
            $schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $meta['price'],
                'priceCurrency' => 'ILS',
            );
        }

        if ($meta['address']) {
            $schema['address'] = array(
                '@type' => 'PostalAddress',
                'streetAddress' => $meta['address'],
                'addressCountry' => 'IL',
            );
        }

        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
    }
}
add_action('wp_head', 'nadlan_add_property_schema');

/**
 * Flush rewrite rules on theme activation
 */
function nadlan_theme_activation() {
    nadlan_register_property_post_type();
    nadlan_register_property_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'nadlan_theme_activation');

/**
 * SEO Functions
 */

/**
 * Customize meta title
 */
function nadlan_meta_title($title) {
    if (is_singular('property')) {
        global $post;
        $meta = nadlan_get_property_meta($post->ID);
        $location = wp_get_post_terms($post->ID, 'property-location', array('fields' => 'names'));
        $type = wp_get_post_terms($post->ID, 'property-type', array('fields' => 'names'));
        
        // Build SEO title: [Type] למכירה ב[Location] - [Rooms] חדרים, [Area] מ"ר | נדל"ן בכפר
        $title_parts = array();
        
        if (!empty($type)) {
            $title_parts[] = $type[0];
        }
        
        if (!empty($location)) {
            $title_parts[] = 'ב' . $location[0];
        }
        
        if (!empty($meta['rooms'])) {
            $title_parts[] = $meta['rooms'] . ' חדרים';
        }
        
        if (!empty($meta['built_area'])) {
            $title_parts[] = $meta['built_area'] . ' מ"ר';
        }
        
        if (!empty($title_parts)) {
            return implode(' | ', $title_parts) . ' | נדל"ן בכפר';
        }
    }
    
    return $title;
}
add_filter('pre_get_document_title', 'nadlan_meta_title');

/**
 * Add meta description
 */
function nadlan_meta_description() {
    if (is_singular('property')) {
        global $post;
        $meta = nadlan_get_property_meta($post->ID);
        $location = wp_get_post_terms($post->ID, 'property-location', array('fields' => 'names'));
        $type = wp_get_post_terms($post->ID, 'property-type', array('fields' => 'names'));
        
        $desc_parts = array();
        
        if (!empty($type)) {
            $desc_parts[] = $type[0];
        }
        
        if (!empty($location)) {
            $desc_parts[] = 'ב' . $location[0];
        }
        
        if (!empty($meta['rooms'])) {
            $desc_parts[] = $meta['rooms'] . ' חדרים';
        }
        
        if (!empty($meta['built_area'])) {
            $desc_parts[] = $meta['built_area'] . ' מ"ר';
        }
        
        if (!empty($meta['price'])) {
            $desc_parts[] = 'מחיר: ' . nadlan_get_property_price();
        }
        
        $description = implode(', ', $desc_parts);
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '" />';
        }
    }
}
add_action('wp_head', 'nadlan_meta_description');

/**
 * Add Open Graph meta tags
 */
function nadlan_og_meta_tags() {
    if (is_singular('property')) {
        global $post;
        
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '" />';
        echo '<meta property="og:type" content="website" />';
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />';
        
        if (has_post_thumbnail()) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            if ($img_src) {
                echo '<meta property="og:image" content="' . esc_url($img_src[0]) . '" />';
                echo '<meta property="og:image:width" content="' . esc_attr($img_src[1]) . '" />';
                echo '<meta property="og:image:height" content="' . esc_attr($img_src[2]) . '" />';
            }
        }
        
        $meta = nadlan_get_property_meta($post->ID);
        $location = wp_get_post_terms($post->ID, 'property-location', array('fields' => 'names'));
        $desc_parts = array();
        
        if (!empty($location)) {
            $desc_parts[] = 'ב' . $location[0];
        }
        if (!empty($meta['rooms'])) {
            $desc_parts[] = $meta['rooms'] . ' חדרים';
        }
        if (!empty($meta['built_area'])) {
            $desc_parts[] = $meta['built_area'] . ' מ"ר';
        }
        
        $description = implode(', ', $desc_parts);
        if ($description) {
            echo '<meta property="og:description" content="' . esc_attr($description) . '" />';
        }
        
        echo '<meta property="og:site_name" content="נדל״ן בכפר" />';
    }
}
add_action('wp_head', 'nadlan_og_meta_tags');

/**
 * Add Twitter Card meta tags
 */
function nadlan_twitter_card_meta_tags() {
    if (is_singular('property')) {
        echo '<meta name="twitter:card" content="summary_large_image" />';
        echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '" />';
        
        if (has_post_thumbnail()) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            if ($img_src) {
                echo '<meta name="twitter:image" content="' . esc_url($img_src[0]) . '" />';
            }
        }
        
        $meta = nadlan_get_property_meta();
        $location = wp_get_post_terms(get_the_ID(), 'property-location', array('fields' => 'names'));
        $desc_parts = array();
        
        if (!empty($location)) {
            $desc_parts[] = 'ב' . $location[0];
        }
        if (!empty($meta['rooms'])) {
            $desc_parts[] = $meta['rooms'] . ' חדרים';
        }
        if (!empty($meta['built_area'])) {
            $desc_parts[] = $meta['built_area'] . ' מ"ר';
        }
        
        $description = implode(', ', $desc_parts);
        if ($description) {
            echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />';
        }
    }
}
add_action('wp_head', 'nadlan_twitter_card_meta_tags');

/**
 * Add image alt text automatically
 */
function nadlan_auto_image_alt($args) {
    if (empty($args['alt'])) {
        $post = get_post($args['id']);
        if ($post) {
            $title = get_the_title($post->post_parent);
            if ($title) {
                $args['alt'] = $title;
            }
        }
    }
    return $args;
}
add_filter('wp_get_attachment_image_attributes', 'nadlan_auto_image_alt');

/**
 * Add robots.txt rules
 */
function nadlan_robots_txt($output) {
    $output .= "\n# נדל״ן בכפר Custom Rules";
    $output .= "\nDisallow: /wp-admin/";
    $output .= "\nDisallow: /wp-includes/";
    $output .= "\nDisallow: /wp-content/plugins/";
    $output .= "\nDisallow: /wp-content/themes/";
    $output .= "\nDisallow: /feed/";
    $output .= "\nDisallow: /trackback/";
    $output .= "\nDisallow: /*?*";
    $output .= "\nDisallow: /*?";
    $output .= "\nAllow: /wp-content/uploads/";
    $output .= "\nAllow: /wp-content/themes/nadlan-bakfar/assets/";
    
    return $output;
}
add_filter('robots_txt', 'nadlan_robots_txt');

/**
 * Add sitemap entries
 */
function nadlan_sitemap_posts($args, $post_type) {
    if ($post_type === 'property') {
        $args['orderby'] = 'modified';
        $args['priority'] = 0.8;
    }
    return $args;
}
add_filter('wp_sitemaps_posts_query_args', 'nadlan_sitemap_posts', 10, 2);

/**
 * Property Importer (CSV)
 * Adds an admin submenu under the Property post type to import properties from CSV.
 */
function nadlan_property_import_menu() {
    add_submenu_page(
        'edit.php?post_type=property',
        'ייבוא נכסים',
        'ייבוא נכסים',
        'manage_options',
        'nadlan-property-import',
        'nadlan_property_import_page'
    );
}
add_action('admin_menu', 'nadlan_property_import_menu');


function nadlan_property_import_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Handle submitted file
    $result = null;
    if (!empty($_POST['nadlan_import_nonce']) && wp_verify_nonce($_POST['nadlan_import_nonce'], 'nadlan_import_action')) {
        if (!empty($_FILES['nadlan_import_file']) && is_uploaded_file($_FILES['nadlan_import_file']['tmp_name'])) {
            $result = nadlan_handle_property_import($_FILES['nadlan_import_file']['tmp_name']);
        } else {
            $result = array('error' => 'לא הועלה קובץ תקין.');
        }
    }

    ?>
    <div class="wrap">
        <h1>ייבוא נכסים (CSV)</h1>

        <p>העלה קובץ CSV עם כותרת שורה הכולל שדות כגון: title,content,price,rooms,bathrooms,built_area,land_area,address,parking,agent_name,agent_phone,latitude,longitude,status,type,location,featured_image,gallery_images</p>

        <p>
            <a class="button button-primary" href="<?php echo esc_url(NADLAN_THEME_URI . '/sample-import.csv'); ?>" download>הורד תבנית דוגמה (CSV)</a>
            <span style="margin-left:10px; color:#666;">(קובץ דוגמה שנמצא בתיקיית התבנית)</span>
        </p>

        <?php if ($result) : ?>
            <h2>תוצאה</h2>
            <?php if (!empty($result['error'])) : ?>
                <div class="notice notice-error"><p><?php echo esc_html($result['error']); ?></p></div>
            <?php else : ?>
                <div class="notice notice-success"><p>הושלם: יובאו <?php echo intval($result['imported']); ?> רשומות. נכשלו: <?php echo intval($result['failed']); ?>.</p></div>
                <?php if (!empty($result['messages'])) : ?>
                    <ul>
                        <?php foreach ($result['messages'] as $m) : ?>
                            <li><?php echo esc_html($m); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('nadlan_import_action', 'nadlan_import_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="nadlan_import_file">קובץ CSV</label></th>
                    <td><input type="file" name="nadlan_import_file" id="nadlan_import_file" accept=".csv" required /></td>
                </tr>
                <tr>
                    <th scope="row">אפשרויות</th>
                    <td>
                        <label><input type="checkbox" name="nadlan_import_publish" value="1" checked /> לפרסם נכסים אחרי הייבוא (אם לא מסומן ישמרו כטיוטה)</label>
                    </td>
                </tr>
            </table>
            <?php submit_button('ייבא נכסים'); ?>
        </form>
    </div>
    <?php
}


/**
 * Handle CSV import logic
 */
function nadlan_handle_property_import($tmp_path) {
    $handle = fopen($tmp_path, 'r');
    if ($handle === false) {
        return array('error' => 'לא ניתן לקרוא את הקובץ.');
    }

    $imported = 0;
    $failed = 0;
    $messages = array();

    // Read header
    $header = fgetcsv($handle);
    if (!$header) {
        fclose($handle);
        return array('error' => 'הקובץ ריק או ללא כותרת.');
    }

    // Normalize header names
    $map = array();
    foreach ($header as $i => $h) {
        $key = trim(strtolower($h));
        $map[$i] = $key;
    }

    // Helper: sideload image and return attachment ID.
    // Supports URLs that point directly to image files and page URLs (HTML)
    // by attempting to extract og:image / twitter:image meta tags.
    function nadlan_sideload_image_from_url($url, $post_id = 0) {
        if (empty($url)) {
            return false;
        }

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Normalize URL
        $url = trim($url);

        // Attempt to GET the URL and inspect headers/body
        $response = wp_remote_get($url, array('timeout' => 20, 'redirection' => 5));
        if (is_wp_error($response)) {
            return new WP_Error('download_failed', 'לא ניתן להוריד כתובת: ' . $url . ' (' . $response->get_error_message() . ')');
        }

        $code = wp_remote_retrieve_response_code($response);
        if ($code !== 200) {
            return new WP_Error('download_failed', 'שרת החזיר קוד ' . $code . ' עבור: ' . $url);
        }

        $content_type = wp_remote_retrieve_header($response, 'content-type');
        $body = wp_remote_retrieve_body($response);

        // If the URL is an image, save it directly
        if ($content_type && strpos($content_type, 'image/') === 0) {
            $tmp = wp_tempnam($url);
            if (!$tmp) {
                return new WP_Error('tempfile_failed', 'לא ניתן ליצור קובץ זמני להורדת התמונה.');
            }
            file_put_contents($tmp, $body);

            $file_array = array(
                'name' => basename(parse_url($url, PHP_URL_PATH)) ?: 'image.jpg',
                'tmp_name' => $tmp,
            );

            $id = media_handle_sideload($file_array, $post_id);
            if (is_wp_error($id)) {
                @unlink($tmp);
                return $id;
            }

            return $id;
        }

        // If the response is HTML, try to extract og:image or twitter:image
        if ($content_type && strpos($content_type, 'text/html') !== false) {
            $image_url = null;

            // Try og:image
            if (preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\']([^"\']+)["\']/i', $body, $m)) {
                $image_url = html_entity_decode($m[1]);
            }

            // Try twitter:image
            if (!$image_url && preg_match('/<meta[^>]+name=["\']twitter:image["\'][^>]+content=["\']([^"\']+)["\']/i', $body, $m2)) {
                $image_url = html_entity_decode($m2[1]);
            }

            // Try link rel=image_src
            if (!$image_url && preg_match('/<link[^>]+rel=["\']image_src["\'][^>]+href=["\']([^"\']+)["\']/i', $body, $m3)) {
                $image_url = html_entity_decode($m3[1]);
            }

            if ($image_url) {
                // Make absolute if necessary
                if (strpos($image_url, '//') === 0) {
                    $image_url = (is_ssl() ? 'https:' : 'http:') . $image_url;
                } elseif (parse_url($image_url, PHP_URL_SCHEME) === null) {
                    $base = wp_parse_url($url);
                    $scheme = isset($base['scheme']) ? $base['scheme'] : 'https';
                    $host = isset($base['host']) ? $base['host'] : '';
                    if ($image_url[0] !== '/') {
                        $image_url = '/' . ltrim($image_url, '/');
                    }
                    $image_url = $scheme . '://' . $host . $image_url;
                }

                // Attempt to download the extracted image URL
                $resp2 = wp_remote_get($image_url, array('timeout' => 20, 'redirection' => 5));
                if (!is_wp_error($resp2) && wp_remote_retrieve_response_code($resp2) === 200 && strpos(wp_remote_retrieve_header($resp2, 'content-type'), 'image/') === 0) {
                    $tmp2 = wp_tempnam($image_url);
                    if (!$tmp2) {
                        return new WP_Error('tempfile_failed', 'לא ניתן ליצור קובץ זמני להורדת התמונה.');
                    }
                    file_put_contents($tmp2, wp_remote_retrieve_body($resp2));

                    $file_array = array(
                        'name' => basename(parse_url($image_url, PHP_URL_PATH)) ?: 'image.jpg',
                        'tmp_name' => $tmp2,
                    );

                    $id2 = media_handle_sideload($file_array, $post_id);
                    if (is_wp_error($id2)) {
                        @unlink($tmp2);
                        return $id2;
                    }

                    return $id2;
                }

                return new WP_Error('image_not_found', 'לא נמצאה תמונה ישירה בעמוד: ' . $url);
            }

            return new WP_Error('no_image_meta', 'העמוד לא מכיל תגיות og:image/twitter:image: ' . $url);
        }

        return new WP_Error('unsupported_content_type', 'סוג תוכן לא נתמך: ' . $content_type . ' עבור ' . $url);
    }

    // Process rows
    while (($row = fgetcsv($handle)) !== false) {
        $data = array();
        foreach ($row as $i => $value) {
            $key = isset($map[$i]) ? $map[$i] : null;
            if ($key) {
                $data[$key] = trim($value);
            }
        }

        // Minimal required: title
        $title = !empty($data['title']) ? $data['title'] : '';
        if (empty($title)) {
            $failed++;
            $messages[] = 'שורה ללא כותרת התעלמה';
            continue;
        }

        $post_status = (!empty($_POST['nadlan_import_publish']) && $_POST['nadlan_import_publish'] == '1') ? 'publish' : 'draft';

        $postarr = array(
            'post_title' => $title,
            'post_content' => !empty($data['content']) ? $data['content'] : '',
            'post_type' => 'property',
            'post_status' => $post_status,
        );

        $post_id = wp_insert_post($postarr);
        if (is_wp_error($post_id) || !$post_id) {
            $failed++;
            $messages[] = 'שגיאה ביצירת פוסט עבור: ' . $title;
            continue;
        }

        // Taxonomies: status, type, location (accept comma/semicolon separated names)
        $tax_fields = array(
            'status' => 'property-status',
            'type' => 'property-type',
            'location' => 'property-location',
        );

        foreach ($tax_fields as $col => $tax) {
            if (!empty($data[$col])) {
                $terms = preg_split('/[,;|]/', $data[$col]);
                $clean = array();
                foreach ($terms as $t) {
                    $t = trim($t);
                    if ($t === '') continue;
                    // Ensure term exists or create
                    if (!term_exists($t, $tax)) {
                        wp_insert_term($t, $tax);
                    }
                    $clean[] = $t;
                }
                if (!empty($clean)) {
                    wp_set_object_terms($post_id, $clean, $tax, false);
                }
            }
        }

        // Meta mapping
        $meta_map = array(
            'price' => 'property_price',
            'rooms' => 'property_rooms',
            'bathrooms' => 'property_bathrooms',
            'built_area' => 'property_built_area',
            'land_area' => 'property_land_area',
            'address' => 'property_address',
            'parking' => 'property_parking',
            'agent_name' => 'property_agent_name',
            'agent_phone' => 'property_agent_phone',
            'latitude' => 'property_latitude',
            'longitude' => 'property_longitude',
        );

        foreach ($meta_map as $col => $meta_key) {
            if (isset($data[$col]) && $data[$col] !== '') {
                update_post_meta($post_id, $meta_key, sanitize_text_field($data[$col]));
            }
        }

        // Featured image
        if (!empty($data['featured_image'])) {
            $img_url = $data['featured_image'];
            $att_id = nadlan_sideload_image_from_url($img_url, $post_id);
            if (is_wp_error($att_id)) {
                $messages[] = 'שגיאה בייבוא תמונת השער עבור ' . $title . ': ' . $att_id->get_error_message();
            } elseif ($att_id) {
                set_post_thumbnail($post_id, $att_id);
            }
        }

        // Gallery images (separated by | or ; or ,)
        if (!empty($data['gallery_images'])) {
            $urls = preg_split('/[,;|]/', $data['gallery_images']);
            $gallery_ids = array();
            foreach ($urls as $u) {
                $u = trim($u);
                if ($u === '') continue;
                $g_att = nadlan_sideload_image_from_url($u, $post_id);
                if (is_wp_error($g_att)) {
                    $messages[] = 'שגיאה בייבוא תמונה בגלריה עבור ' . $title . ': ' . $g_att->get_error_message();
                    continue;
                }
                if ($g_att) {
                    $gallery_ids[] = $g_att;
                }
            }
            if (!empty($gallery_ids)) {
                // store as comma separated attachment IDs (existing single string meta used by theme)
                update_post_meta($post_id, 'property_gallery', implode(',', $gallery_ids));
            }
        }

        $imported++;
    }

    fclose($handle);

    return array('imported' => $imported, 'failed' => $failed, 'messages' => $messages);
}

