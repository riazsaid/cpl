<?php
/**
 * Industry Solutions Block (acf/industry-solutions)
 *
 * Uses the same partial as CPT template pages. One HTML source, one CSS file.
 * Data from Synced Components → Industry Solutions.
 */
if (!function_exists('get_field')) {
    return;
}
$items = get_field('industry_solutions_list', 'option');
if (!empty($is_preview) && (empty($items) || !is_array($items))) {
    echo '<div style="padding:2rem;border:2px dashed #ccc;text-align:center;color:#888;">';
    echo '<strong>Industry Solutions</strong><br>Add items at <em>Synced Components → Industry Solutions</em>.';
    echo '</div>';
    return;
}
get_template_part('template-parts/shared/industry-solutions');
