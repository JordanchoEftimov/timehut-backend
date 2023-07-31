<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Shift;
use Carbon\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DurationOfShiftsPerMonthChart extends ApexChartWidget
{
    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::EMPLOYEE->value;
    }

    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'DurationOfShiftsPerMonthChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Работни часови по месец';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
        $dates = [];

        while ($start->lte($end)) {
            $dates[] = [
                'month' => $start->month,
                'count' => 0,
            ];
            $start->addMonth();
        }

        $loggedInEmployeeId = auth()->user()->employee->id;

        $totalDurationsPerMonth = Shift::join('employees', 'shifts.employee_id', '=', 'employees.id')
            ->selectRaw('YEAR(shifts.start_at) AS year, MONTH(shifts.start_at) AS month, ROUND(SUM(TIME_TO_SEC(TIMEDIFF(shifts.end_at, shifts.start_at))) / 3600, 0) AS total_duration')
            ->where('employees.id', $loggedInEmployeeId)
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        $data = collect($dates)->map(function ($date) use ($totalDurationsPerMonth) {
            foreach ($totalDurationsPerMonth as $order) {
                if ($date['month'] == $order['month']) {
                    $date['total_duration'] = $order['total_duration'];
                    break;
                }
            }

            return (object) $date;
        });

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Работни часови по месец',
                    'data' => $data->pluck('total_duration')
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#6366f1'],
        ];
    }
}
