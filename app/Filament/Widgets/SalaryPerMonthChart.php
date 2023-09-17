<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Salary;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Carbon;

class SalaryPerMonthChart extends LineChartWidget
{
    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::EMPLOYEE->value;
    }

    protected static ?string $heading = 'Плати по месец';

    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;
        $salaries = Salary::selectRaw('IFNULL(SUM(net_payment), 0) as total_payment, month')
            ->whereYear('created_at', $currentYear)
            ->where('employee_id', auth()->user()->employee->id)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_payment', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Плати по месец',
                    'data' => $this->getSalariesForMonths($salaries),
                    'backgroundColor' => 'blue',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getSalariesForMonths(array $salaries): array
    {
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $data[] = isset($salaries[$month]) ? $salaries[$month] : 0;
        }

        return $data;
    }
}
