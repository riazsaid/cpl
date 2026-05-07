<?php
/**
 * Single blog post template.
 */

get_header();
the_post();

$post_id    = get_the_ID();
$category   = atomic_design_get_primary_category($post_id);
$content    = apply_filters('the_content', get_the_content());
$previous   = get_previous_post();
$next       = get_next_post();
$tags       = get_the_tags($post_id);
$related    = new WP_Query([
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post__not_in'        => [$post_id],
    'ignore_sticky_posts' => true,
    'category__in'        => $category ? [$category->term_id] : [],
]);
?>

<main id="site-content" class="single-blog-post">
    <article <?php post_class('article-shell'); ?>>
        <div class="article-card">
            <header class="article-header">
                <?php if ($category) : ?>
                    <a class="article-eyebrow" href="<?php echo esc_url(get_category_link($category)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php endif; ?>

                <h1 class="article-title"><?php the_title(); ?></h1>

                <div class="article-byline">
                    <span><?php echo esc_html__('By', 'atomic-design') . ' ' . esc_html(get_the_author()); ?></span>
                    <span aria-hidden="true">•</span>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('F j, Y')); ?></time>
                </div>
            </header>

            <div class="article-content">
                <?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>

            <?php if ($tags) : ?>
                <div class="article-tags" aria-label="<?php esc_attr_e('Post tags', 'atomic-design'); ?>">
                    <?php foreach ($tags as $tag) : ?>
                        <a class="article-tag" href="<?php echo esc_url(get_tag_link($tag)); ?>">
                            #<?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </article>

    <nav class="article-post-nav container" aria-label="<?php esc_attr_e('Post navigation', 'atomic-design'); ?>">
        <div class="article-post-nav__item">
            <?php if ($previous) : ?>
                <a href="<?php echo esc_url(get_permalink($previous)); ?>">
                    <span><?php esc_html_e('← Previous', 'atomic-design'); ?></span>
                    <strong><?php echo esc_html(get_the_title($previous)); ?></strong>
                </a>
            <?php endif; ?>
        </div>
        <span class="article-post-nav__divider" aria-hidden="true"></span>
        <div class="article-post-nav__item article-post-nav__item--next">
            <?php if ($next) : ?>
                <a href="<?php echo esc_url(get_permalink($next)); ?>">
                    <span><?php esc_html_e('Next →', 'atomic-design'); ?></span>
                    <strong><?php echo esc_html(get_the_title($next)); ?></strong>
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <?php if ($related->have_posts()) : ?>
        <section class="article-related">
            <div class="container">
                <div class="blog-section-head">
                    <h2><?php esc_html_e('Similar Posts', 'atomic-design'); ?></h2>
                </div>
                <div class="blog-grid blog-grid--related">
                    <?php
                    while ($related->have_posts()) :
                        $related->the_post();
                        get_template_part('template-parts/blog/post-card', null, ['variant' => 'related']);
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
