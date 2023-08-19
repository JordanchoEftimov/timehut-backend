<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\User;
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
                }),
        ];
    }
}
