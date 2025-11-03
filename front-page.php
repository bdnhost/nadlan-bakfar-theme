<?php
/**
 * Front Page Template
 *
 * @package NadlanBakfar
 */

get_header();
?>

<main id="main" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content fade-in">
                <h1 class="hero-title">מצא את הבית המושלם בגליל המערבי</h1>
                <p class="hero-subtitle">נדל"ן בכפר - המומחים לנכסים כפריים במושבים, קיבוצים ויישובי גליל</p>
                
                <!-- search removed per request -->
            </div>
        </div>
    </section>

    <!-- Featured Properties Section -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-4">
                <h2>נכסים נבחרים</h2>
                <p>מבחר נכסים מיוחדים שנבחרו במיוחד עבורכם</p>
            </div>

            <?php
            $featured_args = array(
                'post_type' => 'property',
                'posts_per_page' => 6,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $featured_query = new WP_Query($featured_args);

            if ($featured_query->have_posts()) :
                echo '<div class="properties-grid">';
                
                while ($featured_query->have_posts()) :
                    $featured_query->the_post();
                    get_template_part('template-parts/content', 'property-card');
                endwhile;
                
                echo '</div>';
                
                wp_reset_postdata();
            else :
                echo '<p class="text-center">טוען נכסים...</p>';
            endif;
            ?>

            <div class="text-center mt-4">
                <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" class="btn btn-primary">
                    צפה בכל הנכסים
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section section-alt">
        <div class="container">
            <div class="text-center mb-4">
                <h2>למה לבחור בנו?</h2>
                <p>הסיבות שגורמות ללקוחות שלנו לבחור בנו</p>
            </div>

            <div class="properties-grid">
                <div class="property-card">
                    <div class="property-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🏡</div>
                        <h3>ניסיון מקומי</h3>
                        <p>מכירים כל פינה בגליל המערבי - מושבים, קיבוצים ויישובים כפריים</p>
                    </div>
                </div>

                <div class="property-card">
                    <div class="property-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🤝</div>
                        <h3>שירות אישי</h3>
                        <p>ליווי צמוד לאורך כל התהליך - מהחיפוש ועד לקבלת המפתחות</p>
                    </div>
                </div>

                <div class="property-card">
                    <div class="property-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">⭐</div>
                        <h3>מוניטין מוכח</h3>
                        <p>מאות לקוחות מרוצים שמצאו את ביתם בעזרתנו</p>
                    </div>
                </div>

                <div class="property-card">
                    <div class="property-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">💡</div>
                        <h3>ייעוץ מקצועי</h3>
                        <p>הדרכה משפטית, ליווי משכנתא וכל המידע שתצטרכו</p>
                    </div>
                </div>

                <div class="property-card">
                    <div class="property-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                        <h3>נכסים ייחודיים</h3>
                        <p>גישה לנכסים שלא תמצאו במקומות אחרים</p>
                    </div>
                </div>

                <div class="property-card">
                    <div class="property-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📞</div>
                        <h3>זמינות מלאה</h3>
                        <p>תמיד זמינים לענות על שאלות ולעזור בכל נושא</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section">
        <div class="container text-center">
            <h2>מוכנים למצוא את הבית החדש שלכם?</h2>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">צרו קשר עכשיו ונתחיל לחפש ביחד</p>
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="https://wa.me/972542623399?text=שלום, אני מעוניין/ת לקבל פרטים על נכסים בגליל" 
                   class="btn btn-whatsapp btn-icon" 
                   target="_blank">
                    💬 שלחו הודעה בוואטסאפ
                </a>
                <a href="tel:+972542623399" class="btn btn-primary btn-icon">
                    📞 התקשרו עכשיו
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-secondary btn-icon">
                    ✉️ טופס יצירת קשר
                </a>
            </div>
        </div>
    </section>

    <?php if (get_option('show_on_front') == 'posts') : ?>
    <!-- Recent Posts Section -->
    <section class="section section-alt">
        <div class="container">
            <div class="text-center mb-4">
                <h2>פוסטים אחרונים</h2>
                <p>עדכונים, חדשות ומידע שימושי על נדל"ן בגליל המערבי</p>
            </div>

            <div class="recent-posts-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article class="recent-post-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <div class="post-meta">
                                    <span class="post-date">
                                        <?php echo get_the_date('d/m/Y'); ?>
                                    </span>
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) :
                                        echo ' • ';
                                        $primary_category = $categories[0];
                                        echo '<a href="' . esc_url(get_category_link($primary_category->term_id)) . '">' 
                                            . esc_html($primary_category->name) . '</a>';
                                    endif;
                                    ?>
                                </div>
                                
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    קרא עוד »
                                </a>
                            </div>
                        </article>
                        <?php
                    endwhile;

                    // Pagination
                    echo '<div class="pagination-wrap">';
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '&laquo; הקודם',
                        'next_text' => 'הבא &raquo;',
                    ));
                    echo '</div>';
                    
                else :
                    echo '<p class="text-center">אין פוסטים להצגה כרגע.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
    <?php else : 
        // Display page content if set
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                if (get_the_content()) :
                    ?>
                    <section class="section section-alt">
                        <div class="container">
                            <div class="property-description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </section>
                    <?php
                endif;
            endwhile;
        endif;
    endif;
    ?>

</main>

<?php
get_footer();
