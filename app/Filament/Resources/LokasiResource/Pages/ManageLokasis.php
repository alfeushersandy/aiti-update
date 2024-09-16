<?php

namespace App\Filament\Resources\LokasiResource\Pages;

use Filament\Actions;
use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\LokasiResource;
use Filament\Resources\Pages\ManageRecords;

class ManageLokasis extends ManageRecords
{
    protected static string $resource = LokasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data) {
                    foreach ($data['departemen'] as $departemen) {
                        Lokasi::create([
                            'nama_lokasi' => $data['nama_lokasi'],
                            'departemen' => $departemen
                        ]);
                    }
                }),
        ];
    }
}
