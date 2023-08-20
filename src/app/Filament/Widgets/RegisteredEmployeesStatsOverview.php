<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class RegisteredEmployeesStatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    protected function getCards(): array
    {
        return [
            Card::make('Регистрирани вработени', Employee::query()->fromAuthCompany()->count())
                ->description('Број на регистрирани вработени на Timehut')
                ->descriptionIcon('heroicon-o-building-office')
                ->descriptionColor('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
        ];
    }
}
