<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use App\Portfolio;
use Illuminate\Support\Facades\DB;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.materials.index', [
            'materials' => DB::table('materials')->paginate(25),
            'dpi'       => DB::table('print_dpi')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.materials.create', [
            'dpi' => DB::table('print_dpi')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'print_dpi_id'  => 'required|exists:print_dpi,id',
            'm10'           => 'required|integer|min:1',
            'm50'           => 'required|integer|min:1',
            'm200'          => 'required|integer|min:1',
            'm200plus'      => 'required|integer|min:1'
        ], [
            'print_dpi_id.exists' => 'ID данной категории отсутствует'
        ]);

        Material::create($request->all());

        return view('admin.materials.create', [
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        if(!empty($material)) {
            return view('admin.materials.show', [
                'material' => $material,
                'category' => DB::table('print_dpi')->where('id', $material->print_dpi_id)->first()
            ]);
        } else {
            return redirect()->route('AdminMaterials');
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
        $material = Material::find($id);
        if(!empty($material)) {
            return view('admin.materials.edit', [
                'material' => $material,
                'dpi'      => DB::table('print_dpi')->get()
            ]);
        } else {
            return redirect()->route('AdminMaterials');
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
        $material = Material::find($id);

        $request->validate([
            'name'          => 'required',
            'print_dpi_id'  => 'required|exists:print_dpi,id',
            'm10'           => 'required|integer|min:1',
            'm50'           => 'required|integer|min:1',
            'm200'          => 'required|integer|min:1',
            'm200plus'      => 'required|integer|min:1'
        ], [
            'print_dpi_id.exists' => 'ID данной категории отсутствует'
        ]);

        $material->update($request->all());

        return view('admin.materials.edit', [
            'material'  => $material,
            'success'   => true
        ]);
    }

    public function delete($id)
    {
        $material = Material::find($id);

        if(!empty($material)) {
            return view('admin.materials.delete', [
                'material' => $material
            ]);
        } else {
            return redirect()->route('AdminMaterials');
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
        Material::find($id)->delete();
        return redirect()->route('AdminMaterials');
    }
}
