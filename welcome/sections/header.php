<?php
/*
 *  Seasonal sale banner.
 *
 *  This used to be a commented-out block that had to be uncommented each
 *  November and remembered again in January. It now opens and closes on the
 *  same campaign window as the customizer banner.
 */
$viral_news_header_campaign = viral_news_get_active_campaign();

if ($viral_news_header_campaign && !empty($viral_news_header_campaign['image'])) {
    ?>
    <a class="welcome-sale-banner" target="_blank" href="<?php echo esc_url(viral_news_upgrade_url('welcome-banner-' . $viral_news_header_campaign['id'], 'viral-news-welcome-banner')); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/' . $viral_news_header_campaign['image']); ?>" alt="<?php echo esc_attr($viral_news_header_campaign['title']); ?>">
    </a>
    <?php
}
?>
<div class="welcome-hero">
    <div class="welcome-hero-main">
        <div class="welcome-brand">
            <svg class="welcome-brand-mark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45.94 45.94" aria-hidden="true"><path d="M22.92 25.37 35.44 3.7a22.89 22.89 0 0 0-25 .06ZM2.49 12.6a22.94 22.94 0 0 0 20.23 33.33ZM22.9 45.94h.1a22.94 22.94 0 0 0 20.38-33.47Z"/></svg>
            <span class="welcome-version">
                <?php
                /* translators: %s: theme version */
                printf(esc_html__('Version %s', 'viral-news'), esc_html($this->theme_version));
                ?>
            </span>
        </div>

        <h1>
            <?php
            /* translators: %s: theme name */
            printf(esc_html__('Welcome to %s', 'viral-news'), esc_html($this->theme_name));
            ?>
        </h1>
        <p class="welcome-hero-text">
            <?php
            /* translators: %s: theme name */
            printf(esc_html__('Thank you for choosing %s. Everything you need to set up your website is on this page: a setup checklist, shortcuts into the Customizer, recommended plugins and help when you need it.', 'viral-news'), esc_html($this->theme_name));
            ?>
        </p>

        <div class="welcome-hero-actions">
            <a class="welcome-btn welcome-btn-light" href="<?php echo esc_url(admin_url('customize.php')); ?>"><span class="dashicons dashicons-admin-customizer" aria-hidden="true"></span><?php esc_html_e('Customize Your Site', 'viral-news'); ?></a>
            <a class="welcome-btn welcome-btn-ghost" href="https://demo.hashthemes.com/viral-news/" target="_blank"><span class="dashicons dashicons-visibility" aria-hidden="true"></span><?php esc_html_e('Free Demos', 'viral-news'); ?></a>
            <a class="welcome-btn welcome-btn-ghost" href="https://demo.hashthemes.com/viral-pro/" target="_blank"><span class="dashicons dashicons-cart" aria-hidden="true"></span><?php esc_html_e('Premium Demos', 'viral-news'); ?></a>
        </div>
    </div>

    <div class="welcome-pro-card">
        <div class="welcome-pro-top">
            <span class="welcome-pro-badge"><span class="dashicons dashicons-star-filled" aria-hidden="true"></span>Viral Pro</span>
            <p class="welcome-pro-price"><span><?php esc_html_e('From', 'viral-news'); ?></span> <strong>$69</strong></p>
        </div>

        <ul class="welcome-pro-points">
            <li><span class="dashicons dashicons-yes" aria-hidden="true"></span><?php esc_html_e('One time payment, no renewals', 'viral-news'); ?></li>
            <li><span class="dashicons dashicons-yes" aria-hidden="true"></span><?php esc_html_e('1 site or unlimited sites license', 'viral-news'); ?></li>
            <li><span class="dashicons dashicons-yes" aria-hidden="true"></span><?php esc_html_e('Lifetime updates included', 'viral-news'); ?></li>
        </ul>

        <a href="<?php echo esc_url(viral_news_upgrade_url('welcome-promo-button', 'viral-news-welcome')); ?>" target="_blank" class="welcome-btn welcome-btn-pro"><?php esc_html_e('Upgrade to Pro', 'viral-news'); ?><span class="dashicons dashicons-arrow-right-alt" aria-hidden="true"></span></a>
    </div>
</div>

<nav class="welcome-nav" aria-label="<?php esc_attr_e('Settings sections', 'viral-news'); ?>">
    <?php foreach ($tabs as $section_id => $tab) { ?>
        <a href="<?php echo esc_url(admin_url('admin.php?page=viral-news-welcome&section=' . $section_id)); ?>" class="welcome-nav-tab<?php echo $section_id === $section ? ' is-active' : ''; ?>"<?php echo $section_id === $section ? ' aria-current="page"' : ''; ?>>
            <span class="dashicons <?php echo esc_attr($tab[1]); ?>" aria-hidden="true"></span><?php echo esc_html($tab[0]); ?>
        </a>
    <?php } ?>
</nav>
