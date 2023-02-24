<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin',
                'type' => UserType::ADMIN->value,
            ]);

        if (! app()->isProduction()) {
            DB::transaction(function () {
                $user = User::query()
                    ->create([
                        'name' => 'Company',
                        'email' => 'company@gmail.com',
                        'password' => 'admin',
                        'type' => UserType::COMPANY->value,
                    ]);
                $company = new Company([
                    'name' => 'Company',
                    'address' => 'Address',
                ]);
                $company->user()->associate($user->id);
                $company->save();

                $user = User::query()
                    ->create([
                        'name' => 'Employee',
                        'email' => 'employee@gmail.com',
                        'password' => 'admin',
                        'type' => UserType::EMPLOYEE->value,
                    ]);
                $employee = new Employee([
                    'name' => 'Employee',
                    'surname' => 'Surname',
                    'phone' => '077123123',
                    'email' => 'employee@gmail.com',
                    'address' => 'Address',
                    'employment_date' => Carbon::now(),
                ]);
                $employee->user()->associate($user->id);
                $employee->company()->associate($company->id);
                $employee->save();
            });
        }
    }
}
