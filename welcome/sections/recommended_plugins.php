<?php
$free_plugins = $this->free_plugins;

if (!empty($free_plugins)) {
    ?>
    <h3><?php echo esc_html__('Recommended Plugins', 'viral-news'); ?></h3>
    <p><?php echo esc_html__('Please install these free plugins. These plugins are complementary that adds more features to the theme.', 'viral-news'); ?></p>
    <div class="recomended-plugin-wrap">
        <?php
        foreach ($free_plugins as $plugin) {
            $slug = $plugin['slug'];
            $name = $plugin['name'];
            $filename = $plugin['filename'];
            $thumb = $plugin['thumb_path'];
            ?>
            <div class="recommended-plugins">
                <div class="plugin-image">
                    <img src="<?php echo esc_url($thumb) ?>" />
                </div>

                <div class="plugin-title-wrap">
                    <div class="plugin-title">
                        <?php echo esc_html($name); ?>
                    </div>

                    <div class="plugin-btn-wrapper">
                        <?php if ($this->check_plugin_installed_state($slug, $filename) && !$this->check_plugin_active_state($slug, $filename)): ?>
                            <a target="_blank" href="<?php echo esc_url($this->plugin_generate_url('active', $slug, $filename)) ?>" class="button button-primary"><?php esc_html_e('Activate', 'viral-news'); ?></a>
                        <?php elseif ($this->check_plugin_installed_state($slug, $filename)):
                            ?>
                            <button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e('Installed', 'viral-news'); ?></button>
                        <?php else:
                            ?>
                            <a target="_blank" class="install-now button-primary" href="<?php echo esc_url($this->plugin_generate_url('install', $slug, $filename)) ?>">
                                <?php esc_html_e('Install Now', 'viral-news'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
}