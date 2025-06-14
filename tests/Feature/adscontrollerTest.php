<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Ad;

class AdsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_ad_successfully()
    {
        Storage::fake('public');
        session(['admin' => true]);

        $file = UploadedFile::fake()->create('dummy.jpg', 100);

        $response = $this->post('/createads', [
            'title' => 'Test Ad',
            'description' => 'This is a description.',
            'image' => $file,
        ]);

        $response->assertRedirect('/ads');

        $this->assertDatabaseHas('ads', [
            'title' => 'Test Ad',
            'description' => 'This is a description.'
        ]);

        Storage::disk('public')->assertExists('advertimages/' . Ad::first()->image);
    }

    public function test_edit_ad()
    {
        Storage::fake('public');
        session(['admin' => true]);

        $ad = Ad::factory()->create();
        $file = UploadedFile::fake()->create('dummy.jpg', 100);

        $response = $this->post("/editad/{$ad->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated description',
            'image' => $file,
        ]);

        $response->assertRedirect('/ads');

        $this->assertDatabaseHas('ads', [
            'id' => $ad->id,
            'title' => 'Updated Title',
            'description' => 'Updated description'
        ]);

        Storage::disk('public')->assertExists('advertimages/' . Ad::first()->image);
    }

    public function test_delete_ad()
    {
        Storage::fake('public');
        session(['admin' => true]);

        $file = UploadedFile::fake()->create('dummy.jpg', 100);

        $this->post('/createads', [
            'title' => 'Test Ad',
            'description' => 'Ad Description',
            'image' => $file,
        ]);

        $ad = Ad::first();

        $response = $this->get("/deletead/{$ad->id}");

        $response->assertRedirect(route('addashboard'));
        $this->assertDatabaseMissing('ads', [
            'id' => $ad->id
        ]);
    }

    public function test_view_addashboard()
    {
        Ad::factory()->count(6)->create();
        session(['admin' => true]);

        $response = $this->get('/ads');
        $response->assertStatus(200);
        $response->assertViewHas('ads');
    }

    public function test_edit_ad_view()
    {
        $ad = Ad::factory()->create();
        session(['admin' => true]);

        $response = $this->get("/editad/{$ad->id}");

        $response->assertStatus(200);
        $response->assertViewHas('ad', $ad);
    }
}
