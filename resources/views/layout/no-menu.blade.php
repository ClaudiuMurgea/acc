@extends('../layout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
   {{-- @include('../layout/components/mobile-menu')--}}
    @include('../layout/components/blank-top-bar')
    <div class="container sm:px-10">
        <div class="intro-y box p-5 mt-12 sm:mt-5">

            <!-- BEGIN: Content -->
            <div class="px-2 py-10" >
                @yield('subcontent')
            </div>
            <!-- END: Content -->
        </div>
    </div>

@endsection
