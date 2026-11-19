<?php

/** Taxonomy Select Control */
class Viral_News_Taxonomy_Select_Control extends WP_Customize_Control {

    public $type = 'ht--select-taxonomy';
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

        <ul>
            <select <?php $this->link(); ?>>
                <option value="-1" <?php selected((!$this->value() || $this->value() == -1), true); ?>><?php echo esc_html__('All', 'viral-news'); ?></option>
                <?php
                $args = array(
                    'taxonomy' => $this->taxonomy,
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hierarchical' => 0,
                    'hide_empty' => 0,
                );
                $all_categories = get_terms($args);
                $cat_ids = [];

                if (!empty($all_categories)) {
                    foreach ($all_categories as $cat) {
                        $cat_ids[] = $cat->term_id;
                    }
                }
                echo viral_news_get_dropdown_indent(0, $all_categories, array($this->value()), $cat_ids);
                ?>
            </select>
        </ul>
        <?php
    }

}
