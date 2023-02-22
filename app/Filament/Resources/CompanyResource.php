<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Основни';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'компанија';

    protected static ?string $pluralModelLabel = 'компании';

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Име'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(table: User::class)
                    ->required()
                    ->label('Е-пошта'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->hiddenOn('edit')
                    ->label('Лозинка'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255)
                    ->label('Адреса'),
                Forms\Components\Checkbox::make('active')
                    ->label('Активна'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Е-пошта'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Адреса'),
                Tables\Columns\CheckboxColumn::make('active')
                    ->label('Активна')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Креирана на')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ажурирана на')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Активни')
                    ->query(fn (Builder $query) => $query->isActive()),
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCompanies::route('/'),
        ];
    }
}
