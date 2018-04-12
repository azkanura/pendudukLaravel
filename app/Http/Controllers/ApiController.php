<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use \GuzzleHttp\Client;

class ApiController extends Controller
{
    
    public function getDataPenduduk($nik)
    {
        $client = new Client();
        $headers =['Accept'=>'application/json','Content-Type'=>'application/json'];
        $body = ['NIK'=>$nik,'user_id'=>'testpseribu','password'=>'Tapem','ip_users'=>'156.67.215.149'];
        $url='http://uptik.or.id:8580/dukcapil/get_json/tapemseribu/get_nik';
        $res = $client->request('POST', $url,$headers,$body);
		return $res->getStatusCode();
    }
}