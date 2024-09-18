<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use App\Models\Lokasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SerahTerima;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SerahTerimaResource\Pages;
use App\Filament\Resources\SerahTerimaResource\RelationManagers;

class SerahTerimaResource extends Resource
{
    protected static ?string $model = SerahTerima::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Serah';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Order Detail')
                        ->schema([
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
                                ->required(),
                            Forms\Components\DatePicker::make('tanggal_serah')
                                ->required()
                        ])->columns(2),
                    Step::make('Order Items')
                        ->schema([
                            Repeater::make('barang')
                                ->schema([
                                    Forms\Components\Select::make('barang_id')
                                        ->options(function () {
                                            return Barang::where('status', 'Tersedia')->get()->mapWithKeys(function ($item) {
                                                // Gabungkan nama_lokasi dan departemen
                                                return [$item->id => "{$item->kode_barang} | {$item->tipe} | {$item->merek}"];
                                            })->toArray();
                                        })
                                        ->getOptionLabelUsing(function ($value) {
                                            $barang = Barang::find($value);
                                            return $barang ? "{$barang->kode_barang} | {$barang->tipe} | {$barang->merek}" : null;
                                        })
                                        ->label('Lokasi')
                                        ->required(),
                                ])

                        ])
                ])->submitAction(new HtmlString('<button type="submit">Submit</button>'))->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_serah')->searchable(),
                Tables\Columns\TextColumn::make('user')->searchable(),
                Tables\Columns\TextColumn::make('lokasi.nama_lokasi')->label('Lokasi')->searchable(),
                Tables\Columns\TextColumn::make('lokasi.departemen')->label('departemen')->searchable(),
                Tables\Columns\TextColumn::make('jumlah_barang'),
                Tables\Columns\TextColumn::make('tanggal_serah'),
                Tables\Columns\TextColumn::make('tanggal_kembali'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('Surat Jalan')
                        ->icon('heroicon-o-document')
                        ->url(fn(Model $record): string => route('serah.cetak', ['id' => $record]))
                        ->openUrlInNewTab(),
                ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSerahTerimas::route('/'),
            'create' => Pages\CreateSerahTerima::route('/create'),
            'edit' => Pages\EditSerahTerima::route('/{record}/edit'),
        ];
    }
}
