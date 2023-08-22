<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsenceStatusResource\Pages;
use App\Models\AbsenceStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AbsenceStatusResource extends Resource
{
    protected static ?string $model = AbsenceStatus::class;

    protected static ?string $modelLabel = 'барање за отсуство';

    protected static ?string $pluralModelLabel = 'барања за отсуство';

    protected static ?string $navigationIcon = 'heroicon-s-home-modern';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_approved')
                    ->label('Одобрено'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('absenceRequest.from')
                    ->date()
                    ->label('Отсуство од')
                    ->sortable(),
                Tables\Columns\TextColumn::make('absenceRequest.to')
                    ->date()
                    ->label('Отсуство до')
                    ->sortable(),
                Tables\Columns\TextColumn::make('absenceRequest.employee.name')
                    ->label('Вработен')
                    ->sortable(),
                Tables\Columns\IconColumn::make('Статус')
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
                //
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAbsenceStatuses::route('/'),
        ];
    }
}
