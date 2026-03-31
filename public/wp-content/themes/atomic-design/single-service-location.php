<?php
/**
 * Single Service Location template
 *
 * e.g. /locations/{city-slug}/{service-slug}/
 * Structure: Gutenberg blocks → Industry Solutions → Testimonials → FAQs.
 */
get_header();
?>

<main id="site-content">
    <?php
    if (function_exists('get_field')) {
        get_template_part('template-parts/shared/hero', null, ['post_id' => get_queried_object_id()]);
    }

    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>

    <?php
    get_template_part('template-parts/shared/industry-solutions');
    get_template_part('template-parts/shared/testimonials');
    if (function_exists('get_field')) {
        get_template_part('template-parts/shared/faqs', null, ['post_id' => get_queried_object_id()]);
    }
    ?>
</main>

<?php
get_footer();
