<?php

namespace App\Models;

use App\Traits\HasCaching;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasCaching;

    protected $fillable = ['value'];

    public $timestamps = false;

    public static function getValue($key)
    {
        $settings = Setting::getAllCached();
        $s = $settings->where('key', $key)->first();
        if ($s) {
            return $s->value;
        }

        return null;
    }
}
