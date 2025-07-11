<!-- Footer -->
<!-- <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                    <div>
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-semibold">Pixinvent</a>
                    </div>
                    <div>
                        <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                        <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>

                        <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                        <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                    </div>
                </div>
            </div>
        </footer> -->
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ url('public/admin_theme/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

<script src="{{ url('public/admin_theme/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<script src="{{ url('public/admin_theme/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ url('public/admin_theme/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ url('public/admin_theme/assets/js/main.js') }}"></script>
<!-- <script src="{{ url('public/admin_theme/assets/js/forms-pickers.js') }}"></script> -->

<!-- Custom JS -->
<script src="{{ url('public/admin_theme/custom/custom.js') }}"></script>

<script src="{{url('public/admin_theme/plugins/bootbox/bootbox.min.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ url('public/admin_theme/assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script> -->

<script>
    const datePicker = $('.datepicker')
    if (datePicker.length) {
        datePicker.flatpickr({
            dateFormat: 'd-m-Y'
        });
    }

    $(document).ready(function() {
        window.app_base_path = "{{url('/')}}";
        window.app_base_path_admin = "{{url('/admin')}}";
        window.asset_url = "{{asset('')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    
</script>

