@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')

@section('buttons')
        @include('admin.component.buttons.btn_href', [
            'title' => __('إضافة محتوى'),
            'color_class' => 'primary',
            'url' => route('admin.abouts.index'),
            'fe_icon' => 'plus'
        ])
@endsection

<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($page))
                <form action="{{ route('admin.contents.update', [$page->id, 'page' => request()->query('page')]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.contents.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.component.form_fields.textarea', [
                                'label' => 'محتوي الصفحة',
                                'name' => 'content',
                                'required' => true,
                                'is_editor' => true,
                                'value' => old('content') ??(isset($page) ? $page->content : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.image', [
                                'label' => 'Image',
                                'name' => 'image',
                                'value' => old('image') ?? (isset($page) ? $page->display_image : null)
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.contents.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Pages\CreateOrUpdateRequest') !!}
@endpush
@push('scripts')
    <!-- INTERNAL Summernote Editor js -->
    <script src="{{ asset('assets/plugins/summernote-editor/summernote1.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.js') }}"></script>
    <script>

        $('.summernote').summernote({

            tabsize: 3,
            height: 300,
        });
        </script>
@endpush
@push('css')
    <!-- Internal Summernote css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote-editor/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote-editor/summernote1.css') }}">
@endpush
