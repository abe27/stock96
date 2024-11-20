<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'หมวดหมู่สินค้า';

    protected static ?string $slug = 'category';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['no', 'name', 'description'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('หัวข้อ')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('รายละเอียด')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('สถานะ'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_id')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label('หัวข้อ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->html()
                    ->label('รายละเอียด'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('สถานะ')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
