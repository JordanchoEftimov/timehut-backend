<?php

namespace App\Models;

use App\Traits\HasCaching;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    use HasFactory, HasCaching;

    protected $fillable = ['value'];

    public $timestamps = false;

    const PAYMENT_DATE_OF_MONTH_KEY = 'payment_date_of_month';

    const SETTINGS = [
        [
            'key' => self::PAYMENT_DATE_OF_MONTH_KEY,
            'description' => 'Датум од месецот за пресметка на плата',
            'value' => '21',
        ],
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public static function getValue($key)
    {
        $s = Setting::query()
            ->where('company_id', auth()->user()->company_id)
            ->where('key', $key)
            ->first();
        if ($s) {
            return $s->value;
        }

        return null;
    }

    public static function create($setting, $companyId): Model|Builder
    {
        return Setting::query()->create([
            'key' => $setting['key'],
            'description' => $setting['description'],
            'value' => $setting['value'],
            'company_id' => $companyId,
        ]);
    }
}
