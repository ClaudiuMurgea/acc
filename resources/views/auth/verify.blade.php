@extends('../layout/' . $layout)

@section('head')
    <title>Password reset - {!! env('APP_NAME') !!} </title>
@endsection

@section('content')
    <div class="container py-10">
        <div class="block grid grid-cols-1">

            <!-- BEGIN: Login Info -->
            <div class="h-full py-5 xl:py-0 my-10 xl:my-0 bg-white">

                <div class="">

                    <div class="-intro-x text-black font-medium text-3xl leading-tight mt-20 text-center">{!! __('lang.confirm_account_title') !!}</div>
                    <div class="text-gray-600  mt-0.5 text-center py-10">{!! __('lang.verification_link_sent') !!}</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2 text-center">{!! __('lang.verification_link_description') !!}</div>
                    <div class="text-center py-10"><img  style="margin: 0 auto; max-height: 150px" src="/resources/images/eml_mr_sr2.png"></div>
                    <div class="text-gray-700 dark:text-gray-600 mt-20 mb-10 text-center">
                        <form class="d-inline" method="POST" action="{{ route("verification.resend") }}">@csrf <button type="submit" class="btn-link p-0 m-0 align-baseline">{!! __('lang.resent_link') !!} {{ __('Click here to request another') }}</button>.
                        </form>
                    </div>

                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->




        <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')

@endsection
