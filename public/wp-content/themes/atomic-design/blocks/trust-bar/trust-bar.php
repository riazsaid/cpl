<?php
/**
 * Trust Bar Block (acf/trust-bar)
 *
 * Same partial & CSS as on CPT pages. Use on static pages.
 */
if (!function_exists('get_field')) {
    return;
}
$items = get_field('trust_bar_items', 'option');
if (!empty($is_preview) && (empty($items) || !is_array($items))) {
    echo '<div style="padding:2rem;border:2px dashed #ccc;text-align:center;color:#888;">';
    echo '<strong>Trust Bar</strong><br>Add items at <em>Synced Components → Trust Bar</em>.';
    echo '</div>';
    return;
}
get_template_part('template-parts/shared/trust-bar');
