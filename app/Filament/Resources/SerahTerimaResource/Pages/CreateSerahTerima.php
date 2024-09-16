<?php

namespace App\Filament\Resources\SerahTerimaResource\Pages;

use App\Models\SerahTerimaDetail;
use Filament\Actions;
use Filament\Actions\Concerns\HasWizard;
use Filament\Forms\Form;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\SerahTerimaResource;
use App\Models\Barang;
use App\Models\SerahTerima;
use Illuminate\Database\Eloquent\Model;

class CreateSerahTerima extends CreateRecord
{
    use HasWizard;
    protected static string $resource = SerahTerimaResource::class;

    public function getFormActions(): array
    {
        // Kosongkan array untuk menghilangkan semua tombol
        return [];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tanggal_input'] = now();


        $permintaan = SerahTerima::latest()->first() ?? new SerahTerima();
        $kode_permintaan1 = substr($permintaan->kode_serah, 2);
        $kode_permintaan = (int) $kode_permintaan1 + 1;
        $data['kode_serah'] = 'PM' . tambah_nol_didepan($kode_permintaan, 3);

        $data['status'] = 'Submitted';

        $data['jumlah'] = count($data['barang']);

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // simpan data utama
        $serah = SerahTerima::create([
            'tanggal_input' => $data['tanggal_input'],
            'kode_serah' => $data['kode_serah'],
            'user' => $data['user'],
            'lokasi_id' => $data['lokasi_id'],
            'jumlah_barang' => $data['jumlah'],
            'tanggal_serah' => $data['tanggal_serah'],
            'status' => $data['status']
        ]);

        $barang_id =  array_map(fn($item) => $item['barang_id'], $data['barang']);

        foreach ($barang_id as $barang) {
            $master_barang = Barang::find($barang);
            $serahdetail = new SerahTerimaDetail();
            $serahdetail->serah_id = $serah->id;
            $serahdetail->barang_id = $barang;
            $serahdetail->lokasi_awal_id = $master_barang->lokasi_id;
            $serahdetail->lokasi_tujuan_id = $serah->lokasi_id;
            $serahdetail->tanggal_serah = $serah->tanggal_serah;
            $serahdetail->status = true;
            $serahdetail->save();
        }

        return $serah;
    }
}
