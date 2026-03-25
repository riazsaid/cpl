<?php
/**
 * CPT Hero section — Hero heading, subtext, optional background image.
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
$subtext = '';
$image   = null;
switch ($pt) {
    case 'service':
        $heading = get_field('service_hero_heading', $post_id);
        $subtext = get_field('service_hero_subtext', $post_id);
        $image   = get_field('service_hero_image', $post_id);
        break;
    case 'industry':
        $heading = get_field('industry_hero_heading', $post_id);
        $subtext = get_field('industry_hero_subtext', $post_id);
        $image   = get_field('industry_hero_image', $post_id);
        break;
    case 'location':
        $heading = get_field('location_hero_heading', $post_id);
        $subtext = get_field('location_hero_subtext', $post_id);
        $image   = get_field('location_hero_image', $post_id);
        break;
    case 'location_service':
        $heading = get_field('ls_hero_heading', $post_id);
        $subtext = get_field('ls_hero_subtext', $post_id);
        $image   = get_field('ls_hero_image', $post_id);
        break;
}
if (empty($heading) && empty($subtext)) {
    return;
}
$bg_style = '';
if (!empty($image['url'])) {
    $bg_style = ' style="background-image:url(' . esc_url($image['url']) . ');"';
}
?>
<section class="cpt-hero"<?php echo $bg_style; ?>>
    <div class="container cpt-hero__inner">
        <?php if ($heading) : ?>
            <h1 class="cpt-hero__title"><?php echo esc_html($heading); ?></h1>
        <?php endif; ?>
        <?php if ($subtext) : ?>
            <div class="cpt-hero__subtext"><?php echo wpautop(esc_html($subtext)); ?></div>
        <?php endif; ?>
    </div>
</section>
