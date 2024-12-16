@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')
<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($about))
                <form action="{{ route('admin.abouts.update', $about->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.abouts.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.component.form_fields.input', [
                                'label' => 'العنوان',
                                'name' => 'question',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('question') ??(isset($about) ? $about->question : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.textarea', [
                                'label' => 'المحتوى',
                                'name' => 'answer',
                                'required' => true,
                                'value' => old('answer') ??(isset($about) ? $about->answer : null)
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.abouts.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\Dashboard\FAQS\CreateOrUpdateRequest') !!}
@endpush
