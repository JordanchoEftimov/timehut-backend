<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Widgets\PieChartWidget;

class CompaniesChart extends PieChartWidget
{
    protected static ?string $heading = 'Компании';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Комапнии',
                    'data' => [Company::query()->where('active', true)->count(), Company::query()->where('active', false)->count()],
                    'backgroundColor' => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                ],
            ],
            'labels' => ['Активни компании', 'Неактивни компании'],
        ];
    }
}
