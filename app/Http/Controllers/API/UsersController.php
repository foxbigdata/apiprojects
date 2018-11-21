<?php
/**
 * Created by PhpStorm.
 * User: 36krphplirui
 * Date: 2018/11/21
 * Time: 下午6:36
 */

namespace app\Http\Controllers\API;


use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function getUser()
    {
        return Auth::guard('api')->user();
    }
}