<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceiveResource\Pages;
use App\Filament\Resources\ReceiveResource\RelationManagers;
use App\Models\Receive;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReceiveResource extends Resource
{
    protected static ?string $model = Receive::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tax_no')
                    ->maxLength(255),
                Forms\Components\TextInput::make('supplier_id')
                    ->required(),
                Forms\Components\DatePicker::make('received_on'),
                Forms\Components\TextInput::make('qty')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('cost_price')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('receive_by_id')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tax_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier_id'),
                Tables\Columns\TextColumn::make('received_on')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receive_by_id'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListReceives::route('/'),
            'create' => Pages\CreateReceive::route('/create'),
            'edit' => Pages\EditReceive::route('/{record}/edit'),
        ];
    }
}
