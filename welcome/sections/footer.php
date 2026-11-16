<?php
$viral_news_pro_demos = array(
    array('Spotlight', 'spotlight.jpg', 'https://demo.hashthemes.com/viral-pro/spotlight/'),
    array('The Wellness Journal', 'wellness-journal.jpg', 'https://demo.hashthemes.com/viral-pro/wellness-journal/'),
    array('Buzz', 'buzz.jpg', 'https://demo.hashthemes.com/viral-pro/buzz/'),
    array('Headline', 'headline.jpg', 'https://demo.hashthemes.com/viral-pro/headline/'),
    array('Newspaper', 'newspaper.jpg', 'https://demo.hashthemes.com/viral-pro/newspaper/'),
    array('Food', 'food.jpg', 'https://demo.hashthemes.com/viral-pro/food/'),
    array('Magazine', 'magazine.jpg', 'https://demo.hashthemes.com/viral-pro/magazine/'),
    array('News', 'news.jpg', 'https://demo.hashthemes.com/viral-pro/news/'),
    array('News One', 'viral-news-one.jpg', 'https://demo.hashthemes.com/viral-pro/viral-news-one/'),
    array('News Two', 'viral-news-two.jpg', 'https://demo.hashthemes.com/viral-pro/viral-news-two/'),
    array('News Three', 'viral-news-three.jpg', 'https://demo.hashthemes.com/viral-pro/viral-news-three/'),
    array('News Four', 'viral-news-four.jpg', 'https://demo.hashthemes.com/viral-pro/viral-news-four/'),
    array('Sports', 'sports.jpg', 'https://demo.hashthemes.com/viral-pro/sports/'),
    array('Technology', 'technology.jpg', 'https://demo.hashthemes.com/viral-pro/technology/'),
    array('Illustration', 'illustration.jpg', 'https://demo.hashthemes.com/viral-pro/illustration/'),
    array('Fashion', 'fashion.jpg', 'https://demo.hashthemes.com/viral-pro/fashion/'),
    array('Travel', 'travel.jpg', 'https://demo.hashthemes.com/viral-pro/travel/'),
    array('Photography', 'photography.jpg', 'https://demo.hashthemes.com/viral-pro/photography/'),
    array('RTL', 'rtl.jpg', 'https://demo.hashthemes.com/viral-pro/rtl/'),
);
?>
<div class="welcome-pro-demos">
    <div class="welcome-pro-demos-head">
        <span class="welcome-kicker"><?php esc_html_e('Premium Demos', 'viral-news'); ?></span>
        <h3><?php esc_html_e('Launch Faster with a Viral Pro Demo', 'viral-news'); ?></h3>
        <p><?php esc_html_e('Viral Pro comes with professionally designed news and magazine demos, built with the Customizer or with Elementor. Import one in a single click and have a complete website ready in minutes.', 'viral-news'); ?></p>
    </div>

    <div class="welcome-demo-grid">
        <?php foreach ($viral_news_pro_demos as $viral_news_demo) { ?>
            <a class="welcome-demo" href="<?php echo esc_url($viral_news_demo[2]); ?>" target="_blank">
                <span class="welcome-demo-shot">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/' . $viral_news_demo[1]); ?>" alt="" loading="lazy">
                </span>
                <span class="welcome-demo-name">
                    <?php echo esc_html($viral_news_demo[0]); ?>
                    <span class="welcome-demo-preview"><?php echo esc_html__('Preview', 'viral-news'); ?> <span aria-hidden="true">&rarr;</span></span>
                </span>
            </a>
        <?php } ?>
        <a class="welcome-demo welcome-demo-more" href="https://demo.hashthemes.com/viral-pro/" target="_blank">
            <span class="dashicons dashicons-screenoptions" aria-hidden="true"></span>
            <strong><?php esc_html_e('See All Demos', 'viral-news'); ?></strong>
            <span><?php esc_html_e('Browse every Viral Pro demo, with a live preview of each one.', 'viral-news'); ?></span>
            <span class="welcome-demo-preview"><?php esc_html_e('View on HashThemes', 'viral-news'); ?> <span aria-hidden="true">&rarr;</span></span>
        </a>
    </div>
</div>

<div class="welcome-upgrade-box">
    <div class="welcome-guarantee" aria-hidden="true">
        <strong>7</strong>
        <span><?php esc_html_e('Day money back', 'viral-news'); ?></span>
    </div>
    <div class="upgrade-box-text">
        <h3><?php echo esc_html__('Upgrade to Viral Pro, Risk Free', 'viral-news'); ?></h3>
        <p><?php echo esc_html__('Viral Pro adds 50+ magazine blocks, 7 header layouts, 7 blog and 7 single post layouts, 20+ magazine widgets, a mega menu, an advertisement manager and 19 one-click demos.', 'viral-news'); ?></p>
        <p><?php echo esc_html__('Try it with peace of mind: if it is not right for you, ask within 7 days and we will refund your payment.', 'viral-news'); ?></p>
    </div>
    <a class="welcome-btn welcome-btn-pro" href="<?php echo esc_url(viral_news_upgrade_url('welcome-footer', 'viral-news-footer')); ?>" target="_blank"><?php esc_html_e('Upgrade Now', 'viral-news'); ?><span class="dashicons dashicons-arrow-right-alt" aria-hidden="true"></span></a>
</div>
