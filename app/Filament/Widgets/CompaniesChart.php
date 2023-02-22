<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Company;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CompaniesChart extends ApexChartWidget
{
    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::ADMIN->value;
    }

    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'Компании';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Компании';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => [Company::query()->where('active', true)->count(), Company::query()->where('active', false)->count()],
            'labels' => ['Активни компании', 'Неактивни компании'],
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
