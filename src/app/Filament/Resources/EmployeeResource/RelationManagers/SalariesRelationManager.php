<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SalariesRelationManager extends RelationManager
{
    protected static string $relationship = 'salaries';

    protected ?string $heading = 'Плати';

    protected static ?string $title = 'Плати';

    protected static ?string $modelLabel = 'Плата';

    protected static ?string $pluralModelLabel = 'Плати';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('net_payment')
                    ->label('Нето износ')
                    ->numeric()
                    ->prefix('ден.'),
                Tables\Columns\TextColumn::make('gross_payment')
                    ->label('Бруто износ')
                    ->numeric()
                    ->prefix('ден.'),
                Tables\Columns\TextColumn::make('month_name')
                    ->label('Месец'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateActions([
                //
            ]);
    }
}
