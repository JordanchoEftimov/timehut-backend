<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Models\Shift;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ShiftResource extends Resource
{
    protected static ?string $model = Shift::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'смена';

    protected static ?string $pluralModelLabel = 'смени';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function table(Table $table): Table
    {
        return $table
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
            'index' => Pages\ManageShifts::route('/'),
        ];
    }
}
