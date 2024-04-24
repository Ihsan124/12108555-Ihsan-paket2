<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view("pages.produk.index", compact("produk"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.produk.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
            'product_name' => 'required',
            'price' => 'required',
            'deskripsi' => 'required',

        ]);

        $image = $request->file('picture');
        $imgName = rand() . '.' . $image->extension();
        $path = public_path('assets/img/product/');
        $image->move($path, $imgName);

        Produk::create([
            'picture' => $imgName,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('produk.index')->with('Success', "Data Produk berhasil dibuat!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::where('id', $id)->first();
        return view('pages.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
        ]);

        if (is_null($request->file('picture'))) {
            $imgName = $request->file('picture');
        } else {
            $image = $request->file('picture');
            $imgName = rand() .'.'. $image->extension();
            $path = public_path('/assets/img/product/');
            $image->move($path, $imgName);
        }

        Produk::where('id', '=', $id)->update([
            'picture' => $imgName,
            'product_name' => $request->product_name,
            'price' => $request->price,
        ]);
        return redirect()->route('produk.index')->with('Success', "Data produk berhasil diupdate!");
    }


    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required',
        ]);
        Produk::where('id', '=', $id)->update([
            'stock' => $request->stock,
        ]);
        return redirect()->route('produk.index')->with('Success', "Data Stok berhasil diupdate!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Produk::where('id', $id)->delete();
        return redirect()->route('produk.index')->with('Success', "Data produk berhasil dihapus, namun tidak permanet!");
    }

    public function trash()
    {
        $trash = Produk::onlyTrashed()->get();
        return view('pages.produk.trash', compact('trash'));
    }

    public function restore($id)
    {
        $restore = Produk::onlyTrashed()->where('id', $id);
        $restore->restore();
        return redirect()->route('trash.produk')->with('Success', "Data trash produk berhasil direstore!");
    }

    public function permanent($id)
    {
        $permanent = Produk::onlyTrashed()->where('id', $id);
        $permanent->forceDelete();
        return redirect()->route('trash.produk')->with('Success', "Data trash produk berhasil dihapus permanent!");
    }
}