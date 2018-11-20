<?php
namespace app\Http\Controllers\Web;

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: 36krphplirui
 * Date: 2018/11/19
 * Time: 下午12:21
 */
class AppController extends Controller
{
    public function getApp()
    {
        return view('app');
    }

    public function getLogin()
    {
        return view('login');
    }
}