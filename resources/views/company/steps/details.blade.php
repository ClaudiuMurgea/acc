@extends('../layout/no-menu')

@section('customcss')
    @include('commons.stepsCss')
@endsection

@section('subhead')
    <title>{!! $title !!} {!! env('APP_NAME') !!}</title>
@endsection

@section('subcontent')
    <div class="intro-y boxmt-5">
        @livewire('company.register-steps.company-profile-component')
    </div>

@endsection


@push('scripts')
    @include('commons.stepsjs',['sortable' => true])
    <script>
            Livewire.hook('message.processed', (message, component) => {
                search = Object.values(livewire.components.componentsById).find((component) => component.name == "company.register-steps.company-billing-component")
                if (typeof search !== "undefined") {
                    Livewire.emit("reinitSelect2");
                }
            })
    </script>
@endpush


