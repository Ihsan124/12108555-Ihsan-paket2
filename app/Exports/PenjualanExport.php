<?php

namespace App\Exports;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenjualanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetailPenjualan::with( ['produk', 'penjualan', 'penjualan.pelanggan'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'Alamat Pelanggan',
            'No HP Pelanggan',
            'Nama Produk',
            'Harga Produk',
            'Qty',
            'Sub Total',
            'Tangg Pembelian',
            'pembayaran',
            'kembalian',
        ];
    }

    public function map($item): array
    {
        return [
            $item->penjualan->pelanggan->name ?? '',
            $item->penjualan->pelanggan->address ?? '',
            $item->penjualan->pelanggan->no_telp ?? '',
            $item->produk->product_name ?? '',
            $item->produk->price ?? '',
            $item->amount ?? '',
            $item->total ?? '',
            $item->pembayaran ?? '',
            $item->sub_total ?? '',
            \Carbon\Carbon::parse($item->penjualan->sale_date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s') ?? '',
        ];
    }
}
