<?php

namespace App\Filament\Resources\BarangkembaliResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\BarangkembaliResource;
use App\Models\Barang;
use App\Models\SerahTerima;
use App\Models\SerahTerimaDetail;

class ManageBarangkembalis extends ManageRecords
{
    protected static string $resource = BarangkembaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data, string $model = \App\Models\BarangKembali::class): Model {
                    $barangKembali = $model::create($data);

                    $detail = SerahTerimaDetail::find($data['serah_terima_detail_id']);

                    $detail->status = 0;
                    $detail->tanggal_kembali = now();
                    $detail->update();

                    $master_barang = Barang::find($detail->barang_id);
                    $master_barang->lokasi_id = 7;
                    $master_barang->user = "";
                    if ($data['status'] === 'Rusak') {
                        $master_barang->status = "Rusak";
                    } else {
                        $master_barang->status = "Tersedia";
                    }
                    $master_barang->update();

                    $serah_by_id = SerahTerimaDetail::where('serah_id', $detail->serah_id)->count();
                    $serah = SerahTerimaDetail::where('serah_id', $detail->serah_id)->where('status', 0)->count();
                    $serah_terima = SerahTerima::find($detail->serah_id);
                    if ($serah !== $serah_by_id) {
                        return redirect()->route('serah.index');
                    } else {
                        $serah_terima->tanggal_kembali = now();
                        $serah_terima->status = "Seluruh Barang Sudah Dikembalikan";
                        $serah_terima->update();
                    }

                    return $barangKembali;
                }),
        ];
    }
}
