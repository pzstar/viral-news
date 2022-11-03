<?php

/** Editor Control */
class Viral_News_Editor_Control extends WP_Customize_Control {

    /**
     * Flag to do action admin_print_footer_scripts.
     * This needs to be true only for one instance.
     *
     * @var bool|mixed
     */
    private $include_admin_print_footer = false;

    /**
     * Viral_News_Page_Editor constructor.
     *
     * @param WP_Customize_Manager $manager Manager.
     * @param string               $id Id.
     * @param array                $args Constructor args.
     */
    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);

        if (!empty($args['include_admin_print_footer'])) {
            $this->include_admin_print_footer = $args['include_admin_print_footer'];
        }
    }

    /**
     * Render the content on the theme customizer page
     */
    public function render_content() {
        ?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea($this->value()); ?>">
        <?php
        $settings = array(
            'textarea_name' => $this->id,
            'teeny' => true,
            'textarea_rows' => 6,
            'media_buttons' => false
        );

        $page_content = $this->value();

        wp_editor($page_content, $this->id, $settings);

        if ($this->include_admin_print_footer === true) {
            do_action('admin_print_footer_scripts');
        }
    }

}
