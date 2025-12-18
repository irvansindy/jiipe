/**
 * Track brochure download via AJAX
 * @param {string|number} brochureId - ID brochure yang didownload
 */
function trackBrochureDownload(brochureId) {
    // Use sendBeacon for non-blocking request (recommended)
    if (navigator.sendBeacon) {
        const data = new FormData();
        data.append('brochure_id', brochureId);
        data.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');

        navigator.sendBeacon('/api/track-brochure-download', data);
    } else {
        // Fallback to fetch for older browsers
        fetch('/api/track-brochure-download', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                brochure_id: brochureId
            }),
            keepalive: true // Important: keeps request alive even if page closes
        }).catch(err => {
            // Silent fail - don't interrupt user experience
            console.error('Tracking failed:', err);
        });
    }
}

/**
 * Initialize brochure download tracking
 * Automatically called when DOM is ready
 */
function initBrochureTracking() {
    const brochureLinks = document.querySelectorAll('.track-brochure-download');

    brochureLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const brochureId = this.getAttribute('data-brochure-id');

            if (brochureId) {
                // Send tracking request (non-blocking)
                trackBrochureDownload(brochureId);
            }
        });
    });

    console.log(`Brochure tracking initialized for ${brochureLinks.length} links`);
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBrochureTracking);
} else {
    // DOM already loaded
    initBrochureTracking();
}

// Export functions for manual use if needed
window.JiipeTracking = {
    trackBrochureDownload: trackBrochureDownload,
    initBrochureTracking: initBrochureTracking
};