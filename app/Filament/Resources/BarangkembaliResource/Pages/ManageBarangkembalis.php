<?php

namespace App\Filament\Resources\BarangkembaliResource\Pages;

use App\Filament\Resources\BarangkembaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBarangkembalis extends ManageRecords
{
    protected static string $resource = BarangkembaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
