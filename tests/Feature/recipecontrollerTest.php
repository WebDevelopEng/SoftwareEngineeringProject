<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Recipe;
use App\Models\Restaurant;
use App\Models\Member;
use App\Models\User;
use App\Models\Ad;
use Carbon\Carbon;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_recipe_as_restaurant()
    {
        Storage::fake('public');

        $restaurant = Restaurant::factory()->create();
        Session::start();
        session(['restaurant' => $restaurant]);

        $image = UploadedFile::fake()->create('dummy.jpg', 100);

        $response = $this->post('/createmenu', [
            'name' => 'Pasta',
            'description' => 'Food',
            'ingredients' => 'Food',
            'premium' => 0,
            'category' => 'Seafood',
            'image' => $image,
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect('/menudashboard');

        $this->assertDatabaseHas('recipes', [
            'Name' => 'Pasta',
            'restaurant_id' => $restaurant->id
        ]);
    }

    public function test_view_full_recipes()
    {
        Recipe::factory()->count(5)->create();

        $response = $this->get('/menudashboard');
        $response->assertStatus(200);
        $response->assertViewHas('collection');
    }

    public function test_view_particular_recipe_as_user_with_membership()
{
    $user = User::factory()->create();
    $member = Member::create([
        'memberId' => $user->id,
        'price' => 128.15,
        'activeStatus' => true,
        'membershipStart' => now()->toDateString(),
        'membershipDueDate' => now()->addMonth()->toDateString(),
    ]);

    Session::start(); 
    session(['user' => $user]);

    $restaurant = Restaurant::factory()->create();
    $recipe = Recipe::factory()->create([
        'restaurant_id' => $restaurant->id,
        'premium' => false,
    ]);

    $response = $this->get('/viewrecipe/' . $recipe->RecipeID);

    $response->assertStatus(200);
    $response->assertViewHas('recipe');
}

    public function test_edit_recipe_page()
{
    $restaurant = Restaurant::factory()->create();

    $recipe = Recipe::factory()->create([
        'restaurant_id' => $restaurant->id,
    ]);

    Session::start();
    session(['restaurant' => $restaurant]);

    $response = $this->get('/editrecipe/' . $recipe->RecipeID);

    $response->assertStatus(200);
    $response->assertViewHas('recipe');
}

    public function test_delete_recipe_as_admin()
    {
        Storage::fake('public');

        $recipe = Recipe::factory()->create([
            'image' => 'recipe.jpg'
        ]);

        Session::start();
        session(['admin' => true]);

        $response = $this->get('/deleterecipe/' . $recipe->RecipeID);
        $response->assertRedirect('admrecipes');

        $this->assertDatabaseMissing('recipes', [
            'RecipeID' => $recipe->RecipeID
        ]);
    }
}

