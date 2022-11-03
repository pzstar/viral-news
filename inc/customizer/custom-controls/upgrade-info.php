<?php

// Upgrade Text
class Viral_News_Upgrade_Info_Control extends WP_Customize_Control {

    public $type = 'ht--upgrade-info';

    public function render_content() {
        if ($this->label) {
            ?>
            <label>
                <span class="dashicons dashicons-info"></span>

                <span>
                    <?php echo wp_kses_post($this->label); ?>
                </span>

                <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade'); ?>" target="_blank"> <strong><?php echo esc_html__('Upgrade to PRO', 'viral-news'); ?></strong></a>
            </label>
        <?php } ?>

        <?php if ($this->description) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php
        }

        $choices = $this->choices;
        if ($choices) {
            echo '<ul>';
            foreach ($choices as $choice) {
                echo '<li>' . esc_html($choice) . '</li>';
            }
            echo '</ul>';
        }
    }

}
