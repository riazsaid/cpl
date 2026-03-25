<?php
/**
 * CPT CTA — optional heading + button (text + url).
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
$text    = 'Request a Quote';
$url     = '/request-quote/';
switch ($pt) {
    case 'service':
        $heading = get_field('service_cta_heading', $post_id);
        $text    = get_field('service_cta_text', $post_id) ?: $text;
        $url     = get_field('service_cta_url', $post_id) ?: $url;
        break;
    case 'industry':
        $heading = get_field('industry_cta_heading', $post_id);
        $text    = get_field('industry_cta_text', $post_id) ?: $text;
        $url     = get_field('industry_cta_url', $post_id) ?: $url;
        break;
    case 'location':
        $text = get_field('location_cta_text', $post_id) ?: $text;
        $url  = get_field('location_cta_url', $post_id) ?: $url;
        break;
    case 'location_service':
        $text = get_field('ls_cta_text', $post_id) ?: $text;
        $url  = get_field('ls_cta_url', $post_id) ?: $url;
        break;
}
if (empty($text) || empty($url)) {
    return;
}
?>
<section class="cpt-cta section">
    <div class="container cpt-cta__inner">
        <?php if ($heading) : ?>
            <h2 class="cpt-cta__heading"><?php echo wp_kses_post($heading); ?></h2>
        <?php endif; ?>
        <p class="cpt-cta__actions">
            <a href="<?php echo esc_url($url); ?>" class="cpt-cta__btn"><?php echo esc_html($text); ?></a>
        </p>
    </div>
</section>
