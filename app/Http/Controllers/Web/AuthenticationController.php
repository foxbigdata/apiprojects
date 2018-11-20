<?php
/**
 * Created by PhpStorm.
 * User: 36krphplirui
 * Date: 2018/11/19
 * Time: 下午2:26
 */

namespace app\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{

    public function getSocialRedirect($account)
    {
        try{
            return Socialite::with($account)->redirect();
        }catch (\InvalidArgumentException $exception){
            return redirect('/login');
        }
    }

    public function getSocialCallback($account)
    {
        $socialUser = Socialite::with($account)->user();
        $user = User::where('provider_id','=',$socialUser->id)
            ->where('provider','=',$account)
            ->first();
        if ($user == null) {
            // 如果该用户不存在则将其保存到 users 表
            $newUser = new User();
            $newUser->name        = $socialUser->getName()." ";;
            $newUser->email       = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar      = $socialUser->getAvatar();
            $newUser->password    = '';
            $newUser->provider    = $account;
            $newUser->provider_id = $socialUser->getId();
            $newUser->save();
            $user = $newUser;
        }
        // 手动登录该用户
        Auth::login( $user );
        // 登录成功后将用户重定向到首页
        return redirect('/');
    }
}