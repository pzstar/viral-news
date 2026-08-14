<?php

/**
 * Locked Pro layout previews.
 *
 * Shows the actual layout thumbnails a user is missing rather than describing
 * them in a bullet list. Rendered under the free layout picker, where the user
 * is already choosing a layout and the gap is most obvious.
 */
class Viral_News_Pro_Preview_Control extends WP_Customize_Control {

    public $type = 'ht--pro-preview';
    public $upgrade_url = '';
    public $upgrade_text = '';

    /** Image filenames relative to the theme's images/pro/ directory. */
    public $images = array();

    /** Rendered as a trailing "+N more" tile. */
    public $more_count = 0;

    /** Thumbnails per row. Wide artwork needs fewer columns to stay legible. */
    public $columns = 3;

    public function render_content() {
        if (empty($this->images)) {
            return;
        }

        $base = get_template_directory_uri() . '/images/pro/';
        $columns = (2 === (int) $this->columns) ? ' ht--cols-2' : '';
        ?>
        <div class="ht--pro-preview">
            <?php if ($this->label) { ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php } ?>

            <div class="ht--pro-preview-grid<?php echo esc_attr($columns); ?>">
                <?php foreach ($this->images as $image) { ?>
                    <a class="ht--pro-preview-item" href="<?php echo esc_url($this->upgrade_url); ?>" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url($base . $image); ?>" alt="">
                        <span class="ht--pro-preview-lock dashicons dashicons-lock"></span>
                    </a>
                <?php } ?>

                <?php if ($this->more_count > 0) { ?>
                    <a class="ht--pro-preview-item ht--pro-preview-more" href="<?php echo esc_url($this->upgrade_url); ?>" target="_blank" rel="noopener">
                        <span><?php
                            /* translators: %d: number of additional layouts available in the premium version */
                            printf(esc_html__('+%d more', 'viral-news'), absint($this->more_count));
                            ?></span>
                    </a>
                <?php } ?>
            </div>

            <?php if ($this->upgrade_text) { ?>
                <a class="button button-primary ht--pro-preview-btn" href="<?php echo esc_url($this->upgrade_url); ?>" target="_blank" rel="noopener"><?php echo esc_html($this->upgrade_text); ?></a>
            <?php } ?>
        </div>
        <?php
    }

}
