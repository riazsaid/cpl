<?php
/**
 * Single Industry template
 *
 * Structure: Hero → Intro → Use Cases → CTA → (editor content) → Industry Solutions → Testimonials → FAQs.
 */
get_header();
$post_id = get_queried_object_id();
?>

<main id="site-content">
    <?php
    get_template_part('template-parts/cpt/hero', null, ['post_id' => $post_id]);
    get_template_part('template-parts/shared/trust-bar');
    get_template_part('template-parts/cpt/intro', null, ['post_id' => $post_id]);
    get_template_part('template-parts/cpt/benefits-use-cases', null, ['post_id' => $post_id]);
    get_template_part('template-parts/cpt/cta', null, ['post_id' => $post_id]);
    ?>

    <section class="section">
        <div class="container">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>  
        </div>
    </section>

    <?php
    get_template_part('template-parts/shared/industry-solutions');
    get_template_part('template-parts/shared/testimonials');
    if (function_exists('get_field')) {
        get_template_part('template-parts/shared/faqs', null, ['post_id' => $post_id]);
    }
    ?>
</main>

<?php
get_footer();
