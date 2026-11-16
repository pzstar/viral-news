<?php
$viral_news_steps = $this->setup_steps();
$viral_news_done = count(wp_list_filter($viral_news_steps, array('done' => true)));
$viral_news_percent = round(100 * $viral_news_done / count($viral_news_steps));
?>
<div class="welcome-grid welcome-grid-start">
    <div class="welcome-card welcome-setup-checklist">
        <div class="welcome-setup-head">
            <div class="welcome-ring" style="--welcome-progress:<?php echo absint($viral_news_percent); ?>" role="progressbar" aria-valuemin="0" aria-valuemax="<?php echo count($viral_news_steps); ?>" aria-valuenow="<?php echo absint($viral_news_done); ?>" aria-label="<?php esc_attr_e('Setup progress', 'viral-news'); ?>">
                <span><?php echo absint($viral_news_percent); ?>%</span>
            </div>
            <div>
                <h3><?php esc_html_e('Set Up Your Website', 'viral-news'); ?></h3>
                <p class="welcome-setup-count"><?php /* translators: 1: steps done, 2: all steps */ printf(esc_html__('%1$d of %2$d done', 'viral-news'), $viral_news_done, count($viral_news_steps)); ?></p>
            </div>
        </div>

        <ol class="welcome-setup-steps">
            <?php foreach ($viral_news_steps as $viral_news_step) { ?>
                <li class="<?php echo $viral_news_step['done'] ? 'is-done' : 'is-todo'; ?>">
                    <span class="welcome-setup-mark dashicons <?php echo $viral_news_step['done'] ? 'dashicons-yes' : ''; ?>" aria-hidden="true"></span>
                    <div class="welcome-setup-text">
                        <strong><?php echo esc_html($viral_news_step['title']); ?></strong>
                        <span class="screen-reader-text"><?php echo $viral_news_step['done'] ? esc_html__('(done)', 'viral-news') : esc_html__('(to do)', 'viral-news'); ?></span>
                        <p><?php echo esc_html($viral_news_step['text']); ?></p>
                    </div>
                    <?php
                    if ($viral_news_step['url']) {
                        echo '<a class="button' . ($viral_news_step['done'] ? '' : ' button-primary') . '" href="' . esc_url($viral_news_step['url']) . '">' . ($viral_news_step['done'] ? esc_html__('Change', 'viral-news') : esc_html__('Set up', 'viral-news')) . '</a>';
                    } elseif (!$viral_news_step['done']) {
                        echo $this->generate_hdi_install_button();
                    }
                    ?>
                </li>
            <?php } ?>
        </ol>
    </div>

    <div class="welcome-card welcome-demo-import">
        <div class="welcome-demo-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.jpg'); ?>" alt="<?php /* translators: %s: theme name */ printf(esc_attr__('%s Demo', 'viral-news'), $this->theme_name); ?>">
            <a href="https://demo.hashthemes.com/viral-news/" target="_blank" class="welcome-demo-view"><span class="dashicons dashicons-external" aria-hidden="true"></span><?php esc_html_e('View Demo', 'viral-news'); ?></a>
        </div>
        <div class="welcome-card-body">
            <h3><?php esc_html_e('Start From a Demo', 'viral-news'); ?></h3>
            <p><?php esc_html_e('Import a complete demo website, with its content and settings, in a single click, then replace the content with your own.', 'viral-news'); ?></p>
            <?php echo $this->generate_hdi_install_button(); ?>
            <p class="welcome-small"><a href="https://hashthemes.com/documentation/viral-news-documentation/#ImportDemoContent" target="_blank"><?php esc_html_e('How the demo importer works', 'viral-news'); ?></a></p>
        </div>
    </div>
</div>

<div class="welcome-block">
    <div class="welcome-block-head">
        <h3><?php esc_html_e('Customize Your Site', 'viral-news'); ?></h3>
        <a href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Open the Customizer', 'viral-news'); ?> <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="welcome-quick-links">
        <?php foreach ($this->quick_links() as $viral_news_link) { ?>
            <a class="welcome-quick-link" href="<?php echo esc_url($viral_news_link['url']); ?>">
                <span class="dashicons <?php echo esc_attr($viral_news_link['icon']); ?>" aria-hidden="true"></span>
                <?php echo esc_html($viral_news_link['label']); ?>
            </a>
        <?php } ?>
    </div>
</div>

<div class="welcome-block">
    <div class="welcome-block-head">
        <h3><?php esc_html_e('Build Your Front Page', 'viral-news'); ?></h3>
        <a href="https://hashthemes.com/documentation/viral-news-documentation/#HomePageSetup" target="_blank"><?php esc_html_e('Step-by-step guide', 'viral-news'); ?> <span aria-hidden="true">&rarr;</span></a>
    </div>
    <p class="welcome-block-intro"><?php echo esc_html__('Build the front page from the theme\'s ready-made news sections in the Customizer, or design it freely with Elementor.', 'viral-news'); ?></p>

    <div class="welcome-grid welcome-grid-2">
        <div class="welcome-card welcome-method">
            <span class="welcome-method-icon dashicons dashicons-admin-customizer" aria-hidden="true"></span>
            <h4><?php esc_html_e('With the Customizer', 'viral-news'); ?></h4>
            <ol>
                <li><?php echo sprintf(esc_html__('Go to Appearance > Customize > %s.', 'viral-news'), '<a href="' . esc_url(admin_url('customize.php?autofocus[section]=static_front_page')) . '">' . esc_html__('Homepage Settings', 'viral-news') . '</a>'); ?></li>
                <li><?php echo esc_html__('Turn on "Enable FrontPage".', 'viral-news'); ?></li>
                <li><?php echo esc_html__('Go back, open "Front Page Sections" and fill in the sections you want to show.', 'viral-news'); ?></li>
            </ol>
        </div>

        <div class="welcome-card welcome-method">
            <span class="welcome-method-icon dashicons dashicons-layout" aria-hidden="true"></span>
            <h4><?php esc_html_e('With Elementor', 'viral-news'); ?></h4>
            <ol>
                <li><?php printf(esc_html__('Install Elementor from Plugins > Add New, then Hash Elements from the %s.', 'viral-news'), '<a href="' . esc_url(admin_url('admin.php?page=viral-news-welcome&section=recommended_plugins')) . '">' . esc_html__('Recommended Plugins tab', 'viral-news') . '</a>'); ?></li>
                <li><?php echo esc_html__('Create a new page, edit it with Elementor and drag in the news widgets to design your front page.', 'viral-news'); ?></li>
                <li><?php echo sprintf(esc_html__('In Appearance > Customize > %s, choose "A static page", select your new page as the Homepage and turn off "Enable FrontPage".', 'viral-news'), '<a href="' . esc_url(admin_url('customize.php?autofocus[section]=static_front_page')) . '">' . esc_html__('Homepage Settings', 'viral-news') . '</a>'); ?></li>
            </ol>
        </div>
    </div>
</div>
