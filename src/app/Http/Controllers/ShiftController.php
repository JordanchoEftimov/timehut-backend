<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftController extends Controller
{
    public function startShift(Request $request): JsonResource
    {
        $employeeId = $request->user()->employee_id;

        $employee = Employee::query()
            ->firstWhere('id', $employeeId);

        $shift = new Shift();
        $shift->start_at = now();
        $shift->employee()->associate($employee);
        $shift->save();

        return JsonResource::make($shift);
    }

    public function endShift(Shift $shift, Request $request): JsonResource
    {
        $employeeId = $request->user()->employee_id;

        // If the user trying to end the shift is not the shift owner, prevent it
        abort_if($shift->employee_id !== $employeeId, 403);

        $shift->end_at = now();
        $shift->save();

        return JsonResource::make($shift);
    }
}
