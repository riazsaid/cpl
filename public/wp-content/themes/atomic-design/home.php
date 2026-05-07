<?php
/**
 * Blog landing page.
 */

get_header();

$paged = max(1, (int) get_query_var('paged'));
$grid_query = new WP_Query([
    'posts_per_page'      => 9,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'paged'               => $paged,
]);

$categories = get_categories([
    'hide_empty' => true,
]);
?>

<main id="site-content" class="blog-index">
    <section class="blog-intro">
        <div class="container">
            <p class="blog-intro__eyebrow"><?php esc_html_e('Insights', 'atomic-design'); ?></p>
            <h1 class="blog-intro__title"><?php echo esc_html(atomic_design_get_blog_page_title()); ?></h1>
            <p class="blog-intro__subtitle">
                <?php esc_html_e('Practical guidance for phenolic labels, engraved tags, material selection, ordering, and compliance-ready identification.', 'atomic-design'); ?>
            </p>
        </div>
    </section>

    <?php if (!empty($categories)) : ?>
        <nav class="blog-category-filter container" aria-label="<?php esc_attr_e('Blog categories', 'atomic-design'); ?>">
            <a class="blog-category-filter__pill is-active" href="<?php echo esc_url(atomic_design_get_blog_page_url()); ?>">
                <?php esc_html_e('All', 'atomic-design'); ?>
            </a>
            <?php foreach ($categories as $category) : ?>
                <a class="blog-category-filter__pill" href="<?php echo esc_url(get_category_link($category)); ?>">
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    <?php endif; ?>

    <section class="blog-latest container">
        <?php if ($grid_query->have_posts()) : ?>
            <div class="blog-grid">
                <?php
                while ($grid_query->have_posts()) :
                    $grid_query->the_post();
                    get_template_part('template-parts/blog/post-card', null, ['variant' => 'grid']);
                endwhile;
                ?>
            </div>

            <?php
            $pagination = paginate_links([
                'total'     => $grid_query->max_num_pages,
                'current'   => $paged,
                'mid_size'  => 1,
                'prev_text' => __('Previous', 'atomic-design'),
                'next_text' => __('Next', 'atomic-design'),
            ]);
            ?>
            <?php if ($pagination) : ?>
                <nav class="blog-pagination" aria-label="<?php esc_attr_e('Blog pagination', 'atomic-design'); ?>">
                    <?php echo wp_kses_post($pagination); ?>
                </nav>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p class="blog-empty"><?php esc_html_e('No posts found yet.', 'atomic-design'); ?></p>
        <?php endif; ?>
    </section>

    <section class="blog-newsletter">
        <div class="container blog-newsletter__inner">
            <div>
                <p class="blog-newsletter__eyebrow"><?php esc_html_e('Stay Updated', 'atomic-design'); ?></p>
                <h2><?php esc_html_e('Get practical labeling guidance in your inbox.', 'atomic-design'); ?></h2>
            </div>
            <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">
                <?php esc_html_e('Contact Us', 'atomic-design'); ?>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
