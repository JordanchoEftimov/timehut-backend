<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function startShift(Request $request): JsonResource
    {
        $this->authorize('startShift', Shift::class);

        $employeeId = $request->user()->employee_id;

        $employee = Employee::query()
            ->firstWhere('id', $employeeId);

        $shift = new Shift();
        $shift->start_at = now();
        $shift->employee()->associate($employee);
        $shift->save();

        return JsonResource::make($shift);
    }

    /**
     * @throws AuthorizationException
     */
    public function endShift(Shift $shift, Request $request): JsonResource
    {
        $this->authorize('endShift', Shift::class);

        $shift->end_at = now();
        $shift->save();

        return JsonResource::make($shift);
    }
}
