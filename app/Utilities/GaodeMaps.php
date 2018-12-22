<?php

namespace App\Utilities;

use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: 36krphplirui
 * Date: 2018/12/11
 * Time: 下午7:53
 */
class GaodeMaps
{

    public static function geocodeAddress($address,$city,$state){
        //省市区详细地址
        $address = urlencode($state.$city.$address);
        //web服务的api key
        $apiKey = config('services.gaode.ws_api_key');
        $url = 'https://restapi.amap.com/v3/geocode/geo?address=' . $address . '&key=' . $apiKey;
        //创建Guzzle HTTP客户端发起需求
        $client = new Client();
        //发起请求并获取相应数据
        $geocodeResponse = $client->get($url)->getBody();
        $geocodeData = json_decode($geocodeResponse);
       //echo $geocodeResponse;

        //初始化地理编码位置
        $coordinates['lat'] = null;
        $coordinates['lng'] = null;
        //如果相应数据不为空则解析出经纬度
        if(!empty($geocodeData)
            && $geocodeData->status
            && isset($geocodeData->geocodes) && isset($geocodeData->geocodes[0])){
            //echo "1111111";
            list($latitude,$longitude) = explode(',',$geocodeData->geocodes[0]->location);
            $coordinates['lat'] = $latitude; //经度
            $coordinates['lng'] = $longitude; //纬度
        }
        return $coordinates;
    }
}