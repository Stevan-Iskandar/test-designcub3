<?php

namespace App\Http\Controllers;

use App\Models\RegProvince;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Web\Library\Utility;

class MainController extends Controller
{
    protected $UTIL;
    var $region = ['province', 'regency', 'district', 'village'];

    public function __construct()
    {
        $this->UTIL = new Utility;
    }

    public function index()
    {
        $data['title']      = 'Designcub3';
        $data['region']     = $this->region;
        $data['provinces']  = RegProvince::get();

        return view('main', $data);
    }

    public function getRegion($region, $id)
    {
        $modelName  = ucfirst($this->region[$region + 1]);
        $model      = "App\\Models\\Reg$modelName";
        $model      = new $model;
        $data       = $model->where("{$this->region[$region]}_id", $id)->get();

        $response       = [
            'status'    => 401,
            'message'   => "$modelName not found",
        ];

        if (!$data)
        return response()->json($response, $response['status']);

        $response = [
            'status'    => 200,
            'message'   => 'Success',
            'data'      => $data,
        ];

        return response()->json($response, $response['status']);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|min:10|email',
        ]);

        Subscription::create([
            'email' => $request->email,
            'ip'    => $this->UTIL->getIp(),
        ]);

        $response = [
            'status'    => 200,
            'message'   => 'Subscribed',
        ];

        return response()->json($response, $response['status']);
    }
}
