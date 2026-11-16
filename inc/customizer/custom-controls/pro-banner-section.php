<?php
if (class_exists('WP_Customize_Section')) {

    /*
     *  The upgrade card at the top of the Customizer.
     *
     *  Its own section type rather than another use of Viral_News_Upgrade_Section:
     *  that one is a single row (label + button) and is reused for the locked
     *  "Get Pro" rows, while this card carries a badge, selling points, the
     *  price and a guarantee line.
     */
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
                    <# if ( data.badge ) { #>
                    <span class="ht--pro-banner-badge">{{ data.badge }}</span>
                    <# } #>

                    <# if ( data.title ) { #>
                    <h3 class="ht--pro-banner-title">{{ data.title }}</h3>
                    <# } #>

                    <# if ( data.points.length ) { #>
                    <ul class="ht--pro-banner-points">
                        <# _.each( data.points, function( point ) { #>
                        <li>{{ point }}</li>
                        <# } ) #>
                    </ul>
                    <# } #>

                    <# if ( data.price ) { #>
                    <p class="ht--pro-banner-price"><# if ( data.price_prefix ) { #><span>{{ data.price_prefix }}</span> <# } #><strong>{{ data.price }}</strong> <span>{{ data.price_note }}</span></p>
                    <# } #>

                    <# if ( data.upgrade_text && data.upgrade_url ) { #>
                    <a href="{{ data.upgrade_url }}" class="ht--pro-banner-button" target="_blank">{{ data.upgrade_text }}<span class="dashicons dashicons-arrow-right-alt" aria-hidden="true"></span></a>
                    <# } #>

                    <# if ( data.note ) { #>
                    <p class="ht--pro-banner-note"><span class="dashicons dashicons-shield" aria-hidden="true"></span>{{ data.note }}</p>
                    <# } #>
                </div>
            </li>
            <?php
        }

    }

}
