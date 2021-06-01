@extends('pages.layouts.app_home')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/frontend_dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/pay.css') }}">
@stop
@section('contents')
<style>
    .pay-process ul li:last-child {
        background: #50ad4e;
        color: white;
        position: relative;
    }

    .checkout-triangle-right-succsess {
        border-top: 25px solid transparent;
        border-left: 20px solid #50ad4e;
        border-bottom: 25px solid transparent;
        position: absolute;
        right: -20px;
    }

    .pay-process ul {
        overflow: unset;
    }

    .cart-detail {
        width: 60%;
        margin: 30px auto;
    }

    .col-item-c {
        margin: 10px;
    }

    @media only screen and (max-width: 768px) {
        .adsmo-top {
            margin-top: 60px;
        }

        ul.checkout-list-part.pc {
            display: block;
        }

        .pay-process ul li {
            display: block;
            width: 90%;
        }

        .pay-process ul li:nth-child(1),
        .pay-process ul li:nth-child(2) {
            display: none;
        }

        .cart-detail {
            width: 90%;
        }

    }
</style>
<div class="pay-process adsmo-top mb20">
    <div class="container">
        <ul class="checkout-list-part pc">
            <li>
                <span class="checkout-span">Xem giỏ hàng</span>
                <span class="checkout-triangle-right"></span>
            </li>
            <li>
                <span class="checkout-triangle-left"></span>
                <span class="checkout-span">Chọn cách thanh toán và điền thông tin</span>
                <span class="checkout-triangle-right"></span>
            </li>
            <li>
                <span class="checkout-triangle-left"></span>
                <span class="checkout-span">Hoàn tất đơn hàng</span>
                <span class="checkout-triangle-right-succsess"></span>

            </li>
        </ul>
    </div>

</div>
<div class="container" id="pjax-pages-page">
    <h1 class="text-center text-success">Cám ơn bạn đã mua hàng !!!</h1>
    <div class="cart-detail">
        @foreach($listCarts as $item)
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="col-item-c">
                    <img src="http://127.0.0.1:8000/images/default.png" alt="">
                    <p class="text-danger product-tt">Khóa học: <span class="text-success">{{ $item->name }}</span> </p>
                </div>

            </div>
            <div class="col-md-7 col-12">
                <div class="row">
                    <div class="col-12 col-item-c">
                        <p class="text-danger">Phương thức thanh toán: <span class="text-success" id="method_pay">Chuyển khoản</span></p>
                    </div>
                    <div class="col-12 col-item-c">
                        <p class="text-danger">Tài khoản Email: <span class="text-success" id="email_pay">{{ get_data_user('web','email') }}</span> </p>
                    </div>
                    <div class="col-12 col-item-c">
                        <p class="text-danger">Tổng tiền: <span class="text-success" id="subtotal_pay">{{ \Cart::subtotal(0,0,'.') }} đ</span></p>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    <a href="javascript:;void(0)" data-url="{{ route('get_user.generatePDF') }}" title="Xuất hóa đơn" class="btn btn-default js-pdf-now"><i class="uil-play"></i> Xuất hóa đơn</a>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.js-pdf-now').click(function() {
        let url_pdf = $(this).attr('data-url');
        let method_pay = $('#method_pay').text();
        let email_pay = $('#email_pay').text();
        let subtotal_pay = $('#subtotal_pay').text();
        $.ajax({
            url: "{{ route('get_user.generatePDF') }}",
            type: "get",
            dataType: "text",
            data: {
                method_pay: method_pay,
                email_pay: email_pay,
                subtotal_pay: subtotal_pay
            },
            success: function(result) {
                console.log(result);
                window.location.href="{{ route('get_user.generatePDF') }}";
             
            },
            error: function(result) {
                console.log('loixxxxxxxxxxxxxx');
            }
        });
    })
</script>
@stop