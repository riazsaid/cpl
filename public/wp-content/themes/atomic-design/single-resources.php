<?php
/**
 * Single Resources template
 *
 * Resources are built in the Gutenberg editor, so this template intentionally
 * outputs the saved block content without adding the shared CPT sections.
 */
get_header();
?>

<main id="site-content">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <header class="resource-single-header">
            <h1><?php the_title(); ?></h1>
        </header>
        <?php
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();
