<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsenceRequestResource\Pages;
use App\Models\AbsenceRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AbsenceRequestResource extends Resource
{
    protected static ?string $model = AbsenceRequest::class;

    protected static ?string $modelLabel = 'барање за отсуство';

    protected static ?string $pluralModelLabel = 'барања за отсуство';

    protected static ?string $navigationIcon = 'heroicon-s-home-modern';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('from')
                    ->label('Отсуство од')
                    ->required(),
                Forms\Components\DatePicker::make('to')
                    ->label('Отсуство до')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->label('Причина')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('from')
                    ->label('Отсуство од')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to')
                    ->label('Отсуство до')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_name')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Одобрено' => 'success',
                        'Одбиено' => 'danger',
                        'Непрегледано' => 'gray',
                    })
                    ->label('Статус'),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->fromAuthEmployee();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAbsenceRequests::route('/'),
        ];
    }
}
