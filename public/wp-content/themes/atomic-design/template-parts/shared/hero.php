<?php
/**
 * Shared Hero renderer.
 *
 * Args:
 * - post_id (int) Optional. Defaults to current post ID.
 * - kicker (string) Optional.
 * - title (string) Optional.
 * - subtitle (string) Optional.
 * - primary (array) Optional ACF link array.
 * - bg_url (string) Optional background image URL.
 * - align (string) Optional Gutenberg alignment slug, defaults to full.
 * - class_name (string) Optional extra class names.
 */

$hero_post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();

$kicker = isset($args['kicker'])
    ? (string) $args['kicker']
    : (function_exists('get_field') ? (string) get_field('hero_kicker', $hero_post_id) : '');

$title = isset($args['title'])
    ? (string) $args['title']
    : (function_exists('get_field') ? (string) get_field('hero_title', $hero_post_id) : '');

$subtitle = isset($args['subtitle'])
    ? (string) $args['subtitle']
    : (function_exists('get_field') ? (string) get_field('hero_subtitle', $hero_post_id) : '');

$primary = isset($args['primary']) && is_array($args['primary'])
    ? $args['primary']
    : (function_exists('get_field') ? (get_field('hero_primary_link', $hero_post_id) ?: []) : []);

$bg_url = isset($args['bg_url']) ? (string) $args['bg_url'] : '';
if ($bg_url === '' && function_exists('get_field')) {
    $hero_media = get_field('hero_media', $hero_post_id);
    if (is_array($hero_media) && !empty($hero_media['url'])) {
        $bg_url = (string) $hero_media['url'];
    }
}

$align      = !empty($args['align']) ? (string) $args['align'] : 'full';
$class_name = isset($args['class_name']) ? (string) $args['class_name'] : '';

if ($title === '' && $subtitle === '') {
    return;
}

$style_attr = '';
if ($bg_url !== '') {
    $style_attr = ' style="background-image: linear-gradient(90deg, rgba(2, 6, 23, 0.92) 0%, rgba(2, 6, 23, 0.78) 40%, rgba(2, 6, 23, 0.35) 70%, rgba(2, 6, 23, 0.05) 100%), url(' . esc_url($bg_url) . ');"';
}

$align_class   = 'align' . $align;
$section_class = trim('hero ' . $align_class . ' ' . $class_name);
?>

<section class="<?php echo esc_attr($section_class); ?>"<?php echo $style_attr; ?>>
    <div class="container hero__inner hero__inner--single">
        <div class="hero__content">
            <?php if ($kicker !== '') : ?>
                <span class="eyebrow hero__kicker"><?php echo esc_html($kicker); ?></span>
            <?php endif; ?>

            <?php if ($title !== '') : ?>
                <div class="hero__title"><?php echo wp_kses_post($title); ?></div>
            <?php endif; ?>

            <?php if ($subtitle !== '') : ?>
                <div class="hero__subtitle body-lg"><?php echo wp_kses_post(wpautop($subtitle)); ?></div>
            <?php endif; ?>

          
        </div>
    </div>
</section>
<?php if (!empty($primary['url']) && !empty($primary['title'])) : ?>
                <div class="container hero__actions">
                    <a class="btn btn-primary"
                       href="<?php echo esc_url($primary['url']); ?>"
                       target="<?php echo esc_attr($primary['target'] ?: '_self'); ?>">
                        <?php echo esc_html($primary['title']); ?>
                    </a>
                </div>
            <?php endif; ?>
