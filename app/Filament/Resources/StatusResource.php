<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatusResource\Pages;
use App\Filament\Resources\StatusResource\RelationManagers;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;

    protected static ?string $navigationIcon = 'heroicon-o-backspace';

    protected static ?string $activeNavigationIcon = 'heroicon-m-folder-open';

    protected static ?string $navigationLabel = 'ข้อมูลสถานะ';

    protected static ?string $slug = 'status';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'จัดการระบบ';

    public static ?string $pluralModelLabel = 'ข้อมูลสถานะ';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
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
                Forms\Components\Radio::make('color')
                    ->inline()
                    ->label('สี')
                    ->options([
                        'primary' => 'สีฟ้าเข้ม',
                        'success' => 'สีเขียว',
                        'warning' => 'สีเหลือง',
                        'danger' => 'สีแดง',
                        'info' => 'สีฟ้า',
                    ])
                    ->default('danger'),
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
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label('หัวข้อ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('รายละเอียด')
                    ->html(),
                Tables\Columns\TextColumn::make('color')
                    ->label(' ')
                    ->badge()
                    ->color(fn(string $state) => $state),
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
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'edit' => Pages\EditStatus::route('/{record}/edit'),
        ];
    }
}
