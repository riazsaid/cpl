<?php
/**
 * Shared title + rich text section rendered in two columns.
 *
 * Args:
 * - section_heading (string) Required.
 * - description (string) Required HTML from WYSIWYG.
 */

if (!defined('ABSPATH')) {
    exit;
}

$section_heading = isset($args['section_heading']) ? trim((string) $args['section_heading']) : '';
$description     = isset($args['description']) ? trim((string) $args['description']) : '';

if ($section_heading === '' || $description === '') {
    return;
}

$description = wpautop($description);
?>

<section class="title-description-columns">
    <div class="container">
        <div class="title-description-columns__inner">
            <h2 class="title-description-columns__heading"><?php echo esc_html($section_heading); ?></h2>

            <div class="title-description-columns__content" data-title-description-columns>
                <div class="title-description-columns__source" data-title-description-source>
                    <?php echo wp_kses_post($description); ?>
                </div>

                <div class="title-description-columns__split" data-title-description-split hidden>
                    <div class="title-description-columns__column" data-title-description-left></div>
                    <div class="title-description-columns__column" data-title-description-right></div>
                </div>
            </div>
        </div>
    </div>
</section>
