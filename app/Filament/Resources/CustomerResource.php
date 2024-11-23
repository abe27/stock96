<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'ลูกค้า';

    protected static ?string $slug = 'customers';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'address_1'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar')
                    ->label(' ')
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
                    ->label('ที่อยู่')
                    ->maxLength(255),
                Forms\Components\Textarea::make('address_2')
                    ->label('ที่อยู่เพิ่มเติม')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('mobile_bo')
                    ->label('เบอร์โทรศัพท์')
                    ->maxLength(255),
                Forms\Components\TextInput::make('messenger_id')
                    ->label('Messenger')
                    ->maxLength(255),
                Forms\Components\TextInput::make('line_id')
                    ->label('Line')
                    ->maxLength(255),
                Forms\Components\TextInput::make('vat')
                    ->label('หัก%')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('สถานะ'),
                Forms\Components\TextInput::make('owner_id')
                    ->label('ลูกค้าของ'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_id')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label(''),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address_1')
                    ->label('ที่อยู่'),
                Tables\Columns\TextColumn::make('address_2')
                    ->label('ที่อยู่เพิ่มเติม')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('mobile_bo')
                    ->label('เบอร์โทรศัพท์')
                    ->searchable(),
                Tables\Columns\TextColumn::make('messenger_id')
                    ->label('Messenger')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('line_id')
                    ->label('Line')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('vat')
                    ->label('หัก%')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner_id')
                    ->label('ลูกค้าของ'),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
