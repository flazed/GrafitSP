<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Portfolio;
use App\Material;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function addPortfolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|min:5|max:64',
            'description'   => 'required|string|min:5|max:255',
            'photo'         => 'required|mimes:jpeg,jpg,png,gif'
        ], [
            'photo.required' => 'Необходимо загрузить фотографию'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $photo = $request->file('photo');
        $photo_url = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/assets/static/img/portfolio'), $photo_url);

        $request->merge(['photo_url' => $photo_url]);
        Portfolio::create($request->all());

        return json_encode(['success' => true]);
    }

    public function addProducts(Request $request)
    {
        try {
            $photos_count = count($request->file('photo'));
        } catch (\Throwable $th) {
            $photos_count = 0;
        }

        if ($photos_count) {
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|min:5|max:64',
                'description'   => 'required|string|min:5',
                'photo.*'       => 'required|mimes:jpeg,jpg,png,gif'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|min:5|max:64',
                'description'   => 'required|string|min:5',
                'photo'         => 'required|image|mimes:jpeg,jpg,png,gif',
            ], [
                'photo.required' => 'Необходимо загрузить фотографии'
            ]);
        }

        if ($validator->fails()) {
            return $validator->errors();
        }

        $photos = [];
        foreach ($request->file('photo') as $key => $value) {
            $photo = $request->file('photo')[$key];
            $photo_url = time() . "$key." . $photo->getClientOriginalExtension();
            $photo->move(public_path('/assets/static/img/products'), $photo_url);
            array_push($photos, $photo_url);
        }

        $request->merge(['photos' => json_encode($photos)]);
        Product::create($request->all());

        return json_encode(['success' => true]);
    }

    public function makeOrder(Request $request)
    {
        $data = $request->json()->all();
        $order = array();
        $total = 0;
        foreach ($data['basket'] as $key => $value) {
            $item = Material::find($value['id']);
            $price = 0;

            if ($value['count'] <= 10) {
                $price = $value['count'] * $item['m10'];
            } else if ($value['count'] < 50) {
                $price = $value['count'] * $item['m50'];
            } else if ($value['count'] < 200) {
                $price = $value['count'] * $item['m200'];
            } else {
                $price = $value['count'] * $item['m200plus'];
            }

            $total += $price;

            $order[] = (object) array(
                'id'        => $value['id'],
                'count'     => $value['count'],
                'price'     => $price
            );
        }
        $new_order = Order::create(array(
            'mail'  => $data['email'],
            'order' => json_encode($order),
            'total' => $total
        ));

        Mail::to($data['email'])->send(new MailSend($new_order));

        return json_encode(['id' => $new_order->id]);
    }
}
