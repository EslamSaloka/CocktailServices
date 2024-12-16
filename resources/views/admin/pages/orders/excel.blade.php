<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

</head>

<style>
    table, th, td {
        border:1px solid black;
    }
</style>

<div class="container">
    <p style="text-align:left;">Generation Date : {{Date('Y/m/d h:s')}}</p>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table" style="direction:ltr;float:left;width:100%;">
                <thead>
                <tr style="background-color:#2dc4ea;text-align:left;color:#fff;">
                    <th scope="col">رقم الطلب</th>
                    <th scope="col">إسم العميل</th>
                    <th scope="col">رقم جوال العميل</th>
                    <th scope="col">رقم هوية العميل</th>
                    <th scope="col">المنطقة</th>
                    <th scope="col">مسمي جهة العمل</th>
                    <th scope="col">إسم جهة العمل</th>
                    <th scope="col">عدد سنوات العمل</th>
                    <th scope="col">الراتب</th>
                    <th scope="col">إسم الخدمة</th>
                    <th scope="col">سعر الخدمة</th>
                    <th scope="col">إسم البنك المحول له</th>
                    <th scope="col">إسم البنك المحول منه</th>
                    <th scope="col">إسم صاحب الحساب</th>
                    <th scope="col">رقم العملية التحويل</th>
                    <th scope="col">تاريخ التحويل</th>
                    <th scope="col">تاريخ إنشاء الطلب</th>
                    <th scope="col">حالة الطلب</th>
                </tr>
                </thead>
                <tbody>
                @if ($lists->count() > 0)
                    @foreach ($lists as $list)
                        <tr style="text-align:left;direction:rtl;">
                            <td>
                                {{ $list->id ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->username ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->phone ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->area ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->employer->name ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->employer_name ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->employer_years ?? '' }}
                            </td>
                            <td>
                                {{ $list->user->salary ?? '' }}
                            </td>
                            <td>
                                {{ $list->service->name ?? '' }}
                            </td>
                            <td>
                                {{ $list->transfer_price ?? '' }}
                            </td>
                            <td>
                                {{ $list->bank->bank_name ?? '' }}
                            </td>
                            <td>
                                {{ $list->bank_name ?? '' }}
                            </td>
                            <td>
                                {{ $list->account_name ?? '' }}
                            </td>
                            <td>
                                {{ "*$list->transfer_number*" }}
                            </td>
                            <td>
                                {{ $list->transfer_date ?? '' }}
                            </td>
                            <td>
                                {{ date("d-m-Y", strtotime($list->created_at)) }}
                            </td>
                            <td>
                                {!! $list->showStatus() !!}
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="19" style="text-align: center; font-size: 25px; font-weight: 900;">
                            لا يوجد طلبات حاليا
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</html>



