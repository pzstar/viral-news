<?php
if (class_exists('WP_Customize_Section')) {

    /* The upgrade card at the top of the Customizer. */
    class Viral_News_Pro_Banner_Section extends WP_Customize_Section {

        public $type = 'ht--pro-banner';
        public $badge = '';
        public $points = array();
        public $price = '';
        public $price_prefix = '';
        public $price_note = '';
        public $upgrade_text = '';
        public $upgrade_url = '';
        public $note = '';
        public $is_sale = false;

        public function json() {
            $json = parent::json();

            foreach (array('badge', 'points', 'price', 'price_prefix', 'price_note', 'upgrade_text', 'upgrade_url', 'note', 'is_sale') as $key) {
                $json[$key] = $this->$key;
            }

            return $json;
        }

        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand<# if ( data.is_sale ) { #> is-sale<# } #>">
                <div class="ht--pro-banner">
                    <# if ( data.badge || data.note ) { #>
                    <div class="ht--pro-banner-top">
                        <# if ( data.badge ) { #><span class="ht--pro-banner-badge">{{ data.badge }}</span><# } #>
                        <# if ( data.note ) { #><span class="ht--pro-banner-note">{{ data.note }}</span><# } #>
                    </div>
                    <# } #>

                    <# if ( data.title ) { #>
                    <h3 class="ht--pro-banner-title">{{ data.title }}</h3>
                    <# } #>

                    <# if ( data.upgrade_text && data.upgrade_url ) { #>
                    <a href="{{ data.upgrade_url }}" class="ht--pro-banner-button" target="_blank"<# if ( data.price_note ) { #> title="{{ data.price_note }}"<# } #>>{{ data.upgrade_text }}<# if ( data.price ) { #> <span class="ht--pro-banner-button-price"><# if ( data.price_prefix ) { #>{{ data.price_prefix }} <# } #>{{ data.price }}</span><# } #><span class="dashicons dashicons-arrow-right-alt" aria-hidden="true"></span></a>
                    <# } #>
                </div>
            </li>
            <?php
        }

    }

}
