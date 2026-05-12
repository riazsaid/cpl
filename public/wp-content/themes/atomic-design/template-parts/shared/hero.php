<?php
/**
 * Shared Hero renderer.
 *
 * Args:
 * - post_id (int) Optional. Defaults to current post ID.
 * - title (string) Optional.
 * - subtitle (string) Optional.
 * - primary (array) Optional ACF link array.
 * - secondary (array) Optional ACF link array.
 * - image_id (int) Optional hero image attachment ID.
 * - bg_url (string) Optional fallback image URL.
 * - align (string) Optional Gutenberg alignment slug, defaults to full.
 * - class_name (string) Optional extra class names.
 */

$hero_post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();

$title = isset($args['title'])
    ? (string) $args['title']
    : (function_exists('get_field') ? (string) get_field('hero_title', $hero_post_id) : '');

$subtitle = isset($args['subtitle'])
    ? (string) $args['subtitle']
    : (function_exists('get_field') ? (string) get_field('hero_subtitle', $hero_post_id) : '');

$primary = isset($args['primary']) && is_array($args['primary'])
    ? $args['primary']
    : (function_exists('get_field') ? (get_field('hero_primary_link', $hero_post_id) ?: []) : []);

$secondary = isset($args['secondary']) && is_array($args['secondary'])
    ? $args['secondary']
    : (function_exists('get_field') ? (get_field('hero_secondary_link', $hero_post_id) ?: []) : []);

$image_id = isset($args['image_id']) ? (int) $args['image_id'] : 0;
$bg_url   = isset($args['bg_url']) ? (string) $args['bg_url'] : '';
if (($image_id <= 0 || $bg_url === '') && function_exists('get_field')) {
    $hero_media = get_field('hero_media', $hero_post_id);
    if ($image_id <= 0 && is_array($hero_media) && !empty($hero_media['ID'])) {
        $image_id = (int) $hero_media['ID'];
    }
    if (is_array($hero_media) && !empty($hero_media['url'])) {
        $bg_url = (string) $hero_media['url'];
    }
}

$align      = !empty($args['align']) ? (string) $args['align'] : 'full';
$class_name = isset($args['class_name']) ? (string) $args['class_name'] : '';

if ($title === '' && $subtitle === '') {
    return;
}

$align_class   = 'align' . $align;
$has_image     = $image_id > 0 || $bg_url !== '';
$section_class = trim('hero ' . ($has_image ? 'hero--has-image ' : '') . $align_class . ' ' . $class_name);
?>

<section class="<?php echo esc_attr($section_class); ?>">
    <?php if ($image_id > 0) : ?>
        <?php
        echo wp_get_attachment_image(
            $image_id,
            'full',
            false,
            [
                'class'         => 'hero__image',
                'loading'       => 'eager',
                'fetchpriority' => 'high',
                'decoding'      => 'async',
            ]
        );
        ?>
    <?php elseif ($bg_url !== '') : ?>
        <img
            class="hero__image"
            src="<?php echo esc_url($bg_url); ?>"
            alt=""
            loading="eager"
            fetchpriority="high"
            decoding="async"
        >
    <?php endif; ?>
    <div class="container hero__inner hero__inner--single">
        <div class="hero__content">
            <?php if ($title !== '') : ?>
                <h1 class="hero__title hero__title--animate"><?php echo wp_kses_post($title); ?></h1>
            <?php endif; ?>

            <?php if ($subtitle !== '') : ?>
                <div class="hero__subtitle hero__subtitle--animate body-lg"><?php echo wp_kses_post(wpautop($subtitle)); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<div class="hero__actions hero__actions--animate container">
    <?php if (!empty($primary['url']) && !empty($primary['title'])) : ?>
        <a class="hero__link hero__link--primary"
           href="<?php echo esc_url($primary['url']); ?>"
           target="<?php echo esc_attr($primary['target'] ?: '_self'); ?>">
            <?php echo esc_html($primary['title']); ?>
        </a>
    <?php endif; ?>

    <?php if (!empty($secondary['url']) && !empty($secondary['title'])) : ?>
        <a class="hero__link hero__link--secondary"
           href="<?php echo esc_url($secondary['url']); ?>"
           target="<?php echo esc_attr($secondary['target'] ?: '_self'); ?>">
            <span><?php echo esc_html($secondary['title']); ?></span>
            <span class="hero__link-arrow" aria-hidden="true">→</span>
        </a>
    <?php endif; ?>
</div>

<script>
(function () {
    var title = document.querySelector('.hero__title--animate');
    if (!title) return;
    // Split text nodes into word spans (preserves inline HTML like <strong>)
    var html = title.innerHTML;
    // Wrap each word with a span
    title.innerHTML = html.replace(/(\S+)/g, '<span class="hero__word">$1</span>');
    // Set CSS custom property for delay index
    var words = title.querySelectorAll('.hero__word');
    words.forEach(function (w, i) {
        w.style.setProperty('--i', i);
    });
})();
</script>
