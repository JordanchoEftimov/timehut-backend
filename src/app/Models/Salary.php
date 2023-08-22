<?php

namespace App\Models;

use App\Helpers\NetToGross;
use App\Notifications\SalaryPaidNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['net_payment', 'month', 'employee_id'];

    protected $appends = [
        'month_name',
        'gross_payment',
        'previous_work_months_additional_payment',
        'contribution_for_mandatory_social_security',
        'contribution_for_compulsory_health_insurance',
        'unemployment_insurance_contribution',
        'additional_contribution_for_mandatory_insurance_in_case_of_injury_or_occupational_disease',
        'personal_income_tax',
    ];

    public function monthName(): Attribute
    {
        return Attribute::get(fn () => match ($this->month) {
            1 => 'Јануари',
            2 => 'Февруари',
            3 => 'Март',
            4 => 'Април',
            5 => 'Мај',
            6 => 'Јуни',
            7 => 'Јули',
            8 => 'Август',
            9 => 'Септември',
            10 => 'Октомври',
            11 => 'Ноември',
            12 => 'Декември',
            default => 'Непознато',
        });
    }

    public function grossPayment(): Attribute
    {
        return Attribute::get(fn () => NetToGross::netToGross($this->net_payment));
    }

    public function previousWorkMonthsAdditionalPayment(): Attribute
    {
        return Attribute::get(fn () => $this->employee->net_salary * (round($this->employee->previous_work_months / 12) * 0.005));
    }

    public function contributionForMandatorySocialSecurity(): Attribute
    {
        return Attribute::get(fn () => NetToGross::calculateContributionForMandatorySocialSecurity($this->net_payment));
    }

    public function contributionForCompulsoryHealthInsurance(): Attribute
    {
        return Attribute::get(fn () => NetToGross::calculateContributionForCompulsoryHealthInsurance($this->net_payment));
    }

    public function unemploymentInsuranceContribution(): Attribute
    {
        return Attribute::get(fn () => NetToGross::calculateUnemploymentInsuranceContribution($this->net_payment));
    }

    public function additionalContributionForMandatoryInsuranceInCaseOfInjuryOrOccupationalDisease(): Attribute
    {
        return Attribute::get(fn () => NetToGross::calculateAdditionalContributionForMandatoryInsuranceInCaseOfInjuryOrOccupationalDisease($this->net_payment));
    }

    public function personalIncomeTax(): Attribute
    {
        return Attribute::get(fn () => NetToGross::calculatePersonalIncomeTax($this->net_payment));
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeForLoggedInEmployee($query)
    {
        return $query->where('employee_id', auth()->user()->employee->id);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::created(function (Salary $salary) {
            $employee = Employee::query()
                ->firstWhere('id', $salary->employee_id);
            $user = $employee->user;
            $user->notify(new SalaryPaidNotification($salary));
        });
    }
}
