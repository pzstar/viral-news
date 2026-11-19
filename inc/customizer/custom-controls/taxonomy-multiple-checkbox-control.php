<?php

/** Multiple Checkbox Control */
class Viral_News_Taxonomy_Multiple_Checkbox_Control extends WP_Customize_Control {

    public $type = 'ht--checkbox-multiple-taxonomy';

    public $taxonomy = 'category';

    public function render_content() {
        ?>

        <span class="customize-control-title">
            <?php echo esc_html($this->label); ?>
        </span>

        <?php if ($this->description) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php } ?>

        <?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>

        <ul class="ht--taxonomy-checkbox">
            <?php
            $args = array(
                'selected_cats' => $multi_values,
                'taxonomy' => $this->taxonomy,
                'show_count' => true
            );
            viral_news_terms_checklist(0, $args);
            ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
        <?php
    }

}
