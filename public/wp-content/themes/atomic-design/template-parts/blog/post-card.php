<?php
/**
 * Blog post card.
 *
 * @var array $args {
 *     @type string $variant Card variant: grid|secondary|related.
 * }
 */

$variant  = $args['variant'] ?? 'grid';
$post_id  = get_the_ID();
$category = atomic_design_get_primary_category($post_id);
?>

<article <?php post_class('blog-card blog-card--' . sanitize_html_class($variant)); ?>>
    <div class="blog-card__body">
        <?php if ($category) : ?>
            <a class="blog-meta__category" href="<?php echo esc_url(get_category_link($category)); ?>">
                <?php echo esc_html($category->name); ?>
            </a>
        <?php endif; ?>
        <h3 class="blog-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="blog-card__byline">
            <span><?php echo esc_html__('By', 'atomic-design') . ' ' . esc_html(get_the_author()); ?></span>
            <span aria-hidden="true">•</span>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('F j, Y')); ?></time>
        </div>
        <p class="blog-card__excerpt"><?php echo esc_html(atomic_design_get_post_excerpt($post_id, 32)); ?></p>
        <a class="blog-card__read-more" href="<?php the_permalink(); ?>">
            <?php esc_html_e('Read More', 'atomic-design'); ?>
            <span aria-hidden="true">→</span>
        </a>
    </div>
</article>
