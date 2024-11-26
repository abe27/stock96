<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceiveResource\Pages;
use App\Filament\Resources\ReceiveResource\RelationManagers;
use App\Models\Product;
use App\Models\Receive;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReceiveResource extends Resource
{
    protected static ?string $model = Receive::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-plus';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'รับสินค้า';

    protected static ?string $slug = 'receive';

    protected static ?int $navigationSort = 1;

    // protected static ?string $navigationGroup = 'ข้อมูลคลัง';

    public static function getGloballySearchableAttributes(): array
    {
        return ['no', 'tax_no', 'received_on', 'supplier.name'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('no')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\TextInput::make('tax_no')
                    ->label('เลขที่ใบเสร็จ')
                    ->maxLength(255),
                Forms\Components\Select::make('supplier_id')
                    ->label('สินค้าจากร้าน')
                    ->searchable()
                    ->required()
                    ->options(Supplier::pluck('name', 'id')),
                Forms\Components\DatePicker::make('received_on')
                    ->label('วันที่รับ')
                    ->default(Carbon::now()),
                // Forms\Components\TextInput::make('qty')
                //     ->numeric()
                //     ->default(0),
                Forms\Components\TextInput::make('cost_price')
                    ->label('ราคาซื้อทั้งหมด')
                    ->numeric()
                    ->default(0),
                // Forms\Components\TextInput::make('receive_by_id')
                //     ->required(),
                // Forms\Components\Toggle::make('is_active')
                //     ->required(),
                Repeater::make('receiveLines')
                    ->relationship('receiveLines')
                    ->columns(4)
                    ->columnSpanFull()
                    ->defaultItems(0)
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('รหัสสินค้า')
                            ->searchable()
                            ->required()
                            ->options(Product::pluck('name', 'id'))
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $product = Product::where('id', Str::trim($state))->first();
                                $set('cost_price', $product->cost_price);
                                $set('unit_id', $product->unit_id);
                            }),
                        Forms\Components\TextInput::make('qty')
                            ->label('จำนวน')
                            ->numeric()
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
                                $product = Product::where('id', $get('product_id'))->first();
                                $set('cost_price', (int)$state * $product->cost_price);
                            }),
                        Forms\Components\TextInput::make('cost_price')
                            ->label('ราคา')
                            ->numeric(),
                        Forms\Components\Select::make('unit_id')
                            ->label('หน่วย')
                            ->searchable()
                            ->options(Unit::pluck('name', 'id')),
                    ])

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
