<?php

namespace Modules\User\Http\Controllers;

use App\Models\Cart\Order;
use App\Models\Cart\Transaction;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail as FacadesMail;

class UserPayController extends UserController
{
    public function getPay(Request $request)
    {
        \SEOMeta::setTitle('Thanh toán');
        $listCarts = \Cart::content();
        if ($listCarts->isEmpty()) return redirect()->to('/');
        $viewData = [
            'listCarts' => $listCarts
        ];
        return view('user::pages.pay.index', $viewData);
    }
    public function getPaySuccsess()
    {
    
        \SEOMeta::setTitle('Thanh toán');
        $listCarts = \Cart::content();
       
        $_SESSION['data_cart']=$listCarts;
        if($listCarts){
            $viewData = [
                'listCarts' => $listCarts
            ];
            
        } else {
            $viewData = [
                'data_cart' => $_SESSION
            ];
        }


    
        
        return view('user::pages.pay.succsess', $viewData);
    }

    public function popupGuide(Request $request)
    {
        $c_type = $request->c_type;
        $data = config('cart.pay_type');
        $guide_bank = $data[$c_type];
        $html = view('user::pages.pay.popup_guide', compact('guide_bank'))->render();
        return $html;
    }

    public function processPayCart(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                't_user_id' => get_data_user('web'),
                't_total_money' => \Cart::subtotal(0, 0, ''),
                't_type_pay' => $request->type ? $request->type : 1,
                'created_at' => Carbon::now()
            ];
            $idTransaction = Transaction::insertGetId($data);
            if ($idTransaction) {
                $listCart = \Cart::content();
                foreach ($listCart as $item) {
                    Order::insert([
                        'o_transaction_id' => $idTransaction,
                        'o_action_id' => $item->id,
                        'o_user_id' => get_data_user('web'),
                        'o_sale' => 0,
                        'o_price' => $item->price,
                        'o_status' => 1
                    ]);
                }
            }

            return response([
                'status' => 200,
            ]);
        }

        return redirect()->to('/');
    }
}
