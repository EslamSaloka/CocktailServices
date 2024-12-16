@extends('admin.layouts.master')
@section('title', $breadcrumb['title'])
@section('PageContent')

@section('buttons')
    @include('admin.component.buttons.filter')
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
                                <th class="wd-lg-20p"><span>الصوره</span></th>
                                <th class="wd-lg-8p"><span>@lang('User Name')</span></th>
                                <th class="wd-lg-20p"><span>@lang('Phone')</span></th>
                                <th class="wd-lg-20p"><span>@lang('الحالة')</span></th>
                                <th class="wd-lg-20p"><span>@lang('Created At')</span></th>
                                <th class="wd-lg-20p">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        <img alt="avatar" class="rounded-circle avatar-md me-2" src="{{ (new \App\Support\Image)->displayImageByModel($list,'avatar') }}">
                                    </td>
                                    <td>
                                        @canAny('customers.edit')
                                        <a href="{{ route('admin.customers.edit', [$list->id, 'page' => request()->query('page')]) }}">
                                            {{ $list->username ?? '' }}
                                        </a>
                                        @else
                                            {{ $list->username ?? '' }}
                                        @endcanAny
                                    </td>
                                    <td>
                                        {{ $list->phone ?? '' }}
                                    </td>

                                    <td>
                                        @if ($list->suspend == 1)
                                            غير فعال
                                        @else
                                            فعال
                                        @endif
                                    </td>

                                    <td>
                                        {{ $list->created_at}}
                                    </td>
                                    <td>
                                        @canAny('customers.edit')
                                            <a href="{{ route('admin.customers.edit', [$list->id, 'page' => request()->query('page')]) }}" class="btn btn-sm btn-info">
                                                <i class="fe fe-edit-2"></i>
                                            </a>
                                        @endcanAny
                                        @canAny('customers.show')
                                            <a href="{{ route('admin.customers.show', [$list->id, 'page' => request()->query('page')]) }}" class="btn btn-sm btn-info">
                                                <i class="fe fe-eye"></i>
                                            </a>
                                        @endcanAny
                                        @canAny('customers.destroy')
                                            @include('admin.component.buttons.delete_actions', [
                                                'url' => route('admin.customers.destroy',$list->id),
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
                    'name' => __('customers')
                ])
            @endif
        </div>
    </div>
</div>
@include('admin.component.modals.filter', [
    'fields' => [
        [
            'name' => 'name',
            'label' => 'البحث بالإسم أو رقم الجوال',
            'type' => 'text'
        ],
        [
            'name' => 'suspend',
            'label' => 'Status',
            'type' => 'select',
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Not Suspended'
                ],
                [
                    'id' => 0,
                    'name' => 'Suspended'
                ]
            ],
            'translate' => true
        ]
    ],
    'url' => route('admin.customers.index')
])
@include('admin.component.modals.delete')
@endsection
