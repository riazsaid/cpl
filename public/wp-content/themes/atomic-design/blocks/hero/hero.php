<?php
/**
 * Hero Block Template (acf/hero)
 *
 * Fields are attached via ACF JSON and appear in the block sidebar.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Block inner HTML (unused for ACF blocks).
 * @param bool   $is_preview True during Gutenberg preview.
 * @param int    $post_id    Current post ID.
 */

if (!function_exists('get_field')) {
    return;
}

$kicker   = get_field('hero_kicker') ?: '';
$title    = get_field('hero_title') ?: '';
$subtitle = get_field('hero_subtitle') ?: '';
$primary  = get_field('hero_primary_link');
$bg_image = get_field('hero_media'); // Reused field: now treated as the background image.

if ($is_preview && empty($title) && empty($subtitle)) {
    echo '<div style="padding:2rem;border:2px dashed #ccc;text-align:center;color:#888;">';
    echo '<strong>Hero</strong><br>Add a title/subtitle in the block sidebar.';
    echo '</div>';
    return;
}

if (empty($title) && empty($subtitle)) {
    return;
}

$bg_url = '';
if (!empty($bg_image) && is_array($bg_image) && !empty($bg_image['url'])) {
    $bg_url = $bg_image['url'];
}

$style_attr = '';
if ($bg_url) {
    // Full background image with a dark left overlay for text readability.
    $style_attr = ' style="background-image: linear-gradient(90deg, rgba(2, 6, 23, 0.92) 0%, rgba(2, 6, 23, 0.78) 40%, rgba(2, 6, 23, 0.35) 70%, rgba(2, 6, 23, 0.05) 100%), url(' . esc_url($bg_url) . ');"';
}

// Block alignment class from Gutenberg (e.g. alignfull / alignwide).
$align_class = '';
if (!empty($block['align'])) {
    $align_class = 'align' . $block['align'];
}
$extra_class = !empty($block['className']) ? $block['className'] : '';
$section_class = trim('hero ' . $align_class . ' ' . $extra_class);
?>

<section class="<?php echo esc_attr($section_class); ?>"<?php echo $style_attr; ?>>
    <div class="container hero__inner hero__inner--single">

        <div class="hero__content">
            <?php if (!empty($kicker)) : ?>
                <span class="eyebrow hero__kicker"><?php echo esc_html($kicker); ?></span>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h1 class="hero__title"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="hero__subtitle body-lg"><?php echo wpautop(esc_html($subtitle)); ?></div>
            <?php endif; ?>

            <?php if (!empty($primary) && !empty($primary['url']) && !empty($primary['title'])) : ?>
                <div class="hero__actions">
                    <a class="btn btn-primary"
                       href="<?php echo esc_url($primary['url']); ?>"
                       target="<?php echo esc_attr($primary['target'] ?: '_self'); ?>">
                        <?php echo esc_html($primary['title']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

