<?php
/**
 * @package Viral News
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function viral_news_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $website_layout = get_theme_mod('viral_news_website_layout');
    if ($website_layout == 'boxed') {
        $classes[] = 'vl-boxed';
    }

    return $classes;
}

add_filter('body_class', 'viral_news_body_classes');

if (!function_exists('viral_news_excerpt')) {

    function viral_news_excerpt($content, $letter_count) {
        $content = strip_shortcodes($content);
        $content = strip_tags($content);
        $content = mb_substr($content, 0, $letter_count);

        if (strlen($content) == $letter_count) {
            $content .= "...";
        }
        return $content;
    }

}

add_filter('wp_page_menu_args', 'viral_news_change_wp_page_menu_args');

if (!function_exists('viral_news_change_wp_page_menu_args')) {

    function viral_news_change_wp_page_menu_args($args) {
        $args['menu_class'] = 'vl-menu vl-clearfix';
        return $args;
    }

}

if (!function_exists('viral_news_filter_archive_title')) {

    function viral_news_filter_archive_title($title) {
        if (is_category()) {
            $title = single_cat_title('', false);
        }
        return $title;
    }

}

add_filter('get_the_archive_title', 'viral_news_filter_archive_title');

if (!function_exists('viral_news_comment')) {

    function viral_news_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'parent' : '', $comment); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                    <?php echo sprintf('<b class="fn">%s</b>', get_comment_author_link($comment)); ?>
                </div><!-- .comment-author -->

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'viral-news'); ?></p>
                <?php endif; ?>
                <?php edit_comment_link(esc_html__('Edit', 'viral-news'), '<span class="edit-link">', '</span>'); ?>
            </footer><!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <div class="comment-metadata vl-clearfix">
                <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                    <time datetime="<?php comment_time('c'); ?>">
                        <?php
                        /* translators: 1: comment date, 2: comment time */
                        printf(esc_html__('%1$s at %2$s', 'viral-news'), get_comment_date('', $comment), get_comment_time());
                        ?>
                    </time>
                </a>

                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'before' => '<div class="reply">',
                    'after' => '</div>'
                )));
                ?>
            </div><!-- .comment-metadata -->
        </article><!-- .comment-body -->
        <?php
    }

}

add_filter('get_custom_logo', 'viral_news_remove_itemprop');

function viral_news_remove_itemprop() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>', esc_url(home_url('/')), wp_get_attachment_image($custom_logo_id, 'full', false, array(
        'class' => 'custom-logo',
            ))
    );
    return $html;
}

