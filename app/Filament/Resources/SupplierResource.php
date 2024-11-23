<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'ร้านค้า/ขายส่ง';

    protected static ?string $slug = 'supplier';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'mobile_bo'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar')
                    ->label('')
                    ->avatar()
                    ->directory('avatars')
                    ->visibility('private')
                    ->columnSpanFull()
                    ->alignCenter(),
                Forms\Components\TextInput::make('name')
                    ->label('ชื่อ')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_1')
                    ->label('ที่อยู่'),
                Forms\Components\Textarea::make('address_2')
                    ->label('ที่อยู่เพิ่มเติม')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('mobile_bo')
                    ->label('เบอร์โทรศัพท์')
                    ->columnStart(1),
                Forms\Components\TextInput::make('vat')
                    ->label('หัก%')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('สถานะ')
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
                Tables\Columns\ImageColumn::make('avatar')
                    ->label(''),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address_1')
                    ->label('ที่อยู่')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_bo')
                    ->label('เบอร์โทรศัพท์')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vat')
                    ->label('หัก%')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('สถานะ')
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
