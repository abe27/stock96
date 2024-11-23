<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'สินค้า';

    protected static ?string $slug = 'products';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationGroup = 'ข้อมูลสินค้า';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\FileUpload::make('pics')
                    ->label('')
                    ->avatar()
                    ->directory('products')
                    ->visibility('private')
                    ->columnSpanFull()
                    ->alignCenter(),
                Forms\Components\Select::make('category_id')
                    ->label('หมวดหมู่')
                    ->required()
                    ->searchable()
                    ->options(Category::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('name')
                    ->label('ชื่อ')
                    ->required()
                    ->maxLength(255)
                    ->columnStart(1),
                Forms\Components\TextInput::make('product_code')
                    ->label('รหัส')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('รายละเอียด')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label('ราคาขาย')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                Forms\Components\TextInput::make('cost_price')
                    ->label('ราคาต้นทุน')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('unit_id')
                    ->label('หน่วย')
                    ->searchable()
                    ->required()
                    ->options(Unit::all()->pluck('name', 'id')),
                Forms\Components\Toggle::make('is_active')
                    ->label('สถานะ')
                    ->required()
                    ->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_id')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('pics')
                    ->label(' '),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('หมวดหมู่')
                    ->badge()
                    ->color(fn(Product $record) => $record->category->color),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_code')
                    ->label('รหัส')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('ราคาขาย')
                    ->numeric()
                    ->money('thb')
                    ->tooltip('ราคาขายสินค้า')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state) => (int)$state > 0 ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('cost_price')
                    ->label('ราคาต้นทุน')
                    ->numeric()
                    ->money('thb')
                    ->tooltip('ราคาต้นทุนสินค้า')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state) => (int)$state > 0 ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('profit')
                    ->label('กำไร')
                    ->numeric()
                    ->money('thb')
                    ->tooltip('กำไรสุทธิ')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state) => (int)$state > 0 ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('หน่วย')
                    ->badge()
                    ->color(fn(Product $record) => $record->unit->color),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('สถานะ')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('สร้างเมื่อ')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('ปรับปรุงเมื่อ')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('หมวดหมู่')
                    ->multiple()
                    ->searchable()
                    ->options(Category::pluck('name', 'id')),
                SelectFilter::make('unit_id')
                    ->label('หน่วย')
                    ->multiple()
                    ->searchable()
                    ->options(Unit::pluck('name', 'id')),
                TernaryFilter::make('is_active')
                    ->label('สถานะ')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
