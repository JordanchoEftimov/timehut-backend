<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SalaryResource;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SalaryController extends Controller
{
    public function getSalaries(): AnonymousResourceCollection
    {
        $employee = Employee::query()->firstWhere('user_id', auth()->id());
        $salaries = $employee->salaries()
            ->paginate(10);

        return SalaryResource::collection($salaries);
    }
}
