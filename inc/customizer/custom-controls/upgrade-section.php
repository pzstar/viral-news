<?php
if (class_exists('WP_Customize_Section')) {

    class Viral_News_Upgrade_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'ht--upgrade-section';
        public $class = '';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $upgrade_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $upgrade_url = '';
        public $options = array();

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['upgrade_text'] = $this->upgrade_text;
            $json['upgrade_url'] = $this->upgrade_url;
            $json['options'] = $this->options;
            $json['class'] = $this->class;

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand {{data.class}}">
                <# if ( _.isEmpty(data.options) ) { #>
                <h3 class="accordion-section-title">
                    <# if ( data.title ) { #>
                    {{{ data.title }}}
                    <# } #>
                    <# if ( data.upgrade_text && data.upgrade_url ) { #>
                    <a href="{{ data.upgrade_url }}" class="button button-primary" target="_blank">{{ data.upgrade_text }}</a>
                    <# } #>
                </h3>
                <# }else{ #>
                <label>
                    <# if ( data.title ) { #>
                    {{ data.title }}
                    <# } #>
                </label>

                <# _.each( data.options, function(key, value) { #>
                {{ key }}<br />
                <# }) #>

                <# if ( data.upgrade_text && data.upgrade_url ) { #>
                <a href="{{ data.upgrade_url }}" class="button button-primary" target="_blank">{{ data.upgrade_text }}</a>
                <# } #>
                <# } #>
            </li>
            <?php
        }

    }

}
