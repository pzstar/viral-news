<?php

/** Icon Chooser */
class Viral_News_Icon_Selector_Control extends WP_Customize_Control {

    public $type = 'ht--icon-selector';
    //See customizer-fonts-icon.php file
    public $icon_array = array();

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['icon_array'])) {
            $this->icon_array = array_map(array($this, 'wp_parse_args'), $args['icon_array']);
        }
        parent::__construct($manager, $id, $args);
    }

    public function to_json() {
        parent::to_json();
        $this->json['filter_text'] = esc_attr__('Type to filter', 'viral-news');
        $this->json['value'] = $this->value();
        $this->json['link'] = $this->get_link();
        $this->json['icon_array'] = $this->icon_array;
    }

    public function wp_parse_args($icon_array) {
        return wp_parse_args($icon_array, array(
            'name' => '',
            'label' => '',
            'prefix' => '',
            'displayPrefix' => '',
            'url' => '',
            'icons' => array()
        ));
    }

    public function content_template() {
        ?>
        <label>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                {{{ data.label }}}
            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">
                {{{ data.description }}}
            </span>
            <# } #>


            <div class="ht--icon-box-wrap">
                <div class="ht--selected-icon">
                    <i class="{{ data.value }}"></i>
                    <span><i class="ht--down-icon"></i></span>
                </div>

                <# if ( !_.isEmpty(data.icon_array) ) { #>
                <div class="ht--icon-box">
                    <div class="ht--icon-search">
                        <# if ( _.size(data.icon_array)> 1 ) { #>
                        <select>
                            <# _.each( data.icon_array, function( val ) { #>
                            <# if (val['name'] && val['label']) { #>
                            <option value="{{ val['name'] }}">{{{ val['label'] }}}</option>
                            <# } #>
                            <# } ) #>
                        </select>
                        <# } #>
                        <input type="text" class="ht--icon-search-input" placeholder="{{ data.filter_text }}" />
                    </div>


                    <# var index=0; _.each( data.icon_array, function( val ) { #>
                    <ul class="ht--icon-list {{val['name']}} <# if( index == 0 ){ #>active<# } #>">
                        <# if (_.isArray(val['icons'])) { #>
                        <# _.each( val['icons'], function( icon ) { #>
                        <li class='<# if ( icon === data.value ) { #> icon-active <# } #>'><i class="{{val['displayPrefix']}} {{val['prefix']}}{{icon}}"></i></li>
                        <# } ) #>
                        <# } #>
                    </ul>
                    <# index++; } ) #>
                </div>
                <# } #>
                <input type="hidden" value="{{ data.value }}" {{{ data.link }}} />
            </div>
        </div>
        </label>
        <?php
    }

}
