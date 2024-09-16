<?php

namespace App\Filament\Resources\SerahTerimaResource\Pages;

use App\Filament\Resources\SerahTerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSerahTerima extends EditRecord
{
    protected static string $resource = SerahTerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
