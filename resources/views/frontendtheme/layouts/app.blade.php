<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Home')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('frontend/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/font-icons.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">

    <!-- Favicon and Touch Icons -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/logo/favicon.png') }}">

    @stack('styles')
</head>
<body class="preload-wrapper">

    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>

    <!-- Preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">
         <!-- Header -->
        @include('frontendtheme.partials.common.topbar')
        <!-- Header -->
        @include('frontendtheme.partials.common.header')

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('frontendtheme.partials.common.footer')

        <!-- Toolbar Bottom -->
        @include('frontendtheme.partials.common.toolbar')
    </div>

        @include('frontendtheme.partials.common.mobile_menu')
        @include('frontendtheme.partials.common.mobile_categories')
         <!-- Modal Bottom -->
        @include('frontendtheme.partials.common.modal.modal_quickview')
        @include('frontendtheme.partials.common.modal.modal_shoppingcart')
        @include('frontendtheme.partials.common.modal.modal_wishlist')
        <!-- /Modal Bottom -->
    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lazysize.min.js') }}"></script>
    <script src="{{ asset('frontend/js/count-down.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/multiple-modal.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/sibforms.js') }}" defer></script>

    <script>
        window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
        window.LOCALE = 'en';
        window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";
        window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank.";
        window.GENERIC_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";
        window.translation = {
            common: {
                selectedList: '{quantity} list selected',
                selectedLists: '{quantity} lists selected'
            }
        };
        var AUTOHIDE = Boolean(0);
    </script>

    @stack('scripts')
</body>
</html>
