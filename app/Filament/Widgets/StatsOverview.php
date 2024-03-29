<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::ADMIN->value;
    }

    protected function getCards(): array
    {
        return [
            Card::make('Регистрирани компании', Company::query()->count())
                ->description('Број на регистрирани компании на Timehut')
                ->descriptionIcon('heroicon-o-building-office')
                ->descriptionColor('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Card::make('Активни компании', Company::query()->where('active', true)->count())
                ->description('Број на активни компании на Timehut')
                ->descriptionIcon('heroicon-o-building-office')
                ->descriptionColor('warning')
                ->chart([2, 2, 5, 10, 15, 4, 17]),
        ];
    }
}
