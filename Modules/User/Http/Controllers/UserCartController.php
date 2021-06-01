<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\Models\Bill;
use Carbon\Carbon;
use PDF;

class UserCartController extends Controller
{
    public function index()
    {
        \SEOMeta::setTitle('Giỏ hàng');
        $listCarts = \Cart::content();

        if ($listCarts->isEmpty()) return redirect()->to('/');

        return view('user::pages.cart.index', compact('listCarts'));
    }
    public function deletecart($id)
    {
        \Cart::remove($id);
        return redirect()->route('get_user.cart');
    }
    public function generatePDF()
    {
        $listCarts = \Cart::content();
        $data = [
            'date' => date('m/d/Y'),
            'listCarts' => $listCarts
        ];
        return view('user::pages.pay.myPDF', $data);
    }
    public function viewPDF(Request $request)
    {
        $configuration = Configuration::first();
        $paid_total = str_replace(" đ", "", str_replace(".", "", $request->method_paid));
        $total_no_vat = round($paid_total / 1.1, 2);
        $vat_total = $paid_total - $total_no_vat;
        $data_bill = [
            'method_invoice' => $request->method_invoice,
            'method_course' => $request->method_course,
            'method_pay' => $request->method_pay,
            'method_paid' => $request->method_paid,
            'method_email' => $request->method_email,
            'method_customer' => $request->method_customer,
            'method_customer_code' => $request->method_customer_code,
            'method_company' => $request->method_company,
            'method_address' => $request->method_address,
            'group_buy' => $request->group_buy,
            'paid_total' => $paid_total,
            'total_no_vat' => $total_no_vat,
            'vat_total' => $vat_total,
            'invoice_date' => Carbon::now(),
            'configuration' => $configuration
        ];
        return view('user::pages.pay.viewPDF', $data_bill);
    }

    public function downPDF(Request $request)
    {
        $configuration = Configuration::first();
        $bills = Bill::where('method_invoice', $request->method_invoice)->first();
        if(!$bills){
            $paid_total = str_replace(" đ", "", str_replace(".", "", $request->method_paid));
            $total_no_vat = round($paid_total / 1.1, 2);
            $vat_total = $paid_total - $total_no_vat;
            $data_bill = [
                'method_invoice' => $request->method_invoice,
                'method_course' => $request->method_course,
                'method_pay' => $request->method_pay,
                'method_paid' => $request->method_paid,
                'method_email' => $request->method_email,
                'method_customer' => $request->method_customer,
                'method_address' => $request->method_address,
                'method_customer_code' => $request->method_customer_code,
                'method_company' => $request->method_company,
                'group_buy' => $request->group_buy,
                'paid_total' => $paid_total,
                'total_no_vat' => $total_no_vat,
                'vat_total' => $vat_total,
                'created_at' => Carbon::now(),
                'configuration' => $configuration
            ];
            $idBill  = Bill::insertGetId($data_bill);
            \Cart::destroy();
            if ($idBill) {
                $pdf = PDF::loadView('user::pages.pay.downPDF', $data_bill);
                return $pdf->download('hoa-don.pdf');
            }
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
        return redirect()->to('/');
            
    }
}
