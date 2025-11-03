<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="site-logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <span>🏡</span>
                        <span><?php bloginfo('name'); ?></span>
                    </a>
                    <?php
                }
                ?>
            </div>

            <button class="mobile-menu-toggle" aria-label="תפריט" aria-expanded="false">
                ☰
            </button>

            <nav class="main-navigation" role="navigation" aria-label="תפריט ראשי">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'primary-menu',
                    'container' => false,
                    'fallback_cb' => 'nadlan_default_menu',
                ));
                ?>
            </nav>
        </div>
    </div>
</header>

<?php
/**
 * Default Menu Fallback
 */
function nadlan_default_menu() {
    echo '<ul class="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">דף הבית</a></li>';
    echo '<li><a href="' . esc_url(home_url('/property/')) . '">נכסים</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '">אודות</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">צור קשר</a></li>';
    echo '</ul>';
}
?>
