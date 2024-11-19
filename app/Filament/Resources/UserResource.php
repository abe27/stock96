<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $activeNavigationIcon = 'heroicon-m-users';

    protected static ?string $navigationLabel = 'ผู้ใช้งาน';

    protected static ?string $slug = 'members';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'first_name', 'last_name', 'email'];
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
                    ->label('ชื่อผู้ใช้งาน')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('ชื่ออีเมล')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                    ->label('ชื่อ')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label('นามสกุล')
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('รหัสผ่าน')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Radio::make('role')
                    ->label('สิทธิ์การใช้งาน')
                    ->inline()
                    ->options([
                        'admin' => 'ผู้ดูแลระบบ',
                        'cust'  => 'ลูกค้า',
                        'employee' => 'พนักงาน',
                        'dealer' => 'ตัวแทนจำหน่าย',
                    ])
                    ->default('cust')
                    ->columnStart(1),
                Forms\Components\Checkbox::make('is_activated')
                    ->label('อนุญาติให้เข้าสู่ระบบได้')
                    ->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('row_id')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label(''),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_activated')
                    ->label('Activate'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
