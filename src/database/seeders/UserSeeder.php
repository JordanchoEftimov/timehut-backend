<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Shift;
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
                // company
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

                // employee
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
                    'net_salary' => 21000,
                    'previous_work_months' => 12,
                ]);
                $employee->user()->associate($user->id);
                $employee->company()->associate($company->id);
                $employee->save();

                // shift
                collect([
                    [
                        'start_at' => Carbon::now(),
                        'end_at' => Carbon::now()->addHours(8),
                    ],
                    [
                        'start_at' => Carbon::now()->addDay(),
                        'end_at' => Carbon::now()->addDay()->addHours(8),
                    ],
                    [
                        'start_at' => Carbon::now()->addDays(2),
                        'end_at' => Carbon::now()->addDays(2)->addHours(8)->addMinutes(20),
                    ],
                    [
                        'start_at' => Carbon::now()->addDays(10),
                        'end_at' => Carbon::now()->addDays(10)->addHours(8)->addSeconds(40),
                    ],
                ])->each(function ($shift) use ($employee) {
                    $shift = new Shift($shift);
                    $shift->employee()->associate($employee->id);
                    $shift->save();
                });

                // salaries
                collect([
                    [
                        'month' => 1,
                        'net_payment' => 20000,
                    ],
                    [
                        'month' => 2,
                        'net_payment' => 21000,
                    ],
                    [
                        'month' => 3,
                        'net_payment' => 22000,
                    ],
                    [
                        'month' => 4,
                        'net_payment' => 20000,
                    ],
                    [
                        'month' => 6,
                        'net_payment' => 20000,
                    ],
                ])->each(function ($salary) use ($employee) {
                    $salary = new Salary($salary);
                    $salary->employee()->associate($employee->id);
                    $salary->save();
                });
            });
        }
    }
}
