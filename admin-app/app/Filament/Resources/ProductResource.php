<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input untuk nama produk
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // Input untuk harga produk
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric() // Validasi harus angka
                    ->prefix('Rp'), // Prefix "Rp" di form
                // Input untuk deskripsi
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(), // Mengambil lebar penuh
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk nama produk, bisa dicari (searchable)
                Tables\Columns\TextColumn::make('name')
                    ->searchable(), // Memenuhi syarat pencarian
                // Kolom untuk harga, diformat sebagai mata uang IDR
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR') // Format sebagai Rupiah
                    ->sortable(),
                // Kolom untuk deskripsi, dipersingkat
                Tables\Columns\TextColumn::make('description')
                    ->limit(50) // Persingkat deskripsi di tabel
                    ->wrap(),
                // Kolom untuk tanggal update
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Bisa disembunyikan
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
