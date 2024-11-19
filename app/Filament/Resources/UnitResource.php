<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitResource\Pages;
use App\Filament\Resources\UnitResource\RelationManagers;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $activeNavigationIcon = 'heroicon-m-tag';

    protected static ?string $navigationLabel = 'หน่วย';

    protected static ?string $slug = 'units';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("หัวข้อ")
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label("รายละเอียด")
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('conversion_rate')
                    ->label("จำหน่วยต่อหน่วย")
                    ->numeric()
                    ->default(1),
                Forms\Components\Toggle::make('is_active')
                    ->label("สถานะ")
                    ->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_id')
                    ->label('ID')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label("หัวข้อ")
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label("รายละเอียด")
                    ->html(),
                Tables\Columns\TextColumn::make('conversion_rate')
                    ->label("จำหน่วยต่อหน่วย")
                    ->numeric()
                    ->sortable()
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("สถานะ")
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
            'index' => Pages\ListUnits::route('/'),
            'create' => Pages\CreateUnit::route('/create'),
            'edit' => Pages\EditUnit::route('/{record}/edit'),
        ];
    }
}
