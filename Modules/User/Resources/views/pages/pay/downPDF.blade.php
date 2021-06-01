<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Xuất đơn hàng</title>
    <style>
        body {
font-family: DejaVu Sans;
font-size: 12px;
}
         .col-item-c p {
             font-weight: bold;
             text-transform: uppercase;
         }
     
         .col-item-c p>span {
             font-weight: 100;
             text-transform: none;
         }
         .modal-dialog {
             width: 100%;
             margin: auto;
         }
     
         .modal-content {
             padding: 20px;
             background: #f2f2f2;
         }
     
         .header-modal {
             width: 100%;
 display: inline-block;
 height: 250px;
         }
     p.title-orr{
         text-transform: uppercase;
         margin-bottom: 15px;
         font-size: 20px;
         text-align: center;
         color: cornflowerblue;
         margin-top: 0;
     }
         .logo {
             display: inline-block;
             max-width: 250px;
             width: 100%;
             float: left;
         }
     
         .info-adsmo {
             max-width: 500px;
             width: 100%;
 display: inline-block;
 float: right;
         }
     
         .info-adsmo p {
             text-align: right;
         }
     
         .info-adsmo p:first-child {
             font-weight: bold;
             text-transform: uppercase
         }
     
         .name_invoice {
             background: #e4e4e4;
             padding: 10px 10px;
             margin-bottom: 10px;
         }
         .invoice_content table{
             background: #e4e4e4;
             width: 100%;
         }
         .invoice_content table tr td{
             padding: 10px;
         }
         .invoice_content table tr{
             border-bottom: 1px solid #f2f2f2;
         }
         .invoice_content table tr:last-child{
             border-bottom: none;
         }
         span.title-cc{
             font-weight: bold;
             color: rgb(135, 28, 28)
         }
     </style>
</head>

<body>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="header-modal">
                        <div class="logo">
                            <img width="200px" alt="ADSMO Giải Pháp Digital Marketing Tổng Thể ĐỘT PHÁ Traffic" itemprop="logo" src="https://adsmo.vn/wp-content/uploads/2020/08/cropped-ADSMO-Giai-Phap-Digital-Marketing-Tong-The-DOT-PHA-Traffic-1.png">
                        </div>
                        <div class="info-adsmo">
                            <p>{{ $configuration->name }}</p>
                            <p>{{ $configuration->address }}</p>
                            <p>Hotline: {{ $configuration->hotline }}</p>
                            <p>Email: {{ $configuration->email }}</p>
                            <p>Đường dây nóng khiếu nại dịch vụ: {{ $configuration->hotline_rp }}</p>
                            <p>Tax ID: {{ $configuration->tax_id }}</p>
                        </div>
                    </div>
                </div>
        
                <div class="modal-body">
                    <p class="text-center text-success title-orr">Thông tin hóa đơn</p>
                    <div class="name_invoice">
                        <p><span class="title-cc">Mã hóa đơn:</span> {{ $method_invoice }}</p>
                        <p><span class="title-cc">Ngày lập hóa đơn:</span> {{ $created_at }}</p>
                        <p><span class="title-cc">Tên khách hàng:</span> {{ $method_customer }}</p>
                        <p><span class="title-cc">Địa chỉ khách hàng:</span> {{ $method_address }}</p>
                    @if ($group_buy == 1)
                        <p><span class="title-cc">Tên Công Ty:</span> {{ $method_company }}</p>
                        <p><span class="title-cc">Mã số thuế:</span> {{ $method_customer_code }}</p>
                    @else
                        
                    @endif
                    </div>
                    <div class="invoice_content">
                        <table>
                            <tr>
                                <td>Nội dung</td>
                                <td>Tổng tiền</td>
                            </tr>
                            @if ($group_buy == 0)
                            <tr>
                                <td>{{ $method_course }}</td>
                                <td>{{ $method_paid }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $method_course }}</td>
                                <td><?php echo number_format(round($total_no_vat,2),2,',','.'); ?> đ</td>
                            </tr>
                            <tr>
                                <td>Tổng tiền ( Chưa VAT 10% )</td>
                                <td><?php echo number_format(round($total_no_vat,2),2,',','.'); ?> đ</td>
                            </tr>
                            <tr>
                                <td>10.00% VAT</td>
                                <td><?php echo number_format(round($vat_total,2),2,',','.'); ?> đ</td>
                            </tr>
                            <tr>
                                <td>Tổng tiền phải thanh toán</td>
                                <td><?php echo $method_paid; ?></td>
                            </tr>
                            @endif           
                        </table>
                        <br>
                        <p class="text-center text-success title-orr">Giao dịch</p>
                        <table>
                            <tr>
                                <td>Phương thức thanh toán</td>
                                <td><?php echo $method_pay; ?></td>
                            </tr>        
                            <tr>
                                <td>Tổng tiền phải thanh toán</td>
                                <td><?php echo $method_paid; ?></td>
                            </tr>        
                        </table>
                    </div>
                </div>
            
            </div>
        </div>

</body>
</html>