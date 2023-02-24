<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Models\Shift;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
                ExportBulkAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageShifts::route('/'),
        ];
    }
}
