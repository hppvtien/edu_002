<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    div#guideModal {
        overflow: initial;
        background: transparent;
        width: 50%;
        padding: 0;
        box-shadow: none;
        margin: auto;
    }

    button#btn-closepopup {
        color: red !important;
    }
</style>
<div class="pay-left">
    <h3 class="pay-title">Chọn phương thức thanh toán</h3>
    <div class="lists lists-payments">
        @foreach(config('cart.pay_type') as $key => $item)
        <div class="item item-2">
            <label class="box-checkbox js-pay-type">
                <input type="radio" name="type_pay" {{ $key == 0 ? "checked" : ""}} value="{{ $item['type'] }}">
                <b>{{ $item['name'] }}</b>
                <span class="checkmark"></span>
                <br>
                <a data-type="{{ $item['type'] }}" class="popup-guide text-danger" data-toggle="modal" data-target="#guideModal" href="javascript:;">Hướng dẫn thanh toán: {{ $item['name'] }}</a>
            </label>
        </div>
        @endforeach
    </div>

    <div style="clear: both"></div>
    <h3 class="pay-title mt15">Thông tin khách hàng</h3>
    <div class="lists lists-info">
        <div class="item item-2">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Họ tên của bạn" value="{{ get_data_user('web','name') }}">
            </div>
        </div>
        <div class="item item-2">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email của bạn" value="{{ get_data_user('web','email') }}">
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
<div class="modal fade" id="guideModal" role="dialog">

</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.popup-guide').on('click', function() {
        let c_type = $(this).attr('data-type');
        $.ajax({
            url: "{{ route('get_user.popupGuide') }}",
            type: "post",
            dataType: "text",
            data: {
                c_type: c_type
            },
            success: function(result) {
                $('#guideModal').html(result);
            },
            error: function(result) {}
        });
    });
    // 
</script>