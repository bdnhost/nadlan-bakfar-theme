<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package NadlanBakfar
 */
?>

<section class="no-results not-found" style="text-align: center; padding: 4rem 2rem;">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('לא נמצא תוכן', 'nadlan-bakfar'); ?></h1>
    </header>

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :
            ?>
            <p><?php
                printf(
                    wp_kses(
                        __('מוכן לפרסם את הפוסט הראשון שלך? <a href="%1$s">התחל כאן</a>.', 'nadlan-bakfar'),
                        array(
                            'a' => array(
                                'href' => array(),
                            ),
                        )
                    ),
                    esc_url(admin_url('post-new.php'))
                );
                ?></p>
            <?php
        elseif (is_search()) :
            ?>
            <p><?php esc_html_e('מצטערים, לא נמצאו תוצאות לחיפוש שלך. נסה שוב עם מילות חיפוש שונות.', 'nadlan-bakfar'); ?></p>
            <?php
            get_search_form();
        else :
            ?>
            <p><?php esc_html_e('נראה שלא הצלחנו למצוא את מה שחיפשת. אולי חיפוש יעזור?', 'nadlan-bakfar'); ?></p>
            <?php
            get_search_form();
        endif;
        ?>
    </div>
</section>
