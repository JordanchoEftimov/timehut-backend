<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SalaryResource;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SalaryController extends Controller
{
    public function getSalaries(Employee $employee): AnonymousResourceCollection
    {
        abort_if($employee->user_id !== auth()->id(), 403);
        $salaries = $employee->salaries()
            ->paginate(10);

        return SalaryResource::collection($salaries);
    }
}
