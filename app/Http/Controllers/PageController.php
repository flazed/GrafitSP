<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Product;
use App\Mail;
use Cookie;
use File;
use DB;

class PageController extends Controller
{
    // Главная страница
    public function main()
    {
        $clients = File::files(public_path('/assets/static/img/clients'));
        $slider = File::files(public_path('/assets/static/img/slider'));

        return view('pages.main', [
            'clients' => $clients,
            'slider' => $slider
        ]);
    }

    // Странциа "Продукция"
    public function products()
    {
        $products = Product::all();
        $photos = Product::pluck('photos');

        foreach ($photos as $key => $value) {
            $photos[$key] = json_decode($value);
        }

        return view('pages.products', [
            'products' => $products,
            'photos'   => $photos
        ]);
    }

    // Страница "Прайс-Лист"
    public function priceLists()
    {
        $materials = DB::table('materials')->get();
        $print_dpi = DB::table('print_dpi')->get();

        return view('pages.prices', [
            'materials' => $materials,
            'print_dpi' => $print_dpi
        ]);
    }

    // Страница "Порфтолио"
    public function portfolio()
    {
        $portfolio = Portfolio::all();
        return view('pages.portfolio', [
            'portfolio' => $portfolio
        ]);
    }

    // Страница "Конаткты"
    public function contacts()
    {
        Cookie::forget('mail');
        $success = Cookie::get('mail', 0);

        return view('pages.contacts', [
            'success'   => $success
        ])->withCookie($success);
    }

    public function contactsPost(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'message'   => 'required'
        ]);

        Mail::create($request->all());

        return redirect()->route('contacts')->withCookie(Cookie::make('mail', 1, 1440));
    }

    // Страница "Корзина"
    public function basket()
    {
        return view('pages.basket');
    }
}
