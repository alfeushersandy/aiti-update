<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Barangkembali;
use Filament\Resources\Resource;
use App\Models\SerahTerimaDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangkembaliResource\Pages;
use App\Filament\Resources\BarangkembaliResource\RelationManagers;

class BarangkembaliResource extends Resource
{
    protected static ?string $model = Barangkembali::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('serah_terima_id')
                    ->label('Kode Serah')
                    ->relationship('serahTerima', 'kode_serah', function ($query) {
                        return $query->where('status', '!=', 'Seluruh Barang Sudah Dikembalikan');
                    })
                    ->reactive(),

                Forms\Components\Select::make('serah_terima_detail_id')
                    ->label('Pilih Barang')
                    ->required()
                    ->options(function (callable $get) {
                        $serahTerimaId = $get('serah_terima_id');
                        if ($serahTerimaId) {
                            // Mengambil barang terkait dengan kode_serah yang dipilih
                            return SerahTerimaDetail::where('serah_id', $serahTerimaId)
                                ->join('barangs', 'serah_terima_details.barang_id', '=', 'barangs.id')
                                ->pluck('barangs.kode_barang', 'serah_terima_details.id');
                        }
                    })
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serahTerima.kode_serah'),
                Tables\Columns\TextColumn::make('serahTerimaDetail.barang.kode_barang')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBarangkembalis::route('/'),
        ];
    }
}
