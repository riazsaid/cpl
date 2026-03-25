<?php
/**
 * FAQ Accordion Block Template
 *
 * Used as a Gutenberg block (acf/faq-accordion).
 * Each block instance has independent FAQ items — insert it anywhere,
 * on any page or CPT template, multiple times if needed.
 *
 * The same CSS (faq-accordion.css) and JS (faq-accordion.js) that
 * power the template-part partial also apply here — one shared design.
 *
 * @param array       $block      Block settings and attributes.
 * @param string      $content    Block inner HTML (empty for ACF blocks).
 * @param bool        $is_preview True during Gutenberg AJAX preview.
 * @param int|string  $post_id    The post ID this block is saved to.
 */

$section_heading = get_field('faqs_section_heading');
$faq_layout      = get_field('faq_layout') ?: 'two-column';
$faq_items       = get_field('faq_items');

// Unique ID per block instance so multiple blocks on one page never clash.
$block_id = 'faq-block-' . ($block['id'] ?? uniqid());

// Show a placeholder while the block has no content yet (editor preview only).
if ($is_preview && (empty($faq_items) || !is_array($faq_items))) {
    echo '<div style="padding:2rem;border:2px dashed #ccc;text-align:center;color:#888;">';
    echo '<strong>FAQ Accordion</strong><br>Click the block and add FAQ items in the sidebar fields.';
    echo '</div>';
    return;
}

if (empty($faq_items) || !is_array($faq_items)) {
    return;
}

$total = count($faq_items);
$half  = (int) ceil($total / 2);
?>

<section class="faq-accordion-block layout-<?php echo esc_attr($faq_layout); ?>"
         id="<?php echo esc_attr($block_id); ?>">

    <div class="container faq-container">

        <?php if (!empty($section_heading)) : ?>
            <h2 class="faq-heading"><?php echo esc_html($section_heading); ?></h2>
        <?php endif; ?>

        <div class="faq-grid">
            <?php foreach ($faq_items as $index => $faq) :
                $question     = $faq['faq_question'] ?? '';
                $answer       = $faq['faq_answer']   ?? '';
                $default_open = !empty($faq['default_open']);
                $faq_id       = $block_id . '-faq-' . $index;
                $col_class    = '';

                if ($faq_layout === 'two-column') {
                    $col_class = $index < $half ? 'column-left' : 'column-right';
                }
            ?>
                <div class="faq-item <?php echo esc_attr($col_class); ?> <?php echo $default_open ? 'active' : ''; ?>"
                     data-faq-item>

                    <button class="faq-question"
                            aria-expanded="<?php echo $default_open ? 'true' : 'false'; ?>"
                            aria-controls="<?php echo esc_attr($faq_id); ?>">
                        <span class="question-text"><?php echo esc_html($question); ?></span>
                        <span class="faq-icon" aria-hidden="true">
                            <svg class="icon-plus" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 4V16M4 10H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <svg class="icon-minus" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </button>

                    <div class="faq-answer"
                         id="<?php echo esc_attr($faq_id); ?>"
                         <?php echo $default_open ? '' : 'hidden'; ?>>
                        <div class="faq-answer-content">
                            <?php echo wp_kses_post(wpautop($answer)); ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
