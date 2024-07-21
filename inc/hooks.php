<?php
/**
 * @package Viral News
 */
add_action('viral_news_top_section', 'viral_news_top_section_style1');
add_action('viral_news_top_section', 'viral_news_top_section_style2');
add_action('viral_news_top_section', 'viral_news_top_section_style3');
add_action('viral_news_top_section', 'viral_news_top_section_style4');
add_action('viral_news_middle_section', 'viral_news_middle_section_style1');
add_action('viral_news_middle_section', 'viral_news_middle_section_style2');
add_action('viral_news_middle_section', 'viral_news_middle_section_style3');
add_action('viral_news_middle_section', 'viral_news_middle_section_style4');
add_action('viral_news_bottom_section', 'viral_news_bottom_section_style1');
add_action('viral_news_bottom_section', 'viral_news_bottom_section_style2');
add_action('viral_news_carousel_section', 'viral_news_carousel_section');


if (!function_exists('viral_news_top_section_style1')) {

    function viral_news_top_section_style1($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        if ($layout != 'style1')
            return;
        ?>
        <div class="vn-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>

            <div class="vn-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    $index = $query->current_post + 1;
                    ?>
                    <div class="vn-post-item">
                        <div class="vn-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vn-thumb-container">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                        ?>
                                        <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                    <?php }
                                    ?>
                                </div>
                            </a>
                            <?php
                            if ($index == 1) {
                                echo get_the_category_list();
                            } else {
                                viral_news_post_primary_category();
                            }
                            ?>
                        </div>

                        <div class="vn-post-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php echo viral_news_post_date(); ?>

                            <?php if ($index != 1) { ?>
                                <div class="vn-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 100); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_top_section_style2')) {

    function viral_news_top_section_style2($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        if ($layout != 'style2')
            return;
        ?>
        <div class="vn-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    $title_class = $index == 1 ? 'vn-large-title' : '';

                    if ($index == 1) {
                        echo '<div class="col1">';
                    } elseif ($index == 2) {
                        echo '<div class="col2">';
                    } elseif ($index == 4) {
                        echo '<div class="col3">';
                    }
                    ?>
                    <div class="vn-post-item">
                        <div class="vn-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vn-thumb-container">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                        ?>
                                        <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                    <?php }
                                    ?>
                                </div>
                            </a>
                            <?php
                            if ($index == 1) {
                                echo get_the_category_list();
                            } else {
                                viral_news_post_primary_category();
                            }
                            ?>
                        </div>

                        <div class="vn-post-content">
                            <h3 class="vn-post-title <?php echo esc_attr($title_class) ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php viral_news_post_date(); ?>

                            <?php if ($index == 1) { ?>
                                <div class="vn-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 200); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    if ($index == 1 || $index == 3 || $index == $last) {
                        echo '</div>';
                    }
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_top_section_style3')) {

    function viral_news_top_section_style3($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        if ($layout != 'style3')
            return;
        ?>
        <div class="vn-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    if ($index == 1) {
                        echo '<div class="col1">';
                    } elseif ($index == 2) {
                        echo '<div class="col2">';
                        echo '<div class="col2-wrap">';
                    }
                    if ($index == 1) {
                        ?>
                        <div class="vn-post-item">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="vn-post-content vn-gradient-overlay">
                                        <h3 class="vn-post-title vn-large-title"><span><?php the_title(); ?></span></h3>
                                        <?php echo viral_news_post_date(); ?>
                                    </div>
                                </a>
                                <?php echo get_the_category_list(); ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="vn-post-item">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                                <?php viral_news_post_primary_category(); ?>
                            </div>

                            <div class="vn-post-content">
                                <h3 class="vn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                            </div>
                        </div>
                        <?php
                    }
                    if ($index == 1) {
                        echo '</div>';
                    } elseif ($index == 5 || $index == $last) {
                        echo '</div></div>';
                    }
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_top_section_style4')) {

    function viral_news_top_section_style4($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        if ($layout != 'style4')
            return;
        ?>
        <div class="vn-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 6,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    $title_class = ($index == 1 || $index == 2) ? 'vn-big-title' : '';
                    ?>
                    <div class="vn-post-item">
                        <div class="vn-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vn-thumb-container">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                        ?>
                                        <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                    <?php }
                                    ?>
                                </div>
                            </a>
                            <?php
                            if ($index == 1 || $index == 2) {
                                echo get_the_category_list();
                            } else {
                                echo viral_news_post_primary_category();
                            }
                            ?>
                        </div>

                        <div class="vn-post-content">
                            <h3 class="vn-post-title <?php echo esc_attr($title_class) ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php viral_news_post_date(); ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}


if (!function_exists('viral_news_middle_section_style1')) {

    function viral_news_middle_section_style1($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        if ($layout != 'style1')
            return;

        $args = array(
            'cat' => $cat,
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true
        );
        $query = new WP_Query($args);
        ?>
        <div class="vn-middle-block vn-clearfix <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-clearfix vn-big-small-block">
                <?php
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vn-big-block">
                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vn-post-content">
                                <h3 class="vn-big-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                                <div class="vn-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 220); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vn-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 4,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );
                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vn-post-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_middle_section_style2')) {

    function viral_news_middle_section_style2($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        if ($layout != 'style2')
            return;
        ?>
        <div class="vn-middle-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-1-3-block">
                <div class="vn-big-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 1,
                        'ignore_sticky_posts' => true
                    );

                    $query = new WP_Query($args);
                    while ($query->have_posts()):
                        $query->the_post();
                        ?>

                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-840x440');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="vn-post-content vn-gradient-overlay">
                                        <h3 class="vn-large-title vn-post-title"><span><?php the_title(); ?></span></h3>
                                        <?php echo viral_news_post_date(); ?>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                    endwhile;
                    ?>
                </div>
                <?php
                wp_reset_postdata();
                ?>
                <div class="vn-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 3,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vn-post-content">
                                <h3 class="vn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_middle_section_style3')) {

    function viral_news_middle_section_style3($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        if ($layout != 'style3')
            return;
        ?>
        <div class="vn-middle-block vn-clearfix <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-1-6-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vn-big-block">
                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vn-post-content">
                                <h3 class="vn-big-title vn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                                <div class="vn-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 280); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vn-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 6,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vn-post-content">
                                <h3 class="vn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_middle_section_style4')) {

    function viral_news_middle_section_style4($args) {
        $cat = $args['cat'];
        $layout = $args['layout'];
        $title = $args['title'];
        if ($layout != 'style4')
            return;
        ?>
        <div class="vn-middle-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>

            <div class="vn-clearfix vn-1-4-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="vn-big-block">
                        <div class="vn-post-item vn-clearfix">
                            <div class="vn-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vn-thumb-container">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                            ?>
                                            <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </a>
                            </div>

                            <div class="vn-post-content">
                                <h3 class="vn-big-title vn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                                <div class="vn-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 250); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vn-small-block">
                    <div class="vn-small-block-wrap">
                        <?php
                        $args = array(
                            'cat' => $cat,
                            'posts_per_page' => 4,
                            'ignore_sticky_posts' => true,
                            'offset' => 1
                        );

                        $query = new WP_Query($args);

                        while ($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="vn-post-item vn-clearfix">
                                <div class="vn-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vn-thumb-container">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                                ?>
                                                <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                            <?php }
                                            ?>
                                        </div>
                                    </a>
                                </div>

                                <div class="vn-post-content">
                                    <h3 class="vn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php echo viral_news_post_date(); ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_bottom_section_style1')) {

    function viral_news_bottom_section_style1($args) {
        $cat1 = $args['cat1'];
        $cat2 = $args['cat2'];
        $cat3 = $args['cat3'];
        $layout = $args['layout'];
        if ($layout != 'style1')
            return;

        $cats = array($cat1, $cat2, $cat3);
        ?>
        <div class="vn-bottom-block vn-clearfix <?php echo esc_attr($layout); ?>">
            <?php
            foreach ($cats as $cat) {
                ?>
                <div class="vn-clearfix vn-three-column-block">
                    <?php
                    if ($cat) {
                        $cat_name = ($cat != '-1') ? get_cat_name($cat) : esc_html__('Latest', 'viral-news');
                        ?>
                        <h2 class="vn-block-title"><span><?php echo esc_html($cat_name); ?></span></h2>

                        <?php
                        $args = array(
                            'posts_per_page' => 1,
                            'ignore_sticky_posts' => true
                        );

                        if ($cat != '-1') {
                            $args['cat'] = $cat;
                        }
                        $query = new WP_Query($args);
                        while ($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="vn-big-post-item vn-clearfix">
                                <div class="vn-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vn-thumb-container">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                                                ?>
                                                <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                            <?php }
                                            ?>
                                        </div>

                                        <div class="vn-post-content">
                                            <h3><?php the_title(); ?></h3>
                                            <?php echo viral_news_post_date(); ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();

                        $args = array(
                            'posts_per_page' => 3,
                            'ignore_sticky_posts' => true,
                            'offset' => 1
                        );
                        if ($cat != '-1') {
                            $args['cat'] = $cat;
                        }
                        $query = new WP_Query($args);
                        while ($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="vn-post-item vn-clearfix">
                                <div class="vn-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vn-thumb-container">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150');
                                                ?>
                                                <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                            <?php }
                                            ?>
                                        </div>
                                    </a>
                                </div>

                                <div class="vn-post-content">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php echo viral_news_post_date(); ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}

if (!function_exists('viral_news_bottom_section_style2')) {

    function viral_news_bottom_section_style2($args) {
        $cat1 = $args['cat1'];
        $cat2 = $args['cat2'];
        $cat3 = $args['cat3'];
        $layout = $args['layout'];
        if ($layout != 'style2')
            return;

        $cats = array($cat1, $cat2, $cat3);
        ?>
        <div class="vn-bottom-block vn-clearfix <?php echo esc_attr($layout); ?>">
            <?php
            foreach ($cats as $cat) {
                ?>
                <div class="vn-clearfix vn-three-column-block">
                    <?php
                    if ($cat) {
                        $cat_name = ($cat != '-1') ? get_cat_name($cat) : esc_html__('Latest', 'viral-news');
                        ?>
                        <h2 class="vn-block-title"><span><?php echo esc_html($cat_name); ?></span></h2>

                        <?php
                        $args = array(
                            'posts_per_page' => 4,
                            'ignore_sticky_posts' => true
                        );

                        if ($cat != '-1') {
                            $args['cat'] = $cat;
                        }
                        $query = new WP_Query($args);
                        while ($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="vn-post-item vn-clearfix">
                                <div class="vn-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vn-thumb-container">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150');
                                                ?>
                                                <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                            <?php }
                                            ?>
                                        </div>
                                    </a>
                                </div>

                                <div class="vn-post-content">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php echo viral_news_post_date(); ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}


if (!function_exists('viral_news_carousel_section')) {

    function viral_news_carousel_section($args) {
        $title = $args['title'];
        $slide_no = $args['slide_no'];
        $post_no = $args['post_no'];
        $cat = $args['cat'];
        ?>
        <div class="vn-carousel-block" data-count="<?php echo esc_attr($slide_no); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
                <?php
            }
            echo viral_news_is_amp() ? '<amp-base-carousel class="amp-slider vn-carousel-block-wrap" layout="responsive" width="1" height="1" heights="(min-width: 1199px) 23%,(min-width: 900px) 31.33%,(min-width: 600px) 48%, 100%" visible-count="(min-width: 1199px) 4,(min-width: 900px) 3,(min-width: 600px) 2, 1" auto-advance="true" auto-advance-interval="3000">' : '<div class="vn-carousel-block-wrap owl-carousel">';
            $args = array(
                'cat' => $cat,
                'posts_per_page' => absint($post_no),
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($args);
            while ($query->have_posts()):
                $query->the_post();
                ?>
                <div class="vn-post-item">
                    <div class="vn-post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            echo viral_news_is_amp() ? '' : '<div class="vn-thumb-container">';

                            if (has_post_thumbnail()) {
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                ?>
                                <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                <?php
                            }
                            echo viral_news_is_amp() ? '' : '</div>'
                                ?>
                        </a>
                    </div>

                    <div class="vn-post-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php echo viral_news_post_date(); ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            echo viral_news_is_amp() ? '</amp-base-carousel>' : '</div>';
            ?>
        </div>
        <?php
    }

}