if (!function_exists('viral_news_font_awesome_icon_array')) {

    function viral_news_font_awesome_icon_array() {
        return array("fa fa-glass", "fa fa-music", "fa fa-search", "fa fa-envelope-o", "fa fa-heart", "fa fa-star", "fa fa-star-o", "fa fa-user", "fa fa-film", "fa fa-th-large", "fa fa-th", "fa fa-th-list", "fa fa-check", "fa fa-remove", "fa fa-close", "fa fa-times", "fa fa-search-plus", "fa fa-search-minus", "fa fa-power-off", "fa fa-signal", "fa fa-gear", "fa fa-cog", "fa fa-trash-o", "fa fa-home", "fa fa-file-o", "fa fa-clock-o", "fa fa-road", "fa fa-download", "fa fa-arrow-circle-o-down", "fa fa-arrow-circle-o-up", "fa fa-inbox", "fa fa-play-circle-o", "fa fa-rotate-right", "fa fa-repeat", "fa fa-refresh", "fa fa-list-alt", "fa fa-lock", "fa fa-flag", "fa fa-headphones", "fa fa-volume-off", "fa fa-volume-down", "fa fa-volume-up", "fa fa-qrcode", "fa fa-barcode", "fa fa-tag", "fa fa-tags", "fa fa-book", "fa fa-bookmark", "fa fa-print", "fa fa-camera", "fa fa-font", "fa fa-bold", "fa fa-italic", "fa fa-text-height", "fa fa-text-width", "fa fa-align-left", "fa fa-align-center", "fa fa-align-right", "fa fa-align-justify", "fa fa-list", "fa fa-dedent", "fa fa-outdent", "fa fa-indent", "fa fa-video-camera", "fa fa-photo", "fa fa-image", "fa fa-picture-o", "fa fa-pencil", "fa fa-map-marker", "fa fa-adjust", "fa fa-tint", "fa fa-edit", "fa fa-pencil-square-o", "fa fa-share-square-o", "fa fa-check-square-o", "fa fa-arrows", "fa fa-step-backward", "fa fa-fast-backward", "fa fa-backward", "fa fa-play", "fa fa-pause", "fa fa-stop", "fa fa-forward", "fa fa-fast-forward", "fa fa-step-forward", "fa fa-eject", "fa fa-chevron-left", "fa fa-chevron-right", "fa fa-plus-circle", "fa fa-minus-circle", "fa fa-times-circle", "fa fa-check-circle", "fa fa-question-circle", "fa fa-info-circle", "fa fa-crosshairs", "fa fa-times-circle-o", "fa fa-check-circle-o", "fa fa-ban", "fa fa-arrow-left", "fa fa-arrow-right", "fa fa-arrow-up", "fa fa-arrow-down", "fa fa-mail-forward", "fa fa-share", "fa fa-expand", "fa fa-compress", "fa fa-plus", "fa fa-minus", "fa fa-asterisk", "fa fa-exclamation-circle", "fa fa-gift", "fa fa-leaf", "fa fa-fire", "fa fa-eye", "fa fa-eye-slash", "fa fa-warning", "fa fa-exclamation-triangle", "fa fa-plane", "fa fa-calendar", "fa fa-random", "fa fa-comment", "fa fa-magnet", "fa fa-chevron-up", "fa fa-chevron-down", "fa fa-retweet", "fa fa-shopping-cart", "fa fa-folder", "fa fa-folder-open", "fa fa-arrows-v", "fa fa-arrows-h", "fa fa-bar-chart-o", "fa fa-bar-chart", "fa fa-twitter-square", "fa fa-facebook-square", "fa fa-camera-retro", "fa fa-key", "fa fa-gears", "fa fa-cogs", "fa fa-comments", "fa fa-thumbs-o-up", "fa fa-thumbs-o-down", "fa fa-star-half", "fa fa-heart-o", "fa fa-sign-out", "fa fa-linkedin-square", "fa fa-thumb-tack", "fa fa-external-link", "fa fa-sign-in", "fa fa-trophy", "fa fa-github-square", "fa fa-upload", "fa fa-lemon-o", "fa fa-phone", "fa fa-square-o", "fa fa-bookmark-o", "fa fa-phone-square", "fa fa-twitter", "fa fa-facebook-f", "fa fa-facebook", "fa fa-github", "fa fa-unlock", "fa fa-credit-card", "fa fa-feed", "fa fa-rss", "fa fa-hdd-o", "fa fa-bullhorn", "fa fa-bell", "fa fa-certificate", "fa fa-hand-o-right", "fa fa-hand-o-left", "fa fa-hand-o-up", "fa fa-hand-o-down", "fa fa-arrow-circle-left", "fa fa-arrow-circle-right", "fa fa-arrow-circle-up", "fa fa-arrow-circle-down", "fa fa-globe", "fa fa-wrench", "fa fa-tasks", "fa fa-filter", "fa fa-briefcase", "fa fa-arrows-alt", "fa fa-group", "fa fa-users", "fa fa-chain", "fa fa-link", "fa fa-cloud", "fa fa-flask", "fa fa-cut", "fa fa-scissors", "fa fa-copy", "fa fa-files-o", "fa fa-paperclip", "fa fa-save", "fa fa-floppy-o", "fa fa-square", "fa fa-navicon", "fa fa-reorder", "fa fa-bars", "fa fa-list-ul", "fa fa-list-ol", "fa fa-strikethrough", "fa fa-underline", "fa fa-table", "fa fa-magic", "fa fa-truck", "fa fa-pinterest", "fa fa-pinterest-square", "fa fa-google-plus-square", "fa fa-google-plus", "fa fa-money", "fa fa-caret-down", "fa fa-caret-up", "fa fa-caret-left", "fa fa-caret-right", "fa fa-columns", "fa fa-unsorted", "fa fa-sort", "fa fa-sort-down", "fa fa-sort-desc", "fa fa-sort-up", "fa fa-sort-asc", "fa fa-envelope", "fa fa-linkedin", "fa fa-rotate-left", "fa fa-undo", "fa fa-legal", "fa fa-gavel", "fa fa-dashboard", "fa fa-tachometer", "fa fa-comment-o", "fa fa-comments-o", "fa fa-flash", "fa fa-bolt", "fa fa-sitemap", "fa fa-umbrella", "fa fa-paste", "fa fa-clipboard", "fa fa-lightbulb-o", "fa fa-exchange", "fa fa-cloud-download", "fa fa-cloud-upload", "fa fa-user-md", "fa fa-stethoscope", "fa fa-suitcase", "fa fa-bell-o", "fa fa-coffee", "fa fa-cutlery", "fa fa-file-text-o", "fa fa-building-o", "fa fa-hospital-o", "fa fa-ambulance", "fa fa-medkit", "fa fa-fighter-jet", "fa fa-beer", "fa fa-h-square", "fa fa-plus-square", "fa fa-angle-double-left", "fa fa-angle-double-right", "fa fa-angle-double-up", "fa fa-angle-double-down", "fa fa-angle-left", "fa fa-angle-right", "fa fa-angle-up", "fa fa-angle-down", "fa fa-desktop", "fa fa-laptop", "fa fa-tablet", "fa fa-mobile-phone", "fa fa-mobile", "fa fa-circle-o", "fa fa-quote-left", "fa fa-quote-right", "fa fa-spinner", "fa fa-circle", "fa fa-mail-reply", "fa fa-reply", "fa fa-github-alt", "fa fa-folder-o", "fa fa-folder-open-o", "fa fa-smile-o", "fa fa-frown-o", "fa fa-meh-o", "fa fa-gamepad", "fa fa-keyboard-o", "fa fa-flag-o", "fa fa-flag-checkered", "fa fa-terminal", "fa fa-code", "fa fa-mail-reply-all", "fa fa-reply-all", "fa fa-star-half-empty", "fa fa-star-half-full", "fa fa-star-half-o", "fa fa-location-arrow", "fa fa-crop", "fa fa-code-fork", "fa fa-unlink", "fa fa-chain-broken", "fa fa-question", "fa fa-info", "fa fa-exclamation", "fa fa-superscript", "fa fa-subscript", "fa fa-eraser", "fa fa-puzzle-piece", "fa fa-microphone", "fa fa-microphone-slash", "fa fa-shield", "fa fa-calendar-o", "fa fa-fire-extinguisher", "fa fa-rocket", "fa fa-maxcdn", "fa fa-chevron-circle-left", "fa fa-chevron-circle-right", "fa fa-chevron-circle-up", "fa fa-chevron-circle-down", "fa fa-html5", "fa fa-css3", "fa fa-anchor", "fa fa-unlock-alt", "fa fa-bullseye", "fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-rss-square", "fa fa-play-circle", "fa fa-ticket", "fa fa-minus-square", "fa fa-minus-square-o", "fa fa-level-up", "fa fa-level-down", "fa fa-check-square", "fa fa-pencil-square", "fa fa-external-link-square", "fa fa-share-square", "fa fa-compass", "fa fa-toggle-down", "fa fa-caret-square-o-down", "fa fa-toggle-up", "fa fa-caret-square-o-up", "fa fa-toggle-right", "fa fa-caret-square-o-right", "fa fa-euro", "fa fa-eur", "fa fa-gbp", "fa fa-dollar", "fa fa-usd", "fa fa-rupee", "fa fa-inr", "fa fa-cny", "fa fa-rmb", "fa fa-yen", "fa fa-jpy", "fa fa-ruble", "fa fa-rouble", "fa fa-rub", "fa fa-won", "fa fa-krw", "fa fa-bitcoin", "fa fa-btc", "fa fa-file", "fa fa-file-text", "fa fa-sort-alpha-asc", "fa fa-sort-alpha-desc", "fa fa-sort-amount-asc", "fa fa-sort-amount-desc", "fa fa-sort-numeric-asc", "fa fa-sort-numeric-desc", "fa fa-thumbs-up", "fa fa-thumbs-down", "fa fa-youtube-square", "fa fa-youtube", "fa fa-xing", "fa fa-xing-square", "fa fa-youtube-play", "fa fa-dropbox", "fa fa-stack-overflow", "fa fa-instagram", "fa fa-flickr", "fa fa-adn", "fa fa-bitbucket", "fa fa-bitbucket-square", "fa fa-tumblr", "fa fa-tumblr-square", "fa fa-long-arrow-down", "fa fa-long-arrow-up", "fa fa-long-arrow-left", "fa fa-long-arrow-right", "fa fa-apple", "fa fa-windows", "fa fa-android", "fa fa-linux", "fa fa-dribbble", "fa fa-skype", "fa fa-foursquare", "fa fa-trello", "fa fa-female", "fa fa-male", "fa fa-gittip", "fa fa-gratipay", "fa fa-sun-o", "fa fa-moon-o", "fa fa-archive", "fa fa-bug", "fa fa-vk", "fa fa-weibo", "fa fa-renren", "fa fa-pagelines", "fa fa-stack-exchange", "fa fa-arrow-circle-o-right", "fa fa-arrow-circle-o-left", "fa fa-toggle-left", "fa fa-caret-square-o-left", "fa fa-dot-circle-o", "fa fa-wheelchair", "fa fa-vimeo-square", "fa fa-turkish-lira", "fa fa-try", "fa fa-plus-square-o", "fa fa-space-shuttle", "fa fa-slack", "fa fa-envelope-square", "fa fa-wordpress", "fa fa-openid", "fa fa-institution", "fa fa-bank", "fa fa-university", "fa fa-mortar-board", "fa fa-graduation-cap", "fa fa-yahoo", "fa fa-google", "fa fa-reddit", "fa fa-reddit-square", "fa fa-stumbleupon-circle", "fa fa-stumbleupon", "fa fa-delicious", "fa fa-digg", "fa fa-pied-piper-pp", "fa fa-pied-piper-alt", "fa fa-drupal", "fa fa-joomla", "fa fa-language", "fa fa-fax", "fa fa-building", "fa fa-child", "fa fa-paw", "fa fa-spoon", "fa fa-cube", "fa fa-cubes", "fa fa-behance", "fa fa-behance-square", "fa fa-steam", "fa fa-steam-square", "fa fa-recycle", "fa fa-automobile", "fa fa-car", "fa fa-cab", "fa fa-taxi", "fa fa-tree", "fa fa-spotify", "fa fa-deviantart", "fa fa-soundcloud", "fa fa-database", "fa fa-file-pdf-o", "fa fa-file-word-o", "fa fa-file-excel-o", "fa fa-file-powerpoint-o", "fa fa-file-photo-o", "fa fa-file-picture-o", "fa fa-file-image-o", "fa fa-file-zip-o", "fa fa-file-archive-o", "fa fa-file-sound-o", "fa fa-file-audio-o", "fa fa-file-movie-o", "fa fa-file-video-o", "fa fa-file-code-o", "fa fa-vine", "fa fa-codepen", "fa fa-jsfiddle", "fa fa-life-bouy", "fa fa-life-buoy", "fa fa-life-saver", "fa fa-support", "fa fa-life-ring", "fa fa-circle-o-notch", "fa fa-ra", "fa fa-resistance", "fa fa-rebel", "fa fa-ge", "fa fa-empire", "fa fa-git-square", "fa fa-git", "fa fa-y-combinator-square", "fa fa-yc-square", "fa fa-hacker-news", "fa fa-tencent-weibo", "fa fa-qq", "fa fa-wechat", "fa fa-weixin", "fa fa-send", "fa fa-paper-plane", "fa fa-send-o", "fa fa-paper-plane-o", "fa fa-history", "fa fa-circle-thin", "fa fa-header", "fa fa-paragraph", "fa fa-sliders", "fa fa-share-alt", "fa fa-share-alt-square", "fa fa-bomb", "fa fa-soccer-ball-o", "fa fa-futbol-o", "fa fa-tty", "fa fa-binoculars", "fa fa-plug", "fa fa-slideshare", "fa fa-twitch", "fa fa-yelp", "fa fa-newspaper-o", "fa fa-wifi", "fa fa-calculator", "fa fa-paypal", "fa fa-google-wallet", "fa fa-cc-visa", "fa fa-cc-mastercard", "fa fa-cc-discover", "fa fa-cc-amex", "fa fa-cc-paypal", "fa fa-cc-stripe", "fa fa-bell-slash", "fa fa-bell-slash-o", "fa fa-trash", "fa fa-copyright", "fa fa-at", "fa fa-eyedropper", "fa fa-paint-brush", "fa fa-birthday-cake", "fa fa-area-chart", "fa fa-pie-chart", "fa fa-line-chart", "fa fa-lastfm", "fa fa-lastfm-square", "fa fa-toggle-off", "fa fa-toggle-on", "fa fa-bicycle", "fa fa-bus", "fa fa-ioxhost", "fa fa-angellist", "fa fa-cc", "fa fa-shekel", "fa fa-sheqel", "fa fa-ils", "fa fa-meanpath", "fa fa-buysellads", "fa fa-connectdevelop", "fa fa-dashcube", "fa fa-forumbee", "fa fa-leanpub", "fa fa-sellsy", "fa fa-shirtsinbulk", "fa fa-simplybuilt", "fa fa-skyatlas", "fa fa-cart-plus", "fa fa-cart-arrow-down", "fa fa-diamond", "fa fa-ship", "fa fa-user-secret", "fa fa-motorcycle", "fa fa-street-view", "fa fa-heartbeat", "fa fa-venus", "fa fa-mars", "fa fa-mercury", "fa fa-intersex", "fa fa-transgender", "fa fa-transgender-alt", "fa fa-venus-double", "fa fa-mars-double", "fa fa-venus-mars", "fa fa-mars-stroke", "fa fa-mars-stroke-v", "fa fa-mars-stroke-h", "fa fa-neuter", "fa fa-genderless", "fa fa-facebook-official", "fa fa-pinterest-p", "fa fa-whatsapp", "fa fa-server", "fa fa-user-plus", "fa fa-user-times", "fa fa-hotel", "fa fa-bed", "fa fa-viacoin", "fa fa-train", "fa fa-subway", "fa fa-medium", "fa fa-yc", "fa fa-y-combinator", "fa fa-optin-monster", "fa fa-opencart", "fa fa-expeditedssl", "fa fa-battery-4", "fa fa-battery-full", "fa fa-battery-3", "fa fa-battery-three-quarters", "fa fa-battery-2", "fa fa-battery-half", "fa fa-battery-1", "fa fa-battery-quarter", "fa fa-battery-0", "fa fa-battery-empty", "fa fa-mouse-pointer", "fa fa-i-cursor", "fa fa-object-group", "fa fa-object-ungroup", "fa fa-sticky-note", "fa fa-sticky-note-o", "fa fa-cc-jcb", "fa fa-cc-diners-club", "fa fa-clone", "fa fa-balance-scale", "fa fa-hourglass-o", "fa fa-hourglass-1", "fa fa-hourglass-start", "fa fa-hourglass-2", "fa fa-hourglass-half", "fa fa-hourglass-3", "fa fa-hourglass-end", "fa fa-hourglass", "fa fa-hand-grab-o", "fa fa-hand-rock-o", "fa fa-hand-stop-o", "fa fa-hand-paper-o", "fa fa-hand-scissors-o", "fa fa-hand-lizard-o", "fa fa-hand-spock-o", "fa fa-hand-pointer-o", "fa fa-hand-peace-o", "fa fa-trademark", "fa fa-registered", "fa fa-creative-commons", "fa fa-gg", "fa fa-gg-circle", "fa fa-tripadvisor", "fa fa-odnoklassniki", "fa fa-odnoklassniki-square", "fa fa-get-pocket", "fa fa-wikipedia-w", "fa fa-safari", "fa fa-chrome", "fa fa-firefox", "fa fa-opera", "fa fa-internet-explorer", "fa fa-tv", "fa fa-television", "fa fa-contao", "fa fa-500px", "fa fa-amazon", "fa fa-calendar-plus-o", "fa fa-calendar-minus-o", "fa fa-calendar-times-o", "fa fa-calendar-check-o", "fa fa-industry", "fa fa-map-pin", "fa fa-map-signs", "fa fa-map-o", "fa fa-map", "fa fa-commenting", "fa fa-commenting-o", "fa fa-houzz", "fa fa-vimeo", "fa fa-black-tie", "fa fa-fonticons", "fa fa-reddit-alien", "fa fa-edge", "fa fa-credit-card-alt", "fa fa-codiepie", "fa fa-modx", "fa fa-fort-awesome", "fa fa-usb", "fa fa-product-hunt", "fa fa-mixcloud", "fa fa-scribd", "fa fa-pause-circle", "fa fa-pause-circle-o", "fa fa-stop-circle", "fa fa-stop-circle-o", "fa fa-shopping-bag", "fa fa-shopping-basket", "fa fa-hashtag", "fa fa-bluetooth", "fa fa-bluetooth-b", "fa fa-percent", "fa fa-gitlab", "fa fa-wpbeginner", "fa fa-wpforms", "fa fa-envira", "fa fa-universal-access", "fa fa-wheelchair-alt", "fa fa-question-circle-o", "fa fa-blind", "fa fa-audio-description", "fa fa-volume-control-phone", "fa fa-braille", "fa fa-assistive-listening-systems", "fa fa-asl-interpreting", "fa fa-american-sign-language-interpreting", "fa fa-deafness", "fa fa-hard-of-hearing", "fa fa-deaf", "fa fa-glide", "fa fa-glide-g", "fa fa-signing", "fa fa-sign-language", "fa fa-low-vision", "fa fa-viadeo", "fa fa-viadeo-square", "fa fa-snapchat", "fa fa-snapchat-ghost", "fa fa-snapchat-square", "fa fa-pied-piper", "fa fa-first-order", "fa fa-yoast", "fa fa-themeisle", "fa fa-google-plus-circle", "fa fa-google-plus-official", "fa fa-fa", "fa fa-font-awesome");
    }

}

