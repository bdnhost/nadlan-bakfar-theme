<?php
/**
 * 404 Error Page Template
 *
 * @package NadlanBakfar
 */

get_header();
?>

<main id="main" class="site-main">
    
    <section class="section">
        <div class="container">
            <div class="error-404 not-found text-center" style="padding: 4rem 2rem;">
                
                <div style="font-size: 6rem; margin-bottom: 2rem;">🏚️</div>
                
                <header class="page-header">
                    <h1 class="page-title" style="font-size: 3rem; margin-bottom: 1rem;">
                        404 - הדף לא נמצא
                    </h1>
                </header>

                <div class="page-content">
                    <p style="font-size: 1.25rem; margin-bottom: 2rem; color: var(--color-text-light);">
                        מצטערים, הדף שחיפשת אינו קיים או הוסר.
                    </p>

                    <!-- Search Form -->
                    <div style="max-width: 500px; margin: 0 auto 2rem;">
                        <?php get_search_form(); ?>
                    </div>

                    <!-- Quick Links -->
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-icon">
                            🏠 דף הבית
                        </a>
                        <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="btn btn-secondary btn-icon">
                            🏘️ כל הנכסים
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-secondary btn-icon">
                            📞 צור קשר
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="section section-alt">
        <div class="container">
            <h2 class="text-center mb-3">נכסים מומלצים</h2>
            
            <?php
            $args = array(
                'post_type' => 'property',
                'posts_per_page' => 3,
                'orderby' => 'rand',
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                echo '<div class="properties-grid">';
                
                while ($query->have_posts()) :
                    $query->the_post();
                    get_template_part('template-parts/content', 'property-card');
                endwhile;
                
                echo '</div>';
                
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

</main>

<?php
get_footer();
?>
