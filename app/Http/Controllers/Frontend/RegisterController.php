<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail as FacadesMail;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        if ($request->ajax())
        {
            $code =  200;
            try{
                $data               = $request->except('_token','remember','code_verication');
               
                $data['created_at'] = Carbon::now();
                $data['password'] = bcrypt($request->password);
                $data['provider'] = 'register';
                $data['avatar_social'] = '';
                $data['provider_id']  = 0;
                $data['code_verication']  = Str::random(40);       
                $user = User::insertGetId($data);              
                if($user){
                    Mail::to($data['email'])->send(new EmailVerificationMail($data));
                    $success ="Xác nhận Email của bạn để hoàn tất đăng ký!";
                    return $success;
                }
            }catch (\Exception $exception)
            {
                $code = 501;
                Log::error("[Register]: ". $exception->getMessage());
            }
            return response()->json([
                'code'     => $code,
            ]);
        }
                
    }
    public function showEmailSuccess($message = 'Xác nhận Email thành công')
    {
        return \Session::flash('toastr',[
            'type' => 'success',
            'message' => $message
        ]);
    }
    public function showEmailError($message = 'Email chưa được xác nhận')
    {
        return \Session::flash('toastr',[
            'type' => 'error',
            'message' => $message
        ]);
    }
    public function verify_email($code_verication){
        $user = User::where('code_verication', $code_verication)->first();
        if(!$user){
            $this->showEmailError();
            return redirect()->route('get.home');
        }else{
            if($user->email_verified_at){
                $this->showEmailSuccess();
                return redirect()->route('get.home');
            }else{
                $user->update([
                    'email_verified_at'=>\Carbon\Carbon::now()
                ]);
                $this->showEmailSuccess();
                return redirect()->route('get.home');
            }
        }
    }
    public function logout()
    {
        \Auth::logout();
        return redirect()->route('get.home');
    }
}
