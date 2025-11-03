<?php
/**
 * Template part for displaying posts
 *
 * @package NadlanBakfar
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('property-card fade-in'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="property-image-wrapper">
            <?php the_post_thumbnail('property-thumbnail', array('class' => 'property-image')); ?>
        </a>
    <?php endif; ?>

    <div class="property-content">
        
        <header class="entry-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="property-title">', '</h1>');
            else :
                the_title('<h3 class="property-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h3>');
            endif;
            ?>

            <div class="entry-meta" style="color: var(--color-text-light); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">
                <span class="posted-on">
                    📅 <?php echo get_the_date(); ?>
                </span>
                <span class="byline" style="margin-right: var(--spacing-sm);">
                    ✍️ <?php the_author(); ?>
                </span>
            </div>
        </header>

        <div class="entry-content">
            <?php
            if (is_singular()) :
                the_content();
            else :
                the_excerpt();
            endif;
            ?>
        </div>

        <?php if (!is_singular()) : ?>
            <div class="property-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                    קרא עוד
                </a>
            </div>
        <?php endif; ?>

    </div>

</article>
