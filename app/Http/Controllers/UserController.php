<?php

namespace App\Http\Controllers;

use App\Material;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orders()
    {
        $orders = Order::where('mail', Auth::user()->email)->paginate(25);
        $order_materials = [];
        foreach ($orders as $key => $value) {
            $orders[$key]->order = json_decode($value->order);

            $materials = [];
            foreach ($value->order as $v) {
                array_push($materials, Material::find($v->id));
            }
            array_push($order_materials, $materials);
        }

        return view('user.orders', [
            'materials'   => $order_materials,
            'orders'      => $orders
        ]);
    }
}
