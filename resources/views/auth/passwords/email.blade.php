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
                'url'   =>  route('password.email') ,
            ]) !!}

                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">

                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Reset password</h2>
                    @if (session('status'))

                        <div class="alert alert-outline-primary alert-dismissible show flex items-center mb-2" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle w-6 h-6 mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            {!! session('status') !!}

                        </div>

                    @endif
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">{!! __('lang.login_title') !!}</div>
                    <div class="intro-x mt-8">

                            <input id="email" type="email" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div id="error-email" class="login__input-error w-5/6 text-danger">@error('email'){!! $message !!}@enderror</div>


                    </div>

                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-100 xl:mr-3 align-top">{{ __('Send Password Reset Link') }}</button>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <a href="/" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-100 xl:mr-3 align-top">{{ __('Back To Login') }}</a>
                    </div>

                    <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                        {{--  By signin up, you agree to our <br> <a class="text-theme-1 dark:text-theme-10" href="">Terms and Conditions</a> & <a class="text-theme-1 dark:text-theme-10" href="">Privacy Policy</a>--}}
                    </div>
                </div>
            {!! Form::close() !!}
        }
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        cash(function () {
            async function login() {
                // Reset state
                cash('#login-form').find('.login__input').removeClass('border-theme-6')
                cash('#login-form').find('.login__input-error').html('')

                // Post form
                let email = cash('#email').val()
                let password = cash('#password').val()
                let rememberMe = cash('#remember-me').val()

                // Loading state
                cash('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password,
                    remember_me: rememberMe
                }).then(res => {
                    location.href = '/'
                }).catch(err => {
                    cash('#btn-login').html('Login')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            cash(`#${key}`).addClass('border-theme-6')
                            cash(`#error-${key}`).html(val)
                        }
                    } else {
                        cash(`#password`).addClass('border-theme-6')
                        cash(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            cash('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            cash('#btn-login').on('click', function() {
                login()
            })
        })
    </script>
@endsection
