<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class MemberControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_subscribe_with_sufficient_balance()
    {
        $user = User::factory()->create([
            'balance' => 10000,
        ]);

        Session::start();
        session(['user' => $user]);

        $endDate = Carbon::now()->addMonths(1)->format('Y-m-d');

        $response = $this->post(route('subscribe'), [
            'enddate' => $endDate,
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect(route('profile'));
        $this->assertDatabaseHas('members', [
            'memberId' => $user->id,
            'activeStatus' => 1,
        ]);
    }

    public function test_user_cannot_subscribe_with_insufficient_balance()
    {
        $user = User::factory()->create([
            'balance' => 0,
        ]);

        Session::start();
        session(['user' => $user]);

        $endDate = Carbon::now()->addMonths(1)->format('Y-m-d');

        $response = $this->post(route('subscribe'), [
            'enddate' => $endDate,
            '_token' => csrf_token(),
        ]);

        $response->assertViewIs('subscription');
    }

    public function test_user_can_refill_balance()
    {
        $user = User::factory()->create([
            'balance' => 100,
        ]);

        Session::start();
        session(['user' => $user]);

        $response = $this->post(route('refillacc'), [
            'balance' => 500,
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'balance' => 600,
        ]);
    }

    public function test_subscription_view_renders_correctly()
    {
        $response = $this->get(route('subscription'));
        $response->assertViewIs('subscription');
    }
}
