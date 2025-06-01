<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{url('public/admin_theme/assets')}}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | {{env('APP_NAME')}}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('public/admin_theme/assets/img/favicon/favicon.jpg')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
    <!-- <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" /> -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{url('public/admin_theme/assets/vendor/css/pages/page-auth.css')}}" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('public/admin_theme/custom/custom.css')}}" />

    <!-- Helpers -->
    <script src="{{url('public/admin_theme/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{url('public/admin_theme/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('public/admin_theme/assets/js/config.js')}}"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{url('public/admin_theme/assets/img/illustrations/auth-login-illustration-light.png')}}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                    <img src="{{url('public/admin_theme/assets/img/illustrations/bg-shape-image-light.png')}}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{url('admin')}}" class="app-brand-link gap-2">
                            <img src="{{url('public/admin_theme/assets/img/logo.jpg')}}" class="img-fluid">
                        </a>
                    </div>
                    <!-- /Logo -->
                    {{-- <h3 class="mb-1 fw-bold">Welcome to {{env('APP_NAME')}} 👋</h3> --}}
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    <form id="login-form" class="mb-3" action="{{url('admin/verify_login')}}" method="POST">
                        @csrf

                        <div class="mb-3 ajax-msg"></div>
                        <div class="mb-3 ajax-field">
                            <label for="email" class="form-label">Email/Username</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email/username" autofocus />
                            <span class="ajax-error"></span>
                        </div>
                        <div class="mb-3 form-password-toggle ajax-field">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <span class="ajax-error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{url('public/admin_theme/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/libs/node-waves/node-waves.js')}}"></script>

    <script src="{{url('public/admin_theme/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

    <script src="{{url('public/admin_theme/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <!-- <script src="{{url('public/admin_theme/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script> -->
    <script src="{{url('public/admin_theme/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{url('public/admin_theme/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{url('public/admin_theme/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{url('public/admin_theme/assets/js/pages-auth.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{url('public/admin_theme/custom/custom.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#login-form', function(e) {
                e.preventDefault();
                clearAjaxErrors();

                let url = $(this).attr('action');
                let data = $(this).serializeArray();

                $.post(url, data, function(res) {
                    processAjaxResponse(res, 1000);
                }, 'json')
            })
        })
    </script>
</body>

</html>