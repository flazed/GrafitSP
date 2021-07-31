<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Product::pluck('photos');

        foreach ($photos as $key => $value) {
            $photos[$key] = json_decode($value);
        }

        return view('admin.products.index', [
            'products' => DB::table('products')->paginate(25),
            'photos'   => $photos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $photos = json_decode($product->photos);

        if(!empty($product)) {
            return view('admin.products.show', [
                'product'   => $product,
                'photos'    => $photos
            ]);
        } else {
            return redirect()->route('AdminProducts');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if(!empty($product)) {
            $photos = json_decode($product->photos);

            return view('admin.products.edit', [
                'product' => $product,
                'photos'    => $photos
            ]);
        } else {
            return redirect()->route('AdminProducts');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $photos = json_decode($product->photos);

        try {
            $photos_count = count($request->file('photo'));
        } catch (\Throwable $th) {
            $photos_count = 0;
        }

        $request->validate([
            'title'         => 'required|string|min:5|max:64',
            'description'   => 'required|string|min:5',
            'photo.*'       => 'nullable|mimes:jpeg,jpg,png,gif'
        ]);

        if($photos_count) {
            foreach ($photos as $key => $value) {
                unlink(public_path('/assets/static/img/products/').$value);
            }

            $new_photos = [];
            foreach ($request->file('photo') as $key => $value) {
                $photo = $request->file('photo')[$key];
                $photo_url = time()."$key.".$photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/static/img/products'), $photo_url);
                array_push($new_photos, $photo_url);
            }

            $request->merge(['photos' => json_encode($new_photos)]);
        }

        $product->update($request->all());

        return view('admin.products.edit', [
            'product' => $product,
            'success' => true
        ]);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if(!empty($product)) {
            return view('admin.products.delete', [
                'product' => $product
            ]);
        } else {
            return redirect()->route('AdminProducts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $photos = json_decode($product->photos);

        foreach ($photos as $key => $value) {
            unlink(public_path('/assets/static/img/products/').$value);
        }

        $product->delete();
        return redirect()->route('AdminProducts');
    }
}
