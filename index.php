<?php
/**
 * The main template file
 *
 * @package NadlanBakfar
 */

get_header();
?>

<main id="main" class="site-main">
    
    <?php if (is_home() && !is_front_page()) : ?>
        <div class="section">
            <div class="container">
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            </div>
        </div>
    <?php endif; ?>

    <div class="section">
        <div class="container">
            <?php
            if (have_posts()) :
                
                echo '<div class="recent-posts-grid">';
                
                while (have_posts()) :
                    the_post();
                    
                    if (get_post_type() === 'property') {
                        get_template_part('template-parts/content', 'property-card');
                    } else :
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
                    endif;
                    
                endwhile;
                
                echo '</div>';
                
                // Pagination
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← הקודם',
                    'next_text' => 'הבא →',
                ));
                
            else :
                
                get_template_part('template-parts/content', 'none');
                
            endif;
            ?>
        </div>
    </div>

</main>

<?php
get_footer();
