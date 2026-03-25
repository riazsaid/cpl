<?php
/**
 * Testimonials Block (acf/testimonials)
 *
 * Uses the same partial as CPT template pages. One HTML source, one CSS file.
 * Data from Synced Components → Testimonials.
 */
if (!function_exists('get_field')) {
    return;
}
$testimonials = get_field('testimonials_list', 'option');
if (!empty($is_preview) && (empty($testimonials) || !is_array($testimonials))) {
    echo '<div style="padding:2rem;border:2px dashed #ccc;text-align:center;color:#888;">';
    echo '<strong>Testimonials</strong><br>Add reviews at <em>Synced Components → Testimonials</em>.';
    echo '</div>';
    return;
}
get_template_part('template-parts/shared/testimonials');
