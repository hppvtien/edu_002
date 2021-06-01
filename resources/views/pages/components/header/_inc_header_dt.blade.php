
<div class="header">
    <div class="container flex flex-jc-sb flex-a-c">
        <div class="header-left flex flex-jc-sb flex-a-c">
            <div class="logo">
                <a href="/" title="Logo">
                    <img src="{{ isset($configuration->logo) ? pare_url_file($configuration->logo) : asset('images/logo.png') }}" alt="">
                </a>
            </div>
            <div class="form_search">
                <form action="{{ route('get.search') }}" class="flex" id="form-search-header">
                    <input type="text" class="form-control" id="input_search" name="k" value="{{ \Request::get('k') }}" placeholder="Từ khoá tìm kiếm ...">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="header-right flex flex-jc-sb flex-a-c">
            <a href="" class="btn-cdo cdo"><i class="fa fa-unlock-alt"></i> Kích hoạt COD</a>
            <a href="{{ route('get_user.cart') }}" title="Giỏ hàng" class="cart"><i class="fa fa-cart-arrow-down"></i> <span id="countSource">{{ \Cart::count() }}</span></a>
            @if(get_data_user('web'))
                <div class="auth-login">
                    <a href="{{ route('get_user.dashboard') }}" title="Dashboard">{{ get_data_user('web','name') }}</a>
                </div>
            @else
                <div class="auth flex flex-a-c">
                    <p class="js-auth-popup">
                        <a href="" class="login">Đăng nhập</a>
                        <a href="" class="google"><i class="fa fa-google "></i></a>
                    </p>
                </div>
            @endif

        </div>
    </div>
    <div class="header-button container mt10 flex flex-jc-sb">
        <div class="box-category">
            <a href="/" title="Danh mục khoá học">
                <i class="fa fa-bars"></i> <span>Danh mục khoá học</span>
            </a>
        </div>
        <div class="box-right">
            <a href="{{ route('get.course.pay_selling') }}" title="Khoá học bán chạy"><i class="fa fa-thumbs-o-up"></i> <span>Bán chạy nhất</span></a>
            <a href="{{ route('get.course.favourite') }}" title="Khoá học yêu thích"><i class="fa fa-star"></i> <span>Khoá học yêu thích</span></a>
            <a href="{{ route('get_blog.home') }}" title="Bài viết" target="_blank"><i class="fa fa-rss"></i> <span>Blog</span></a>
        </div>
    </div>
</div>



