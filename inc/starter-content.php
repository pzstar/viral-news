<?php
/**
 * Starter content, shown on new sites in the Customizer and in the WordPress.org theme preview.
 *
 * @package Viral News
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('viral_news_starter_content')) {

    function viral_news_starter_content() {
        // Paragraphs as block markup, so the posts open cleanly in the block editor.
        $paragraphs = function ($texts) {
            $html = '';
            foreach ($texts as $text) {
                $html .= '<!-- wp:paragraph --><p>' . $text . '</p><!-- /wp:paragraph -->';
            }
            return $html;
        };

        // An advertisement placeholder image bundled with the theme.
        $ad_image = function ($file, $width, $height) {
            return array('custom_html', array(
                'title' => '',
                'content' => '<a href="#"><img src="' . esc_url(get_template_directory_uri() . '/images/starter/' . $file) . '" width="' . $width . '" height="' . $height . '" alt="' . esc_attr_x('Advertise with us', 'Theme starter content', 'viral-news') . '"></a>',
            ));
        };

        $starter_content = array(
            'posts' => array(
                'viral-news-post-1' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Heatwave Brings Record Temperatures Across the Region', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('Temperatures climbed past 40°C in several towns this week, breaking records that had stood for more than thirty years. Forecasters expect the hot spell to last until the weekend before cooler air arrives from the coast.', 'Theme starter content', 'viral-news'),
                        _x('Local councils have opened cooling centers in libraries and community halls, and health officials are asking people to drink plenty of water, stay out of the midday sun and check on elderly neighbors.', 'Theme starter content', 'viral-news'),
                        _x('Farmers say the heat has arrived at a difficult time, just weeks before harvest, and are watering crops at night to save what they can.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-1}}',
                ),
                'viral-news-post-2' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Colorful Old Town Streets Draw Record Number of Visitors', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('The painted houses and tiled streets of the old town welcomed more visitors this summer than in any year before, according to the local tourism office.', 'Theme starter content', 'viral-news'),
                        _x('Cafe owners have added outdoor seating to keep up with demand, and a new walking tour now guides visitors through the quieter lanes behind the main square.', 'Theme starter content', 'viral-news'),
                        _x('Residents welcome the boost to local business but have asked the council to plan for busier seasons ahead, with more buses and better signs for visitors.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-2}}',
                ),
                'viral-news-post-3' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Old Factory Chimney to Become Centerpiece of New Waterfront Park', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('The tall brick chimney that has stood by the lake for over a century will be kept and restored as part of a new waterfront park, the city announced on Monday.', 'Theme starter content', 'viral-news'),
                        _x('Plans include walking and cycling paths, a small museum about the town\'s industrial past and a viewing platform with views across the water at sunset.', 'Theme starter content', 'viral-news'),
                        _x('Work is expected to begin next spring, and the first section of the park could open to the public within two years.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-3}}',
                ),
                'viral-news-post-4' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Young Boxers Shine at National Youth Championship', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('Two teenagers from the local boxing club came home with medals from the national youth championship, the club\'s best result since it opened.', 'Theme starter content', 'viral-news'),
                        _x('Their coach credits hard work and early morning training sessions, and says interest in the sport among young people in the area has never been higher.', 'Theme starter content', 'viral-news'),
                        _x('The club is now raising money for new equipment so it can welcome more members next season.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-4}}',
                ),
                'viral-news-post-5' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Tea Growers Turn to Organic Farming as Demand Rises', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('A growing number of tea estates in the highlands are switching to organic methods as buyers at home and abroad ask for chemical-free leaves.', 'Theme starter content', 'viral-news'),
                        _x('Growers say the change takes several years and lowers yields at first, but the higher price for organic tea makes the effort worthwhile.', 'Theme starter content', 'viral-news'),
                        _x('Workers have been trained in new ways to protect the plants from pests, and some estates now invite visitors to see how their tea is grown and picked.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-5}}',
                ),
                'viral-news-post-6' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Historic Fortress Reopens After Five-Year Restoration', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('After five years behind scaffolding, the old stone fortress on the hill has reopened its gates to visitors, with repaired towers, new walkways and a refreshed exhibition.', 'Theme starter content', 'viral-news'),
                        _x('Craftspeople used traditional tools and local stone to rebuild the damaged walls, keeping as much of the original structure as possible.', 'Theme starter content', 'viral-news'),
                        _x('Entry is free for local residents during the first month, and guided tours run every afternoon.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-6}}',
                ),
                'viral-news-post-7' => array(
                    'post_type' => 'post',
                    'post_title' => _x('New Rapid Bus Lanes Promise Shorter Commutes Downtown', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('Dedicated bus lanes opened on the city\'s main boulevard this week, and early figures suggest journeys across downtown are already up to ten minutes faster.', 'Theme starter content', 'viral-news'),
                        _x('The project also added new crossings, wider sidewalks and shade trees along the route, making the street safer for people on foot.', 'Theme starter content', 'viral-news'),
                        _x('Transport officials will review the results after six months before deciding whether to extend the lanes to other busy roads.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-7}}',
                ),
                'viral-news-post-8' => array(
                    'post_type' => 'post',
                    'post_title' => _x('How Communities Are Rebuilding After the Earthquake', 'Theme starter content', 'viral-news'),
                    'post_content' => $paragraphs(array(
                        _x('Months after the earthquake, families in the worst-hit villages are moving into new homes built to withstand future tremors.', 'Theme starter content', 'viral-news'),
                        _x('Volunteers, engineers and local builders have worked side by side, and many of the new houses use designs that are cheaper and stronger than before.', 'Theme starter content', 'viral-news'),
                        _x('Schools and health posts are next on the list, and aid groups say the community\'s own efforts have made all the difference.', 'Theme starter content', 'viral-news'),
                    )),
                    'thumbnail' => '{{viral-news-image-8}}',
                ),
                'about',
                'contact',
            ),

            // Photos from the WordPress.org Photo Directory (CC0).
            'attachments' => array(
                'viral-news-image-1' => array(
                    'post_title' => _x('Thermometer showing 40 degrees', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-1.jpg',
                ),
                'viral-news-image-2' => array(
                    'post_title' => _x('Colorful street with outdoor seating', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-2.jpg',
                ),
                'viral-news-image-3' => array(
                    'post_title' => _x('Chimney by a lake at sunset', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-3.jpg',
                ),
                'viral-news-image-4' => array(
                    'post_title' => _x('Young boxers training in a ring', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-4.jpg',
                ),
                'viral-news-image-5' => array(
                    'post_title' => _x('Worker on a tea plantation', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-5.jpg',
                ),
                'viral-news-image-6' => array(
                    'post_title' => _x('Stone fortress under a cloudy sky', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-6.jpg',
                ),
                'viral-news-image-7' => array(
                    'post_title' => _x('City road lined with palm trees', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-7.jpg',
                ),
                'viral-news-image-8' => array(
                    'post_title' => _x('House damaged by an earthquake', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/news-8.jpg',
                ),
                'viral-news-logo' => array(
                    'post_title' => _x('Viral News Logo', 'Theme starter content', 'viral-news'),
                    'file' => 'images/starter/logo.png',
                ),
            ),

            // Settings from Demo One (demo.hashthemes.com/viral-news/demo1). Its blocks show the latest posts, as starter posts can't have categories.
            'theme_mods' => array(
                'custom_logo' => '{{viral-news-logo}}',
                'viral_news_template_color' => '#1e73be',

                // Header: dark top bar with the date and social links, light menu bar.
                'viral_news_top_header_style' => 'dark',
                'viral_news_nav_style' => 'light',
                'viral_news_left_header_date' => true,
                'viral_news_social_facebook' => '#',
                'viral_news_social_twitter' => '#',
                'viral_news_social_youtube' => '#',
                'viral_news_social_instagram' => '#',

                // Front page sections.
                'viral_news_enable_frontpage' => true,
                'viral_news_frontpage_top_blocks' => wp_json_encode(array(
                    array('title' => '', 'category' => '', 'layout' => 'style2', 'enable' => 'on'),
                )),
                'viral_news_frontpage_middle_blocks' => wp_json_encode(array(
                    array('title' => _x('Politics', 'Theme starter content', 'viral-news'), 'category' => '', 'layout' => 'style3', 'enable' => 'on'),
                    array('title' => _x('Entertainment', 'Theme starter content', 'viral-news'), 'category' => '', 'layout' => 'style1', 'enable' => 'on'),
                    array('title' => _x('Fashion', 'Theme starter content', 'viral-news'), 'category' => '', 'layout' => 'style2', 'enable' => 'on'),
                    array('title' => _x('Sports', 'Theme starter content', 'viral-news'), 'category' => '', 'layout' => 'style4', 'enable' => 'on'),
                    array('title' => _x('Opinion', 'Theme starter content', 'viral-news'), 'category' => '', 'layout' => 'style1', 'enable' => 'on'),
                )),
                'viral_news_frontpage_bottom_blocks' => wp_json_encode(array(
                    array('category1' => '-1', 'category2' => '-1', 'category3' => '-1', 'layout' => 'style1', 'enable' => 'on'),
                )),
                'viral_news_frontpage_carousel_blocks' => wp_json_encode(array(
                    array('title' => _x('Editorial Picks', 'Theme starter content', 'viral-news'), 'category' => '', 'slide_no' => '4', 'post_no' => '6', 'enable' => 'on'),
                )),
            ),

            'widgets' => array(
                'viral-news-frontpage-sidebar' => array(
                    'science' => array('viral_news_category_block', array('title' => _x('Science & Technology', 'Theme starter content', 'viral-news'), 'category' => '-1', 'post_no' => 5)),
                    'trending' => array('viral_news_timeline', array('title' => _x('Trending', 'Theme starter content', 'viral-news'), 'category' => '-1', 'post_no' => 4)),
                    'frontpage_ad' => $ad_image('ad-sidebar.jpg', 300, 250),
                ),
                'viral-news-sidebar' => array(
                    'sidebar_ad' => $ad_image('ad-sidebar.jpg', 300, 250),
                    'search',
                    'latest' => array('viral_news_category_block', array('title' => _x('Latest Posts', 'Theme starter content', 'viral-news'), 'category' => '-1', 'post_no' => 5)),
                ),
                'viral-news-footer1' => array(
                    'about' => array('text', array(
                        'title' => _x('About Us', 'Theme starter content', 'viral-news'),
                        'text' => _x('Viral News brings you the latest news, stories and opinions from around the region and the world, updated every day by our team of reporters and editors.', 'Theme starter content', 'viral-news'),
                        'filter' => true,
                        'visual' => true,
                    )),
                ),
                'viral-news-footer2' => array(
                    'recent' => array('recent-posts', array('title' => _x('Recent Posts', 'Theme starter content', 'viral-news'), 'number' => 5, 'show_date' => false)),
                ),
                'viral-news-footer3' => array(
                    'contact' => array('viral_news_contact_info', array(
                        'title' => _x('Contact Info', 'Theme starter content', 'viral-news'),
                        'phone' => '(555) 123-4567',
                        'email' => 'news@example.com',
                        'website' => 'www.example.com',
                        'address' => _x('1428 Elmwood Avenue, IL 62704', 'Theme starter content', 'viral-news'),
                        'time' => _x('Sun - Fri, 10:00 AM - 6:00 PM', 'Theme starter content', 'viral-news'),
                    )),
                ),
                'viral-news-footer4' => array(
                    'archives',
                ),
            ),

            'nav_menus' => array(
                'viral-news-primary-menu' => array(
                    'name' => __('Main Menu', 'viral-news'),
                    'items' => array(
                        'link_home',
                        'page_about',
                        'page_contact',
                    ),
                ),
            ),
        );

        add_theme_support('starter-content', apply_filters('viral_news_starter_content', $starter_content));
    }

}

add_action('after_setup_theme', 'viral_news_starter_content');

if (!function_exists('viral_news_preview_starter_posts')) {

    // In the Customizer, starter posts stay auto-drafts until the user publishes, so post lists can't see them; include them while previewing.
    function viral_news_preview_starter_posts($query) {
        global $wp_customize;

        if (is_admin() || !is_customize_preview() || !get_option('fresh_site') || !$wp_customize instanceof WP_Customize_Manager || !in_array($query->get('post_type'), array('', 'post'), true)) {
            return;
        }

        $setting = $wp_customize->get_setting('nav_menus_created_posts');
        $ids = $setting ? array_filter(array_map('absint', (array) $setting->value())) : array();

        if ($ids) {
            $query->set('post_status', array('publish', 'auto-draft'));
            $query->set('viral_news_starter_ids', $ids);
        }
    }

}

add_action('pre_get_posts', 'viral_news_preview_starter_posts');

if (!function_exists('viral_news_preview_starter_posts_where')) {

    // Limits the auto-drafts let in above to the starter content ones.
    function viral_news_preview_starter_posts_where($where, $query) {
        global $wpdb;
        $ids = $query->get('viral_news_starter_ids');

        if ($ids) {
            $where .= " AND ({$wpdb->posts}.post_status <> 'auto-draft' OR {$wpdb->posts}.ID IN (" . implode(',', array_map('absint', $ids)) . '))';
        }

        return $where;
    }

}

add_filter('posts_where', 'viral_news_preview_starter_posts_where', 10, 2);

if (!function_exists('viral_news_theme_preview_posts')) {

    // The WordPress.org theme preview keeps starter posts only in the object cache, with made-up IDs from 10000 and their keys as slugs, so post lists never see them.
    // Finds them there and gives them the dates and author the preview leaves out; returns nothing on real sites.
    function viral_news_theme_preview_posts() {
        static $posts = null;

        if (null !== $posts) {
            return $posts;
        }

        $posts = array();

        if (is_admin() || !get_option('fresh_site') || wp_using_ext_object_cache()) {
            return $posts;
        }

        $starter_content = get_theme_starter_content();
        $keys = array();
        foreach ((array) ($starter_content['posts'] ?? array()) as $key => $starter_post) {
            if ('post' === ($starter_post['post_type'] ?? '')) {
                $keys[$key] = true;
            }
        }

        $last_id = 10000 + count((array) ($starter_content['posts'] ?? array())) + count((array) ($starter_content['attachments'] ?? array())) + 20;
        $found = array();
        for ($id = 10000; $id < $last_id && count($found) < count($keys); $id++) {
            $cached = wp_cache_get($id, 'posts');
            if (is_object($cached) && isset($cached->post_name, $keys[$cached->post_name])) {
                $found[$cached->post_name] = $cached;
            }
        }

        if (!$found) {
            return $posts;
        }

        $latest = get_posts(array('numberposts' => 1, 'post_type' => 'post', 'suppress_filters' => true));
        $author = $latest ? $latest[0]->post_author : 1;
        $time = current_time('timestamp');
        $i = 0;

        // Starter content order, newest first, a few hours apart.
        foreach (array_keys($keys) as $key) {
            if (!isset($found[$key])) {
                continue;
            }

            $data = (object) array_merge((array) $found[$key], array(
                'post_status' => 'publish',
                'post_author' => $author,
                'post_date' => gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS),
                'post_date_gmt' => get_gmt_from_date(gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS)),
                'post_modified' => gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS),
                'comment_status' => 'closed',
                'filter' => 'raw',
            ));
            wp_cache_set($data->ID, $data, 'posts');
            $posts[] = new WP_Post($data);
            $i++;
        }

        return $posts;
    }

}

if (!function_exists('viral_news_theme_preview_post_lists')) {

    // In the WordPress.org theme preview, the front page sections, latest posts and post widgets list the starter posts instead of the Theme Unit Test posts.
    function viral_news_theme_preview_post_lists($posts, $query) {
        if (null !== $posts || ($query->is_main_query() && !$query->is_home()) || !in_array($query->get('post_type'), array('', 'post'), true) || $query->get('p') || $query->get('page_id') || $query->get('post__in') || $query->get('s') || $query->get('cat') || $query->get('category_name') || $query->get('tag') || $query->get('tax_query') || $query->get('author')) {
            return $posts;
        }

        $preview_posts = viral_news_theme_preview_posts();

        if (!$preview_posts) {
            return $posts;
        }

        $per_page = (int) $query->get('posts_per_page');
        $per_page = $per_page > 0 ? $per_page : count($preview_posts);
        $offset = (int) $query->get('offset') + (max(1, (int) $query->get('paged')) - 1) * $per_page;
        $posts = array_slice($preview_posts, $offset, $per_page);

        $query->found_posts = count($preview_posts);
        $query->max_num_pages = (int) ceil(count($preview_posts) / $per_page);

        return 'ids' === $query->get('fields') ? wp_list_pluck($posts, 'ID') : $posts;
    }

}

add_filter('posts_pre_query', 'viral_news_theme_preview_post_lists', 10, 2);
