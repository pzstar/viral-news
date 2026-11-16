<?php
$free_plugins = $this->free_plugins;
$plugin_descriptions = $this->plugin_descriptions();

if (!empty($free_plugins)) {
    ?>
    <div class="welcome-block-head">
        <h3><?php echo esc_html__('Recommended Plugins', 'viral-news'); ?></h3>
    </div>
    <p class="welcome-block-intro"><?php echo esc_html__('These free plugins are made to work with Viral News and add more features to your site. Install the ones you need.', 'viral-news'); ?></p>

    <div class="welcome-grid welcome-grid-3">
        <?php
        foreach ($free_plugins as $plugin) {
            $slug = $plugin['slug'];
            $filename = $plugin['filename'];
            $installed = $this->check_plugin_installed_state($slug, $filename);
            $active = $installed && $this->check_plugin_active_state($slug, $filename);

            if ($active) {
                $status = array('is-active', esc_html__('Active', 'viral-news'));
            } elseif ($installed) {
                $status = array('is-inactive', esc_html__('Inactive', 'viral-news'));
            } else {
                $status = array('is-missing', esc_html__('Not installed', 'viral-news'));
            }
            ?>
            <div class="welcome-card welcome-plugin">
                <div class="welcome-plugin-head">
                    <img src="<?php echo esc_url($plugin['thumb_path']); ?>" alt="" loading="lazy" />
                    <div>
                        <h4><?php echo esc_html($plugin['name']); ?></h4>
                        <span class="welcome-status <?php echo esc_attr($status[0]); ?>"><?php echo esc_html($status[1]); ?></span>
                    </div>
                </div>

                <?php if (!empty($plugin_descriptions[$slug])) { ?>
                    <p><?php echo esc_html($plugin_descriptions[$slug]); ?></p>
                <?php } ?>

                <div class="welcome-plugin-action">
                    <?php if ($active) { ?>
                        <button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e('Installed', 'viral-news'); ?></button>
                    <?php } elseif ($installed) { ?>
                        <a href="<?php echo esc_url($this->plugin_generate_url('active', $slug, $filename)); ?>" class="button button-primary"><?php esc_html_e('Activate', 'viral-news'); ?></a>
                    <?php } else { ?>
                        <a class="install-now button button-primary" href="<?php echo esc_url($this->plugin_generate_url('install', $slug, $filename)); ?>"><?php esc_html_e('Install Now', 'viral-news'); ?></a>
                    <?php } ?>
                    <a class="welcome-plugin-more" href="<?php echo esc_url('https://wordpress.org/plugins/' . $slug . '/'); ?>" target="_blank"><?php esc_html_e('Details', 'viral-news'); ?></a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}
