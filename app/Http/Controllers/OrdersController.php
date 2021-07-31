<?php

namespace App\Http\Controllers;

use App\Material;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::orderByDesc('id')->paginate(25);
        $order_materials = [];
        foreach ($orders as $key => $value) {
            $orders[$key]->order = json_decode($value->order);

            $materials = [];
            foreach ($value->order as $v) {
                array_push($materials, Material::find($v->id));
            }
            array_push($order_materials, $materials);
        }

        return view('admin.orders.index', [
            'orders'    => $orders,
            'materials' => $order_materials
        ]);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        if (!empty($order)) {
            $order->order = json_decode($order->order);
            $materials = [];
            foreach ($order->order as $v) {
                array_push($materials, Material::find($v->id));
            }

            return view('admin.orders.edit', [
                'order'     => $order,
                'materials' => $materials
            ]);
        } else {
            return redirect()->route('AdminOrders');
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $order->update($request->all());

        return view('admin.orders.edit', [
            'order'  => $order,
            'success'   => true
        ]);
    }

    public function delete($id)
    {
        $order = Order::find($id);
        if (!empty($order)) {
            $order->order = json_decode($order->order);
            $materials = [];
            foreach ($order->order as $v) {
                array_push($materials, Material::find($v->id));
            }

            return view('admin.orders.delete', [
                'order' => $order,
                'materials' => $materials
            ]);
        } else {
            return redirect()->route('AdminOrders');
        }
    }

    public function destroy(Request $request, $id)
    {
        $Order = Order::find($id);
        $Order->delete();
        return redirect()->route('AdminOrders');
    }
}
