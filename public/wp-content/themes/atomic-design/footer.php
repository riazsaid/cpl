    <?php
    // Contact details from ACF Site Settings — set once, used everywhere.
    $phone   = function_exists('get_field') ? get_field('phone_number', 'option') : '';
    $email   = function_exists('get_field') ? get_field('email_address', 'option') : '';
    $address = function_exists('get_field') ? get_field('business_address', 'option') : '';
    $phone_tel = preg_replace('/[^+\d]/', '', $phone);
    ?>

    <footer class="site-footer" role="contentinfo">
        <div class="container footer-wrapper">

            <!-- Top area: brand | nav | CTA card -->
            <div class="site-footer__left">
            <span class="site-footer__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img
                        class="site-logo"
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>"
                        alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                        width="420"
                        height="80"
                        loading="eager"
                        decoding="async"
                    />
                </a>
            </span>

                <!-- Brand column -->
                <div class="site-footer__brand">
                    <?php if ($phone) : ?>
                    <a class="site-footer__contact-item"
                       href="tel:<?php echo esc_attr($phone_tel); ?>">
                        <?php echo esc_html($phone); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                    <a class="site-footer__contact-item"
                       href="mailto:<?php echo esc_attr($email); ?>">
                        <?php echo esc_html($email); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ($address) : ?>
                    <address class="site-footer__contact-item site-footer__address">
                        <?php echo nl2br(esc_html($address)); ?>
                    </address>
                    <?php endif; ?>
                </div>

                <!-- Footer navigation -->
                <nav class="site-footer__nav" aria-label="<?php esc_attr_e('Footer menu', 'atomic-design'); ?>">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'site-footer__menu',
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </nav>
                <div class="site-footer__copy-wrapper site-footer__copy">
                    <span class="site-footer__copyright">
                        &copy; <?php echo esc_html(wp_date('Y')); ?>
                        <?php esc_html_e('Custom Phenolic Labels — All rights reserved.', 'atomic-design'); ?>
                    </span>
                    <br>
                    <span class="site-footer__credit">
                        <a href="https://atomicdesign.net/" target="_blank" rel="noopener noreferrer" class="site-footer__credit-link">
                            <?php esc_html_e('Website Design & SEO by Atomic Design', 'atomic-design'); ?>
                        </a>
                    </span>
                    <br>
                    <span class="site-footer__legal">
                        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'atomic-design'); ?></a>
                        <span aria-hidden="true">|</span>
                        <a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>"><?php esc_html_e('Terms of Service', 'atomic-design'); ?></a>
                        <span aria-hidden="true">|</span>
                        <a href="<?php echo esc_url(home_url('/shipping-returns/')); ?>"><?php esc_html_e('Shipping & Returns', 'atomic-design'); ?></a>
                        <span aria-hidden="true">|</span>
                        <a href="<?php echo esc_url(home_url('/resources/color-chart/')); ?>"><?php esc_html_e('Phenolic Color Chart', 'atomic-design'); ?></a>
                        <span aria-hidden="true">|</span>
                        <a href="<?php echo esc_url(home_url('/resources/material-specs/')); ?>"><?php esc_html_e('Material Specs', 'atomic-design'); ?></a>
                        <span aria-hidden="true">|</span>
                        <a href="<?php echo esc_url(home_url('/how-it-works/')); ?>"><?php esc_html_e('How to Order', 'atomic-design'); ?></a>
                    </span>
                </div>
                <!-- CTA card -->
            

            </div><!-- /.site-footer__top -->

            <!-- Bottom bar -->
            <div class="site-footer__right">
            <aside class="site-footer__cta">
                <?php echo do_shortcode('[forminator_form id="1114"]'); ?>
            </aside>
            </div><!-- /.site-footer__bottom -->

        </div><!-- /.container -->
    </footer><!-- /.site-footer -->

</div><!-- /.site-shell -->

<!-- Quote Popup Modal -->
<div id="quote-popup" class="quote-popup" style="display: none;">
    <div class="quote-popup__overlay"></div>
    <div class="quote-popup__modal">
        <button class="quote-popup__close" aria-label="<?php esc_attr_e('Close popup', 'atomic-design'); ?>">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="quote-popup__content">
            <?php echo do_shortcode('[forminator_form id="1114"]'); ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
