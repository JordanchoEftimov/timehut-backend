<?php

use App\Models\User;

it('can logout', function () {
    $user = User::factory()->create();

    $token = $user->createToken('Test')->plainTextToken;

    $response = $this->actingAs($user)->postJson(route('v1.auth.logout'));

    $response->assertOk();

    // Ensure the token has been revoked
    $this->assertDatabaseMissing('personal_access_tokens', ['token' => $token]);
});
