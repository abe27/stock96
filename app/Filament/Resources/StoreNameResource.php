<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreNameResource\Pages;
use App\Filament\Resources\StoreNameResource\RelationManagers;
use App\Models\Currency;
use App\Models\StoreName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreNameResource extends Resource
{
    protected static ?string $model = StoreName::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $activeNavigationIcon = 'heroicon-m-home-modern';

    protected static ?string $navigationLabel = 'ชื่อร้าน';

    protected static ?string $slug = 'storename';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('logo')
                    ->label('')
                    ->avatar()
                    ->directory('stores')
                    ->visibility('private')
                    ->columnSpanFull()
                    ->alignCenter(),
                Forms\Components\TextInput::make('name')
                    ->label('ชื่อร้าน')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('รายละเอียด')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address_1')
                    ->label('ที่อยู่')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address_2')
                    ->label('ที่อยู่เพิ่มเติม')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('เบอร์โทรศัพท์')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('ชื่ออิเมล์')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->label('เว็บไซต์')
                    ->maxLength(255),
                Forms\Components\Select::make('currency_id')
                    ->label('สกุลเงินที่ใช้')
                    ->options(Currency::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
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
                Tables\Columns\ImageColumn::make('logo')
                    ->label(''),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('เบอร์โทรศัพท์')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('ชื่ออิเมล์')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->label('เว็บไซต์')
                    ->searchable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('currency.name')
                    ->label('สกุลเงิน')
                    ->badge()
                    ->color('success'),
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
            'index' => Pages\ListStoreNames::route('/'),
            'create' => Pages\CreateStoreName::route('/create'),
            'edit' => Pages\EditStoreName::route('/{record}/edit'),
        ];
    }
}
