<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Splashcreative.com">
@yield('head')


<!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
    {{--   <link rel="stylesheet" href="{{ mix('dist/css/starter.css') }}" />--}}
    <link rel="stylesheet" href="/resources/css/custom.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/PTOplanner.css') }}" />

@yield('customcss')

<!-- END: CSS Assets-->
    @livewireStyles
</head>
<!-- END: Head -->

@yield('body')

</html>
