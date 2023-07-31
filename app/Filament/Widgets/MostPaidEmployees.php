<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MostPaidEmployees extends BaseWidget
{
    protected static ?string $heading = 'Најплатени вработени';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    protected function getTableQuery(): Builder
    {
        return Employee::query()
            ->whereHas('salaries')
            ->select('employees.*', DB::raw('(SELECT SUM(payment) FROM salaries WHERE employee_id = employees.id) as total_salary'))
            ->orderByDesc('total_salary');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Име'),
            Tables\Columns\TextColumn::make('surname')
                ->label('Презиме'),
            Tables\Columns\TextColumn::make('total_salary')
                ->label('Вкупно плата'),
        ];
    }
}
