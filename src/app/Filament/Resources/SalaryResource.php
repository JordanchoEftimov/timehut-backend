<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryResource\Pages;
use App\Models\Salary;
use Filament\Forms;
use Filament\Forms\Form;
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

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('month_name')
                ->label('Месец'),
            Forms\Components\TextInput::make('net_payment')
                ->label('Плата од работа')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('previous_work_months_additional_payment')
                ->label('Минат труд')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('contribution_for_mandatory_social_security')
                ->label('Придонеси за задолжително ПИО (18%)')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('contribution_for_compulsory_health_insurance')
                ->label('Придонеси за задолжително здравствено осигурување (7.5%)')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('unemployment_insurance_contribution')
                ->label('Придонес за осигурување во случај на невработеност (1.2%)')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('additional_contribution_for_mandatory_insurance_in_case_of_injury_or_occupational_disease')
                ->label('Дополнителен придонес за задолжително осигурување во случај повреда или професионално заболување (0.5%)')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('personal_income_tax')
                ->label('Данок на личен доход (10%)')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
            Forms\Components\TextInput::make('gross_payment')
                ->label('Бруто плата')
                ->numeric()
                ->prefix('ден.')
                ->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Види'),
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
            'view' => Pages\ViewSalary::route('/{record}'),
        ];
    }
}
