@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')
<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($bank))
                <form action="{{ route('admin.banks.update', $bank->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.banks.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.component.form_fields.input', [
                                'label' => 'إسم البنك',
                                'name' => 'bank_name',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('bank_name') ??(isset($bank) ? $bank->bank_name : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.input', [
                                'label' => 'إسم الحساب',
                                'name' => 'account_name',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('account_name') ??(isset($bank) ? $bank->account_name : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.input', [
                                'label' => 'رقم الحساب',
                                'name' => 'account_number',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('account_number') ??(isset($bank) ? $bank->account_number : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.input', [
                                'label' => 'رقم الايبان',
                                'name' => 'iban',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('iban') ??(isset($bank) ? $bank->iban : null)
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.banks.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Banks\CreateOrUpdateRequest') !!}
@endpush
