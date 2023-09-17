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
                // create 100 companies
                for ($i = 0; $i < 20; $i++) {
                    $user = User::query()
                        ->create([
                            'name' => fake()->name,
                            'email' => fake()->email,
                            'password' => 'admin',
                            'type' => UserType::COMPANY->value,
                        ]);
                    $company = new Company([
                        'name' => fake()->name,
                        'address' => fake()->address,
                    ]);
                    $company->user()->associate($user->id);
                    $company->save();
                }

                // create 10 employees per company
                $companies = Company::all();
                foreach ($companies as $company) {
                    for ($i = 0; $i < 20; $i++) {
                        $user = User::query()
                            ->create([
                                'name' => fake()->name,
                                'email' => fake()->email,
                                'password' => 'admin',
                                'type' => UserType::EMPLOYEE->value,
                            ]);
                        $name = explode(' ', fake()->name);
                        $employee = new Employee([
                            'name' => $name[0],
                            'surname' => $name[1],
                            'phone' => fake()->phoneNumber,
                            'address' => fake()->address,
                            'employment_date' => Carbon::now(),
                            'net_salary' => fake()->numberBetween(20000, 30000),
                            'previous_work_months' => fake()->numberBetween(0, 96),
                        ]);
                        $employee->user()->associate($user->id);
                        $employee->company()->associate($company->id);
                        $employee->save();
                    }
                }

                // shifts
                $employees = Employee::all();
                foreach ($employees as $employee) {
                    // shift
                    collect([
                        [
                            'start_at' => Carbon::now()->subMonth(),
                            'end_at' => Carbon::now()->subMonth()->addHours(8),
                        ],
                        [
                            'start_at' => Carbon::now()->subMonth()->addDay(),
                            'end_at' => Carbon::now()->subMonth()->addDay()->addHours(8),
                        ],
                        [
                            'start_at' => Carbon::now()->subMonth()->addDays(2),
                            'end_at' => Carbon::now()->subMonth()->addDays(2)->addHours(8)->addMinutes(20),
                        ],
                        [
                            'start_at' => Carbon::now()->subMonth()->addDays(10),
                            'end_at' => Carbon::now()->subMonth()->addDays(10)->addHours(8)->addSeconds(40),
                        ],
                    ])->each(function ($shift) use ($employee) {
                        $shift = new Shift($shift);
                        $shift->employee()->associate($employee->id);
                        $shift->save();
                    });
                }

                // salaries
                foreach ($employees as $employee) {
                    $salariesCount = rand(10, 20);
                    for ($i = 0; $i < $salariesCount; $i++) {
                        $salary = new Salary([
                            'month' => fake()->numberBetween(1, 12),
                            'net_payment' => fake()->numberBetween(20000, 30000),
                        ]);
                        $salary->employee()->associate($employee->id);
                        $salary->save();
                    }
                }
            });
        }
    }
}
