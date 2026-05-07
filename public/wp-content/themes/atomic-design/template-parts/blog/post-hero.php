<?php
/**
 * Blog hero post card.
 */

$post_id   = get_the_ID();
$category  = atomic_design_get_primary_category($post_id);
$author_id = get_the_author_meta('ID');
?>

<article <?php post_class('blog-hero-card'); ?>>
    <a class="blog-hero-card__media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large', ['loading' => 'eager', 'decoding' => 'async']); ?>
        <?php else : ?>
            <span class="blog-card__placeholder" aria-hidden="true"></span>
        <?php endif; ?>
        <span class="blog-hero-card__badge"><?php esc_html_e('Featured', 'atomic-design'); ?></span>
    </a>
    <div class="blog-hero-card__body">
        <div class="blog-meta">
            <?php if ($category) : ?>
                <a class="blog-meta__category" href="<?php echo esc_url(get_category_link($category)); ?>">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endif; ?>
            <span><?php echo esc_html(get_the_date('M j, Y')); ?></span>
            <span><?php echo esc_html(sprintf(__('%d min read', 'atomic-design'), atomic_design_get_read_time($post_id))); ?></span>
        </div>
        <h2 class="blog-hero-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <p class="blog-hero-card__excerpt"><?php echo esc_html(atomic_design_get_post_excerpt($post_id, 34)); ?></p>
        <div class="blog-author">
            <?php echo get_avatar($author_id, 36, '', '', ['class' => 'blog-author__avatar']); ?>
            <div>
                <span class="blog-author__name"><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></span>
                <span class="blog-author__role"><?php esc_html_e('Author', 'atomic-design'); ?></span>
            </div>
        </div>
    </div>
</article>
