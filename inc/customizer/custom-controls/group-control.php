<?php

/** Control Tab */
class Viral_News_Group_Control extends WP_Customize_Control {

    public $type = 'ht--group';
    public $params = '';

    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
        if (isset($args['params'])) {
            $this->params = $args['params'];
        }
    }

    public function to_json() {
        parent::to_json();
        $params = $this->params;

        $this->json['heading'] = $params['heading'];
        $this->json['icon'] = $params['icon'];
        $this->json['fields'] = $params['fields'];
        $this->json['open'] = $params['open'];
    }

    public function content_template() {
        ?>
        <div class="ht--group-wrap">
            <div class="ht--group-heading">
                <# if ( data.heading ) { #>
                <label>{{{ data.heading }}}</label>
                <# } #>
            </div>

            <div class="ht--group-content"></div>
        </div>
        <?php
    }

}
