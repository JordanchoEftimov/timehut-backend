<?php

namespace App\Console\Commands;

use App\Models\Salary;
use App\Models\Setting;
use Illuminate\Console\Command;

class CalculateMonthlySalaryForEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-monthly-salary-for-employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates the monthly salary for every employee of the company for the previous month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting calculation of salary for employees...');

        $todayDateDay = date('d');

        $settings = Setting::query()
            ->where('key', Setting::PAYMENT_DATE_OF_MONTH_KEY)
            ->where('value', $todayDateDay)
            ->get();

        $companies = collect();

        foreach ($settings as $setting) {
            $companies->push($setting->company);
        }

        foreach ($companies as $company) {
            foreach ($company->employees as $employee) {
                $netPayment = $employee->net_salary;
                Salary::query()->create([
                    'employee_id' => $employee->id,
                    'net_payment' => $netPayment,
                    'month' => intval(date('m')) - 1,
                ]);
            }
        }

        $this->info('Calculation of salary for employees finished');
    }
}
