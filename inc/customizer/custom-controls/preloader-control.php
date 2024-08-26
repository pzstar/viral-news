<?php

/** Image Select Control */
class Viral_News_Preloader_Selector_Control extends WP_Customize_Control {

    public $type = 'select';

    public function __construct($manager, $id, $args = array(), $choices = array()) {
        $this->choices = $args['choices'];
        $this->file_path = $args['file_path'];
        parent::__construct($manager, $id, $args);
    }

    public function render_content() {
        if (!empty($this->choices)) {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <select class="ht--preloader-selector" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $key => $choice) {
                        printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($key), selected($this->value(), $key, false), esc_html($choice));
                    }
                    ?>
                </select>

                <div class="ht--preloader-container">
                    <?php
                    foreach ($this->choices as $key => $choice) {
                        $style = ($this->value() != $key) ? 'style="display:none"' : '';
                        echo '<div class="ht--preloader ht--' . $key . '" ' . $style . '>';
                        $preloader_path = trailingslashit($this->file_path) . $key . '.php';
                        if (file_exists($preloader_path)) {
                            require_once $preloader_path;
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
                </div>
            </label>
            <?php
        }
    }

}
