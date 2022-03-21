@extends('layout.no-menu')

@section('customcss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

@endsection

@section('subhead')
    <title>Employee {!! env('APP_NAME') !!}</title>
@endsection

@section('subcontent')
    <div class="intro-y box py-10 sm:py-20 mt-5">
        @livewire('employee-steps.employee-component')
    </div>
@endsection

@push('scripts')
    @include('commons.stepsjs',['sortable' => true])
    <script>
        $(document).on('click',".benefit-badge", (e) => {
            e.target.classList.add('selected');
        });
    </script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
@endpush
