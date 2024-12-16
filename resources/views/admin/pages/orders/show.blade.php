@extends('admin.layouts.master')
@section('title',$breadcrumb['title'])
@section('PageContent')



@php
    $my = $order->entitles()->pluck("entities_id")->toArray();
    $entitles = \App\Models\Entitle::whereHas("services",function($q)use($order){
        return $q->where("service_id",$order->service_id);
    })->get();
@endphp


@if (count($entitles) == 0)
    <div class="alert alert-warning" style="border-radius:0px;">
        لا يوجد جهات تمويل تدعم هذه الخدمة حاليا
    </div>
@endif
<div class="row">
    <div class="col-lg-8">
        <h3>
            الخدمة
        </h3>

        <div class="">
            <div class="table-responsive">
                <table class="table project-list-table table-nowrap align-middle table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                @lang('إسم الخدمة')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->service->name ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('سعر الخدمة')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->service->price ?? '' }} SAR
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <h3>
            تفاصيل الطلب
        </h3>

        <div class="">
            <div class="table-responsive">
                <table class="table project-list-table table-nowrap align-middle table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                @lang('إسم البنك الذي تم التحويل علية')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->bank->bank_name ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('إسم البنك الذي تم التحويل من خلالة')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->bank_name ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('اسم الشخص المحول')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->account_name ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('اسم الشخص المحول نيابة عنه (ان وجد)')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->person_any ?? 'لا يوجد' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('تاريخ التحويل')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->transfer_date ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('مبلغ التحويل')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->transfer_price ?? '' }} SAR
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('رقم إيصال التحويل')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->transfer_number ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('إرفاق صورة إيصال التحويل')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    <img src="{{ $order->display_image ?? '' }}" class="clickImage" width="75px" height="75px" style="border-radius: 20%">
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <hr>
    </div>
    <div class="col-lg-4">
        <div class="">
            <div class="table-responsive">
                <table class="table project-list-table table-nowrap align-middle table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                @lang('Name')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $order->user->username ?? '' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('Phone')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    <a href="tel:{{ $order->user->phone }}">{{ $order->user->phone }}</a>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('Status')
                            </td>
                            <td>
                                {!! $order->showStatus() !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @lang('Created At')
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format("d-m-Y") }}
                                </span>
                            </td>
                        </tr>
                        @if ($order->action == 1)
                            <tr>
                                <td>
                                    @lang('إرسال إلي جهات التمويل')
                                </td>
                                <td>
                                    @if (count($entitles) > 0)
                                        @if (count($my) == count($entitles))
                                            <span style="font-weight: 900;color:green">تم الإرسال</span>
                                        @else
                                            <button class="OPENMODAL btn btn-primary">@lang('عرض جميع الجهات')</button>
                                        @endif
                                    @else
                                        <span style="font-weight: 900;color:red">لا يوجد جهات تمويل تدعم هذة الخدمة</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if ($order->action == 0)
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    @lang('الإجراء')
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.update',$order->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="action" class="form-control">
                                            <option value="0" selected>قيد المراجعة</option>
                                            <option value="1">قبول</option>
                                            <option value="2">رفض</option>
                                        </select>
                                        <br/>
                                        <button type="submit" class="btn btn-primary">تغيير الحالة</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="composemodalTitle">@lang('الصوره')</h5>
                <button aria-label="Close" class="btn btn-sm" data-bs-dismiss="modal" type="button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row showImage">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('إلغاء')</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="OPENMODAL" tabindex="-1" role="dialog" aria-labelledby="OPENMODALTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OPENMODALTitle">@lang('جهات التمويل')</h5>
                <button aria-label="Close" class="btn btn-sm" data-bs-dismiss="modal" type="button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table project-list-table table-nowrap align-middle table-borderless">
                    <tbody>
                        @foreach ($entitles as $item)
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    @if (in_array($item->id,$my))
                                        <span style="font-weight: 900;color:green">
                                            تم ارسال الطلب
                                        </span>
                                    @else
                                        <a target="_blank" href="{{ route("admin.orders.sendPDF",[$order->id,$item->id]) }}" class="btn btn-sm btn-info oop">
                                            إرســـال
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('إلغاء')</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        $(".clickImage").click(function() {
            $("#composemodal").modal("show");
            $(".showImage").html("<img src='"+$(this).attr("src")+"' />");
        });
        $(".OPENMODAL").click(function() {
            $("#OPENMODAL").modal("show");
        });
        $(".oop").click(function() {
            $(this).parent().html(' ').html('<span style="font-weight: 900;color:green">تم إرسال الطلب</span>');
        });
    </script>
@endpush
