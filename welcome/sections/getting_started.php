<div class="getting-started-top-wrap clearfix">
    <div class="theme-steps-list">
        <div class="theme-steps">
            <h3><?php echo esc_html__('Step 1 - Create a new page with "Home Page" Template', 'viral-news'); ?></h3>
            <ol>
                <li><?php echo esc_html__('Create a new page (any title like Home )', 'viral-news'); ?></li>
                <li><?php echo esc_html__('In right column, select "Home Page" for the option Page Attributes > Template', 'viral-news'); ?> </li>
                <li><?php echo esc_html__('Click on Publish', 'viral-news'); ?></li>
            </ol>
            <a class="button button-primary" target="_blank" href="<?php echo esc_url(admin_url('post-new.php?post_type=page')); ?>"><?php echo esc_html__('Create New Page', 'viral-news'); ?></a>
        </div>

        <div class="theme-steps">
            <h3><?php echo esc_html__('Step 2 - Set "Your homepage displays" to "A Static Page"', 'viral-news'); ?></h3>
            <ol>
                <li><?php echo esc_html__('Go to Appearance > Customize > General settings > Static Front Page', 'viral-news'); ?></li>
                <li><?php echo esc_html__('Set "Your homepage displays" to "A Static Page"', 'viral-news'); ?></li>
                <li><?php echo esc_html__('In "Homepage", select the page that you created in the step 1', 'viral-news'); ?></li>
                <li><?php echo esc_html__('Save changes', 'viral-news'); ?></li>
            </ol>
            <a class="button button-primary" target="_blank" href="<?php echo esc_url(admin_url('options-reading.php')); ?>"><?php echo esc_html__('Assign Static Page', 'viral-news'); ?></a>
        </div>

        <div class="theme-steps">
            <h3><?php echo esc_html__('Step 3 - Customizer Options Panel', 'viral-news'); ?></h3>
            <p><?php echo esc_html__('Now go to Customizer Page. Using the WordPress Customizer you can easily set up the home page and customize the theme.', 'viral-news'); ?></p>
            <p>Video Tutorial - <a href="https://www.youtube.com/watch?v=mfLt0pA-Kx8" target="_blank">https://www.youtube.com/watch?v=mfLt0pA-Kx8</a></p>
            <a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php echo esc_html__('Go to Customizer Panels', 'viral-news'); ?></a>
        </div>

    </div>

    <div class="theme-image">
        <h3><?php echo esc_html__('Demo Importer', 'viral-news'); ?><a href="https://demo.hashthemes.com/<?php echo get_option('stylesheet'); ?>" target="_blank" class="button button-primary"><?php esc_html_e('View Demo', 'viral-news'); ?></a></h3>
        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php echo esc_html__('Viral Demo', 'viral-news'); ?>">

        <div class="theme-import-demo">
            <?php
            $viral_news_demo_importer_slug = 'hashthemes-demo-importer';
            $viral_news_demo_importer_filename = 'hashthemes-demo-importer';
            $viral_news_import_url = '#';

            if ($this->viral_news_check_installed_plugin($viral_news_demo_importer_slug, $viral_news_demo_importer_filename) && !$this->viral_news_check_plugin_active_state($viral_news_demo_importer_slug, $viral_news_demo_importer_filename)) :
                $viral_news_import_class = 'button button-primary viral-news-activate-plugin';
                $viral_news_import_button_text = esc_html__('Activate Demo Importer Plugin', 'viral-news');
            elseif ($this->viral_news_check_installed_plugin($viral_news_demo_importer_slug, $viral_news_demo_importer_filename)) :
                $viral_news_import_class = 'button button-primary';
                $viral_news_import_button_text = esc_html__('Go to Demo Importer Page', 'viral-news');
                $viral_news_import_url = admin_url('themes.php?page=hdi-demo-importer');
            else :
                $viral_news_import_class = 'button button-primary viral-news-install-plugin';
                $viral_news_import_button_text = esc_html__('Install Demo Importer Plugin', 'viral-news');
            endif;
            ?>
            <p><?php esc_html_e('Or you can get started by importing the demo with just one click.', 'viral-news'); ?></p>
            <p><?php echo sprintf(esc_html__('Click on the button below to install and activate HashThemes Demo Importer plugin. For more detail documentation on how the demo importer works, click %s.', 'viral-news'), '<a href="https://hashthemes.com/documentation/viral-news-documentation/#ImportDemoContent" target="_blank">' . esc_html__('here', 'viral-news') . '</a>'); ?></p>
            <a data-slug="<?php echo esc_attr($viral_news_demo_importer_slug); ?>" data-filename="<?php echo esc_attr($viral_news_demo_importer_filename); ?>" class="<?php echo esc_attr($viral_news_import_class); ?>" href="<?php echo $viral_news_import_url; ?>"><?php echo esc_html($viral_news_import_button_text); ?></a>
        </div>
    </div>
</div>

<div class="getting-started-bottom-wrap">
    <h3><?php echo esc_html__('Viral Pro Demos - Check the premium demos. You might be interested in purchasing premium version.', 'viral-news'); ?></h3>
    <p><?php echo sprintf(esc_html__('Check out the websites that you can create with the premium version of the %s Theme. These demos can be imported with just one click in the premium version.', 'viral-news'), $this->theme_name); ?></p>

    <div class="recomended-plugin-wrap clearfix">
        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/magazine.jpg'); ?>" alt="<?php echo esc_html__('Viral Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">Magazine</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/magazine/" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/news.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">News</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/news/" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/sports.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">Sports</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/sports/" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/technology.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">Technology</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/technology" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/illustration.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">Illustration</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/illustration" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/fashion.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">Fashion</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/fashion" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/travel.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">Travel</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/travel" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>

        <div class="recom-plugin-wrap">
            <div class="plugin-img-wrap">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/rtl.jpg'); ?>" alt="<?php echo esc_html__('Viral Plus Demo', 'viral-news'); ?>">
            </div>

            <div class="plugin-title-install clearfix">
                <span class="title">RTL</span>
                <span class="plugin-btn-wrapper">
                    <a target="_blank" href="https://demo.hashthemes.com/viral-pro/rtl" class="button button-primary"><?php echo esc_html__('Preview', 'viral-news'); ?></a>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="upgrade-box">
    <div class="upgrade-box-text">
        <h3><?php echo esc_html__('Upgrade To Premium Version (7 Day Money Back Guarantee)', 'viral-news'); ?></h3>
        <p><?php echo sprintf(esc_html__('With %s Theme you can create a beautiful website. But if you want to unlock more possibilites then upgrade to premium version.', 'viral-news'), $this->theme_name); ?></p>
        <p><?php echo esc_html__('Try the Premium version and check if it fits to your need or not. If not, we have 7 day money back guarantee.', 'viral-news'); ?></p>
    </div>

    <a class="upgrade-button" href="https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-getting-started&utm_campaign=viral-news-upgrade" target="_blank"><?php esc_html_e('Upgrade Now', 'viral-news'); ?></a>
</div>