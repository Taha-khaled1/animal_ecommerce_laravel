@extends('admin.master', ['menu' => 'catbad', 'submenu' => 'Service'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div id="table-url" data-url="{{ route('admin.Service') }}"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{__('Service')}}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Service')}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <div class="col-xs-6">
                        <a href="{{route('admin.Service.create')}}" class="btn btn-md btn-info">{{ __('Add Service')}}</a>
                    </div>
                </div>
                <div class="customers__table">
                    <table id="ServiceTable" class="row-border data-table-filter table-style">
                        <thead>
                        <tr>
                            <th>{{ __('Service Name')}}</th>
                            <th>{{ __('Service Slug')}}</th>
                            <th>{{ __('Description')}}</th>
                            <th>{{ __('Icon')}}</th>
                            <th>{{ __('Status')}}</th>
                            <th>{{ __('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
    @push('post_scripts')

        <script src="{{asset('backend/js/admin/datatables/Service.js')}}"></script>
        <!-- Page level custom scripts -->
    @endpush
@endsection
