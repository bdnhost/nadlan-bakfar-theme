<?php
/**
 * Template part for displaying property cards
 *
 * @package NadlanBakfar
 */

$meta = nadlan_get_property_meta(get_the_ID());
$status_terms = get_the_terms(get_the_ID(), 'property-status');
$location_terms = get_the_terms(get_the_ID(), 'property-location');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('property-card fade-in'); ?>>
    
    <a href="<?php the_permalink(); ?>" class="property-image-wrapper">
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'property-thumbnail')); ?>" 
                 alt="<?php the_title_attribute(); ?>" 
                 class="property-image"
                 loading="lazy">
        <?php else : ?>
            <div class="property-image" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                🏡
            </div>
        <?php endif; ?>
        
        <?php if ($status_terms && !is_wp_error($status_terms)) : ?>
            <span class="property-status"><?php echo esc_html($status_terms[0]->name); ?></span>
        <?php endif; ?>
    </a>

    <div class="property-content">
        <h3 class="property-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="property-location">
            📍 
            <?php
            if ($location_terms && !is_wp_error($location_terms)) {
                echo esc_html($location_terms[0]->name);
            } else {
                echo 'גליל מערבי';
            }
            ?>
        </div>

        <div class="property-price">
            <?php echo nadlan_get_property_price(); ?>
        </div>

        <div class="property-features">
            <?php if ($meta['rooms']) : ?>
                <span class="feature-item">
                    🛏️ <?php echo esc_html($meta['rooms']); ?> חדרים
                </span>
            <?php endif; ?>

            <?php if ($meta['bathrooms']) : ?>
                <span class="feature-item">
                    🚿 <?php echo esc_html($meta['bathrooms']); ?> חדרי רחצה
                </span>
            <?php endif; ?>

            <?php if ($meta['built_area']) : ?>
                <span class="feature-item">
                    📐 <?php echo esc_html($meta['built_area']); ?> מ"ר
                </span>
            <?php endif; ?>

            <?php if ($meta['land_area']) : ?>
                <span class="feature-item">
                    🏞️ <?php echo esc_html($meta['land_area']); ?> מ"ר מגרש
                </span>
            <?php endif; ?>
        </div>

        <div class="property-footer">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                צפה בפרטים
            </a>
        </div>
    </div>

</article>
