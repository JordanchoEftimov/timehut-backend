<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers\SalariesRelationManager;
use App\Filament\Resources\EmployeeResource\RelationManagers\ShiftsRelationManager;
use App\Models\Employee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'вработен';

    protected static ?string $pluralModelLabel = 'вработени';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Име')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label('Презиме')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Тел. број')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Е-пошта')
                    ->required()
                    ->email()
                    ->unique(table: User::class)
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Лозинка')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Адреса')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('employment_date')
                    ->label('Датум на вработување')
                    ->required(),
                Forms\Components\TextInput::make('net_salary')
                    ->label('Основна нето плата')
                    ->numeric()
                    ->required()
                    ->prefix('ден.'),
                Forms\Components\TextInput::make('previous_work_months')
                    ->label('Минат труд во месеци')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Презиме')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Тел. број')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Е-пошта'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Адреса'),
                Tables\Columns\TextColumn::make('net_salary')
                    ->label('Основна нето плата')
                    ->numeric()
                    ->prefix('ден.'),
                Tables\Columns\TextColumn::make('gross_salary')
                    ->label('Основна бруто плата')
                    ->numeric()
                    ->prefix('ден.'),
                Tables\Columns\TextColumn::make('employment_date')
                    ->date()
                    ->label('Датум на вработување')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
                    ->label('Види'),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->fromAuthCompany();
    }

    public static function getRelations(): array
    {
        return [
            ShiftsRelationManager::class,
            SalariesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmployees::route('/'),
            'view' => Pages\ViewEmployee::route('/{record}'),
        ];
    }
}
