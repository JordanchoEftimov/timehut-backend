<?php

namespace App\Console\Commands;

use App\Models\Salary;
use App\Models\Setting;
use App\Models\Shift;
use Carbon\Carbon;
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

        $this->info('Calculating salaries for '.count($companies).' companies');

        foreach ($companies as $company) {
            // Get the selected employees for the current company
            $selectedEmployees = $company->employees;

            // Calculate the start and end date for the previous month
            $currentDate = Carbon::now();
            $startDate = $currentDate->copy()->subMonth()->startOfMonth();
            $endDate = $currentDate->copy()->subMonth()->endOfMonth();

            $shifts = Shift::query()->whereBetween('start_at', [$startDate, $endDate])
                ->whereIn('employee_id', $selectedEmployees->pluck('id'))
                ->get();

            foreach ($selectedEmployees as $employee) {
                $totalHoursWorked = 0;

                foreach ($shifts->where('employee_id', $employee->id) as $shift) {
                    $timeParts = explode(':', $shift->duration);

                    $hours = (int) $timeParts[0];
                    $totalHoursWorked += $hours;
                }

                $hourlyRate = $employee->net_salary / 160;
                $monthlySalary = $totalHoursWorked * $hourlyRate;

                Salary::query()->create([
                    'employee_id' => $employee->id,
                    'net_payment' => $monthlySalary,
                    'month' => intval(date('m')) - 1,
                ]);
                $prevMonths = $employee->previous_work_months;
                $employee->previous_work_months = $prevMonths + 1;
                $employee->save();
            }
        }

        $this->info('Calculation of salary for employees finished');
    }
}
