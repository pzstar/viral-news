<?php

/** Control Tab */
class Viral_News_Tab_Control extends WP_Customize_Control {

    public $type = 'ht--tab';
    public $buttons = '';

    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
    }

    public function to_json() {
        parent::to_json();
        $first = true;
        $formatted_buttons = array();
        $all_fields = array();
        foreach ($this->buttons as $button) {
            //$fields = array();
            $active = isset($button['active']) ? $button['active'] : false;
            if ($active && $first) {
                $first = false;
            } elseif ($active && !$first) {
                $active = false;
            }

            $formatted_buttons[] = array(
                'name' => $button['name'],
                'icon' => isset($button['icon']) ? $button['icon'] : '',
                'fields' => $button['fields'],
                'active' => $active,
            );
            $all_fields = array_merge($all_fields, $button['fields']);
        }
        $this->json['buttons'] = $formatted_buttons;
        $this->json['fields'] = $all_fields;
    }

    public function content_template() {
        ?>
        <div class="ht--customizer-tab-wrap">
            <# if ( data.buttons ) { #>
            <div class="ht--customizer-tabs">
                <# for (tab in data.buttons) { #>
                <a href="#" class="ht--customizer-tab <# if ( data.buttons[tab].active ) { #> active <# } #>" data-tab="{{ tab }}">
                    <# if ( data.buttons[tab].icon ) { #>
                    <span class="{{ data.buttons[tab].icon }}"></span>
                    <# } #>
                    {{ data.buttons[tab].name }}
                </a>
                <# } #>
            </div>
            <# } #>
        </div>
        <?php
    }

}
