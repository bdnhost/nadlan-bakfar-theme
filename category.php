<?php
/**
 * Category Archive Template
 *
 * @package NadlanBakfar
 */

get_header();
?>

<main id="main" class="site-main">

    <!-- Page Header -->
    <div class="section" style="background-color: var(--color-background); padding: 2rem 0;">
        <div class="container">
            <?php if (is_category()) : ?>
                <h1 class="text-center">
                    <?php single_cat_title(); ?>
                </h1>
                <?php
                $category_description = category_description();
                if ($category_description) :
                    ?>
                    <p class="text-center"><?php echo $category_description; ?></p>
                    <?php
                endif;
                ?>
            <?php else : ?>
                <h1 class="text-center">קטגוריות</h1>
                <p class="text-center">עיין במאמרים והמשאבים שלנו</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Content Section -->
    <div class="section">
        <div class="container">

            <?php
            if (have_posts()) :

                echo '<div class="recent-posts-grid">';

                while (have_posts()) :
                    the_post();
                    ?>
                    <article class="recent-post-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
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

                echo '</div>';

                // Pagination
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← הקודם',
                    'next_text' => 'הבא →',
                ));

            else :
                ?>
                <div class="no-results" style="text-align: center; padding: 3rem;">
                    <h2>לא נמצאו מאמרים בקטגוריה זו</h2>
                    <p>נראה שאין תוכן בקטגוריה זו כרגע.</p>
                    <div style="margin-top: 2rem;">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                            חזור לדף הבית
                        </a>
                        <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>"
                           class="btn btn-primary" style="margin-right: 1rem;">
                            צפה בנכסים
                        </a>
                    </div>
                </div>
                <?php
            endif;
            ?>

        </div>
    </div>

    <!-- CTA Section -->
    <?php if (have_posts()) : ?>
    <section class="section section-alt">
        <div class="container text-center">
            <h2>מחפשים נכס בגליל?</h2>
            <p style="font-size: 1.125rem; margin-bottom: 2rem;">
                צפו במגוון הנכסים שלנו או צרו איתנו קשר
            </p>
            <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>"
               class="btn btn-primary"
               style="margin-left: 1rem;">
                צפו בנכסים
            </a>
            <a href="https://wa.me/972542623399?text=שלום, אני מעוניין בפרטים נוספים"
               class="btn btn-whatsapp btn-icon"
               target="_blank">
                💬 צור קשר בוואטסאפ
            </a>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php
get_footer();
?>
