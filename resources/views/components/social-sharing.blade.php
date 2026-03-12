<!-- ✅ SOCIAL SHARING BUTTONS COMPONENT -->
@if (isset($data['shareData']))
    <div class="social-sharing-container mt-4 mb-4">
        <div class="share-title">
            <strong>{{ __('system.share_this') ?? 'Bagikan Artikel Ini' }}</strong>
        </div>

        <div class="share-buttons d-flex flex-wrap gap-2 mt-3">
            <!-- Facebook Share -->
            <a href="{{ $data['shareData']['social']['facebook'] }}" target="_blank" rel="noopener noreferrer"
                class="btn btn-social btn-facebook" title="Bagikan di Facebook">
                <i class="fab fa-facebook-f"></i>
                <span class="d-none d-sm-inline">Facebook</span>
            </a>

            <!-- Twitter Share -->
            <a href="{{ $data['shareData']['social']['twitter'] }}" target="_blank" rel="noopener noreferrer"
                class="btn btn-social btn-twitter" title="Bagikan di Twitter">
                <i class="fab fa-twitter"></i>
                <span class="d-none d-sm-inline">Twitter</span>
            </a>

            <!-- LinkedIn Share -->
            <a href="{{ $data['shareData']['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer"
                class="btn btn-social btn-linkedin" title="Bagikan di LinkedIn">
                <i class="fab fa-linkedin-in"></i>
                <span class="d-none d-sm-inline">LinkedIn</span>
            </a>

            <!-- WhatsApp Share -->
            <a href="{{ $data['shareData']['social']['whatsapp'] }}" target="_blank" rel="noopener noreferrer"
                class="btn btn-social btn-whatsapp" title="Bagikan di WhatsApp">
                <i class="fab fa-whatsapp"></i>
                <span class="d-none d-sm-inline">WhatsApp</span>
            </a>

            <!-- Email Share -->
            <a href="{{ $data['shareData']['social']['email'] }}" class="btn btn-social btn-email"
                title="Bagikan via Email">
                <i class="fas fa-envelope"></i>
                <span class="d-none d-sm-inline">Email</span>
            </a>

            <!-- Copy Link -->
            <button class="btn btn-social btn-copy-link" id="copyShareLink"
                data-url="{{ $data['shareData']['short_url'] }}" title="Salin Link">
                <i class="fas fa-link"></i>
                <span class="d-none d-sm-inline">Salin Link</span>
            </button>
        </div>

        <!-- Short Link Display -->
        <div class="share-link-display mt-3 d-none d-sm-block">
            <small class="text-muted">{{ __('system.short_link') ?? 'Short Link' }}:</small>
            <div class="input-group input-group-sm mt-1" style="max-width: 400px;">
                <input type="text" class="form-control" id="shortLinkInput"
                    value="{{ $data['shareData']['short_url'] }}" readonly>
                <button class="btn btn-outline-secondary" type="button" id="copyShortLink">
                    <i class="fas fa-copy"></i> Salin
                </button>
            </div>
        </div>
    </div>

    <style>
        .social-sharing-container {
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #d22c12;
        }

        .share-title {
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .share-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-social {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-social i {
            font-size: 1.1rem;
        }

        .btn-facebook {
            background-color: #1877f2;
        }

        .btn-facebook:hover {
            background-color: #0a66c2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(24, 119, 242, 0.3);
        }

        .btn-twitter {
            background-color: #1da1f2;
        }

        .btn-twitter:hover {
            background-color: #1a91da;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(29, 161, 242, 0.3);
        }

        .btn-linkedin {
            background-color: #0077b5;
        }

        .btn-linkedin:hover {
            background-color: #005885;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 119, 181, 0.3);
        }

        .btn-whatsapp {
            background-color: #25d366;
        }

        .btn-whatsapp:hover {
            background-color: #1ebc5a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 211, 102, 0.3);
        }

        .btn-email {
            background-color: #ea4335;
        }

        .btn-email:hover {
            background-color: #d33426;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(234, 67, 53, 0.3);
        }

        .btn-copy-link {
            background-color: #6c757d;
        }

        .btn-copy-link:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
        }

        .share-link-display {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #dee2e6;
        }

        .input-group-sm .form-control {
            font-size: 0.875rem;
            padding: 0.4rem 0.6rem;
            border-color: #dee2e6;
        }

        .input-group-sm .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .social-sharing-container {
                padding: 1rem;
            }

            .btn-social {
                padding: 6px 10px;
                font-size: 0.8rem;
            }

            .btn-social i {
                font-size: 1rem;
            }

            .share-link-display {
                display: none;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Copy Share Link Button
            const copyShareLinkBtn = document.getElementById('copyShareLink');
            if (copyShareLinkBtn) {
                copyShareLinkBtn.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    copyToClipboard(url, 'Tautan disalin!');
                });
            }

            // Copy Short Link Button
            const copyShortLinkBtn = document.getElementById('copyShortLink');
            if (copyShortLinkBtn) {
                copyShortLinkBtn.addEventListener('click', function() {
                    const input = document.getElementById('shortLinkInput');
                    copyToClipboard(input.value, 'Tautan disalin ke clipboard!');
                });
            }

            // Helper function untuk copy to clipboard
            function copyToClipboard(text, successMessage) {
                // Use modern Clipboard API jika tersedia
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text).then(function() {
                        showCopyFeedback(successMessage);
                    }).catch(function(err) {
                        console.error('Gagal menyalin: ', err);
                        fallbackCopyToClipboard(text, successMessage);
                    });
                } else {
                    // Fallback untuk browser lama
                    fallbackCopyToClipboard(text, successMessage);
                }
            }

            // Fallback copy to clipboard untuk browser lama
            function fallbackCopyToClipboard(text, successMessage) {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    showCopyFeedback(successMessage);
                } catch (err) {
                    console.error('Fallback: Gagal menyalin', err);
                }
                document.body.removeChild(textarea);
            }

            // Show copy feedback
            function showCopyFeedback(message) {
                // Simple alert atau toast notification bisa digunakan di sini
                const Toast = window.bootstrap ? window.bootstrap.Toast : null;

                if (Toast) {
                    const toastEl = document.createElement('div');
                    toastEl.className = 'toast';
                    toastEl.setAttribute('role', 'alert');
                    toastEl.innerHTML = `
                <div class="toast-body">
                    ✓ ${message}
                </div>
            `;
                    document.body.appendChild(toastEl);
                    const toast = new Toast(toastEl);
                    toast.show();

                    setTimeout(() => toastEl.remove(), 3000);
                } else {
                    // Fallback ke alert jika Bootstrap Toast tidak tersedia
                    alert(message);
                }
            }
        });
    </script>
@endif
