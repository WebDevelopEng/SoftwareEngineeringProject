<?php

namespace Tests\Feature;

use App\Models\donation;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DonationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }
    /** @test */
    public function restaurant_can_create_a_donation()
    {
        $restaurant = Restaurant::factory()->create();
        Session::put('restaurant', $restaurant);

        $response = $this->post(route('createdonation'), [
            'name' => 'Food Aid',
            'description' => 'Meal box',
            'image' => UploadedFile::fake()->create('dummy.jpg', 100),
            'price' => 25,
            'count' => 20,
        ]);

        $response->assertRedirect(route('donate'));
        $this->assertDatabaseHas('donations', ['name' => 'Food Aid']);
        Storage::disk('public')->assertExists('donationimages');
    }

    /** @test */
    public function restaurant_can_update_a_donation_with_new_image()
    {
        $restaurant = Restaurant::factory()->create();
        $donation = donation::factory()->create(['restaurant_id' => $restaurant->id]);

        Session::put('restaurant', $restaurant);

        $response = $this->post(route('editdonation', $donation->id), [
            'name' => 'Updated Donation',
            'description' => 'Updated Description',
            'image' => UploadedFile::fake()->create('dummy.jpg', 100),
            'count' => 30,
            'price'=>1000,
        ]);

        $response->assertRedirect(route('donate'));
        $this->assertDatabaseHas('donations', ['name' => 'Updated Donation']);
    }

    public function donation_can_be_deleted()
    {
        $donation = donation::factory()->create(['image' => 'todelete.jpg']);
        Storage::disk('public')->put('donationimages/todelete.jpg', 'fake');

        $response = $this->get(route('deletedonation', $donation->id));
        $response->assertRedirect(route('donate'));

        $this->assertDatabaseMissing('donations', ['id' => $donation->id]);
        Storage::disk('public')->assertMissing('donationimages/todelete.jpg');
    }
    /** @test */
    public function donation_can_be_edited()
    {
        $restaurant = Restaurant::factory()->create();

        $donation = donation::factory()->create([
            'restaurant_id' => $restaurant->id,
        ]);

        Session::put('restaurant', $restaurant);

        $response = $this->post(route('editdonation', $donation->id), [
            'name' => 'Edited Name',
            'description' => 'Short desc',
            'price' => 99,
            'count' => 5,
        ]);

        $response->assertRedirect(route('donate'));
        $this->assertDatabaseHas('donations', ['name' => 'Edited Name']);
    }

    /** @test */
    public function donations_can_be_searched()
    {
        donation::factory()->create(['name' => 'Special Pack']);

        $response = $this->post(route('searchdonations', ['search' => 'Special Pack']));
        $response->assertViewHas('donations');
    }

    /** @test */
   public function donation_views_are_accessible()
{
    $restaurant = Restaurant::factory()->create();
    $donation = donation::factory()->create(['restaurant_id' => $restaurant->id]);

    Session::put('restaurant', $restaurant);

    $this->get(route('createdonationview'))->assertStatus(200);
    $this->get(route('editdonationview', $donation->id))->assertStatus(200);
    $this->get(route('viewdonation', $donation->id))->assertStatus(200);
}
}
