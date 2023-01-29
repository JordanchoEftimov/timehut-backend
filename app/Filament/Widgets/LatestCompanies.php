<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Company;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestCompanies extends BaseWidget
{
    protected static ?string $heading = 'Последни регистрирани компании';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::ADMIN->value;
    }

    protected function getTableQuery(): Builder
    {
        return Company::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Име на компанија'),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Сопственик'),
        ];
    }
}
