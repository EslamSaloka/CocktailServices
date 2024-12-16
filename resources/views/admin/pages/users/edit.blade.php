@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')

<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card custom-card">
            @if(isset($user))
                <form action="{{ route('admin.users.update', [$user->id, 'page' => request()->query('page')]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'User Name',
                                'name' => 'username',
                                'type' => 'text',
                                'required' => true,
                                'value' => old('username') ??(isset($user) ? $user->username : null)
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => 'رقم الجوال',
                                'name' => 'phone',
                                'placeholder' => 'رقم الجوال',
                                'type' => 'number',
                                'required' => true,
                                'value' => old('phone') ??(isset($user) ? $user->phone : null)
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('admin.component.form_fields.input', [
                                'label' => isset($user) ? 'New Password' : 'Password',
                                'name' => 'password',
                                'placeholder' => 'Enter password',
                                'type' => 'password',
                                'required' => !isset($user) ? true : false,
                                'value' => null
                            ])
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">@lang('Role') <span class="tx-danger">*</span></label>
                                <select name="role" id="role" class="form-control select2 @error('role') is-invalid @enderror">
                                    <option disabled selected>@lang('Choose type')</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}" @if(old('role') == $role->name || isset($user) && ($user->roles->first() && $user->roles->first()->name == $role->name) ) selected @endif> @lang($role->name)</option>
                                    @endforeach
                                </select>
                                @error('role')
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
                                'value' => old('img_base64') ?? (isset($user) && $user->avatar ? asset($user->avatar) : null)
                            ])
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="suspend">@lang('الحاله') <span class="tx-danger">*</span></label>
                                <select name="suspend" id="suspend" class="form-control select2 @error('suspend') is-invalid @enderror">
                                    <option @if(isset($user)) @if($user->suspend == 0) selected @endif @endif value="0">@lang('فعال')</option>
                                    <option @if(isset($user)) @if($user->suspend == 1) selected @endif @endif value="1">@lang('غير فعال')</option>
                                </select>
                                @error('suspend')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-1">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    <a href="{{ route('admin.users.index')}}" class="btn btn-danger">@lang('Cancel')</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
