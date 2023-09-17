<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ShiftsRelationManager extends RelationManager
{
    protected static string $relationship = 'shifts';

    protected ?string $heading = 'Смени';

    protected static ?string $title = 'Смени';

    protected static ?string $modelLabel = 'Смена';

    protected static ?string $pluralModelLabel = 'Смени';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->label('Ден'),
                Tables\Columns\TextColumn::make('start_at')
                    ->label('Започнато на')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('end_at')
                    ->label('Завршено на')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Времетраење')
                    ->time(),
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
