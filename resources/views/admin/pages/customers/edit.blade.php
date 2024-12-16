@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')

<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($customer))
                <form action="{{ route('admin.customers.update', [$customer->id, 'page' => request()->query('page')]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.customers.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'User Name',
                                'name' => 'username',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('username') ??(isset($customer) ? $customer->username : null)
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'Phone',
                                'name' => 'phone',
                                'placeholder' => 'Enter Phone',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('phone') ??(isset($customer) ? $customer->phone : null)
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'كلمة المرور',
                                'name' => 'password',
                                'placeholder' => 'إدخل كلمة المرور الجديدة',
                                'type' => 'text',
                                'value' => null
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'المنطقة',
                                'name' => 'area',
                                'placeholder' => 'المنطقة',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('area') ??(isset($customer) ? $customer->area : null)
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'رقم الهوية',
                                'name' => 'id_number',
                                'placeholder' => 'رقم الهوية',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('id_number') ??(isset($customer) ? $customer->id_number : null)
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.select', [
                                'label' => 'مسمي جهة العمل',
                                'name' => 'employer_id',
                                'placeholder' => 'مسمي جهة العمل',
                                'required' => true,
                                "data"  => \App\Models\Employer::all(),
                                'value' => old('employer_id') ??(isset($customer) ? $customer->employer_id : null)
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'إسم جهة العمل',
                                'name' => 'employer_name',
                                'placeholder' => 'إسم جهة العمل',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('employer_name') ??(isset($customer) ? $customer->employer_name : null)
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'عدد سنين الخبره',
                                'name' => 'employer_years',
                                'placeholder' => 'عدد سنين الخبره',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('employer_years') ??(isset($customer) ? $customer->employer_years : null)
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'الراتب',
                                'name' => 'salary',
                                'placeholder' => 'إدخل الراتب',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('salary') ??(isset($customer) ? $customer->salary : null)
                            ])
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="suspend">@lang('الحاله') <span class="tx-danger">*</span></label>
                                <select name="suspend" id="suspend" class="form-control select2 @error('suspend') is-invalid @enderror">
                                    <option @if(isset($customer)) @if($customer->suspend == 0) selected @endif @endif value="0">@lang('فعال')</option>
                                    <option @if(isset($customer)) @if($customer->suspend == 1) selected @endif @endif value="1">@lang('غير فعال')</option>
                                </select>
                                @error('suspend')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            @include('admin.component.form_fields.image', [
                                'label' => 'Image',
                                'name' => 'avatar',
                                'value' => old('img_base64') ?? (isset($customer) && $customer->avatar ? asset($customer->avatar) : null)
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.customers.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
