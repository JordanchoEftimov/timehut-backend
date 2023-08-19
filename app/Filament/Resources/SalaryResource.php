<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryResource\Pages;
use App\Models\Salary;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;

    protected static ?string $modelLabel = 'плата';

    protected static ?string $pluralModelLabel = 'плати';

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment')
                    ->label('Износ')
                    ->numeric()
                    ->prefix('ден.'),
                Tables\Columns\TextColumn::make('month_name')
                    ->label('Месец'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->forLoggedInEmployee();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSalaries::route('/'),
        ];
    }
}
