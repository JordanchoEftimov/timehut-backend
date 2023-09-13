<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class MostHardworkingEmployees extends BaseWidget
{
    protected static ?string $heading = 'Највредни вработени';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Employee::query()
                    ->whereHas('shifts')
                    ->select('*', DB::raw('(SELECT SUM(TIME_TO_SEC(TIMEDIFF(end_at, start_at))) FROM shifts WHERE employee_id = employees.id) as total_working_seconds'))
                    ->orderByDesc('total_working_seconds')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име'),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Презиме'),
                Tables\Columns\TextColumn::make('total_working_hours')
                    ->label('Работни часови'),
            ])
            ->paginated(false);
    }
}
