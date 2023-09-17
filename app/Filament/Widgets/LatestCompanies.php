<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Company;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCompanies extends BaseWidget
{
    protected static ?string $heading = 'Последни регистрирани компании';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::ADMIN->value;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Company::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име на компанија'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Сопственик'),
            ])
            ->paginated(false);
    }
}
