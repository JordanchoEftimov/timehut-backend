<?php

use App\Models\Employee;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('cannot get salaries when not authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();

    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.salaries.get', $employee));

    $response->assertUnauthorized();
});

it('can get own salaries when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($user);
    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.salaries.get', $employee));

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

it('cannot get another user\'s salaries when authenticated', function () {
    $user = User::factory()->has(Employee::factory())->create();
    $anotherUser = User::factory()->has(Employee::factory())->create();
    Sanctum::actingAs($anotherUser);
    $employee = Employee::query()->firstWhere('user_id', $user->id);

    $response = $this->getJson(route('v1.salaries.get', $employee));

    $response->assertForbidden();
});
