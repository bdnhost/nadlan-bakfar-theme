<?php
/**
 * Property Archive Template
 *
 * @package NadlanBakfar
 */

get_header();
?>

<main id="main" class="site-main">
    
    <!-- Page Header -->
    <div class="section" style="background-color: var(--color-background); padding: 2rem 0;">
        <div class="container">
            <h1 class="text-center">כל הנכסים שלנו</h1>
            <p class="text-center">מצא את הבית המושלם מתוך מגוון נכסים בגליל המערבי</p>
        </div>
    </div>

    <!-- Search removed per request -->

    <!-- Results Section -->
    <div class="section">
        <div class="container">
            
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                <div>
                    <p>
                        <?php
                        global $wp_query;
                        $total = $wp_query->found_posts;
                        echo sprintf(
                            _n('נמצא נכס אחד', 'נמצאו %s נכסים', $total, 'nadlan-bakfar'),
                            number_format_i18n($total)
                        );
                        ?>
                    </p>
                </div>
                
                <!-- Sort Options -->
                <div class="form-group" style="min-width: 200px; margin-bottom: 0;">
                    <select id="property-sort" class="form-control">
                        <option value="date-desc">החדשים ביותר</option>
                        <option value="date-asc">הישנים ביותר</option>
                        <option value="price-asc">מחיר: נמוך לגבוה</option>
                        <option value="price-desc">מחיר: גבוה לנמוך</option>
                        <option value="title-asc">שם: א-ת</option>
                    </select>
                </div>
            </div>

            <!-- Properties Grid -->
            <div id="properties-container" class="properties-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'property-card');
                    endwhile;
                else :
                    ?>
                    <div class="no-results" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                        <h2>לא נמצאו נכסים</h2>
                        <p>נסה לשנות את קריטריוני החיפוש</p>
                        <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" 
                           class="btn btn-primary mt-2">
                            איפוס חיפוש
                        </a>
                    </div>
                    <?php
                endif;
                ?>
            </div>

            <!-- Pagination -->
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '← הקודם',
                'next_text' => 'הבא →',
                'class' => 'pagination',
            ));
            ?>

        </div>
    </div>

    <!-- CTA Section -->
    <section class="section section-alt">
        <div class="container text-center">
            <h2>לא מצאת מה שחיפשת?</h2>
            <p style="font-size: 1.125rem; margin-bottom: 2rem;">
                הצוות שלנו יעזור לך למצוא את הנכס המושלם
            </p>
            <a href="https://wa.me/972542623399?text=שלום, אני מחפש נכס בגליל ולא מצאתי באתר משהו מתאים" 
               class="btn btn-whatsapp btn-icon" 
               target="_blank">
                💬 צור קשר בוואטסאפ
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
?>
