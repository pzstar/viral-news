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


if (!function_exists('viral_news_top_section_style1')) {

    function viral_news_top_section_style1($args) {
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        if ($layout != 'style1')
            return;
        ?>
        <div class="vl-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>

            <div class="vl-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $index = $query->current_post + 1;
                    ?>
                    <div class="vl-post-item">
                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600'); ?>
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
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

                        <div class="vl-post-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php echo viral_news_post_date(); ?>

                            <?php if ($index != 1) { ?>
                                <div class="vl-excerpt">
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
        <div class="vl-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vl-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    $title_class = $index == 1 ? 'vl-large-title' : '';
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');

                    if ($index == 1) {
                        echo '<div class="col1">';
                    } elseif ($index == 2) {
                        echo '<div class="col2">';
                    } elseif ($index == 4) {
                        echo '<div class="col3">';
                    }
                    ?>
                    <div class="vl-post-item">
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
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

                        <div class="vl-post-content">
                            <h3 class="vl-post-title <?php echo esc_attr($title_class) ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php viral_news_post_date(); ?>

                            <?php if ($index == 1) { ?>
                                <div class="vl-excerpt">
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
        <div class="vl-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vl-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                    if ($index == 1) {
                        echo '<div class="col1">';
                    } elseif ($index == 2) {
                        echo '<div class="col2">';
                        echo '<div class="col2-wrap">';
                    }
                    if ($index == 1) {
                        ?>
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>

                                    <div class="vl-post-content vl-gradient-overlay">
                                        <h3 class="vl-post-title vl-large-title"><span><?php the_title(); ?></span></h3>
                                        <?php echo viral_news_post_date(); ?>
                                    </div>
                                </a>
                                <?php echo get_the_category_list(); ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="vl-post-item">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                                <?php viral_news_post_primary_category(); ?>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
        <div class="vl-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vl-top-block-wrap">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 6,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    $title_class = ($index == 1 || $index == 2) ? 'vl-big-title' : '';
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                    ?>
                    <div class="vl-post-item">
                        <div class="vl-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vl-thumb-container">
                                    <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
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

                        <div class="vl-post-content">
                            <h3 class="vl-post-title <?php echo esc_attr($title_class) ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
        <div class="vl-middle-block vl-clearfix <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vl-clearfix vl-big-small-block">
                <?php
                while ($query->have_posts()): $query->the_post();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400')
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 220); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 4,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );
                    $query = new WP_Query($args);

                    while ($query->have_posts()): $query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150')
                        ?>
                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
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
        <div class="vl-middle-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vl-1-3-block">
                <div class="vl-big-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 1,
                        'ignore_sticky_posts' => true
                    );

                    $query = new WP_Query($args);
                    while ($query->have_posts()): $query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-840x440')
                        ?>

                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                    <div class="vl-post-content vl-gradient-overlay">
                                        <h3 class="vl-large-title vl-post-title"><span><?php the_title(); ?></span></h3>
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
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 3,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()): $query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400')
                        ?>
                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
        <div class="vl-middle-block vl-clearfix <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vl-1-6-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 280); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <?php
                    $args = array(
                        'cat' => $cat,
                        'posts_per_page' => 6,
                        'ignore_sticky_posts' => true,
                        'offset' => 1
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()): $query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150');
                        ?>
                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
        <div class="vl-middle-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vl-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>

            <div class="vl-clearfix vl-1-4-block">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                    ?>
                    <div class="vl-big-block">
                        <div class="vl-post-item vl-clearfix">
                            <div class="vl-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="vl-thumb-container">
                                        <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                    </div>
                                </a>
                            </div>

                            <div class="vl-post-content">
                                <h3 class="vl-big-title vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo viral_news_post_date(); ?>
                                <div class="vl-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 150); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="vl-small-block">
                    <div class="vl-small-block-wrap">
                        <?php
                        $args = array(
                            'cat' => $cat,
                            'posts_per_page' => 4,
                            'ignore_sticky_posts' => true,
                            'offset' => 1
                        );

                        $query = new WP_Query($args);

                        while ($query->have_posts()): $query->the_post();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400');
                            ?>
                            <div class="vl-post-item vl-clearfix">
                                <div class="vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vl-thumb-container">
                                            <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                        </div>
                                    </a>
                                </div>

                                <div class="vl-post-content">
                                    <h3 class="vl-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
        <div class="vl-bottom-block vl-clearfix <?php echo esc_attr($layout); ?>">
            <?php
            foreach ($cats as $cat) {
                ?>
                <div class="vl-clearfix vl-three-column-block">
                    <?php
                    if ($cat) {
                        $cat_name = ($cat != '-1' ) ? get_cat_name($cat) : esc_html__('Latest', 'viral-news');
                        ?>
                        <h2 class="vl-block-title"><span><?php echo esc_html($cat_name); ?></span></h2>

                        <?php
                        $args = array(
                            'posts_per_page' => 1,
                            'ignore_sticky_posts' => true
                        );

                        if ($cat != '-1') {
                            $args['cat'] = $cat;
                        }
                        $query = new WP_Query($args);
                        while ($query->have_posts()): $query->the_post();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-400x400')
                            ?>
                            <div class="vl-big-post-item vl-clearfix">
                                <div class="vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vl-thumb-container">
                                            <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                        </div>

                                        <div class="vl-post-content">
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
                        while ($query->have_posts()): $query->the_post();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150')
                            ?>
                            <div class="vl-post-item vl-clearfix">
                                <div class="vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vl-thumb-container">
                                            <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                        </div>
                                    </a>
                                </div>

                                <div class="vl-post-content">
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
        <div class="vl-bottom-block vl-clearfix <?php echo esc_attr($layout); ?>">
            <?php
            foreach ($cats as $cat) {
                ?>
                <div class="vl-clearfix vl-three-column-block">
                    <?php
                    if ($cat) {
                        $cat_name = ($cat != '-1' ) ? get_cat_name($cat) : esc_html__('Latest', 'viral-news');
                        ?>
                        <h2 class="vl-block-title"><span><?php echo esc_html($cat_name); ?></span></h2>

                        <?php
                        $args = array(
                            'posts_per_page' => 4,
                            'ignore_sticky_posts' => true
                        );

                        if ($cat != '-1') {
                            $args['cat'] = $cat;
                        }
                        $query = new WP_Query($args);
                        while ($query->have_posts()): $query->the_post();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-150x150')
                            ?>
                            <div class="vl-post-item vl-clearfix">
                                <div class="vl-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="vl-thumb-container">
                                            <img alt="<?php echo esc_attr(get_the_title()) ?>" src="<?php echo esc_url($image[0]) ?>">
                                        </div>
                                    </a>
                                </div>

                                <div class="vl-post-content">
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