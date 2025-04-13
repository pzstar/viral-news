<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Viral News
 */
if (!function_exists('viral_news_posted_on')):

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_news_posted_on() {
        $viral_news_is_updated_date = get_theme_mod('viral_news_display_date_option', 'posted') == 'updated' ? true : false;

        $posted_on = sprintf('<span class="vn-day">%1$s</span><span class="vn-month">%2$s</span>', esc_html($viral_news_is_updated_date ? get_the_modified_date('j') : get_the_date('j')), esc_attr($viral_news_is_updated_date ? get_the_modified_date('M') : get_the_date('M')));

        $avatar = get_avatar(get_the_author_meta('ID'), 48);

        $author = sprintf(esc_html_x('By %s', 'post author', 'viral-news'), esc_html(get_the_author()));

        $comment_count = get_comments_number(); // get_comments_number returns only a numeric value

        if ($comment_count == 0) {
            $comments = esc_html__('No Comments', 'viral-news');
        } elseif ($comment_count > 1) {
            $comments = $comment_count . ' ' . esc_html__('Comments', 'viral-news');
        } else {
            $comments = esc_html__('1 Comment', 'viral-news');
        }

        echo '<span class="entry-date" ' . viral_news_get_schema_attribute('publish_date') . '>' . $posted_on . '</span><span class="entry-author" ' . viral_news_get_schema_attribute('author') . '> ' . $avatar . '<span class="author" ' . viral_news_get_schema_attribute('author_name') . '>' . $author . '</span></span><span class="entry-comment">' . $comments . '</span>'; // WPCS: XSS OK.
    }

endif;


if (!function_exists('viral_news_post_date')):

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_news_post_date() {
        $viral_news_is_updated_date = get_theme_mod('viral_news_display_date_option', 'posted') == 'updated' ? true : false;
        $time_string = '<time class="entry-date published updated" datetime="' . ($viral_news_is_updated_date ? get_the_modified_date('c') : get_the_date('c')) . '">' . ($viral_news_is_updated_date ? get_the_modified_date() : get_the_date()) . '</time>';

        echo '<div class="posted-on"><i class="mdi-clock-time-three-outline"></i>' . $time_string . '</div>'; // WPCS: XSS OK.
    }

endif;

if (!function_exists('viral_news_entry_footer')):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function viral_news_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                printf('<div class="cat-links"><i class="mdi-book-open-outline"></i> ' . esc_html__('Posted in %1$s', 'viral-news') . '</div>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                printf('<div class="tags-links"><i class="mdi-tag-multiple-outline"></i> ' . esc_html__('Tagged in %1$s', 'viral-news') . '</div>', $tags_list); // WPCS: XSS OK.
            }
        }
    }

endif;

if (!function_exists('viral_news_entry_category')):

    /**
     * Prints HTML with meta information for the categories
     */
    function viral_news_entry_category() {
        // Hide category and tag text for pages.
        if ('post' == get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo '<i class="mdi-book-open-outline"></i> ' . $categories_list; // WPCS: XSS OK.
            }
        }
    }

endif;

if (!function_exists('viral_news_post_primary_category')) {

    function viral_news_post_primary_category($class = "post-categories") {
        $post_categories = viral_news_get_post_primary_category(get_the_ID());

        if (!empty($post_categories)) {
            $category_obj = $post_categories['primary_category'];
            $category_link = get_category_link($category_obj->term_id);
            echo '<ul class="' . esc_attr($class) . '">';
            echo '<li><a class="vn-primary-cat vn-category-' . esc_attr($category_obj->term_id) . '" href="' . esc_url($category_link) . '">' . esc_html($category_obj->name) . '</a></li>';
            echo '</ul>';
        }
    }

}


if (!function_exists('viral_news_get_post_primary_category')) {

    function viral_news_get_post_primary_category($post_id, $term = 'category', $return_all_categories = false) {
        $return = array();

        if (class_exists('WPSEO_Primary_Term')) {
            // Show Primary category by Yoast if it is enabled & set
            $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
            $primary_term = get_term($wpseo_primary_term->get_primary_term());

            if (!is_wp_error($primary_term)) {
                $return['primary_category'] = $primary_term;
            }
        }

        if (empty($return['primary_category']) || $return_all_categories) {
            $categories_list = get_the_terms($post_id, $term);

            if (empty($return['primary_category']) && !empty($categories_list)) {
                $return['primary_category'] = $categories_list[0];  //get the first category
            }

            if ($return_all_categories) {
                $return['all_categories'] = array();

                if (!empty($categories_list)) {
                    foreach ($categories_list as &$category) {
                        $return['all_categories'][] = $category->term_id;
                    }
                }
            }
        }

        return $return;
    }

}


