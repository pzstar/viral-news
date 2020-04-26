<?php
if (!class_exists('Viral_News_Welcome')) :

    class Viral_News_Welcome {

        public $tab_sections = array();
        public $theme_name = ''; // For storing Theme Name
        public $theme_version = ''; // For Storing Theme Current Version Information
        public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins
        public $pro_plugins = array(); // For Storing the list of the Recommended Pro Plugins

        /**
         * Constructor for the Welcome Screen
         */

        public function __construct() {

            /** Useful Variables * */
            $theme = wp_get_theme();
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;
            $this->theme_desc = $theme->Description;

            /** Define Tabs Sections * */
            $this->tab_sections = array(
                'getting_started' => esc_html__('Getting Started', 'viral-news'),
                'recommended_plugins' => esc_html__('Recommended Plugins', 'viral-news'),
                'support' => esc_html__('Support', 'viral-news'),
                'free_vs_pro' => esc_html__('Free Vs Pro', 'viral-news'),
            );

            /** List of Recommended Free Plugins * */
            $this->free_plugins = array(
                'simple-floating-menu' => array(
                    'name' => 'Simple Floating Menu',
                    'slug' => 'simple-floating-menu',
                    'filename' => 'simple-floating-menu'
                ),
                'instagram-feed' => array(
                    'name' => 'Smash Balloon Instagram Feed',
                    'slug' => 'instagram-feed',
                    'filename' => 'instagram-feed'
                ),
                'hashthemes-demo-importer' => array(
                    'name' => 'HashThemes Demo Importer',
                    'slug' => 'hashthemes-demo-importer',
                    'filename' => 'hashthemes-demo-importer'
                )
            );

            /** List of Recommended Pro Plugins * */
            $this->pro_plugins = array();

            /* Theme Activation Notice */
            add_action('admin_notices', array($this, 'viral_news_activation_admin_notice'));

            add_filter('admin_footer_text', array($this, 'viral_news_admin_footer_text'));

            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'viral_news_welcome_register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'viral_news_welcome_styles_and_scripts'));

            add_action('wp_ajax_viral_news_activate_plugin', array($this, 'viral_news_activate_plugin'));
        }

        /** Welcome Message Notification on Theme Activation * */
        public function viral_news_activation_admin_notice() {
            global $pagenow;

            if (is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated']))) {
                ?>
                <div class="notice notice-success is-dismissible"> 
                    <p><?php echo sprintf(esc_html__('Welcome! Thank you for choosing %1$s. Please make sure you visit Settings Page to get started with %1$s theme.', 'viral-news'), $this->theme_name, $this->theme_name); ?></p>
                    <p><a class="button button-primary" href="<?php echo admin_url('/themes.php?page=viral-news-welcome') ?>"><?php echo esc_html__('Let\'s Get Started', 'viral-news'); ?></a></p>
                </div>
                <?php
            }
        }

        /** Register Menu for Welcome Page * */
        public function viral_news_welcome_register_menu() {
            add_theme_page(esc_html__('Welcome', 'viral-news'), sprintf(esc_html__('%s Settings', 'viral-news'), $this->theme_name), 'edit_theme_options', 'viral-news-welcome', array($this, 'viral_news_welcome_screen'));
        }

        /** Welcome Page * */
        public function viral_news_welcome_screen() {
            $tabs = $this->tab_sections;
            ?>
            <div class="wrap about-wrap access-wrap">
                <div class="abt-promo-wrap clearfix">
                    <div class="abt-theme-wrap">
                        <h1><?php
                            printf(// WPCS: XSS OK.
                                    /* translators: 1-theme name, 2-theme version */
                                    esc_html__('Welcome to %1$s - Version %2$s', 'viral-news'), $this->theme_name, $this->theme_version);
                            ?></h1>
                        <div class="about-text"><?php echo $this->theme_desc; ?></div>
                    </div>

                    <div class="promo-banner-wrap">
                        <p><?php esc_html_e('Upgrade for $59', 'viral-news'); ?></p>
                        <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-welcome&utm_campaign=viral-news-upgrade'); ?>" target="_blank" class="button button-primary upgrade-btn"><?php echo esc_html__('Upgrade Now', 'viral-news'); ?></a>
                        <a class="promo-offer-text" href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-welcome&utm_campaign=viral-news-upgrade'); ?>" target="_blank"><?php echo esc_html__('Unlock all the possibitlies with Viral Pro.', 'viral-news'); ?></a>
                    </div>
                </div>

                <div class="nav-tab-wrapper clearfix">
                    <?php foreach ($tabs as $id => $label) : ?>
                        <?php
                        $section = isset($_GET['section']) ? $_GET['section'] : 'getting_started'; // Input var okay.
                        $nav_class = 'nav-tab';
                        if ($id == $section) {
                            $nav_class .= ' nav-tab-active';
                        }
                        ?>
                        <a href="<?php echo esc_url(admin_url('themes.php?page=viral-news-welcome&section=' . $id)); ?>" class="<?php echo esc_attr($nav_class); ?>" >
                            <?php echo esc_html($label); ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="welcome-section-wrapper">
                    <?php $section = isset($_GET['section']) ? $_GET['section'] : 'getting_started'; // Input var okay.  ?>

                    <div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
                        <?php require_once get_template_directory() . '/welcome/sections/' . $section . '.php'; ?>
                    </div>
                </div>
            </div>
            <?php
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page * */
        public function viral_news_welcome_styles_and_scripts($hook) {
            if ('appearance_page_viral-news-welcome' == $hook) {
                $importer_params = array(
                    'installing_text' => esc_html__('Installing Demo Importer Plugin', 'viral-news'),
                    'activating_text' => esc_html__('Activating Demo Importer Plugin', 'viral-news'),
                    'importer_page' => esc_html__('Go to Demo Importer Page', 'viral-news'),
                    'importer_url' => admin_url('themes.php?page=hdi-demo-importer'),
                    'error' => esc_html__('Error! Reload the page and try again.', 'viral-news'),
                );
                wp_enqueue_style('viral-news-welcome', get_template_directory_uri() . '/welcome/css/welcome.css', array(), VIRAL_NEWS_VERSION);
                wp_enqueue_style('plugin-install');
                wp_enqueue_script('plugin-install');
                wp_enqueue_script('updates');
                wp_enqueue_script('viral-news-welcome', get_template_directory_uri() . '/welcome/js/welcome.js', array(), VIRAL_NEWS_VERSION);
                wp_localize_script('viral-news-welcome', 'importer_params', $importer_params);
            }
        }

        // Check if plugin is installed
        public function viral_news_check_installed_plugin($slug, $filename) {
            return file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php') ? true : false;
        }

        // Check if plugin is activated
        public function viral_news_check_plugin_active_state($slug, $filename) {
            return is_plugin_active($slug . '/' . $filename . '.php') ? true : false;
        }

        /** Generate Url for the Plugin Button * */
        public function viral_news_plugin_generate_url($status, $slug, $file_name) {
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

        public function viral_news_activate_plugin() {
            $slug = isset($_POST['slug']) ? $_POST['slug'] : '';
            $file = isset($_POST['file']) ? $_POST['file'] : '';
            $success = false;

            if (!empty($slug) && !empty($file)) {
                $result = activate_plugin($slug . '/' . $file . '.php');

                if (!is_wp_error($result)) {
                    $success = true;
                }
            }
            echo wp_json_encode(array('success' => $success));
            die();
        }

        public function viral_news_admin_footer_text($text) {
            $screen = get_current_screen();

            if ('appearance_page_viral-news-welcome' == $screen->id) {
                $text = sprintf(esc_html__('Please leave us a %s rating if you like our theme . A huge thank you from HashThemes in advance!', 'viral-news'), '<a href="https://wordpress.org/support/theme/viral-news/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>');
            }

            return $text;
        }

        public function viral_news_plugin_thumb($plugin_slug = '') {
            if (!empty($plugin_slug)) {
                $image_url = "";
                $image_types = array('icon.svg', 'icon-256x256.png', 'icon-256x256.jpg', 'icon-128x128.png', 'icon-128x128.jpg');

                foreach ($image_types as $image_type) {
                    $image_url = 'https://ps.w.org/' . $plugin_slug . '/assets/' . $image_type;
                    if ($this->viral_img_exist($image_url)) {
                        return $image_url;
                    }
                }
            }
        }

        public function viral_img_exist($url = NULL) {
            if (!$url)
                return FALSE;

            $headers = get_headers($url);
            return stripos($headers[0], "200 OK") ? TRUE : FALSE;
        }

    }

    new Viral_News_Welcome();

endif;
