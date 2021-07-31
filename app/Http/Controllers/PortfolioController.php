<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.portfolio.index', [
            'portfolio' => DB::table('portfolios')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);
        if(!empty($portfolio)) {
            return view('admin.portfolio.show', [
                'portfolio' => $portfolio
            ]);
        } else {
            return redirect()->route('AdminPortfolio');
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
        $portfolio = Portfolio::find($id);
        if(!empty($portfolio)) {
            return view('admin.portfolio.edit', [
                'portfolio' => $portfolio
            ]);
        } else {
            return redirect()->route('AdminPortfolio');
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
        $portfolio = Portfolio::find($id);
        $request->validate([
            'title'         => 'required|string|min:5|max:64',
            'description'   => 'required|string|min:5|max:255',
            'photo'         => 'nullable|mimes:jpeg,jpg,png,gif'
        ]);

        if(!empty($request->photo)) {
            unlink(public_path('/assets/static/img/portfolio/').$portfolio->photo_url);

            $photo = $request->file('photo');
            $photo_url = time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('/assets/static/img/portfolio'), $photo_url);

            $request->merge(['photo_url' => $photo_url]);
        }

        $portfolio->update($request->all());

        return view('admin.portfolio.edit', [
            'portfolio' => $portfolio,
            'success' => true
        ]);
    }

    public function delete($id)
    {
        $portfolio = Portfolio::find($id);
        if(!empty($portfolio)) {
            return view('admin.portfolio.delete', [
                'portfolio' => $portfolio
            ]);
        } else {
            return redirect()->route('AdminPortfolio');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);
        unlink(public_path('/assets/static/img/portfolio/').$portfolio->photo_url);
        $portfolio->delete();
        return redirect()->route('AdminPortfolio');
    }
}
