<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestEmployees extends BaseWidget
{
    protected static ?string $heading = 'Последни регистрирани вработени';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Employee::query()->fromAuthCompany()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име'),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Презиме'),
            ])
            ->paginated(false);
    }
}
