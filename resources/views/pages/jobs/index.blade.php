@extends('pages.layouts.app_home')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/frontend_dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/unistyle.css') }}">
@stop
@section('contents')
@include('pages.jobs.include._inc_breadcrumb')
<style>
    .card.card-jobs {
        margin-top: 20px;
    }

    table.table-jobs {
        min-width: 600px;
        color: #292621;
    }
    .table-jobs thead>tr>th {
        background: #122a67;
        color: #f2f2f2;
        padding: 15px;
        font-size: 15px;
        text-transform: uppercase;
    }
    .table-jobs tbody.list>tr>th {
        padding: 15px;
        font-size: 15px;
    }
    .page-content-inner{
        padding: 0;
    }
    a.more-jobs{
        border: 1px solid #122a67;
        padding: 10px;
    }
    a.more-jobs:hover{
        border: 1px solid #122a67;
        padding: 10px;
        background: #122a67;
        color: #f2f2f2;
        transition: 0.2s;
    }
    
</style>
<div class="uni-content">
    <div class="page-content-inner">
        <!-- Intro banner container  -->
        <h1 class="mt-5 mb-10 uk-article-title">Tin tuyển dụng</h1>
        <div class="card card-jobs">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table align-items-center table-jobs">
                    <thead>
                        <tr>
                            <th scope="col" class="w-35">Vị trí tuyển dụng</th>
                            <th scope="col">Hạn nộp</th>
                            <th scope="col" colspan="2">Địa điểm làm việc</th>
                        </tr>
                    </thead>
                    @if (count($jobs) > 0)
                    <tbody class="list">
                        @foreach ($jobs as $key => $item)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <a href="javascript:;" class="name h6 mb-0 text-sm">{{ $item->name }}</a>
                                    </div>
                                </div>
                            </th>
                            <th> {{ $item->end_date }}</th>
                            <th>
                                <div class="media-body">
                                    <a href="javascript:;" class="name h6 mb-0 text-sm">{{ $item->address }}</a>
                                </div>
                            </th>
                            <th class="text-right">
                                <!-- Actions -->
                                <div class="text-center actions ml-3">
                                    <a href="{{ route('get.jobsdetail', $item->slug) }}" class="name h6 mb-0 more-jobs">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </th>
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
@include('pages.course.include._inc_popup_view_course')
@stop

@section('scripts')
<script>
    (function(window, document, undefined) {
        'use strict';
        if (!('localStorage' in window)) return;
        var nightMode = localStorage.getItem('gmtNightMode');
        if (nightMode) {
            document.documentElement.className += ' night-mode';
        }
    })(window, document);


    (function(window, document, undefined) {

        'use strict';

        // Feature test
        if (!('localStorage' in window)) return;

        // Get our newly insert toggle
        var nightMode = document.querySelector('#night-mode');
        if (!nightMode) return;

        // When clicked, toggle night mode on or off
        nightMode.addEventListener('click', function(event) {
            event.preventDefault();
            document.documentElement.classList.toggle('night-mode');
            if (document.documentElement.classList.contains('night-mode')) {
                localStorage.setItem('gmtNightMode', true);
                return;
            }
            localStorage.removeItem('gmtNightMode');
        }, false);

    })(window, document);
</script>
<script src="{{ asset('js/frontend_dashboard.js') }}"></script>
<script src="{{ asset('js/unijs.js') }}"></script>
@stop