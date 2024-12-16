@extends('admin.layouts.master')
@section('title', $breadcrumb['title'])
@section('PageContent')

@section('buttons')
    @canAny('banners.create')
        @include('admin.component.buttons.btn_href', [
            'title' => __('اضافة فيديو جديد'),
            'color_class' => 'primary',
            'url' => route('admin.banners.create'),
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
                                <th class="wd-lg-8p"><span>@lang('الفيديو')</span></th>
                                <th class="wd-lg-20p">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        <video width="20%" height="auto"  controls="controls" autoplay muted>
                                            <source src="{{ $list->video }}" type="video/mp4">
                                        </video>
                                    </td>
                                    <td>
                                        @canAny('banners.edit')
                                            <a href="{{ route('admin.banners.edit', [$list->id, 'page' => request()->query('page')]) }}" class="btn btn-sm btn-info">
                                                <i class="fe fe-edit-2"></i>
                                            </a>
                                        @endcanAny
                                        @canAny('banners.destroy')
                                            @include('admin.component.buttons.delete_actions', [
                                                'url' => route('admin.banners.destroy',$list->id),
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
                    'name' => __('فيديوهات')
                ])
            @endif
        </div>
    </div>
</div>
@include('admin.component.modals.delete')
@endsection
