<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class MostPaidEmployees extends BaseWidget
{
    protected static ?string $heading = 'Најплатени вработени';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Employee::query()
                    ->fromAuthCompany()
                    ->whereHas('salaries')
                    ->select('employees.*', DB::raw('(SELECT SUM(net_payment) FROM salaries WHERE employee_id = employees.id) as total_salary'))
                    ->orderByDesc('total_salary')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име'),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Презиме'),
                Tables\Columns\TextColumn::make('total_salary')
                    ->numeric()
                    ->prefix('ден.')
                    ->label('Вкупно плата'),
            ])
            ->paginated(false);
    }
}
