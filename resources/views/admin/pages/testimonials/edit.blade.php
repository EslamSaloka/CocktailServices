@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')
<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($testimonial))
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.testimonials.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.component.form_fields.input', [
                                'label' => 'إسم العميل',
                                'name' => 'name',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('name') ??(isset($testimonial) ? $testimonial->name : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.textarea', [
                                'label' => 'التقييم',
                                'name' => 'message',
                                'required' => true,
                                'value' => old('message') ??(isset($testimonial) ? $testimonial->message : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.image', [
                                'label' => 'Image',
                                'name' => 'avatar',
                                'value' => old('avatar') ?? (isset($testimonial) ? $testimonial->display_image : null)
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.testimonials.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    @if (isset($testimonial))
        {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Testimonials\CreateOrUpdateRequest') !!}
    @else
        {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Testimonials\CreateOrUpdateRequest') !!}
    @endif
@endpush
