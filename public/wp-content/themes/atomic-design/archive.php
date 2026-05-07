<?php
/**
 * Blog archive template for categories, tags, authors, and dates.
 */

get_header();
?>

<main id="site-content" class="blog-index blog-archive">
    <section class="blog-intro">
        <div class="container">
            <p class="blog-intro__eyebrow"><?php esc_html_e('Archive', 'atomic-design'); ?></p>
            <h1 class="blog-intro__title"><?php the_archive_title(); ?></h1>
            <?php if (get_the_archive_description()) : ?>
                <div class="blog-intro__subtitle"><?php the_archive_description(); ?></div>
            <?php endif; ?>
        </div>
    </section>

    <section class="blog-latest container">
        <?php if (have_posts()) : ?>
            <div class="blog-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/blog/post-card', null, ['variant' => 'grid']);
                endwhile;
                ?>
            </div>

            <?php
            $pagination = paginate_links([
                'mid_size'  => 1,
                'prev_text' => __('Previous', 'atomic-design'),
                'next_text' => __('Next', 'atomic-design'),
            ]);
            ?>
            <?php if ($pagination) : ?>
                <nav class="blog-pagination" aria-label="<?php esc_attr_e('Archive pagination', 'atomic-design'); ?>">
                    <?php echo wp_kses_post($pagination); ?>
                </nav>
            <?php endif; ?>
        <?php else : ?>
            <p class="blog-empty"><?php esc_html_e('No posts found.', 'atomic-design'); ?></p>
        <?php endif; ?>
    </section>
</main>

<?php
get_footer();
