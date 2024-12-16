@extends('main.layouts.master')
@section('title') @lang('الرئيسية') @endsection
@section('PageContent')

@include('main.pages.home.more.slider')
@include('main.pages.home.more.services')
@include('main.pages.home.more.videos')
@include('main.pages.home.more.testimonial')
@include('main.pages.home.more.counter')
@include('main.pages.home.more.clients')


@endsection
