<?php

namespace App\Filament\Resources\SerahTerimaResource\Pages;

use App\Filament\Resources\SerahTerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSerahTerimas extends ListRecords
{
    protected static string $resource = SerahTerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
