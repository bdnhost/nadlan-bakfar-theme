<?php
/**
 * Template for displaying pages
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
            
            <!-- Page Header -->
            <div class="section" style="background-color: var(--color-background); padding: 2rem 0;">
                <div class="container">
                    <header class="entry-header text-center">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                </div>
            </div>

            <!-- Page Content -->
            <div class="section">
                <div class="container">
                    <div class="entry-content property-description" style="max-width: 900px; margin: 0 auto;">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('עמודים:', 'nadlan-bakfar'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </div>
            </div>

            <?php
            // If comments are open or there is at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                ?>
                <div class="section section-alt">
                    <div class="container">
                        <div style="max-width: 900px; margin: 0 auto;">
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

</main>

<?php
get_footer();
?>
