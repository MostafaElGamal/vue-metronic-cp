<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->

<head>

    <!--begin::Base Path (base relative path for assets of this page) -->

    <!--end::Base Path -->
    <meta charset="utf-8" />
    <title>DashBoard</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/login-1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/pricing-1.css') }}" rel="stylesheet">

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('css/dashboard/vendors.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/style.bundle.css') }}" rel="stylesheet">

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('css/dashboard/skins/header/base/light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/skins/header/menu/light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/skins/brand/dark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/skins/aside/dark.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
	<!--begin::Fonts -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
    <!--end::Layout Skins -->
    <link href="{{ asset('css/dashboard/favicon.ico') }}">
</head>

<!-- end::Head -->

    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <Dashboard id="app"></Dashboard>

    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <script src="{{ asset('/js/app.js') }}" ></script>
    <script src="{{ asset('/js/dashboard/vendors.bundle.js') }}"></script>
    <script src="{{ asset('/js/dashboard/scripts.bundle.js') }}"></script>
    <script src="{{ asset('/js/dashboard/dashboard.js') }}"></script>
    <script src="{{ asset('/js/dashboard/login-1.js') }}"></script>
    <script src="{{ asset('/js/dashboard/summernote.js') }}"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>

</body>
</html>
