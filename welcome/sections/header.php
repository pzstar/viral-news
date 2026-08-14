<div class="welcome-header clearfix">
    <?php
    // Seasonal sale banner. Renders only while a campaign window is open and only
    // if its artwork actually ships, so a missing file can never show up broken.
    $viral_news_campaign = viral_news_get_active_campaign();

    if ($viral_news_campaign && !empty($viral_news_campaign['image']) && file_exists(get_template_directory() . '/welcome/css/' . $viral_news_campaign['image'])) {
        ?>
        <a href="<?php echo esc_url(viral_news_upgrade_url('welcome-banner-' . $viral_news_campaign['id'], 'viral-news-welcome')); ?>" target="_blank">
            <img style="width:100%;margin-bottom:40px;display:block;" src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/' . $viral_news_campaign['image']); ?>" alt="<?php echo esc_attr($viral_news_campaign['title']); ?>">
        </a>
        <?php
    }
    ?>
    <div class="welcome-intro">
        <h2><?php
        printf(// WPCS: XSS OK.
            /* translators: 1-theme name, 2-theme version */
            esc_html__('Welcome to %1$s - Version %2$s', 'viral-news'), $this->theme_name, $this->theme_version);
        ?></h2>
        <div class="welcome-text">
            <?php
            printf(// WPCS: XSS OK.
                /* translators: 1-theme name */
                esc_html__('Welcome and thank you for installing %1$s. Getting started with %1$s is very easy. Here you will find all the necessary information required to get started with the theme. And of course, the premium version if you require more features.', 'viral-news'), $this->theme_name);
            ?>
        </div>

        <div class="free-pro-demos">
            <a class="button button-primary" href="https://demo.hashthemes.com/<?php echo get_option('stylesheet'); ?>/" target="_blank"><span class="dashicons dashicons-visibility"></span><?php esc_html_e('Free Demos', 'viral-news'); ?></a>
            <a class="button button-primary" href="https://demo.hashthemes.com/viral-pro/" target="_blank"><span class="dashicons dashicons-cart"></span><?php esc_html_e('Premium Demos', 'viral-news'); ?></a>
        </div>
    </div>

    <div class="welcome-promo-banner">
        <a class="welcome-promo-offer" href="<?php echo esc_url(viral_news_upgrade_url('welcome-promo', 'viral-news-welcome')); ?>" target="_blank"><?php echo esc_html__('Unlock all the possibilities with Viral Pro.', 'viral-news'); ?></a>
        <a href="<?php echo esc_url(viral_news_upgrade_url('welcome-header-btn', 'viral-news-welcome')); ?>" target="_blank" class="button button-primary upgrade-btn"><?php echo esc_html__('UPGRADE TO PRO', 'viral-news'); ?></a>
    </div>
</div>

<div class="welcome-nav-wrapper clearfix">
    <?php foreach ($tabs as $section_id => $label): ?>
        <?php
        $section = isset($_GET['section']) && array_key_exists($_GET['section'], $tabs) ? $_GET['section'] : 'getting_started';
        $nav_class = 'welcome-nav-tab';
        if ($section_id == $section) {
            $nav_class .= ' welcome-nav-tab-active';
        }
        ?>
        <a href="<?php echo esc_url(admin_url('admin.php?page=viral-news-welcome&section=' . $section_id)); ?>" class="<?php echo esc_attr($nav_class); ?>">
            <?php echo esc_html($label); ?>
        </a>
    <?php endforeach; ?>
</div>