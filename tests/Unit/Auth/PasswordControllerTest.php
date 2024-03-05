<?php

namespace Tests\Unit\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class PasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_user_password()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->put(route('password.update'), [
            'current_password' => 'password',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));
        $response->assertRedirect()->assertSessionHas('status', 'profile-updated');
    }

}
