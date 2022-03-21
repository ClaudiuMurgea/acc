@extends('../layout/' . $layout)

@section('head')
    <title>Password reset - {!! env('APP_NAME') !!} </title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">

            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="{!! env('APP_DESCRIPTION') !!}" class="w-6" src="{{ asset(env('APP_LOGO')) }}">
                    <span class="text-white text-lg ml-3">
                        {!! env('APP_LOGO_NAME') !!}
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="{!! env('APP_DESCRIPTION') !!}" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">{!! __('lang.login_title') !!}</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">{!! __('lang.login_tagline') !!}</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            {!! Form::open([
                'class' => 'h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0',
                'url'   =>  route('password.update') ,
            ]) !!}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">

                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Reset password</h2>

                <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">{!! __('lang.login_title') !!}</div>
                <div class="intro-x mt-8">

                    <input id="email" type="email" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    <div id="error-email" class="login__input-error w-5/6 text-danger">@error('email'){!! $message !!}@enderror</div>

                    <input id="password" placeholder="Password" type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4"  required autocomplete="new-password">
                    <div id="error-password" class="login__input-error w-5/6 text-danger">@error('password'){!! $message !!}@enderror</div>

                    <input id="password-confirm" placeholder="Password confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="intro-x login__input form-control py-3 px-4 block mt-4" >

                </div>

                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-100 xl:mr-3 align-top">{{ __('Reset Password') }}</button>

                </div>

                <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                    {{--  By signin up, you agree to our <br> <a class="text-theme-1 dark:text-theme-10" href="">Terms and Conditions</a> & <a class="text-theme-1 dark:text-theme-10" href="">Privacy Policy</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')

@endsection
