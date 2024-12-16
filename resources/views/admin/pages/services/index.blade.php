@extends('admin.layouts.master')
@section('title', $breadcrumb['title'])
@section('PageContent')

@section('buttons')
    @canAny('services.create')
        @include('admin.component.buttons.btn_href', [
            'title' => __('إنشاء خدمة جديدة'),
            'color_class' => 'primary',
            'url' => route('admin.services.create'),
            'fe_icon' => 'plus'
        ])
    @endcanAny
@endsection

<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card custom-card">
            @if ($lists->count() > 0)
            <div class="card-body">
                <div class="table-responsive border userlist-table">
                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class="wd-lg-8p"><span>@lang('إسم الخدمة')</span></th>
                                <th class="wd-lg-8p"><span>@lang('سعر الخدمة')</span></th>
                                <th class="wd-lg-20p">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        @canAny('services.edit')
                                            <a href="{{ route('admin.services.edit',$list->id) }}">
                                                {{ $list->name ?? '' }}
                                            </a>
                                        @else
                                            {{ $list->name ?? '' }}
                                        @endcanAny
                                    </td>
                                    <td>
                                        {{ $list->price ?? '' }}
                                    </td>
                                    <td>
                                        @canAny('services.edit')
                                            <a href="{{ route('admin.services.edit',$list->id) }}" class="btn btn-sm btn-info">
                                                <i class="fe fe-edit-2"></i>
                                            </a>
                                        @endcanAny
                                        @canAny('services.destroy')
                                            @include('admin.component.buttons.delete_actions', [
                                                'url' => route('admin.services.destroy',$list->id),
                                            ])
                                        @endcanAny
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $lists->withQueryString()->withQueryString()->links('admin.layouts.inc.paginator') }}
            </div>
            @else
                @include('admin.component.inc.nodata', [
                    'name' => __('الخدمات')
                ])
            @endif
        </div>
    </div>
</div>
@include('admin.component.modals.delete')
@endsection
