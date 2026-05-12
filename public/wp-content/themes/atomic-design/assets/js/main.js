/* ============================================================
   THEME JS — atomic-design
   Handles: mobile nav toggle, scroll-shadow on header.
   ============================================================ */

(function () {
    'use strict';

    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 700,
            once: true,
            offset: 80,
        });
    }

    // Mobile nav toggle
    const toggle = document.querySelector('.site-header__toggle');
    const nav    = document.querySelector('.site-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Close nav when clicking a link (single-page feel)
        nav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });

        // Close nav on outside click
        document.addEventListener('click', e => {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    const materialDisclosure = document.querySelector('.site-header__material-clarification');
    const materialToggle = materialDisclosure ? materialDisclosure.querySelector('.site-header__material-toggle') : null;
    const materialPanel = materialDisclosure ? materialDisclosure.querySelector('.site-header__material-panel') : null;

    if (materialDisclosure && materialToggle && materialPanel) {
        const setMaterialOpen = isOpen => {
            materialToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            materialPanel.hidden = !isOpen;
            materialDisclosure.classList.toggle('is-open', isOpen);
        };

        materialToggle.addEventListener('click', () => {
            setMaterialOpen(materialPanel.hidden);
        });

        document.addEventListener('click', event => {
            if (!materialDisclosure.contains(event.target)) {
                setMaterialOpen(false);
            }
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                setMaterialOpen(false);
                materialToggle.focus();
            }
        });
    }

    // Add scroll shadow to header
    const header = document.querySelector('.site-header');
    if (header) {
        const onScroll = () => {
            header.classList.toggle('is-scrolled', window.scrollY > 10);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    const articleHeadings = document.querySelectorAll('.article-content h2[id]');
    const tocItems = document.querySelectorAll('.article-toc__item');

    if (articleHeadings.length && tocItems.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    return;
                }

                tocItems.forEach(item => {
                    item.classList.toggle('is-active', item.dataset.target === entry.target.id);
                });
            });
        }, { rootMargin: '-20% 0px -70% 0px' });

        articleHeadings.forEach(heading => observer.observe(heading));
    }

    function getWordTokens(text) {
        const normalized = text.replace(/\s+/g, ' ');
        return normalized ? normalized.match(/\S+\s*/g) || [] : [];
    }

    function splitNodeByWords(node, wordsForLeft) {
        if (node.nodeType === Node.TEXT_NODE) {
            const tokens = getWordTokens(node.textContent || '');
            const take = Math.min(wordsForLeft, tokens.length);
            const leftText = tokens.slice(0, take).join('');
            const rightText = tokens.slice(take).join('');

            return {
                leftNode: leftText.trim() ? document.createTextNode(leftText) : null,
                rightNode: rightText.trim() ? document.createTextNode(rightText) : null,
                wordsUsed: take,
                totalWords: tokens.length,
            };
        }

        if (node.nodeType !== Node.ELEMENT_NODE) {
            return {
                leftNode: null,
                rightNode: null,
                wordsUsed: 0,
                totalWords: 0,
            };
        }

        const leftClone = node.cloneNode(false);
        const rightClone = node.cloneNode(false);
        let wordsUsed = 0;
        let totalWords = 0;

        Array.from(node.childNodes).forEach(child => {
            const result = splitNodeByWords(child, Math.max(wordsForLeft - wordsUsed, 0));
            totalWords += result.totalWords;
            wordsUsed += result.wordsUsed;

            if (result.leftNode) {
                leftClone.appendChild(result.leftNode);
            }

            if (result.rightNode) {
                rightClone.appendChild(result.rightNode);
            }
        });

        return {
            leftNode: leftClone.childNodes.length ? leftClone : null,
            rightNode: rightClone.childNodes.length ? rightClone : null,
            wordsUsed,
            totalWords,
        };
    }

    function buildSplitContent(source, wordsForLeft) {
        const leftWrapper = document.createElement('div');
        const rightWrapper = document.createElement('div');

        Array.from(source.childNodes).forEach(child => {
            const result = splitNodeByWords(child, wordsForLeft);
            wordsForLeft -= result.wordsUsed;

            if (result.leftNode) {
                leftWrapper.appendChild(result.leftNode);
            }

            if (result.rightNode) {
                rightWrapper.appendChild(result.rightNode);
            }
        });

        return {
            leftHTML: leftWrapper.innerHTML,
            rightHTML: rightWrapper.innerHTML,
        };
    }

    function measureSplitHeight(source, leftHTML, width) {
        const measurer = document.createElement('div');
        const sourceStyles = window.getComputedStyle(source);

        measurer.style.position = 'absolute';
        measurer.style.visibility = 'hidden';
        measurer.style.pointerEvents = 'none';
        measurer.style.left = '-9999px';
        measurer.style.top = '0';
        measurer.style.width = width + 'px';
        measurer.style.font = sourceStyles.font;
        measurer.style.lineHeight = sourceStyles.lineHeight;
        measurer.style.letterSpacing = sourceStyles.letterSpacing;
        measurer.style.wordSpacing = sourceStyles.wordSpacing;
        measurer.style.whiteSpace = 'normal';
        measurer.innerHTML = leftHTML;

        document.body.appendChild(measurer);
        const height = measurer.getBoundingClientRect().height;
        document.body.removeChild(measurer);

        return height;
    }

    function balanceTitleDescriptionColumns() {
        const sections = document.querySelectorAll('[data-title-description-columns]');

        sections.forEach(section => {
            const source = section.querySelector('[data-title-description-source]');
            const split = section.querySelector('[data-title-description-split]');
            const leftColumn = section.querySelector('[data-title-description-left]');
            const rightColumn = section.querySelector('[data-title-description-right]');

            if (!source || !split || !leftColumn || !rightColumn) {
                return;
            }

            if (window.innerWidth <= 768) {
                section.classList.remove('is-split');
                split.hidden = true;
                leftColumn.innerHTML = '';
                rightColumn.innerHTML = '';
                return;
            }

            const contentWidth = section.getBoundingClientRect().width;
            const gap = parseFloat(window.getComputedStyle(split).columnGap || window.getComputedStyle(split).gap || 0);
            const columnWidth = (contentWidth - gap) / 2;
            const totalWords = getWordTokens(source.textContent || '').length;

            if (totalWords < 8 || columnWidth <= 0) {
                section.classList.remove('is-split');
                split.hidden = true;
                return;
            }

            const fullHeight = measureSplitHeight(source, source.innerHTML, columnWidth);
            const targetHeight = fullHeight / 2;

            let low = 1;
            let high = totalWords - 1;
            let bestLeftHTML = source.innerHTML;
            let bestRightHTML = '';
            let bestDelta = Number.POSITIVE_INFINITY;

            while (low <= high) {
                const mid = Math.floor((low + high) / 2);
                const candidate = buildSplitContent(source, mid);

                if (!candidate.leftHTML || !candidate.rightHTML) {
                    break;
                }

                const leftHeight = measureSplitHeight(source, candidate.leftHTML, columnWidth);
                const delta = Math.abs(leftHeight - targetHeight);

                if (delta < bestDelta) {
                    bestDelta = delta;
                    bestLeftHTML = candidate.leftHTML;
                    bestRightHTML = candidate.rightHTML;
                }

                if (leftHeight < targetHeight) {
                    low = mid + 1;
                } else {
                    high = mid - 1;
                }
            }

            if (!bestRightHTML) {
                section.classList.remove('is-split');
                split.hidden = true;
                return;
            }

            leftColumn.innerHTML = bestLeftHTML;
            rightColumn.innerHTML = bestRightHTML;
            split.hidden = false;
            section.classList.add('is-split');
        });
    }

    let titleDescriptionResizeTimer = null;
    const onTitleDescriptionResize = () => {
        window.clearTimeout(titleDescriptionResizeTimer);
        titleDescriptionResizeTimer = window.setTimeout(balanceTitleDescriptionColumns, 120);
    };

    window.addEventListener('load', balanceTitleDescriptionColumns);
    window.addEventListener('resize', onTitleDescriptionResize);
    balanceTitleDescriptionColumns();

    // Quote Popup Modal functionality
    const quotePopup = document.getElementById('quote-popup');
    const quotePopupClose = document.querySelector('.quote-popup__close');
    const quotePopupOverlay = document.querySelector('.quote-popup__overlay');

    // Function to check if a link should trigger the quote popup
    function isQuoteButton(link) {
        if (!link) return false;
        
        const text = (link.textContent || '').toLowerCase();
        const href = (link.href || '').toLowerCase();
        
        // Check text content for quote-related keywords
        const textPatterns = [
            'get a quote',
            'get a fast quote',
            'get a fast free quote',
            'request a quote',
            'request quote',
            'free quote'
        ];
        
        // Check URL for quote-related paths
        const urlPatterns = [
           
        ];
        
        // Exclude pages that have dedicated content
        const excludeUrls = [
            '/how-to-order/',
            '/contact/',
            '/request-quote'
        ];
        
        const hasQuoteText = textPatterns.some(pattern => text.includes(pattern));
        const hasQuoteUrl = urlPatterns.some(pattern => href.includes(pattern));
        const isExcluded = excludeUrls.some(pattern => href.includes(pattern));
        
        return (hasQuoteText || hasQuoteUrl) && !isExcluded;
    }

    // Function to open popup
    function openQuotePopup(e) {
        e.preventDefault();
        if (quotePopup) {
            quotePopup.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
    }

    // Function to close popup
    function closeQuotePopup() {
        if (quotePopup) {
            quotePopup.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
        }
    }

    // Find and attach event listeners to all quote buttons
    function initializeQuoteButtons() {
        // Specific header button
        const headerQuoteBtn = document.getElementById('get-quote-btn');
        if (headerQuoteBtn) {
            headerQuoteBtn.addEventListener('click', openQuotePopup);
        }

        // Hero primary buttons
        const heroLinks = document.querySelectorAll('.hero__link--primary');
        heroLinks.forEach(link => {
            if (isQuoteButton(link)) {
                link.addEventListener('click', openQuotePopup);
            }
        });

        // Area coverage CTA buttons
        const areaCtaLinks = document.querySelectorAll('.area-coverage-grid__cta');
        areaCtaLinks.forEach(link => {
            if (isQuoteButton(link)) {
                link.addEventListener('click', openQuotePopup);
            }
        });

        // Any other potential quote buttons
        const allLinks = document.querySelectorAll('a');
        allLinks.forEach(link => {
            if (isQuoteButton(link) && !link.hasAttribute('data-quote-initialized')) {
                link.addEventListener('click', openQuotePopup);
                link.setAttribute('data-quote-initialized', 'true');
            }
        });
    }

    // Initialize when DOM is ready
    if (quotePopup) {
        initializeQuoteButtons();

        // Close popup when clicking close button
        if (quotePopupClose) {
            quotePopupClose.addEventListener('click', closeQuotePopup);
        }

        // Close popup when clicking overlay
        if (quotePopupOverlay) {
            quotePopupOverlay.addEventListener('click', closeQuotePopup);
        }

        // Close popup on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && quotePopup.style.display === 'block') {
                closeQuotePopup();
            }
        });

        // Re-initialize if new content is loaded dynamically
        const observer = new MutationObserver(() => {
            initializeQuoteButtons();
        });
        observer.observe(document.body, { childList: true, subtree: true });
    }

})();
