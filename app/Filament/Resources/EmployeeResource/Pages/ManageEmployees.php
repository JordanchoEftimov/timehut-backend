<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Enums\UserType;
use App\Filament\Resources\EmployeeResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEmployees extends ManageRecords
{
    protected static string $resource = EmployeeResource::class;

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
                            'type' => UserType::EMPLOYEE->value,
                        ]);

                    $data['user_id'] = $user->id;

                    return $data;
                }),
        ];
    }
}
