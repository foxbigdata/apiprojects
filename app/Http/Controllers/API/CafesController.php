<?php

namespace  app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: 36krphplirui
 * Date: 2018/11/20
 * Time: 下午3:44
 */
class CafesController extends Controller
{

    public function getCafes()
    {
        $cafes = Cafe::all();
        return response()->json($cafes);
    }

    public function getCafe($id){
        $cafe = Cafe::where('id','=',$id)->first();
        return response()->json($cafe);
    }

    public function postNewCafe(Request $request)
    {
        $cafe = new Cafe();
        $cafe->name = $request->input('name');
        $cafe->address =$request->input('address');
        $cafe->city = $request->input('city');
        $cafe->state =$request->input('state');
        $cafe->zip = $request->input('zip');
        $cafe->latitude='12.12345000';
        $cafe->longitude='98.12345111';
        $cafe->save();
        return response()->json($cafe,201);
    }























}