if (function_exists('viral_news_check_social_icon_exists')) {

    function viral_news_check_social_icon_exists() {
        $facebook = get_theme_mod('viral_news_social_facebook');
        $twitter = get_theme_mod('viral_news_social_twitter');
        $youtube = get_theme_mod('viral_news_social_youtube');
        $instagram = get_theme_mod('viral_news_social_instagram');

        if ($facebook || $twitter || $youtube || $instagram) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('viral_news_social_links')) {

    function viral_news_social_links() {
        echo '<div class="vl-header-social-icons">';
        $facebook = get_theme_mod('viral_news_social_facebook', '#');
        $twitter = get_theme_mod('viral_news_social_twitter', '#');
        $youtube = get_theme_mod('viral_news_social_youtube', '#');
        $instagram = get_theme_mod('viral_news_social_instagram', '#');

        if ($facebook)
            echo '<a class="vl-facebook" href="' . esc_url($facebook) . '" target="_blank"><i class="fa fa-facebook"></i></a>';

        if ($twitter)
            echo '<a class="vl-twitter" href="' . esc_url($twitter) . '" target="_blank"><i class="fa fa-twitter"></i></a>';

        if ($youtube)
            echo '<a class="vl-youtube" href="' . esc_url($youtube) . '" target="_blank"><i class="fa fa-youtube"></i></a>';

        if ($instagram)
            echo '<a class="vl-instagram" href="' . esc_url($instagram) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
        echo '</div>';
    }

}

if (!function_exists('viral_news_show_date')) {

    function viral_news_show_date() {
        $viral_news_left_header_date = get_theme_mod('viral_news_left_header_date');
        if ($viral_news_left_header_date) {
            echo '<span><i class="fa fa-clock-o" aria-hidden="true"></i>';
            echo date_i18n('l, F j', time());
            echo '</span>';
        }
    }

}

if (!function_exists('viral_news_header_text')) {

    function viral_news_header_text() {
        $viral_news_left_header_text = get_theme_mod('viral_news_left_header_text');
        if ($viral_news_left_header_text) {
            echo '<span>';
            echo '<i class="fa fa-bookmark" aria-hidden="true"></i>' . esc_html($viral_news_left_header_text);
            echo '</span>';
        }
    }

}

if (!function_exists('viral_news_top_menu')) {

    function viral_news_top_menu() {
        wp_nav_menu(
                array(
                    'theme_location' => 'viral-news-top-menu',
                    'container_class' => 'vl-top-menu',
                    'depth' => -1,
                    'menu_class' => 'vl-clearfix',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'fallback_cb' => false
                )
        );
    }

}

if (!function_exists('viral_news_site_logo')) {

    function viral_news_site_logo() {
        ?>
        <div id="vl-site-branding">
            <?php
            if (function_exists('has_custom_logo') && has_custom_logo()) :
                the_custom_logo();
            else :
                if (is_front_page()) :
                    ?>
                    <h1 class="vl-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                    <p class="vl-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                <?php endif; ?>
                <p class="vl-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                <?php endif; ?>
        </div><!-- .site-branding -->
        <?php
    }

}

if (!function_exists('viral_news_search_icon')) {

    function viral_news_search_icon() {
        echo '<div class="vl-header-search">';
        echo '<a href="javascript:void()"><i class="fa fa-search"></i></a>';
        echo '</div>';
    }

}

if (!function_exists('viral_news_header_search_wrapper')) {

    function viral_news_header_wrapper() {
        $placeholder_text = esc_attr__('Enter a keyword to search...', 'viral-news');
        $form = '<div class="ht-search-wrapper">';
        $form .= '<div class="ht-search-container">';
        $form .= '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">';
        $form .= '<input autocomplete="off" type="search" class="search-field" placeholder="' . $placeholder_text . '" value="' . get_search_query() . '" name="s" />';
        $form .= '<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>';
        $form .= '<div class="ht-search-close"><span></span></div>';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div>';

        $result = apply_filters('get_search_form', $form);
        echo $result;
    }

}

add_action('wp_footer', 'viral_news_header_wrapper');

add_action('viral_news_left_header_content', 'viral_news_show_date', 10);
add_action('viral_news_left_header_content', 'viral_news_header_text', 10);
add_action('viral_news_right_header_content', 'viral_news_top_menu', 10);

add_action('viral_news_main_header_content', 'viral_news_social_links', 10);
add_action('viral_news_main_header_content', 'viral_news_site_logo', 20);
add_action('viral_news_main_header_content', 'viral_news_search_icon', 30);
