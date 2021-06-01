@extends('user::layouts.app_master_user')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_dashboard.css') }}">
@stop
@section('content')
    <div class="container" id="pjax-pages-page">
        <div class="pages_user mt30">
            <div class="box">
                <div class="box-30">
                    <div class="box-dashboard-item">
                        @include('user::components._inc_avatar')
                    </div>
                </div>
                <div class="box-70 margin-left" >
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="d-inline-block mb-0">Tin tuyển dụng</h4>
                                <div class="d-flex">
                                    <a class="btn btn-primary" href="{{ route('get_user.addjobs') }}" role="button">Thêm
                                        tin tuyển
                                        dụng</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Tin tuyển dụng</th>
                                        <th class="hide-sm" scope="col">Địa điểm</th>
                                        <th class="hide-sm" scope="col">Hạn nộp</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                @if (count($jobs) > 0)
                                    <tbody class="list">

                                        @foreach ($jobs as $key => $item)
                                            <tr>
                                                <td> {{ $item->name }} </td>
                                                <td class="hide-sm"> Địa chỉ: {{ $item->address }} </td>
                                                <td class="hide-sm"> Hạn nộp: {{ $item->end_date }} </td>
                                                <td>
                                                    <div class="actions ml-3">
                                                        <a href="{{ route('get_user.editJobs', $item->id) }}"
                                                            class="btn btn-icon btn-hover btn-sm btn-circle"
                                                            uk-tooltip="Edit jobs">
                                                            <i class="uil-pen text-success"></i>
                                                        </a>
                                                        <a href="{{ route('get_user.delete', $item->id) }}"
                                                            class="job-delete btn btn-icon btn-hover btn-sm btn-circle  ">
                                                            <i class="uil-trash-alt text-danger"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody class="list">
                                        <tr>
                                            <td colspan="4">
                                                <p>Dữ liệu chưa được cập nhật</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('js/deletejob.js') }}"></script>
@stop
