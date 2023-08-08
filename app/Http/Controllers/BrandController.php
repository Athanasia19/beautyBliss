<?php


namespace App\Http\Controllers;


use App\Models\Brand;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brand.index', compact('brands'));
    }


    public function create()
    {
        return view('brand.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);


        Brand::create($validatedData);


        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
    }


    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.show', compact('brand'));
    }


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.edit', compact('brand'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $id,
        ]);


        $brand = Brand::findOrFail($id);


        $brand->update($validatedData);


        return redirect()->route('brand.index')->with('success', 'Brand updated successfully.');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();


        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully.');
    }
}