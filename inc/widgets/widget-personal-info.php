<?php
/**
 * @package Viral News
 */
add_action('widgets_init', 'viral_news_register_personal_info');

function viral_news_register_personal_info() {
    register_widget('viral_news_personal_info');
}

class viral_news_personal_info extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'viral_news_personal_info', 'Viral News : Personal Info', array(
                'description' => esc_html__('A widget to display Personal Information', 'viral-news')
            )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'viral_news_widgets_name' => 'title',
                'viral_news_widgets_title' => esc_html__('Title', 'viral-news'),
                'viral_news_widgets_field_type' => 'text',
            ),
            'image' => array(
                'viral_news_widgets_name' => 'image',
                'viral_news_widgets_title' => esc_html__('Image', 'viral-news'),
                'viral_news_widgets_field_type' => 'upload',
            ),
            'intro' => array(
                'viral_news_widgets_name' => 'intro',
                'viral_news_widgets_title' => esc_html__('Short Intro', 'viral-news'),
                'viral_news_widgets_field_type' => 'textarea',
                'viral_news_widgets_row' => '4'
            ),
            'signature' => array(
                'viral_news_widgets_name' => 'name',
                'viral_news_widgets_title' => esc_html__('Name', 'viral-news'),
                'viral_news_widgets_field_type' => 'text',
            )
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $title = isset($instance['title']) ? $instance['title'] : '';
        $image = isset($instance['image']) ? $instance['image'] : '';
        $intro = isset($instance['intro']) ? $instance['intro'] : '';
        $name = isset($instance['name']) ? $instance['name'] : '';

        echo $before_widget;
        ?>
        <div class="vn-personal-info">
            <?php
            if (!empty($title)):
                echo $before_title . esc_html($title) . $after_title;
            endif;

            if (!empty($image)):
                $image_id = attachment_url_to_postid($image);
                if ($image_id) {
                    $image_array = wp_get_attachment_image_src($image_id, 'thumbnail');
                    echo '<div class="vn-pi-image"><img alt="' . esc_html($title) . '" src="' . esc_url($image_array[0]) . '"/></div>';
                } else {
                    echo '<div class="vn-pi-image"><img alt="' . esc_html($title) . '" src="' . esc_url($image) . '"/></div>';
                }
            endif;

            if (!empty($name)):
                echo '<div class="vn-pi-name"><span>' . esc_html($name) . '</span></div>';
            endif;

            if (!empty($intro)):
                echo '<div class="vn-pi-intro">' . esc_html($intro) . '</div>';
            endif;
            ?>
        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	viral_news_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$viral_news_widgets_name] = viral_news_widgets_updated_field_value($widget_field, $new_instance[$viral_news_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	viral_news_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $viral_news_widgets_field_value = !empty($instance[$viral_news_widgets_name]) ? esc_attr($instance[$viral_news_widgets_name]) : '';
            viral_news_widgets_show_widget_field($this, $widget_field, $viral_news_widgets_field_value);
        }
    }

}
