<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'คลังสินค้า';

    protected static ?string $slug = 'stock';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationGroup = 'ข้อมูลคลัง';

    public static function getGloballySearchableAttributes(): array
    {
        return ['category.name', 'product.name'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('หมวดหมู่')
                    ->searchable()
                    ->options(Category::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->label('สินค้า')
                    ->searchable()
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required()
                    ->columnStart(1),
                Forms\Components\Select::make('unit_id')
                    ->label('หน่วย')
                    ->searchable()
                    ->options(Unit::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('จำนวน')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->label('ราคา')
                    ->required()
                    ->numeric()
                    ->prefix('฿')
                    ->columnStart(1),
                Forms\Components\TextInput::make('cost_price')
                    ->label('ราคาต้นทุน')
                    ->required()
                    ->numeric()
                    ->prefix('฿'),
                // Forms\Components\TextInput::make('min_qty')
                //     ->numeric()
                //     ->default(0),
                // Forms\Components\TextInput::make('max_qty')
                //     ->numeric()
                //     ->default(500),
                Forms\Components\TextInput::make('safety_stock')
                    ->label('จำนวนที่ต้องการให้แจ้งเตือน')
                    ->numeric()
                    ->default(0),
                Forms\Components\RichEditor::make('description')
                    ->label('รายละเอียด')
                    ->columnSpanFull(),
                // Forms\Components\TextInput::make('adjust_by_id'),
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
                    ->label('ID')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit.name'),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost_price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_qty')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('max_qty')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('safety_stock')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('adjust_by_id')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }
}
