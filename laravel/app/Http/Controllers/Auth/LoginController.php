<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Siireuser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use Inertia\Inertia;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:siireuser')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Inertia\Response
     */
    public function showLoginForm()
    {
        return Inertia::render('Login');
    }

    protected function guard()
    {
        return Auth::guard('siireuser');
    }

    public function logout(Request $request)
    {
        Auth::guard('siireuser')->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }


    // auth認証カラムをemail→siireuser_idに上書きする
    public function username()
    {
        return 'siireuser_id';
    }

    // auth認証カラムをpassword→user_passwdに上書きする処理
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'siireuser_passwd' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'siireuser_passwd');
    }

    protected function attemptLogin(Request $request)
    {
        try {
            Log::debug($request->siireuser_id . 'がログインリクエスト');
            $siireuser = Siireuser::where('siireuser_id', $request->siireuser_id)
                ->where(DB::raw('md5(siireuser_passwd)'), $request->siireuser_passwd)
                ->first();
            if (!isset($siireuser)) {
                Log::info($request->siireuser_id . 'さんがログイン失敗(データ不一致)');
                return false;
            } else {
                //仕入れ先名をセッションに持たせる処理
                session()->put('display-name', $siireuser->siireuser_last_name);
            }
            Auth::login($siireuser);
            Log::debug($siireuser->siireuser_id . 'が' . $siireuser->siireuser_last_name . 'としてログイン');
            return true;
        } catch (Exception $e) {
            // ID・パスワードの不一致はfalseで返すので、それ以外のエラー
            Log::error($request->siireuser_id . 'さんがログインに失敗(例外エラー)');
            report($e);

            $flash = 'DB・サーバーとの通信に失敗しています。';
            $type = 'alert-danger';

            return redirect()->route('login')->with([
                'flash' => $flash,
                'type' => $type
            ]);
        } finally {
            // nop
        }
    }

    // ログイン後のリダイレクト先
    protected function redirectTo()
    {
        return route('dashboard');
    }
}
