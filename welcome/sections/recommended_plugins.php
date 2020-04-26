<?php
$free_plugins = $this->free_plugins;

if (!empty($free_plugins)) {
    ?>
    <h4 class="recomplug-title"><?php echo esc_html__('Recommended Plugins', 'viral-news'); ?></h4>
    <p><?php echo esc_html__('Please install these plugins. These plugins are complementary only and add more feature to theme.', 'viral-news'); ?></p>
    <div class="recomended-plugin-wrap">
        <?php
        foreach ($free_plugins as $plugin) {
            $slug = $plugin['slug'];
            $name = $plugin['name'];
            $filename = $plugin['filename'];
            ?>
            <div class="recom-plugin-wrap">
                <div class="plugin-img-wrap">
                    <img src="<?php echo esc_url($this->viral_news_plugin_thumb($slug)) ?>" />
                </div>

                <div class="plugin-title-install clearfix">
                    <span class="title">
                        <?php echo esc_html($name); ?>	
                    </span>

                    <span class="plugin-btn-wrapper">
                        <?php if ($this->viral_news_check_installed_plugin($slug, $filename) && !$this->viral_news_check_plugin_active_state($slug, $filename)) : ?>
                            <a target="_blank" href="<?php echo esc_url($this->viral_news_plugin_generate_url('active', $slug, $filename)) ?>" class="button button-primary"><?php esc_html_e('Activate', 'viral-news'); ?></a>
                        <?php elseif ($this->viral_news_check_installed_plugin($slug, $filename)) :
                            ?>
                            <button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e('Installed', 'viral-news'); ?></button>
                        <?php else :
                            ?>
                            <a target="_blank" class="install-now button-primary" href="<?php echo esc_url($this->viral_news_plugin_generate_url('install', $slug, $filename)) ?>" >
                                <?php esc_html_e('Install Now', 'viral-news'); ?></a>							
                            <?php endif; ?>
                    </span>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
}