<!-- Modal Loader Component - Inside Modal -->
<!-- Loading Overlay untuk Modal -->
<style>
    .modal-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1055;
        border-radius: 0.5rem;
    }

    .modal-loading-overlay.show {
        display: flex !important;
    }

    .modal-loading-spinner {
        text-align: center;
    }

    .modal-loading-spinner .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.3em;
    }

    .modal-loading-text {
        margin-top: 1rem;
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Disable form elements saat loading */
    .modal-loading-overlay.show ~ .modal-body,
    .modal-loading-overlay.show ~ .modal-footer {
        pointer-events: none;
        opacity: 0.6;
    }

    /* Animation untuk smooth appearance */
    .modal-loading-overlay {
        animation: fadeIn 0.2s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* ============================================
       FIX: SweetAlert2 Z-index Issue
       SweetAlert harus berada di atas modal Bootstrap
       ============================================ */

    /* SweetAlert container */
    .swal2-container {
        z-index: 9999 !important; /* Lebih tinggi dari modal backdrop (1055) */
    }

    /* SweetAlert popup */
    .swal2-popup {
        z-index: 10000 !important;
    }

    /* Optional: Backdrop SweetAlert lebih tinggi dari modal */
    .swal2-container.swal2-backdrop-show {
        z-index: 9999 !important;
    }

    /* Fix untuk SweetAlert di dalam modal */
    body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
        overflow: hidden !important;
    }

    /* Pastikan modal backdrop tidak menutupi SweetAlert */
    .modal-backdrop {
        z-index: 1050 !important; /* Default Bootstrap */
    }

    /* Modal sendiri */
    .modal {
        z-index: 1055 !important; /* Default Bootstrap */
    }
</style>

<!-- Template Loading Overlay yang akan di-inject ke modal -->
<template id="modalLoadingTemplate">
    <div class="modal-loading-overlay">
        <div class="modal-loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="modal-loading-text">Loading data...</div>
        </div>
    </div>
</template>