/**
 * Determine whether this is an AMP response.
 *
 * Note that this must only be called after the parse_query action.
 *
 * @link https://github.com/Automattic/amp-wp
 * @return bool Is AMP endpoint (and AMP plugin is active).
 */
function viral_news_is_amp() {
    return function_exists('is_amp_endpoint') && is_amp_endpoint();
}


/**
 * Adds amp support for menu toggle.
 */
function viral_news_amp_menu_toggle() {
    if (viral_news_is_amp()) {
        echo "[aria-expanded]=\"primaryMenuExpanded? 'true' : 'false'\" ";
        echo 'on="tap:AMP.setState({primaryMenuExpanded: !primaryMenuExpanded})"';
    }
}

/**
 * Adds amp support for mobile dropdown navigation menu.
 */
function viral_news_amp_menu_is_toggled() {
    if (viral_news_is_amp()) {
        echo "[class]=\"( primaryMenuExpanded ? 'vn-toggled-on' : '' )\"";
    }
}

/**
 * Adds amp support for search toggle.
 */
function viral_news_amp_search_toggle() {
    if (viral_news_is_amp()) {
        return 'on="tap:htSearchWrapper.toggleClass(class=\'ht-search-triggered\')"';
    }
}

/**
 * Adds amp support for search toggle.
 */
function viral_news_amp_search_is_toggled() {
    if (viral_news_is_amp()) {
        return 'on="tap:htSearchWrapper.toggleClass(class=\'ht-search-triggered\', force=false)"';
    }
}


if (!function_exists('viral_news_get_schema_attribute')) {

    function viral_news_get_schema_attribute($place) {
        $schema_markup = get_theme_mod('viral_news_schema_markup', false);
        if (!$schema_markup) {
            return '';
        }
        $attrs = "";
        switch ($place) {
            case 'single':
                $itemscope = 'itemscope';
                $itemtype = 'WebPage';
                break;
            case 'article':
                $itemscope = 'itemscope';
                $itemtype = 'Article';
                break;
            case 'blog':
                $itemscope = 'itemscope';
                $itemtype = 'Blog';
                break;
            case 'header':
                $itemscope = '';
                $itemtype = 'WPHeader';
                break;
            case 'logo':
                $itemscope = 'itemscope';
                $itemtype = 'Organization';
                break;
            case 'navigation':
                $itemscope = '';
                $itemtype = 'SiteNavigationElement';
                break;
            case 'breadcrumb':
                $itemscope = '';
                $itemtype = 'BreadcrumbList';
                break;
            case 'sidebar':
                $itemscope = 'itemscope';
                $itemtype = 'WPSideBar';
                break;
            case 'footer':
                $itemscope = 'itemscope';
                $itemtype = 'WPFooter';
                break;
            case 'author':
                $itemprop = 'author';
                $itemscope = '';
                $itemtype = 'Person';
                break;
            case 'breadcrumb_list':
                $itemscope = '';
                $itemtype = 'BreadcrumbList';
                break;
            case 'breadcrumb_item':
                $itemscope = '';
                $itemprop = 'itemListElement';
                $itemtype = 'ListItem';
                break;
            case 'author_name':
                $itemprop = 'name';
                break;
            case 'author_link':
                $itemprop = 'author';
                break;
            case 'author_url':
                $itemprop = 'url';
                break;
            case 'publish_date':
                $itemprop = 'datePublished';
                break;
            case 'modified_date':
                $itemprop = 'dateModified';
                break;
            default:
        }
        if (isset($itemprop)) {
            $attrs .= ' itemprop="' . $itemprop . '"';
        }
        if (isset($itemtype)) {
            $attrs .= ' itemtype="https://schema.org/' . $itemtype . '"';
        }
        if (isset($itemscope)) {
            $attrs .= ' itemscope="' . $itemscope . '"';
        }
        return apply_filters('viral_news_schema_' . $place . '_attributes', $attrs); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}