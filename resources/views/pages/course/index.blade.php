@extends('pages.layouts.app_home')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/course.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend_dashboard.css') }}">
@stop
@section('contents')
{{-- @include('pages.course.include._inc_breadcrumb') --}}
<div class="page-content">
    @include('pages.course.include._inc_header_course',['courseDetail' => $courseDetail])
    <div class="container">
        <div class="uk-grid-large mt-4" uk-grid>
            <div class="uk-width-2-3@m">
                <ul id="course-intro-tab" class="uk-switcher mt-4">
                    <!-- course Curriculum-->

                    <li>
                        <ul class="course-curriculum" uk-accordion="multiple: true">
                            @php
                            $keys = 0;
                            @endphp
                            @foreach ($courseContent as $item)
                            <li class="{{ $keys++ == 0 ? 'uk-open' : '' }} ">
                                {{-- <p class="">
                                            <span><i class="fa fa-play-circle"></i> {{ count($item->videos ?? [])  }} Video</span>
                                <span><i class="fa fa-question-circle"></i> {{ $item->cc_total_question }} Bài tập</span>
                                </p> --}}
                                <a class="uk-accordion-title" href="#"> {{ $item->cc_name }} </a>
                                <div class="uk-accordion-content">
                                    <!-- course-video-list -->
                                    <ul class="course-curriculum-list">
                                        @if (isset($item->videos) && !$item->videos->isEmpty())
                                        @foreach ($item->videos as $key => $item)
                                        <li> {{ $item->cv_name }}
                                            @if ($item->cv_link != null)
                                            <a href="#trailer-modal" uk-toggle>Miễn phí</a>
                                            <div id="trailer-modal" uk-modal>
                                                <div class="uk-modal-dialog">
                                                    <button class="uk-modal-close-default mt-2  mr-1" type="button" uk-close></button>
                                                    <div class="video-responsive">
                                                        <iframe src="https://www.youtube.com/embed/{{ $item->cv_link }}" class="uk-padding-remove" uk-video="automute: true" frameborder="0" allowfullscreen uk-responsive></iframe>
                                                    </div>
                                                    <div class="uk-modal-body">
                                                        <h3>{{ $item->cv_name }} </h3>
                                                        <p>Duis aute irure dolor in reprehenderi</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <span> 23 min </span>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                        @if (isset($courseDetail->teacher))
                        <div class="box-section teacher">
                            <h4 class="box-title">Thông tin giảng viên <a href="">Chi tiết <i class="fa fa-chevron-right"></i> </a></h4>
                            <div class="box-content">
                                <div class="box">
                                    <div class="box-30">
                                        <div class="info">
                                            <a href="">
                                                <img src="{{ pare_url_file($courseDetail->teacher->t_avatar) }}" alt="">
                                            </a>
                                            <p class="name"><strong>{{ $courseDetail->teacher->t_name }}</strong>
                                            </p>
                                            <p class="job"><i class="fa fa-briefcase"></i>
                                                {{ $courseDetail->teacher->t_job }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="box-70">
                                        <div class="content">
                                            {!! $courseDetail->teacher->t_content !!}
                                            <div class="item">
                                                <p>Chức vụ :</p>
                                                <p>Nguyên giám đốc Chiến lược Công ty Chứng khoán Mirea Asset (Hàn
                                                    Quốc)</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="box-section teacher-course">
                            <h4 class="box-title">Khoá học của
                                <b style="color: #122a67">{{ $courseDetail->teacher->t_name ?? '[N\A]' }}</b>
                                <a href="{{ route('get.teacher.course', $courseDetail->teacher->t_slug ?? '') }}" title="Xem thêm">Xem thêm </a>
                            </h4>
                            <div class="box-content">
                                <div class="lists " style="margin: -10px;">
                                    @forelse($courses as $item)
                                    @include('pages.category.include._item_course',['course' => $item])
                                    @empty
                                    <p>Dữ liệu chưa được cập nhật</p>
                                    @endforelse
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        @include('pages.course.include._inc_course_you',['courses' => $courses])
                        <!-- @include('pages.course.include._inc_vote',['courseDetail' => $courseDetail,'votes' =>
                            $votes,'votesDashboard' => $votesDashboard]) -->
                        @include('pages.course.include._inc_box_bottom')
                    </li>

                    <!-- course description -->
                    <li class="course-description-content">
                        <h4> Giới thiệu </h4>
                        {!! $courseDetail->c_about !!}
                    </li>
                    <!-- course bài tập-->
                    <li>
                        @if (isset($questions) && !$questions->isEmpty())
                        <div class="choice" style="margin-top: 20px">
                            <a href="" class="btn btn-primary btn-radius js-process-choice">Làm bài</a>
                            <a href="" class="btn btn-primary btn-radius" id="timer">2 phút </a>
                        </div>
                        <div class="box-section quiz-main">
                            <h4 class="box-title">Một số bài mẫu trắc nghiệm <a href="{{ route('get.course.multiple_choice', ['slug' => $courseDetail->c_slug . '-cr']) }}">Làm
                                    thử</a></h4>
                            <div class="box-content">
                                <ul>
                                    @foreach ($questions as $key => $item)
                                    <li data-sectionid="457" class="quiz-section">
                                        <div class="quiz-section-title">Câu {{ $key + 1 }}.
                                            {{ $item->q_name }}
                                        </div>
                                        <div class="quiz-section-content">
                                            <div class="item item-question item-choices">
                                                @if (isset($item->answers) && !$item->answers->isEmpty())
                                                <ul class="list btn-group group-theme">
                                                    @foreach ($item->answers as $item)
                                                    <li class="list-item">
                                                        <label class="overlabel">
                                                            <input type="radio" class="hide" name="option-{{ $item->id }}" data-status="1" data-point="1"> <span class="mark"></span> </label>
                                                        <div class="boxcheck">
                                                            <div class="answer-desc textview">
                                                                <p>{{ $item->a_name }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @else
                        <p>Bài tập đang được cập nhật</p>
                        @endif
                    </li>
                    <!-- course Faq-->
                    <li>
                        <h4 class="my-4"> Câu hỏi thường gặp</h4>
                        <ul class="course-faq" uk-accordion>
                            @php
                            $key = 0;
                            @endphp
                            @foreach ($courseFaq as $item)
                            <li class="{{ $keys++ == 0 ? 'uk-open' : '' }}">
                                <a class="uk-accordion-title" href="#"> {{ $item->title }} </a>
                                <div class="uk-accordion-content">
                                    <p>
                                        {{ $item->content }}
                                    </p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <!-- course Reviews-->
                    <li>
                        <?php if ($count_vote != 0) { ?>
                            <div class="review-summary">
                                <h4 class="review-summary-title"> Đánh giá </h4>
                                <div class="review-summary-container">
                                    <div class="review-summary-avg">
                                        <div class="avg-number">
                                            {{ $avg_star }}
                                        </div>
                                        <div class="review-star">
                                            <div class="star-rating">
                                                @for ($i = 1; $i <= $avg_star; $i++) <span class="star"></span>
                                                    @endfor
                                                    @if (is_int($avg_star) == false)
                                                    <span class="star half"></span>
                                                    @endif
                                                    @if (is_int($avg_star) == true)

                                                    @endif

                                            </div>
                                        </div>
                                        <span>Course Rating</span>
                                    </div>
                                    <div class="review-summary-rating">
                                        @foreach ($votesData as $key => $item)
                                        <div class="review-summary-rating-wrap">
                                            <div class="review-bars">
                                                <div class="full_bar">
                                                    <div class="bar_filler" style="width:{{ ($item * 100) / $count_vote }}%"></div>
                                                </div>
                                            </div>
                                            <div class="review-stars">
                                                <div class="star-rating">

                                                    @for ($i = 0; $i < $key; $i++) <span class="star"></span>
                                                        @endfor

                                                </div>
                                            </div>
                                            <div class="review-avgs">
                                                {{ round(($item * 100) / $count_vote) }} %
                                            </div>
                                        </div>
                                        @endforeach


                                        <!-- <div class="review-summary-rating-wrap">
                                                <div class="review-bars">
                                                    <div class="full_bar">
                                                        <div class="bar_filler" style="width:95%"></div>
                                                    </div>
                                                </div>
                                                <div class="review-stars">
                                                    <div class="star-rating"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></div>
                                                </div>
                                                <div class="review-avgs">
                                                    95 %
     @@ -234,9 +253,7 @@ class="star"></span><span class="star"></span></div>
                                                    </div>
                                                </div>
                                                <div class="review-stars">
                                                    <div class="star-rating"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-avgs">
     @@ -250,9 +267,7 @@ class="star"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-stars">
                                                    <div class="star-rating"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star empty"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-avgs">
     @@ -266,9 +281,7 @@ class="star empty"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-stars">
                                                    <div class="star-rating"><span class="star"></span><span class="star"></span><span class="star empty"></span><span class="star empty"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-avgs">
     @@ -282,184 +295,126 @@ class="star empty"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-stars">
                                                    <div class="star-rating"><span class="star"></span><span class="star empty"></span><span class="star empty"></span><span class="star empty"></span><span class="star empty"></span>
                                                    </div>
                                                </div>
                                                <div class="review-avgs">
                                                    25 %
                                                </div>
                                            </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="comments">
                                <h4>Bình luận: <span class="comments-amount"> ({{ $count_vote }}) </span> </h4>
                                <ul>
                                    @foreach ($votes as $keyv => $item)
                                    <li>
                                        <div class="comments-avatar"><img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-by">

                                                {{ $item->v_name }}


                                                <div class="comment-stars">
                                                    <div class="star-rating">
                                                        @for ($i = 0; $i < $item->v_number; $i++) <span class="star"></span>
                                                            @endfor

                                                    </div>
                                                </div>
                                            </div>
                                            <p> {{ $item->v_content }}
                                            </p>

                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        <?php } else { ?>

                        <?php } ?>


                        <div class="comments">
                            <h3>Bình luận </h3>
                            <ul>
                                <li>

                                    <div class="comment-content">
                                        <form class="uk-grid-small" method="post" uk-grid>
                                            <div class="uk-width-1-1@s">
                                                <label class="uk-form-label">Name</label>
                                                <input class="uk-input" name="rv_name" type="text" placeholder="Name">
                                            </div>
                                            <div class="uk-width-1-1@s">
                                                <label class="uk-form-label">Comment</label>
                                                <textarea name="content_review" id="rv_content" cols="30" rows="5" class="uk-textarea" placeholder="Enter Your Comments her..." style=" height:160px"></textarea>
                                            </div>
                                            <input type="hidden" class="uk-input" name="rv_id" value="{{ $courseDetail->id }}" type="text">
                                            <div class="uk-grid-margin">
                                                <button type="button" id="vote_submit" class="btn btn-pink btn-radius mt10 {{ get_data_user('web') ? 'js-view-comment' : 'js-show-login' }}">Gửi
                                                    đánh giá</button>
                                            </div>
                                        </form>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="uk-width-1-3@m">
                @include('pages.course.include._inc_box_right',['courseDetail' => $courseDetail,'courseVideo' =>
                $courseVideo])
            </div>
        </div>
    </div>
</div>
@include('pages.course.include._inc_popup_view_course')
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script src="{{ asset('js/course.js') }}"></script>
<script src="{{ asset('js/frontend_dashboard.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#vote_submit').on('click', function() {
        let rv_name = $("input[name='rv_name']").val();
        let rv_content = $("#rv_content").val();
        let rv_id = $("input[name='rv_id']").val();
        $.ajax({
            url: "{{ route('get.course.voteComment', $courseDetail->c_slug . '-cr') }}",
            type: "post",
            dataType: "text",
            data: {
                rv_name: rv_name,
                rv_content: rv_content,
                rv_id: rv_id
            },
            success: function(result) {
                location.reload();
                showPopupViewComment();
            },
            error: function(result) {
                location.reload();
                showPopupViewComment();

            }
        });
    });
    // 
</script>
@stop