<?php

// Upgrade Text
class Viral_News_Upgrade_Info_Control extends WP_Customize_Control {

    public $type = 'ht--upgrade-info';
    public $upgrade_url = '';
    public $upgrade_text = '';

    /**
     * Value line shown under the feature list, only when the control links somewhere. False hides it.
     */
    public $upgrade_note = '';

    public function render_content() {
        if ($this->label) {
            ?>
            <label>
                <span class="dashicons dashicons-info"></span>

                <span>
                    <?php echo wp_kses_post($this->label); ?>
                </span>

                <a href="<?php echo esc_url($this->upgrade_url); ?>" target="_blank"> <strong><?php echo esc_html($this->upgrade_text); ?></strong></a>
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

        if ($this->upgrade_url && false !== $this->upgrade_note) {
            $note = $this->upgrade_note ? $this->upgrade_note : apply_filters('viral_news_upgrade_note', esc_html__('One-time payment, lifetime updates, no renewal fees.', 'viral-news'));
            echo '<p class="ht--upgrade-note">' . esc_html($note) . '</p>';
        }
    }

}
