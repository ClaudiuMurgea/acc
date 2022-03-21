@extends('../layout/base')

@section('body')
    <body class="py-5 {!! $layout ?? '' !!}" @if($layout == 'login' ) style="overflow: scroll!important;height: auto;
    min-height: 100vh;"@endif>
        @yield('content')
       {{-- @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher')--}}

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts />
        @yield('script')
        @stack('scripts')
        <script>

            Livewire.on('alert', data => {

                let type = data.type
                toastr[type](data.message)

            })
        </script>
        <livewire:modals.holiday-modal />

        <livewire:modals.facility-step-modal />
    </body>
@endsection
