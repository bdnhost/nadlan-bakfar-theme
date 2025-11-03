<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php else : ?>
                <div class="footer-widget">
                    <h3>נדל״ן בכפר</h3>
                    <p>משרד תיווך נדל"ן מוביל בגליל המערבי. מתמחים בנכסים כפריים, מושבים וקיבוצים.</p>
                    <div class="social-links">
                        <a href="https://facebook.com" class="social-link" target="_blank" rel="noopener" aria-label="Facebook">
                            📘
                        </a>
                        <a href="https://instagram.com" class="social-link" target="_blank" rel="noopener" aria-label="Instagram">
                            📷
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr(nadlan_get_whatsapp()); ?>" class="social-link" target="_blank" rel="noopener" aria-label="WhatsApp">
                            💬
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php else : ?>
                <div class="footer-widget">
                    <h3>קישורים מהירים</h3>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">דף הבית</a></li>
                        <li><a href="<?php echo esc_url(home_url('/property/')); ?>">נכסים למכירה</a></li>
                        <li><a href="<?php echo esc_url(home_url('/about/')); ?>">אודות</a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">בלוג</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">צור קשר</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php else : ?>
                <div class="footer-widget">
                    <h3>צור קשר</h3>
                    <ul>
                        <li>📞 <a href="tel:+<?php echo esc_attr(str_replace('-', '', nadlan_get_phone())); ?>"><?php echo esc_html(nadlan_get_phone()); ?></a></li>
                        <li>✉️ <a href="mailto:<?php echo esc_attr(nadlan_get_email()); ?>"><?php echo esc_html(nadlan_get_email()); ?></a></li>
                        <li>📍 גליל מערבי, ישראל</li>
                        <li>🕐 ראשון-חמישי: 9:00-18:00<br>שישי: 9:00-13:00</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. כל הזכויות שמורות.</p>
            <p>
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">מדיניות פרטיות</a> | 
                <a href="<?php echo esc_url(home_url('/terms/')); ?>">תנאי שימוש</a>
            </p>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/<?php echo esc_attr(nadlan_get_whatsapp()); ?>?text=שלום, אני מעוניין/ת לקבל פרטים נוספים על נכס"
   class="whatsapp-float"
   target="_blank"
   rel="noopener"
   aria-label="צור קשר בוואטסאפ">
    💬
</a>

<?php wp_footer(); ?>
</body>
</html>
