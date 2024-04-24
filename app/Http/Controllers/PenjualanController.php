<?php

namespace App\Http\Controllers;

use App\Exports\PenjualanExport;
use App\Models\Penjualan;
use App\Http\Controllers\Controller;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;
use Excel;



class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = Carbon::now();
        $detail = DetailPenjualan::all();
        $penjualan = Penjualan::all();
        $data = [];
        foreach ($penjualan as $jual) {
            $pelanggan = Pelanggan::find($jual->pelanggan_id);
            $data[] = ['penjualan' => $jual, 'pelanggan' => $pelanggan,];
        }
        return view('pages.penjualan.index', compact('data', 'date', 'detail'));
    }

    public function exportExcel()
    {
        // $file_name membuat nama file yang akan terdownload
        // selain .xlsx juga bisa .csv
        $file_name = 'data_keseluruhan_penjulan.xlsx';
        // memanggil file PenjualanExport dan mendonloadnya dengan nama seperti $file_name
        return Excel::download(new PenjualanExport, $file_name);
    }

    public function exportPDF($id)
    {
        $date = Carbon::now();
        $penjualan = Penjualan::find($id);
        $detail = DetailPenjualan::where('penjualan_id', $id)->get();
        $totalPrice = $detail->sum('sub.total');
        $totalKembalian = $detail->sum('sub.kembalian');
        $totalPembayaran = $detail->sum('sub.pembayaran');
        $pdf = PDF::loadview('pages.penjualan.penjualan-pdf', ['detail' => $detail, 'penjualan' => $penjualan, 'date' => $date, 'totalPrice' => $totalPrice]);
        return $pdf->download('data-penjualan.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sell = Produk::get();
        return view('pages.penjualan.create', compact('sell'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { // Validasi data penjualan
    $request->validate([
        'produk_id' => 'required|array',
        'amount' => 'required|array',
        // Tambahkan validasi lain sesuai kebutuhan
    ]);

    // Simpan data penjualan
    $pelanggan = new Pelanggan();
    $pelanggan->name = $request->input('name');
    $pelanggan->address = $request->input('address');
    $pelanggan->no_telp = $request->input('no_telp');
    $pelanggan->save();

    $totalprice = 0;
    $return = 0;
    $payment = 0;
    $kasir = User::where('role', 'Kasir')->first();
    // Setelah menyimpan pelanggan, Anda dapat menggunakan ID pelanggan untuk menyimpan penjualan
    $penjualan = new Penjualan(); 
    $penjualan->sale_date = now(); // Tanggal penjualan saat ini
    $penjualan->price_amount = 0; // Nilai awal total harga
    $penjualan->pelanggan_id = $pelanggan->id; // Atur PelangganID di sini
    $penjualan->total_price = $totalprice;
    $penjualan->return = $return;
    $penjualan->payment = $payment;
    $penjualan->user_id = $kasir->id;
    $penjualan->save();

    // Simpan id pelanggan ke dalam penjualan
    $penjualan->pelanggan_id = $pelanggan->id;

    // Simpan data detail penjualan
    foreach ($request->input('produk_id') as $key => $produkId)
    {
        $detailPenjualan = new DetailPenjualan();
        $detailPenjualan->penjualan_id = $penjualan->id;
        // Atur PenjualanID di sini
        $detailPenjualan->produk_id = $produkId;
        $detailPenjualan->amount = $request->input('amount.' . $key);

        // Hitung sub_total berdasarkan harga produk
        $produk = Produk::find($produkId);
        $detailPenjualan->sub_total = $produk->price * $request->input('amount.' . $key);
        $penjualan->price_amount += $detailPenjualan->sub_total;

        // Tambahkan sub_total ke total harga penjualan
        $penjualan->detailPenjualan()->save($detailPenjualan);

        // Simpan detail penjualan ke dalam penjualan
        $produk->stock -= $detailPenjualan->amount;
        $produk->save();
        // Simpan perubahan stok produk
    }

    $penjualan->total_price = $penjualan->price_amount;
    $penjualan->save();
    // Redirect or provide response as needed
    return redirect()->route('invoice.penjualan', ['id' => $penjualan->id]);
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $date = Carbon::now();
        $penjualan = Penjualan::find($id);
        $detail = DetailPenjualan::where('penjualan_id', $id)->with('produk')->get();
        // dd($detail);
        return view('pages.penjualan.detail', compact('penjualan', 'detail', 'date'));
    }   

    public function invoice($id)
    {
        $date = Carbon::now();
        $pelanggan = Pelanggan::find($id);
        $penjualan = Penjualan::find($id);
        $details = DetailPenjualan::where('penjualan_id', $id)->get();
        return view('pages.penjualan.invoice', compact('penjualan', 'details', 'pelanggan', 'date'));
    }

    public function invoiceStore(Request $request, $id)
    {
        $request->validate([
            'payment' => 'required',
            'total_price' => 'required',
        ]);

        $penjualan = Penjualan::find($id);

        if ($request->payment >= $request->total_price) {
            $return = $request->payment - $request->total_price;
        } else {
             return redirect()->route('penjualan.index')->with('Error', 'Saldo Anda Kurang!');
        }

        $penjualan->update([
        'payment' => $request->payment,
        'return' => $return,
        'total_price' => $request->total_price,
    ]);

    return redirect()->route('penjualan.index')->with('Success', "Pembayran Telah Berhasil!");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $penjualan->detailPenjualan()->delete();

        $pelanggan = Pelanggan::findOrFail($penjualan->pelanggan_id);
        $pelanggan->delete();

        $penjualan->delete();

        return redirect()->back()->with('Success', 'Berhasil Menghapus Data Penjualan!');
    }
}