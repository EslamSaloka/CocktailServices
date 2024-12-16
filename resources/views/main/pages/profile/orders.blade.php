@extends('main.layouts.master')
@section('title')
    طلباتي
@endsection
@section('PageContent')



<!--=================================page-title-->
<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ getSettings('profile_orders_page_image','/main/images/bg/02.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-name">
                    <h1>قائمة الطلبات</h1>
                    <p>يمكنك تصفح طلباتك من هنا</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================page-title -->



<!--=================================Orders -->
<section class="shop grid page-section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-9 sm-mt-40">

                <div class="section-title text-center">
                    <h2 class="title-effect">قائمة الطلبات</h2>
                </div>
                @if ($lists->count() > 0)
                    @foreach ($lists as $list)
                        <div class="product listing" style="margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-8">
                                    <div class="product-des text-start" style="text-align:right !important;background:#cccccc24;border-radius:10px;padding:15px;">
                                        <div class="product-title">
                                            <h5 href="{{ route('services.show',$list->service_id) }}">{{ $list->service->name }}</h5>
                                        </div>
                                        <br>
                                        <div class="product-info">
                                            <p style="font-size:14px;">تاريخ الطلب : {{ $list->created_at->format("d-m-Y") }}</p>
                                        </div>
                                        <div class="product-info mt-20">
                                            حالة سداد رسوم الطلب : {!! $list->showStatus() !!}
                                        </div>

                                        <div style="float:left;margin-left:15px;margin-top:-100px;">
                                            <p>#{{ $list->id }}</p>
                                        </div>

                                        <div style="float:left;margin-left:15px;margin-top:-30px;">
                                            @include('admin.component.buttons.delete_actions', [
                                                'url' => route("profile.orders.destroy",$list->id),
                                            ])
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $lists->withQueryString()->withQueryString()->links('admin.layouts.inc.paginator') }}
                @else
                    @include('admin.component.inc.nodata', [
                        'name' => __('طلبات')
                    ])
                @endif

            </div>
        </div>
    </div>
</section>
<!--=================================Orders -->

@include('admin.component.modals.delete')
@endsection
@push('scripts')

@endpush
