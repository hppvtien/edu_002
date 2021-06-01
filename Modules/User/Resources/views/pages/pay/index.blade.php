@extends('pages.layouts.app_home')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/frontend_dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/pay.css') }}">
@stop
@section('contents')
@include('user::pages.pay.include._inc_process')
<style>
    @media only screen and (max-width: 768px) {
        .container.flex {
            display: flex;
            flex-wrap: wrap;
            padding-top: 0;
        }

        .container.flex .item {
            flex: 0 0 100%;
            max-width: 100%;
            display: flex;
            width: 100%;
        }

        .item span:nth-child(1) {
            color: chocolate;
            padding-right: 20px;
            padding-bottom: 0 !important;
        }

        .box-fix {
            height: 140px;
            padding-top: 0px;
            padding: 15px 30px;
        }

        button.checkout-button.btn.js-save-cart {
            padding: 10px 50px;
            font-size: 14px;
            margin: 0;
            text-transform: uppercase;
        }
        .box-fix .item span:first-child{
            font-size: 14px;
        }
    }
</style>
<div class="container" id="pjax-pages-page">
    <form action="" method="POST" id="formTransaction">
        <div class="box mb20">
            <div class="box-70">
                @include('user::pages.pay.include._inc_pay_left')
            </div>
            <div class="box-30">
                @include('user::pages.pay.include._inc_pay_right',['listCarts' => $listCarts])
            </div>
        </div>
        <div class="box-fix">
            <div class="container flex">
                <div class="item">
                    <span>Phương thức thanh toán</span><br>
                    <span class="js-pay-type-preview">Chuyển khoản</span>
                </div>
                <div class="item">
                    <span>Tổng tiền thanh toán</span><br>
                    <span><b>{{ \Cart::subtotal(0,0,'.') }} đ</b></span>
                </div>
                <div class="item">
                    <span>Email tài khoản</span>
                    <span>{{ get_data_user('web','email') }}</span>
                </div>
                <div class="item">
                    <button type="submit" class="checkout-button btn js-save-cart" data-url-rd="{{ route('get_user.paysuccsess') }}" data-url="{{ route('post_user.cart.pay',['type' => 'course']) }}">Hoàn tất đơn hàng</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script src="{{ asset('js/cart.js') }}"></script>
@stop