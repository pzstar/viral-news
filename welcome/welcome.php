<?php
if (!class_exists('Viral_News_Welcome')):

    class Viral_News_Welcome {
        public $theme_name = ''; // For storing Theme Name
        public $theme_version = ''; // For Storing Theme Current Version Information
        public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins

        /**
         * Constructor for the Welcome Screen
         */

        public function __construct() {

            /** Useful Variables */
            $theme = wp_get_theme();
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;

            /** List of Recommended Free Plugins */
            $this->free_plugins = array(
                'hashthemes-demo-importer' => array(
                    'name' => 'HashThemes Demo Importer',
                    'slug' => 'hashthemes-demo-importer',
                    'filename' => 'hashthemes-demo-importer',
                    'thumb_path' => 'https://ps.w.org/hashthemes-demo-importer/assets/icon-256x256.png'
                ),
                'hash-form' => array(
                    'name' => 'Hash Form Builder',
                    'slug' => 'hash-form',
                    'filename' => 'hash-form',
                    'thumb_path' => 'https://ps.w.org/hash-form/assets/icon-256x256.gif'
                ),
                'hash-elements' => array(
                    'name' => 'Hash Elements',
                    'slug' => 'hash-elements',
                    'filename' => 'hash-elements',
                    'thumb_path' => 'https://ps.w.org/hash-elements/assets/icon-256x256.png'
                ),
                'simple-floating-menu' => array(
                    'name' => 'Simple Floating Menu',
                    'slug' => 'simple-floating-menu',
                    'filename' => 'simple-floating-menu',
                    'thumb_path' => 'https://ps.w.org/simple-floating-menu/assets/icon-256x256.png'
                ),
                'smart-blocks' => array(
                    'name' => 'Smart Blocks - WordPress Gutenberg Blocks',
                    'slug' => 'smart-blocks',
                    'filename' => 'smart-blocks',
                    'thumb_path' => 'https://ps.w.org/smart-blocks/assets/icon-256x256.png'
                ),
                 'onyx-dark-mode-switcher' => array(
                    'name' => 'Onyx Dark Mode Switcher',
                    'slug' => 'onyx-dark-mode-switcher',
                    'filename' => 'onyx-dark-mode-switcher',
                    'thumb_path' => 'https://ps.w.org/onyx-dark-mode-switcher/assets/icon-256x256.png'
                )
            );

            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'welcome_register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'welcome_styles_and_scripts'));

            /* Adds Footer Rating Text */
            add_filter('admin_footer_text', array($this, 'admin_footer_text'));

            /* Create a Welcome Page */
            add_action('wp_loaded', array($this, 'admin_notice'), 20);

            add_action('after_switch_theme', array($this, 'erase_hide_notice'));

            add_action('wp_ajax_viral_news_activate_plugin', array($this, 'activate_plugin'));

            add_action('admin_init', array($this, 'welcome_init'));
        }

        /** Trigger Welcome Message Notification */
        public function admin_notice() {
            add_action('admin_notices', array($this, 'admin_notice_content'));
            add_action('in_admin_header', array($this, 'screen_notice_header'));
            add_action('admin_enqueue_scripts', array($this, 'block_widgets_notice'), 20);
        }

        /** Welcome Message Notification */
        public function admin_notice_content() {
            if (!$this->is_dismissed('welcome')) {
                $this->welcome_notice();
            }

            if (!$this->is_dismissed('review') && !empty(get_option('viral_news_first_activation')) && time() > get_option('viral_news_first_activation') + 15 * DAY_IN_SECONDS) {
                $this->review_notice();
            }

            if (!$this->is_dismissed('upgrade') && !empty(get_option('viral_news_first_activation')) && time() > get_option('viral_news_first_activation') + 30 * DAY_IN_SECONDS) {
                $this->upgrade_notice();
            }

            $this->screen_notice('admin_notices');
        }

        public function welcome_notice() {
            $screen = get_current_screen();

            if ('toplevel_page_viral-news-welcome' === $screen->id || (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) || 'theme-install' === $screen->id) {
                return;
            }
            ?>
            <div class="updated notice viral-news-welcome-notice viral-news-notice">
                <?php $this->dismiss_button('welcome'); ?>
                <div class="viral-news-welcome-notice-wrap">
                    <h2><?php esc_html_e('Congratulations!', 'viral-news'); ?></h2>
                    <p><?php printf(esc_html__('%1$s is installed and ready to use. Start from a ready-made demo, or set up the site yourself.', 'viral-news'), $this->theme_name); ?></p>

                    <div class="viral-news-welcome-info">
                        <div class="viral-news-welcome-thumb">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.jpg'); ?>" alt="<?php echo esc_attr_e('Viral Demo', 'viral-news'); ?>">
                        </div>

                        <?php
                        if ('appearance_page_hdi-demo-importer' !== $screen->id) {
                            ?>
                            <div class="viral-news-welcome-import">
                                <h3><?php esc_html_e('Import Demo', 'viral-news'); ?></h3>
                                <p><?php esc_html_e('Install and activate the HashThemes Demo Importer plugin to import a demo in one click.', 'viral-news'); ?></p>
                                <p><?php echo $this->generate_hdi_install_button(); ?></p>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="viral-news-welcome-getting-started">
                            <h3><?php esc_html_e('Get Started', 'viral-news'); ?></h3>
                            <p><?php printf(esc_html__('A setup checklist, Customizer shortcuts and help for getting the most out of %s.', 'viral-news'), $this->theme_name); ?></p>
                            <p><a href="<?php echo esc_url(admin_url('admin.php?page=viral-news-welcome')); ?>" class="button button-primary"><?php esc_html_e('Go to Settings Page', 'viral-news'); ?></a></p>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }

        /** Register Menu for Welcome Page */
        public function welcome_register_menu() {
            add_menu_page(esc_html__('Welcome', 'viral-news'), sprintf(esc_html__('%s Settings', 'viral-news'), esc_html($this->theme_name)), 'manage_options', 'viral-news-welcome', array($this, 'welcome_screen'), 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NS45NCA0NS45NCIgZmlsbD0iI0ZGRkZGRiI+PGc+PGc+PHBhdGggZD0iTTIyLjkyIDI1LjM3IDM1LjQ0IDMuN2EyMi44OSAyMi44OSAwIDAgMC0yNSAuMDZaTTIuNDkgMTIuNmEyMi45NCAyMi45NCAwIDAgMCAyMC4yMyAzMy4zM1pNMjIuOSA0NS45NGguMWEyMi45NCAyMi45NCAwIDAgMCAyMC4zOC0zMy40N1oiLz48L2c+PC9nPjwvc3ZnPg==', 60);
        }

        /** Welcome Page */
        public function welcome_screen() {
            /** Define Tabs Sections */
            $tabs = array(
                'getting_started' => array(esc_html__('Getting Started', 'viral-news'), 'dashicons-flag'),
                'recommended_plugins' => array(esc_html__('Recommended Plugins', 'viral-news'), 'dashicons-admin-plugins'),
                'support' => array(esc_html__('Help & Support', 'viral-news'), 'dashicons-sos'),
                'free_vs_pro' => array(esc_html__('Free vs Pro', 'viral-news'), 'dashicons-star-filled')
            );
            $section = isset($_GET['section']) && array_key_exists($_GET['section'], $tabs) ? sanitize_key($_GET['section']) : 'getting_started';
            ?>
            <div class="welcome-wrap">
                <?php require_once get_template_directory() . '/welcome/sections/header.php'; ?>

                <div class="welcome-section welcome-section-<?php echo esc_attr($section); ?>">
                    <?php require_once get_template_directory() . '/welcome/sections/' . $section . '.php'; ?>
                </div>

                <?php require_once get_template_directory() . '/welcome/sections/footer.php'; ?>
            </div>
            <?php
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page */
        public function welcome_styles_and_scripts($hook) {
            if ('theme-install.php' !== $hook) {
                $importer_params = array(
                    'installing_text' => esc_html__('Installing Demo Importer Plugin', 'viral-news'),
                    'activating_text' => esc_html__('Activating Demo Importer Plugin', 'viral-news'),
                    'importer_page' => esc_html__('Go to Demo Importer Page', 'viral-news'),
                    'importer_url' => admin_url('themes.php?page=hdi-demo-importer'),
                    'error' => esc_html__('Error! Reload the page and try again.', 'viral-news'),
                    'ajax_nonce' => wp_create_nonce('viral_news_activate_hdi_plugin')
                );
                wp_enqueue_script('viral-news-welcome', get_template_directory_uri() . '/welcome/js/welcome.js', array('plugin-install', 'updates'), VIRAL_NEWS_VERSION, true);
                wp_localize_script('viral-news-welcome', 'importer_params', $importer_params);
            }

            // One stylesheet for both directions: it uses logical properties.
            wp_enqueue_style('viral-news-welcome', get_template_directory_uri() . '/welcome/css/welcome.css', array('dashicons'), VIRAL_NEWS_VERSION);
        }

        /* Check if plugin is installed */

        public function check_plugin_installed_state($slug, $filename) {
            return file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php') ? true : false;
        }

        /* Check if plugin is activated */

        public function check_plugin_active_state($slug, $filename) {
            return is_plugin_active($slug . '/' . $filename . '.php') ? true : false;
        }

        /** Generate Url for the Plugin Button */
        public function plugin_generate_url($status, $slug, $file_name) {
            switch ($status) {
                case 'install':
                    return wp_nonce_url(add_query_arg(array(
                        'action' => 'install-plugin',
                        'plugin' => esc_attr($slug)
                    ), network_admin_url('update.php')), 'install-plugin_' . esc_attr($slug));
                    break;

                case 'inactive':
                    return add_query_arg(array(
                        'action' => 'deactivate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('deactivate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                    ), network_admin_url('plugins.php'));
                    break;

                case 'active':
                    return add_query_arg(array(
                        'action' => 'activate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('activate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                    ), network_admin_url('plugins.php'));
                    break;
            }
        }

        /** Ajax Plugin Activation */
        public function activate_plugin() {
            if (!current_user_can('manage_options')) {
                return;
            }

            check_ajax_referer('viral_news_activate_hdi_plugin', 'security');

            $slug = isset($_POST['slug']) ? $_POST['slug'] : '';
            $file = isset($_POST['file']) ? $_POST['file'] : '';
            $success = false;

            if (!empty($slug) && !empty($file)) {
                $result = activate_plugin($slug . '/' . $file . '.php');
                update_option('viral_news_hide_notice', true);
                if (!is_wp_error($result)) {
                    $success = true;
                }
            }
            echo wp_json_encode(array('success' => $success));
            die();
        }

        /** Adds Footer Notes */
        public function admin_footer_text($text) {
            $screen = get_current_screen();

            if ('toplevel_page_viral-news-welcome' == $screen->id) {
                $text = sprintf(esc_html__('Enjoying Viral News? Please leave us a %s rating on WordPress.org. Thank you from the HashThemes team!', 'viral-news'), '<a href="https://wordpress.org/support/theme/viral-news/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>');
            }

            return $text;
        }

        /** Generate HashThemes Demo Importer Install Button Link */
        public function generate_hdi_install_button() {
            $slug = $filename = 'hashthemes-demo-importer';
            $import_url = '#';

            if ($this->check_plugin_installed_state($slug, $filename) && !$this->check_plugin_active_state($slug, $filename)) {
                $import_class = 'button button-primary viral-news-activate-plugin';
                $import_button_text = esc_html__('Activate Demo Importer Plugin', 'viral-news');
            } elseif ($this->check_plugin_installed_state($slug, $filename)) {
                $import_class = 'button button-primary';
                $import_button_text = esc_html__('Go to Demo Importer Page', 'viral-news');
                $import_url = admin_url('themes.php?page=hdi-demo-importer');
            } else {
                $import_class = 'button button-primary viral-news-install-plugin';
                $import_button_text = esc_html__('Install Demo Importer Plugin', 'viral-news');
            }
            return '<a data-slug="' . esc_attr($slug) . '" data-filename="' . esc_attr($filename) . '" class="' . esc_attr($import_class) . '" href="' . $import_url . '">' . esc_html($import_button_text) . '</a>';
        }

        // The first things to set up, each marked done from the site's own settings.
        public function setup_steps() {
            $demo_active = $this->check_plugin_active_state('hashthemes-demo-importer', 'hashthemes-demo-importer');
            return array(
                array(
                    'title' => esc_html__('Show the front page sections', 'viral-news'),
                    'text' => esc_html__('Turn on "Enable FrontPage", then fill in each section under Front Page Sections.', 'viral-news'),
                    'done' => (bool) get_theme_mod('viral_news_enable_frontpage', false) || ('page' === get_option('show_on_front') && 'templates/template-home.php' === get_page_template_slug(get_option('page_on_front'))),
                    'url' => admin_url('customize.php?autofocus[section]=static_front_page'),
                ),
                array(
                    'title' => esc_html__('Add your logo', 'viral-news'),
                    'text' => esc_html__('Upload a logo, or keep the site title as text.', 'viral-news'),
                    'done' => has_custom_logo(),
                    'url' => admin_url('customize.php?autofocus[control]=custom_logo'),
                ),
                array(
                    'title' => esc_html__('Set up the main menu', 'viral-news'),
                    'text' => esc_html__('Create a menu and assign it to the Main Menu location.', 'viral-news'),
                    'done' => has_nav_menu('viral-news-primary-menu'),
                    'url' => admin_url('customize.php?autofocus[panel]=nav_menus'),
                ),
                array(
                    'title' => esc_html__('Choose your colors', 'viral-news'),
                    'text' => esc_html__('Set the theme color used for buttons, links and highlights.', 'viral-news'),
                    'done' => false !== get_theme_mod('viral_news_template_color', false),
                    'url' => admin_url('customize.php?autofocus[section]=colors'),
                ),
                array(
                    'title' => esc_html__('Import a demo (optional)', 'viral-news'),
                    'text' => esc_html__('Start from a ready-made website instead of an empty one.', 'viral-news'),
                    'done' => (bool) get_option('hdi_last_imported_demo'),
                    'url' => $demo_active ? admin_url('themes.php?page=hdi-demo-importer') : '',
                ),
            );
        }

        // Shortcuts into the Customizer panels people look for most.
        public function quick_links() {
            $links = array(
                array('dashicons-id', esc_html__('Logo & Favicon', 'viral-news'), 'section', 'title_tagline'),
                array('dashicons-admin-appearance', esc_html__('Header', 'viral-news'), 'panel', 'viral_news_header_setting_panel'),
                array('dashicons-admin-home', esc_html__('Front Page Sections', 'viral-news'), 'panel', 'viral_news_front_page_panel'),
                array('dashicons-art', esc_html__('Colors', 'viral-news'), 'section', 'colors'),
                array('dashicons-editor-textcolor', esc_html__('Typography', 'viral-news'), 'panel', 'viral_news_typography_panel'),
                array('dashicons-menu', esc_html__('Menus', 'viral-news'), 'panel', 'nav_menus'),
                array('dashicons-media-document', esc_html__('Single Post', 'viral-news'), 'section', 'viral_news_single_post_sec'),
                array('dashicons-share', esc_html__('Social Icons', 'viral-news'), 'section', 'viral_news_social_icons_sec'),
                array('dashicons-layout', esc_html__('Website Layout', 'viral-news'), 'section', 'viral_news_website_layout_section'),
                array('dashicons-performance', esc_html__('SEO & Performance', 'viral-news'), 'section', 'viral_news_seo_section'),
            );

            foreach ($links as $i => $link) {
                $links[$i] = array(
                    'icon' => $link[0],
                    'label' => $link[1],
                    'url' => admin_url('customize.php?autofocus[' . $link[2] . ']=' . $link[3]),
                );
            }

            return $links;
        }

        /*
         *  One-line plugin descriptions. Built on demand, not in the constructor:
         *  the class is created before init, and translating there makes
         *  WordPress load the text domain too early.
         */
        public function plugin_descriptions() {
            return array(
                'hashthemes-demo-importer' => esc_html__('Import any Viral News demo, with its content and settings, in one click.', 'viral-news'),
                'hash-form' => esc_html__('Build contact forms, surveys and quotes with drag and drop.', 'viral-news'),
                'hash-elements' => esc_html__('Elementor widgets designed by the makers of Viral News.', 'viral-news'),
                'simple-floating-menu' => esc_html__('Add a floating bar of buttons for calls, chat and social links.', 'viral-news'),
                'smart-blocks' => esc_html__('Magazine-style post blocks for the block editor.', 'viral-news'),
                'onyx-dark-mode-switcher' => esc_html__('Let visitors switch your site to dark mode.', 'viral-news'),
            );
        }

        public function erase_hide_notice() {
            delete_option('viral_news_dismissed_notices');
            delete_option('viral_news_first_activation');
        }

        /**
         * Handle a click on the dismiss button
         *
         * @return void
         */
        public function welcome_init() {
            if (!get_option('viral_news_first_activation')) {
                update_option('viral_news_first_activation', time());
            }

            if (get_option('viral_news_hide_notice') && !$this->is_dismissed('welcome')) {
                delete_option('viral_news_hide_notice');
                self::dismiss('welcome');
            }

            if (isset($_GET['viral-news-hide-notice'], $_GET['viral_news_notice_nonce'])) {
                $notice = sanitize_key($_GET['viral-news-hide-notice']);
                check_admin_referer($notice, 'viral_news_notice_nonce');
                self::dismiss($notice);
                wp_safe_redirect(remove_query_arg(array('viral-news-hide-notice', 'viral_news_notice_nonce'), wp_get_referer()));
                exit;
            }
        }


        /**
         * Renders the widgets-screen prompt, on in_admin_header as the block editor drops admin_notices.
         *
         * @return void
         */
        public function screen_notice_header() {
            if (function_exists('wp_use_widgets_block_editor') && wp_use_widgets_block_editor()) {
                $screen = get_current_screen();

                if ($screen && 'widgets' === $screen->id) {
                    return;
                }
            }

            $this->screen_notice('in_admin_header');
        }

        /**
         * Contextual prompts on the two admin screens where users run into
         * Pro-only limits - widget areas and menus.
         *
         * @param string $hook Which hook is currently rendering.
         * @return void
         */
        private function screen_notice($hook) {
            $screen = get_current_screen();

            if (!$screen) {
                return;
            }

            $screens = array(
                'widgets' => array(
                    'hook' => 'in_admin_header',
                    'placement' => 'screen-widgets',
                    'text' => esc_html__('Viral Pro adds 20+ magazine widgets and lets you create unlimited widget areas, each with its own sidebar layout.', 'viral-news')
                ),
                'nav-menus' => array(
                    'hook' => 'admin_notices',
                    'placement' => 'screen-menus',
                    'text' => esc_html__('Viral Pro adds an in-built MegaMenu and an Off Canvas menu, plus 10 menu hover styles and full menu color control.', 'viral-news')
                )
            );

            if (!isset($screens[$screen->id]) || $screens[$screen->id]['hook'] !== $hook || $this->is_dismissed('screen-' . $screen->id)) {
                return;
            }

            $notice = $screens[$screen->id];
            ?>
            <div class="viral-news-notice notice notice-info">
                <?php $this->dismiss_button('screen-' . $screen->id); ?>
                <div class="viral-news-notice-content">
                    <p><?php echo esc_html($notice['text']); ?></p>
                    <a target="_blank" class="button action" href="<?php echo esc_url(viral_news_upgrade_url($notice['placement'], 'viral-news-admin-screen')); ?>"><?php echo esc_html__('See what Viral Pro adds', 'viral-news'); ?></a>
                </div>
            </div>
            <?php
        }

        /**
         * Widgets prompt for the block-based widget editor, pushed into its core/notices store.
         * Uses add_query_arg, not wp_nonce_url, whose &amp; would break the nonce.
         *
         * @return void
         */
        public function block_widgets_notice() {
            $screen = get_current_screen();

            if (!$screen || 'widgets' !== $screen->id) {
                return;
            }

            if (!function_exists('wp_use_widgets_block_editor') || !wp_use_widgets_block_editor()) {
                return;
            }

            if ($this->is_dismissed('screen-widgets') || !wp_script_is('wp-edit-widgets', 'enqueued')) {
                return;
            }

            $dismiss_url = add_query_arg(array(
                'viral-news-hide-notice' => 'screen-widgets',
                'viral_news_notice_nonce' => wp_create_nonce('screen-widgets')
                    ), admin_url('widgets.php'));

            wp_add_inline_script('wp-edit-widgets', sprintf(
                    'wp.domReady( function () {
                        if ( ! wp.data || ! wp.data.dispatch( "core/notices" ) ) { return; }
                        wp.data.dispatch( "core/notices" ).createInfoNotice( %1$s, {
                            isDismissible: true,
                            actions: [
                                { url: %2$s, label: %3$s },
                                { url: %4$s, label: %5$s }
                            ]
                        } );
                    } );', wp_json_encode(__('Viral Pro adds 20+ magazine widgets and lets you create unlimited widget areas, each with its own sidebar layout.', 'viral-news')), wp_json_encode(viral_news_upgrade_url('screen-widgets', 'viral-news-admin-screen')), wp_json_encode(__('See what Viral Pro adds', 'viral-news')), wp_json_encode($dismiss_url), wp_json_encode(__('Don\'t show again', 'viral-news'))
            ));
        }

        /**
         * Displays an upgrade prompt once the theme has been in use for a while.
         *
         * @return void
         */
        private function upgrade_notice() {
            $screen = get_current_screen();

            if ($screen && 'toplevel_page_viral-news-welcome' === $screen->id) {
                return;
            }
            ?>
            <div class="viral-news-notice notice notice-info">
                <?php $this->dismiss_button('upgrade'); ?>
                <div class="viral-news-notice-content">
                    <p>
                        <?php
                        printf(
                            /* translators: %1$s is link start tag, %2$s is link end tag. */
                            esc_html__('You have been running this theme for a month now. %1$sViral Pro%2$s adds 50+ magazine blocks, 7 header layouts, 7 blog and 7 single post layouts, and a lot more - a one-time payment from $69, with lifetime updates and no renewal fees.', 'viral-news'), '<a style="text-decoration:none;font-weight:bold;" target="_blank" href="' . esc_url(viral_news_upgrade_url('notice-30day', 'viral-news-admin-notice')) . '">', '</a>'
                        );
                        ?>
                    </p>
                    <a target="_blank" class="button action" href="<?php echo esc_url(viral_news_upgrade_url('notice-30day-btn', 'viral-news-admin-notice')); ?>"><span class="dashicons dashicons-cart"></span><?php echo esc_html__('See Free vs Pro', 'viral-news'); ?></a> &nbsp;
                    <a class="button action" href="<?php echo esc_url(wp_nonce_url(add_query_arg('viral-news-hide-notice', 'upgrade'), 'upgrade', 'viral_news_notice_nonce')); ?>"><span class="dashicons dashicons-no"></span><?php echo esc_html__('No thanks', 'viral-news'); ?></a>
                </div>
            </div>
            <?php
        }

        /**
         * Displays a notice asking for a review
         *
         * @return void
         */
        private function review_notice() {
            ?>
            <div class="viral-news-notice notice notice-info">
                <?php $this->dismiss_button('review'); ?>
                <div class="viral-news-notice-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45.94 45.94">
                        <g>
                            <g>
                                <path d="M22.92 25.37 35.44 3.7a22.89 22.89 0 0 0-25 .06ZM2.49 12.6a22.94 22.94 0 0 0 20.23 33.33ZM22.9 45.94h.1a22.94 22.94 0 0 0 20.38-33.47Z" />
                            </g>
                        </g>
                    </svg>
                </div>

                <div class="viral-news-notice-content">
                    <p>
                    <?php
                        printf(
                            /* translators: %1$s is link start tag, %2$s is link end tag, %3$s is five stars. */
                            esc_html__('You have been using the Viral News theme for a while now, and we hope you love it. Would you %1$sgive it a %3$s rating%2$s on WordPress.org? Your review helps other people find the theme and keeps us improving it.', 'viral-news'), '<a style="text-decoration:none;font-weight:bold;" target="_blank" href="https://wordpress.org/support/theme/viral-news/reviews/?filter=5#new-post">', '</a>', '<span class="viral-news-notice-star"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></span>'
                        );
                        ?>
                    </p>
                    <a target="_blank" class="button button-primary button-large" href="https://wordpress.org/support/theme/viral-news/reviews/?filter=5#new-post"><span class="dashicons dashicons-thumbs-up"></span><?php echo esc_html__('Yes, of course', 'viral-news') ?></a> &nbsp;
                    <a class="button button-large" href="<?php echo esc_url(wp_nonce_url(add_query_arg('viral-news-hide-notice', 'review'), 'review', 'viral_news_notice_nonce')); ?>"><span class="dashicons dashicons-yes"></span><?php echo esc_html__('I have already rated', 'viral-news') ?></a>
                </div>
            </div>
            <?php
        }

        /**
         * Has a notice been dismissed?
         *
         * @param string $notice Notice name
         * @return bool
         */
        public static function is_dismissed($notice) {
            $dismissed = get_option('viral_news_dismissed_notices', array());

            // Handle legacy user meta
            $dismissed_meta = get_user_meta(get_current_user_id(), 'viral_news_dismissed_notices', true);
            if (is_array($dismissed_meta)) {
                if (array_diff($dismissed_meta, $dismissed)) {
                    $dismissed = array_merge($dismissed, $dismissed_meta);
                    update_option('viral_news_dismissed_notices', $dismissed);
                }
                if (!is_multisite()) {
                    // Don't delete on multisite to avoid the notices to appear in other sites.
                    delete_user_meta(get_current_user_id(), 'viral_news_dismissed_notices');
                }
            }

            return in_array($notice, $dismissed);
        }

        /**
         * Displays a dismiss button
         *
         * @param string $name Notice name
         * @return void
         */
        public function dismiss_button($name) {
            printf('<a class="notice-dismiss" href="%s"><span class="screen-reader-text">%s</span></a>', esc_url(wp_nonce_url(add_query_arg('viral-news-hide-notice', $name), $name, 'viral_news_notice_nonce')), esc_html__('Dismiss this notice.', 'viral-news')
            );
        }

        /**
         * Stores a dismissed notice in database
         *
         * @param string $notice
         * @return void
         */
        public static function dismiss($notice) {
            $dismissed = get_option('viral_news_dismissed_notices', array());

            if (!in_array($notice, $dismissed)) {
                $dismissed[] = $notice;
                update_option('viral_news_dismissed_notices', array_unique($dismissed));
            }
        }

    }

    new Viral_News_Welcome();

endif;
