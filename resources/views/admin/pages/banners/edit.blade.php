@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')
<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($banner))
                <form action="{{ route('admin.banners.update', [$banner->id, 'page' => request()->query('page')]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.component.form_fields.image', [
                                'label' => 'ارفق ملف الفيديو',
                                'name' => 'video',
                                'value' => null
                            ])
                        </div>
                        <div class="col-md-12">
                            @if(isset($banner))
                                <video width="320" height="240" controls>
                                    <source src="{{url($banner->video)}}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.banners.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Banners\CreateOrUpdateRequest') !!}
@endpush
