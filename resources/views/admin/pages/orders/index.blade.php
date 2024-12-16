@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')
@section('buttons')
    @include('admin.component.buttons.btn_href', [
            'title' => __('تصدير ملف excel'),
            'color_class' => 'primary',
            'url' => route('admin.orders.index')."?order_id=".request('order_id',null)."&service_id=".request('service_id',-1)."&user_id=".request('user_id',-1)."&seen=".request('seen',-1)."&action=".request('action',-1)."&export=1",
            'fe_icon' => 'download'
        ])
    @include('admin.component.buttons.filter')
@endsection

<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card custom-card">
            @if ($lists->count() > 0)
            <div class="card-body">
                <div class="table-responsive border newlist-table">
                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class="wd-lg-8p"><span>@lang('#')</span></th>
                                <th class="wd-lg-8p"><span>@lang('إسم المستخدم')</span></th>
                                <th class="wd-lg-8p"><span>@lang('الخدمة')</span></th>
                                <th class="wd-lg-8p"><span>@lang('السعر')</span></th>
                                <th class="wd-lg-8p"><span>@lang('نوع الطلب')</span></th>
                                <th class="wd-lg-8p"><span>@lang('حالة الطلب')</span></th>
                                <th class="wd-lg-20p"><span>@lang('Created At')</span></th>
                                <th class="wd-lg-20p">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        {{ $list->id ?? "###" }}
                                    </td>
                                    <td>
                                        {{ $list->user->username ?? '-----' }}
                                    </td>
                                    <td>
                                        {{ $list->service->name ?? '-----' }}
                                    </td>
                                    <td>
                                        {{ $list->service->price ?? '-----' }}
                                    </td>
                                    <td>
                                        {!! $list->showShow() !!}
                                    </td>
                                    <td>
                                        {!! $list->showStatus() !!}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($list->created_at)->format("d-m-Y") }}
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ route('pdf',$list->id_hash) }}" class="btn btn-sm btn-info">
                                            <i class="fe fe-download-cloud"></i>
                                        </a>
                                        @canAny('orders.show')
                                            <a href="{{ route('admin.orders.show',$list->id) }}" class="btn btn-sm btn-info">
                                                <i class="fe fe-eye"></i>
                                            </a>
                                        @endcanAny
                                        @canAny('orders.destroy')
                                        @include('admin.component.buttons.delete_actions', [
                                            'url' => route('admin.orders.destroy',$list->id),
                                        ])
                                        @endcanAny
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $lists->withQueryString()->links('admin.layouts.inc.paginator') }}
            </div>
            @else
            @include('admin.component.inc.nodata', [
                'name' => __('الطلبات')
            ])
            @endif
        </div>
    </div>
</div>

@include('admin.component.modals.filter', [
    'fields' => [
        [
            'name' => 'order_id',
            'label' => 'رقم الطلب',
            'type' => 'text',
            'translate' => true
        ],
        [
            'name' => 'service_id',
            'label' => 'بحث بالخدمة',
            'type' => 'select',
            'data' => \App\Models\Service::select("id","name")->get(),
            'translate' => true
        ],
        [
            'name' => 'user_id',
            'label' => 'بحث بالمستخدم',
            'type' => 'select',
            'data' => \App\Models\User::select("id","username as name")->whereHas("roles",function($q){
                $q->where("name",\App\Models\User::TYPE_CUSTOMER);
            })->get(),
            'translate' => true
        ],
        [
            'name' => 'seen',
            'label' => 'نوع الطلب',
            'type' => 'select',
            'data' => [
                [
                    'id' => 1,
                    'name' => 'مشاهد'
                ],
                [
                    'id' => 0,
                    'name' => 'غير مشاهد'
                ]
            ],
            'translate' => true
        ],
        [
            'name' => 'action',
            'label' => 'حالة الطلب',
            'type' => 'select',
            'data' => [
                [
                    'id' => 0,
                    'name' => 'قيد المعالجة'
                ],
                [
                    'id' => 1,
                    'name' => 'تم الموافقة'
                ],
                [
                    'id' => 2,
                    'name' => 'تم الرفض'
                ]
            ],
            'translate' => true
        ],
        [
            'name' => 'from',
            'label' => 'من تاريخ',
            'type' => 'date',
            'translate' => true
        ],
        [
            'name' => 'to',
            'label' => 'إلي تاريخ',
            'type' => 'date',
            'translate' => true
        ],
    ],
    'url' => route('admin.orders.index')
])
@include('admin.component.modals.delete')
@endsection
