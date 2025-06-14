<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;

class AccControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_account()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'dob' => '2000-01-01',
            'email' => 'testuser@example.com',
            'password' => 'userpassword',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::create([
            'name' => 'User Example',
            'email' => 'user@example.com',
            'password' => Hash::make('userpassword'),
            'dateofbirth' => '1995-01-01',
            'balance' => 0,
        ]);

        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'userpassword',
            'hidden' => 'userselection'
        ]);

        $response->assertRedirect('/menudashboard');
    }

    public function test_restaurant_can_register()
    {
        $response = $this->post('/restoregist', [
            'name' => 'Test Resto',
            'location' => 'City Center',
            'email' => 'resto@example.com',
            'password' => 'restopassword',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('restaurants', [
            'restaurantName' => 'Test Resto',
            'restaurantEmail' => 'resto@example.com'
        ]);
    }

    public function test_restaurant_can_login()
    {
        $resto = Restaurant::create([
            'restaurantName' => 'Sample Resto',
            'location' => 'Downtown',
            'restaurantEmail' => 'sample@resto.com',
            'password' => 'restopassword',
            'balance' => 0
        ]);

        $response = $this->post('/login', [
            'email' => 'sample@resto.com',
            'password' => 'restopassword',
            'hidden' => 'restoselection'
        ]);

        $response->assertRedirect('/menudashboard');
    }

    public function test_admin_can_register()
    {
        $response = $this->post('/adminregist', [
            'name' => 'Admin Name',
            'email' => 'admin@site.com',
            'password' => 'adminpass'
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('admins', [
            'username' => 'Admin Name',
            'email' => 'admin@site.com'
        ]);
    }

    public function test_admin_can_login()
    {
        $admin = Admin::create([
            'username' => 'AdminTest',
            'email' => 'admin@test.com',
            'password' => 'adminpass'
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'adminpass',
            'hidden' => 'adminselection'
        ]);

        $response->assertRedirect('/menudashboard');
    }
    public function test_user_can_update_profile()
    {
    Storage::fake('public');

    $user = User::factory()->create([
        'profilepicture' => 'old.jpg'
    ]);

    Session::put('user', $user);

    $image = UploadedFile::fake()->create('dummy.jpg', 100);

    $response = $this->actingAs($user)->post('/userprofile', [
        'name' => 'Updated Name',
        'dob' => '1995-01-01',
        'image' => $image,
    ]);

    $response->assertRedirect('/profile');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
        'dateofbirth' => '1995-01-01',
    ]);

    Storage::disk('public')->assertExists('profileimages/use' . now()->format('YmdHis') . '.jpg');
    }
    public function test_user_can_update_account()
{
    $user = User::factory()->create([
        'email' => 'old@example.com',
        'password' => bcrypt('oldpassword')
    ]);

    Session::put('user', $user);

    $response = $this->actingAs($user)->post('/useracc', [
        'email' => 'new@example.com',
        'password' => 'newpassword'
    ]);

    $response->assertRedirect('/profile');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'email' => 'new@example.com'
    ]);

    $user->refresh();
    $this->assertTrue(Hash::check('newpassword', $user->password));
}
    public function test_restaurant_can_update_profile()
{
    Storage::fake('public');

    $resto = Restaurant::factory()->create([
        'image' => 'old.jpg'
    ]);

    Session::put('restaurant', $resto);

    $image = UploadedFile::fake()->create('dummy.jpg', 100);

    $response = $this->post('/restoprofile', [
        'name' => 'New Resto',
        'location' => 'New City',
        'image' => $image
    ]);

    $response->assertRedirect('/profile');

    $resto->refresh();

    $this->assertEquals('New Resto', $resto->restaurantName);
    $this->assertEquals('New City', $resto->location);
    Storage::disk('public')->assertExists('profileimages/' . $resto->image);
}
    public function test_restaurant_can_update_account()
{
    $resto = Restaurant::factory()->create([
        'restaurantEmail' => 'oldresto@example.com',
        'password' => 'oldpass'
    ]);

    Session::put('restaurant', $resto);

    $response = $this->post('/restoacc', [
        'email' => 'newresto@example.com',
        'password' => 'newpass'
    ]);

    $response->assertRedirect('/profile');

    $this->assertDatabaseHas('restaurants', [
        'id' => $resto->id,
        'restaurantEmail' => 'newresto@example.com',
        'password' => 'newpass'
    ]);
}
public function test_admin_can_update_account()
{
    $admin = Admin::factory()->create([
        'email' => 'adminold@example.com',
        'password' => 'oldadminpass'
    ]);

    Session::put('admin', $admin);

    $response = $this->post('/adminacc', [
        'email' => 'adminnew@example.com',
        'password' => 'newadminpass'
    ]);

    $response->assertRedirect('/profile');

    $this->assertDatabaseHas('admins', [
        'id' => $admin->id,
        'email' => 'adminnew@example.com',
        'password' => 'newadminpass'
    ]);
}
public function test_admin_can_update_profile()
{
    $admin = Admin::factory()->create([
        'username' => 'OldAdmin'
    ]);

    Session::put('admin', $admin);

    $response = $this->post('/adminprofile', [
        'name' => 'NewAdminName'
    ]);

    $response->assertRedirect('/profile');

    $this->assertDatabaseHas('admins', [
        'id' => $admin->id,
        'username' => 'NewAdminName'
    ]);
}
}
