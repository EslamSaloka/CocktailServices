@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')
<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($entitle))
                <form action="{{ route('admin.entitles.update', $entitle->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.entitles.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'إسم الجهه',
                                'name' => 'name',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('name') ??(isset($entitle) ? $entitle->name : null)
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'رقم الواتساب',
                                'name' => 'whatsapp',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('whatsapp') ??(isset($entitle) ? $entitle->whatsapp : null)
                            ])
                        </div>
                        @php
                            $ids = [];
                            if(isset($entitle)) {
                                $ids = $entitle->services()->pluck("service_id")->toArray();
                            }
                        @endphp
                        <div class="col-md-12">
                            @include('admin.component.form_fields.select', [
                                'label'     => 'الخدمات',
                                'name'      => 'services[]',
                                'required'  => true,
                                'multiple'  => true,
                                'data'      => $services,
                                'keyV'      => "name",
                                'value'     => old('services') ?? (isset($entitle) ? $ids : null)
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.entitles.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush
