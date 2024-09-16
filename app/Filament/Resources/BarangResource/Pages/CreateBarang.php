<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use App\Models\Barang;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kategori = $data['category_id'];
        $kategori_final = Category::where('id', $kategori)->latest()->first();
        $barang = Barang::where('category_id', $kategori)->latest()->first();
        $tahun = date('Y');
        $sub_tahun = substr($tahun, 2);

        if ($barang) {
            $kode_barang = $barang->kode_barang;
            $exp_kode_barang = explode('/', $kode_barang);
            if ($sub_tahun == $exp_kode_barang[1]) {
                $kode_barang_akhir1 = substr($exp_kode_barang[0], 3);
                $kode_barang_final = (int) $kode_barang_akhir1 + 1;
                $data['kode_barang'] = $kategori_final->kode_kategori . '-' . tambah_nol_didepan($kode_barang_final, 3) . '/' . $exp_kode_barang[1];
            } else {
                $data['kode_barang'] =  $kategori_final->kode_kategori . '-' . '001' . '/' . $sub_tahun;
            }
        } else {
            $data['kode_barang'] =  $kategori_final->kode_kategori . '-' . '001' . '/' . $sub_tahun;
        }

        return $data;
    }
}
