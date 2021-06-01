
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hướng dẫn thanh toán: {{ $guide_bank['name'] }} </h4>
            </div>
            <div class="modal-body">
                <p> <span class="font-weight-bold text-success">Ngân hàng:</span> {{ $guide_bank['bank'] }}</p>
                <p> <span class="font-weight-bold text-success">Tài khoản:</span> {{ $guide_bank['account'] }}</p>
                <p> <span class="font-weight-bold text-success">Chi nhánh:</span> {{ $guide_bank['address'] }}</p>
                <p> <span class="font-weight-bold text-success">Nội dung chuyển khoản:</span> Tên khóa học + số điện thoại</p>
                <p class="font-weight-bold text-danger"> Mọi thắc mắc hãy liên hệ cho chúng tôi qua: </p>
                <p> <span class="font-weight-bold text-primary">Hotline:</span> {{ $guide_bank['hotline'] }} </p>
                <p> <span class="font-weight-bold text-primary">Email:</span> {{ $guide_bank['email'] }} </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-closepopup" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
