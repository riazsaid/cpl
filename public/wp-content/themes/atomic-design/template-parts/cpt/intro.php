<?php
/**
 * CPT Intro section — optional heading + main content.
 * Used on service, industry, location, location_service.
 *
 * Args: post_id (int)
 */
if (!defined('ABSPATH') || !function_exists('get_field')) {
    return;
}
$post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_queried_object_id();
$pt      = get_post_type($post_id);

$heading = '';
$content = '';
switch ($pt) {
    case 'service':
        $heading = get_field('service_intro_heading', $post_id);
        $content = get_field('service_intro_content', $post_id);
        break;
    case 'industry':
        $content = get_field('industry_intro_content', $post_id);
        break;
    case 'location':
        $content = get_field('location_intro_content', $post_id);
        break;
    case 'location_service':
        $content = get_field('ls_intro_content', $post_id);
        break;
}
if (empty($content) && empty($heading)) {
    return;
}
?>
<section class="cpt-intro section">
    <div class="container">
        <?php if ($heading) : ?>
            <h2 class="cpt-intro__heading"><?php echo wp_kses_post($heading); ?></h2>
        <?php endif; ?>
        <?php if ($content) : ?>
            <div class="cpt-intro__content"><?php echo wp_kses_post($content); ?></div>
        <?php endif; ?>
    </div>
</section>
