<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCompanies extends ManageRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $user = User::query()
                        ->create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => $data['password'],
                        ]);

                    $data['user_id'] = $user->id;

                    return $data;
                })
                ->steps([
                    Step::make('Податоци за компанијата')
                        ->description('Внесете ги основните податоци за компанијата')
                        ->schema([
                            FileUpload::make('avatar_url')
                                ->image()
                                ->imageEditor(),
                            TextInput::make('name')
                                ->required()
                                ->label('Име'),
                            TextInput::make('address')
                                ->required()
                                ->maxLength(255)
                                ->label('Адреса'),
                            Checkbox::make('active')
                                ->label('Активна'),
                        ]),
                    Step::make('Податоци за најава')
                        ->description('Податоци за најава на системот за компанијата')
                        ->schema([
                            TextInput::make('email')
                                ->email()
                                ->unique(table: User::class)
                                ->required()
                                ->label('Е-пошта'),
                            TextInput::make('password')
                                ->password()
                                ->required()
                                ->hiddenOn('edit')
                                ->label('Лозинка'),
                        ]),
                ]),
        ];
    }
}
