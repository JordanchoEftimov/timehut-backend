<?php

use App\Models\Employee;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('cannot get shifts when not authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();

    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.shifts.get', $employee));

    $response->assertUnauthorized();
});

it('can get own shifts when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.shifts.get', $employee));

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'start_at',
                    'end_at',
                    'duration',
                ],
            ],
        ]);
});

it('cannot get another user\'s shifts when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    $anotherUser = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($anotherUser);
    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.shifts.get', $employee));

    $response->assertForbidden();
});
