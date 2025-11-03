<?php
/**
 * Template for displaying single posts
 *
 * @package NadlanBakfar
 */

get_header();
?>

<main id="main" class="site-main">
    
    <?php
    while (have_posts()) :
        the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- Post Header -->
            <div class="section" style="background-color: var(--color-background); padding: 2rem 0;">
                <div class="container">
                    <header class="entry-header">
                        <h1 class="entry-title" style="margin-bottom: 1rem;"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta" style="color: var(--color-text-light); display: flex; gap: 1.5rem; flex-wrap: wrap;">
                            <span class="posted-on">
                                📅 <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                ✍️ מאת: <?php the_author(); ?>
                            </span>
                            <?php if (has_category()) : ?>
                                <span class="categories">
                                    🏷️ <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>
                </div>
            </div>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="section">
                    <div class="container">
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: var(--border-radius);')); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="section">
                <div class="container">
                    <div class="entry-content property-description" style="max-width: 800px; margin: 0 auto;">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('עמודים:', 'nadlan-bakfar'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="post-tags" style="max-width: 800px; margin: 2rem auto 0; padding-top: 2rem; border-top: 1px solid var(--color-border);">
                            <strong>תגיות:</strong>
                            <?php the_tags('<span style="display: inline-block; margin: 0.25rem 0.5rem 0.25rem 0; padding: 0.25rem 0.75rem; background: var(--color-background); border-radius: 20px; font-size: 0.875rem;">', '</span><span style="display: inline-block; margin: 0.25rem 0.5rem 0.25rem 0; padding: 0.25rem 0.75rem; background: var(--color-background); border-radius: 20px; font-size: 0.875rem;">', '</span>'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Author Bio -->
                    <div class="author-bio" style="max-width: 800px; margin: 2rem auto 0; padding: 2rem; background: var(--color-background); border-radius: var(--border-radius);">
                        <h3>על הכותב</h3>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="author-avatar" style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0;">
                                👤
                            </div>
                            <div>
                                <h4 style="margin: 0 0 0.5rem 0;"><?php the_author(); ?></h4>
                                <p style="margin: 0; color: var(--color-text-light);">
                                    <?php echo get_the_author_meta('description') ?: 'כותב/ת בצוות נדל״ן בכפר'; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="post-share" style="max-width: 800px; margin: 2rem auto 0; text-align: center;">
                        <h3>שתף את הפוסט</h3>
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                               target="_blank" 
                               class="btn btn-secondary"
                               rel="noopener">
                                📘 Facebook
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                               target="_blank" 
                               class="btn btn-whatsapp"
                               rel="noopener">
                                💬 WhatsApp
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               class="btn btn-primary"
                               rel="noopener">
                                🐦 Twitter
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post Navigation -->
            <div class="section section-alt">
                <div class="container">
                    <nav class="post-navigation" style="max-width: 800px; margin: 0 auto;">
                        <div class="d-flex justify-content-between gap-2 flex-wrap">
                            <?php
                            $prev_post = get_previous_post();
                            if ($prev_post) :
                            ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="btn btn-secondary">
                                    ← <?php echo get_the_title($prev_post); ?>
                                </a>
                            <?php endif; ?>

                            <?php
                            $next_post = get_next_post();
                            if ($next_post) :
                            ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="btn btn-secondary" style="margin-right: auto;">
                                    <?php echo get_the_title($next_post); ?> →
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Comments -->
            <?php
            if (comments_open() || get_comments_number()) :
                ?>
                <div class="section">
                    <div class="container">
                        <div style="max-width: 800px; margin: 0 auto;">
                            <?php comments_template(); ?>
                        </div>
                    </div>
                </div>
                <?php
            endif;
            ?>

        </article>

        <?php
    endwhile;
    ?>

    <!-- Related Posts -->
    <?php
    $categories = get_the_category();
    
    if ($categories) {
        $category_ids = array();
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }

        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 3,
            'orderby' => 'rand',
        );

        $related_query = new WP_Query($args);

        if ($related_query->have_posts()) :
        ?>
            <section class="section section-alt">
                <div class="container">
                    <h2 class="text-center mb-3">פוסטים נוספים שעשויים לעניין אותך</h2>
                    
                    <div class="recent-posts-grid">
                        <?php
                        while ($related_query->have_posts()) :
                            $related_query->the_post();
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
                                        $post_categories = get_the_category();
                                        if ($post_categories) :
                                            echo ' • ';
                                            $primary_category = $post_categories[0];
                                            echo '<a href="' . esc_url(get_category_link($primary_category->term_id)) . '">' 
                                                . esc_html($primary_category->name) . '</a>';
                                        endif;
                                        ?>
                                    </div>
                                    
                                    <div class="post-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </div>
                                    
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        קרא עוד »
                                    </a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
        <?php
        endif;
    }
    ?>

</main>

<?php
get_footer();
?>
