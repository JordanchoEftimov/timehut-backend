<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Основни';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'компанија';

    protected static ?string $pluralModelLabel = 'компании';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar_url')
                    ->image()
                    ->imageEditor(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Име'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(table: User::class)
                    ->required()
                    ->label('Е-пошта'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->hiddenOn('edit')
                    ->label('Лозинка'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255)
                    ->label('Адреса'),
                Forms\Components\Checkbox::make('active')
                    ->label('Активна'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Лого'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Име')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Е-пошта'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Адреса'),
                Tables\Columns\CheckboxColumn::make('active')
                    ->label('Активна')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Креирана на')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ажурирана на')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Активни')
                    ->query(fn (Builder $query) => $query->isActive()),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Креирано од'),
                        DatePicker::make('created_until')
                            ->label('Креирано до'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCompanies::route('/'),
        ];
    }
}
