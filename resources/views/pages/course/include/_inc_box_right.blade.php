<div class="course-card-trailer" uk-sticky="top: 190 ;offset:190 ; media: @m ; bottom:true">
    <div class="course-thumbnail">
        <img class="thumb" src="{{ pare_url_file($courseDetail->c_avatar) }}" alt="{{ $courseDetail->c_name }}">
        <a class="play-button-trigger show" href="#trailer-modal" uk-toggle> </a>
    </div>
    <!-- video demo model -->
    {{-- <div id="trailer-modal" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default mt-2  mr-1" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h4> Trailer video </h4>
            </div>
            <div class="video-responsive">
                <iframe src="https://www.youtube.com/embed/nOCXXHGMezU" class="uk-padding-remove"
                    uk-video="automute: true" frameborder="0" allowfullscreen
                    uk-responsive></iframe>
            </div>
            <div class="uk-modal-body">
                <h3>Build Responsive Websites </h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore
                    eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident,
                    sunt
                    in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
    </div> --}}
    <div class="p-3">
        <p class="my-3 text-center">
            @if($courseDetail->c_sale == 0)
            <span class="uk-h1-adsmo"> {{ number_format($courseDetail->c_price,0,',','.') }} đ </span>
            @else
            <span class="uk-h1-adsmo"> {{ number_format(($courseDetail->c_price - $courseDetail->c_price*$courseDetail->c_sale/100),0,',','.') }} đ </span>
            <s class="uk-h4 text-muted"> {{ number_format($courseDetail->c_price,0,',','.') }} đ </s>
            @endif
        </p>
        <div class="uk-child-width-1-2 uk-grid-small mb-4" uk-grid>
            <div>
                <a href="javascript:;void(0)" data-url="{{ route('get_user.cart.add',['id' => $courseDetail->id,'type' => 'course']) }}" title="Mua ngay" class="uk-width-1-1 btn btn-default transition-3d-hover js-buy-now"><i class="uil-play"></i> Mua ngay</a>
            </div>
            <div>
                {{-- <a href="javascript:;void(0)" title="Thêm giỏ hàng" data-url="{{ route('get_user.cart.add',['id' => $courseDetail->id,'type' => 'course']) }}"
                class="btn btn-pink btn-radius js-add-cart">Thêm giỏ hàng</a> --}}
                <a href="javascript:;void(0)" title="Yêu thích" data-url="{{ route('get_user.favourite.add',['type' => 'course', 'id' => $courseDetail->id]) }}" class="btn btn-danger uk-width-1-1 transition-3d-hover {{ get_data_user('web') ? 'js-save-favorite' : 'js-show-login' }}"><i class="uil-heart"></i> Yêu thích</a>

            </div>
        </div>
        <p class="uk-text-bold"> Khóa học này bao gồm </p>
        <div class="uk-child-width-1-2 uk-grid-small" uk-grid>
            <div>
                <span><i class="uil-youtube-alt"></i> {{ $courseDetail->c_total_time }} Giờ video</span>
            </div>
            <div>
                <span> <i class="uil-award"></i> Chứng chỉ </span>
            </div>
            <div>
                <span> <i class="uil-file-alt"></i> {{ $courseDetail->c_total_time }} Bài học </span>
            </div>
            <div>
                <a href="{{ route('get.video.kh',$courseDetail->c_slug) }}" class="{{ get_data_user('web') ?  : 'js-show-login' }}"> <i class="uil-video"></i> Xem trực tuyến </a>
            </div>
        </div>
        {{-- <a href="{{ route('get.video.kh',['slug' => $courseDetail->c_slug.'-cr']) }}" class="{{ get_data_user('web') ? 'js-view-course' : 'js-show-login' }}"> <i class="uil-video"></i> Xem trực tuyến </a> --}}
        {{-- <div class="right-section">
            <h4 class="right-section-title">{{ $courseDetail->c_name }}</h4>
        <div class="list-course">
            @forelse($courseVideo as $video)
            <a href="{{ route('ajax_get.course.view_course', $video->id) }}" class="{{ get_data_user('web') ? 'js-view-course' : 'js-show-login' }}"><i class="fa fa-play-circle"></i> {{ $video->cv_name }}</a>
            @empty
            <a href="">Chưa cập nhật</a>
            @endforelse
        </div>
    </div> --}}
</div>
</div>