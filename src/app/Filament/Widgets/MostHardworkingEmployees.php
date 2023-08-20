<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MostHardworkingEmployees extends BaseWidget
{
    protected static ?string $heading = 'Највредни вработени';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    protected function getTableQuery(): Builder
    {
        return Employee::query()
            ->whereHas('shifts')
            ->select('*', DB::raw('(SELECT SUM(TIME_TO_SEC(TIMEDIFF(end_at, start_at))) FROM shifts WHERE employee_id = employees.id) as total_working_seconds'))
            ->orderByDesc('total_working_seconds');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Име'),
            Tables\Columns\TextColumn::make('surname')
                ->label('Презиме'),
            Tables\Columns\TextColumn::make('total_working_hours')
                ->label('Работни часови'),
        ];
    }
}
