@extends('main.layouts.master')
@section('title')
    الإشعارات
@endsection
@section('PageContent')



<!--=================================page-title-->
<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('profile_notifications_page_image','/main/images/bg/02.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-name">
                    <h1>الإشعارات والتنيهات</h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================page-title -->



<!--=================================Alerts -->
<section class="page-section-ptb alerts-and-callouts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="section-title text-center">
                    <h2 class="title-effect">الإشعارات</h2>
                </div>

                <div class="clearfix"></div>

                @if ($lists->count() > 0)

                    @foreach ($lists as $list)
                        <div class="alert bd-callout bd-callout-primary">
                            <h5>
                                {{ $list->title }} - ( {{ \Carbon\Carbon::parse($list->created_at)->format("d-m-Y") }} )
                            </h5>
                            <p>
                                {{ $list->descriptions }}
                            <p>
                            {{--<button type="button" style="top:0px;left:10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                            <div style="float:left;margin-left:15px;margin-top:-30px;">
                                @include('admin.component.buttons.delete_actions', [
                                    'url' => route("profile.notifications.destroy",$list->id),
                                ])
                            </div>

                        </div>

                    @endforeach

                    {{ $lists->withQueryString()->withQueryString()->links('admin.layouts.inc.paginator') }}

                @else
                    @include('admin.component.inc.nodata', [
                        'name' => __('إشعارات')
                    ])
                @endif

            </div>
        </div>
    </div>
</section>
<!--=================================Alerts -->

@include('admin.component.modals.delete')
@endsection
@push('scripts')

@endpush
