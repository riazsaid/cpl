<?php
/**
 * CPT Benefits (service) or Use Cases (industry) — repeater: title + description.
 * Location and location_service do not have this section.
 *
 * Args: post_id (int)
 */
if (!defined('ABSPATH') || !function_exists('get_field')) {
    return;
}
$post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_queried_object_id();
$pt      = get_post_type($post_id);

$section_heading = '';
$items          = [];
switch ($pt) {
    case 'service':
        $section_heading = get_field('service_benefits_heading', $post_id);
        $items            = get_field('service_benefits', $post_id);
        break;
    case 'industry':
        $section_heading = '';
        $items            = get_field('industry_use_cases', $post_id);
        break;
    default:
        return;
}
if (empty($items) || !is_array($items)) {
    return;
}
$title_key    = $pt === 'service' ? 'benefit_title' : 'use_case_title';
$desc_key     = $pt === 'service' ? 'benefit_description' : 'use_case_description';
$section_class = $pt === 'service' ? 'cpt-benefits' : 'cpt-use-cases';
?>
<section class="<?php echo esc_attr($section_class); ?> section">
    <div class="container">
        <?php if ($section_heading) : ?>
            <h2 class="cpt-repeater__heading"><?php echo wp_kses_post($section_heading); ?></h2>
        <?php endif; ?>
        <div class="cpt-repeater-grid">
            <?php foreach ($items as $item) :
                $title = $item[ $title_key ] ?? '';
                $desc  = $item[ $desc_key ] ?? '';
                if (empty($title) && empty($desc)) {
                    continue;
                }
            ?>
                <div class="cpt-repeater-card">
                    <?php if ($title) : ?>
                        <h3 class="cpt-repeater-card__title"><?php echo wp_kses_post($title); ?></h3>
                    <?php endif; ?>
                    <?php if ($desc) : ?>
                        <div class="cpt-repeater-card__description"><?php echo wp_kses_post($desc); ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
