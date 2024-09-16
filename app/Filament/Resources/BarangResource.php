<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Master Barang')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->options(Category::all()->pluck('nama_kategori', 'id'))
                            ->required()
                            ->live(),
                        Forms\Components\TextInput::make('kode_barang_lama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('merek')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tipe')
                            ->maxLength(255),
                        Forms\Components\Select::make('lokasi_id')
                            ->options(function () {
                                return Lokasi::all()->mapWithKeys(function ($item) {
                                    // Gabungkan nama_lokasi dan departemen
                                    return [$item->id => "{$item->nama_lokasi} | {$item->departemen}"];
                                })->toArray();
                            })
                            ->getOptionLabelUsing(function ($value) {
                                $lokasiDepartemen = Lokasi::find($value);
                                return $lokasiDepartemen ? "{$lokasiDepartemen->nama_lokasi} | {$lokasiDepartemen->departemen}" : null;
                            })
                            ->label('Lokasi')
                            ->required(),
                        Forms\Components\TextInput::make('user')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Tersedia' => 'Tersedia',
                                'Digunakan' => 'Digunakan',
                                'Rusak' => 'Rusak'
                            ])->required()
                    ])->columns(3),

                Section::make('Spesifikasi')
                    ->schema([
                        Forms\Components\TextInput::make('mainboard')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('prosesor')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('memori')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('vga')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sound')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('network')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('keyboard'),
                        Forms\Components\Toggle::make('mouse'),
                        Forms\Components\TextInput::make('os')
                            ->maxLength(255),
                    ])
                    ->columns(3)
                    ->visible(fn(callable $get) => $get('category_id') === '1')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_barang_lama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.nama_kategori')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('merek')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi.nama_lokasi')
                    ->label('Lokasi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi.departemen')
                    ->label('departemen')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mainboard')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('prosesor')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('memori')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('vga')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sound')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('network')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('keyboard')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('mouse')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('os')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('GenerateQr')
                        ->label('GenerateQr')
                        ->action(fn(Collection $records) => static::generateQrCodes($records))
                        ->requiresConfirmation()
                        ->color('primary')
                ]),
            ]);
    }

    protected static function generateQrCodes(Collection $records)
    {
        return redirect()->route('barang.generate', [
            'ids' => $records->pluck('id')->toArray(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
