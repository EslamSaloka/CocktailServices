@extends('admin.layouts.master')
@section('title', $breadcrumb['title'])
@section('PageContent')

@section('buttons')
        @include('admin.component.buttons.btn_href', [
            'title' => __('اضافة محتوي داخلي جديد'),
            'color_class' => 'primary',
            'url' => route('admin.abouts.create'),
            'fe_icon' => 'plus'
        ])
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
                                <th class="wd-lg-8p"><span>@lang('العنوان')</span></th>
                                <th class="wd-lg-20p">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        {{ $list->question ?? '' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.abouts.edit',$list->id) }}" class="btn btn-sm btn-info">
                                            <i class="fe fe-edit-2"></i>
                                        </a>
                                        @include('admin.component.buttons.delete_actions', [
                                            'url' => route('admin.abouts.destroy',$list->id),
                                        ])
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
                    'name' => __('المحتوي الداخلي')
                ])
            @endif
        </div>
    </div>
</div>
@include('admin.component.modals.delete')
@endsection
