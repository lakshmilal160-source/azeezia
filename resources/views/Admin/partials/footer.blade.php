                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            © {{ date('Y') }} {{ config('custom.app_name', 'Azeezia') }}. All rights reserved.
                        </div>
                        <div>
                            <span class="text-muted">SEO Ready • Responsive Dashboard</span>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"></script>
<script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/admin/js/main.js') }}"></script>

<script>
    // Universal Slugifier helper
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .trim()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    // Auto slug hookup
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.querySelector('[data-slug-source]');
        const slugInput = document.querySelector('[data-slug-target]');

        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                if (!slugInput.dataset.manualEdited) {
                    slugInput.value = generateSlug(this.value);
                }
            });

            slugInput.addEventListener('input', function () {
                slugInput.dataset.manualEdited = "true";
            });
        }
    });
</script>

@stack('scripts')
@yield('jscript')
</body>
</html>

