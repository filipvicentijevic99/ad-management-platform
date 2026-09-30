<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function public_index_route_displays_ads()
    {
        // Kreiramo korisnika
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'customer',
        ]);

        // Dummy kategorija
        $category = Category::factory()->create([
            'name' => 'Electronics'
        ]);

        // Kreiramo oglas sa kategorijom
        $ad = Ad::factory()->create([
            'title' => 'iPhone 14 for sale',
            'description' => 'Almost new iPhone 14, barely used',
            'price' => 999.99,
            'condition' => 'novo',
            'image_path' => 'images/iphone14.png',
            'contact_phone' => '123456789',
            'location' => 'Belgrade',
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('ads.public'));

        $response->assertStatus(200);
        $response->assertSee('iPhone 14 for sale');
    }

    /** @test */
    public function public_show_route_displays_single_ad()
    {
        $user = User::factory()->create([
            'name' => 'Alice Smith',
            'email' => 'alice@example.com',
            'role' => 'admin',
        ]);

        $category = Category::factory()->create([
            'name' => 'Books'
        ]);

        $ad = Ad::factory()->create([
            'title' => 'Harry Potter Book Set',
            'description' => 'Complete Harry Potter series',
            'price' => 120,
            'condition' => 'polovno',
            'image_path' => 'images/hp.png',
            'contact_phone' => '987654321',
            'location' => 'Novi Sad',
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('ads.public.show', $ad->id));

        $response->assertStatus(200);
        $response->assertSee('Harry Potter Book Set');
    }

    /** @test */
    public function admin_dashboard_requires_auth_and_displays_data()
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Ukupno korisnika');
    }

    /** @test */
    public function customer_profile_requires_auth_and_displays_profile()
    {
        $customer = User::factory()->create([
            'name' => 'Customer One',
            'email' => 'customer@example.com',
            'role' => 'customer',
        ]);

        $response = $this->actingAs($customer)->get(route('customer.profile'));

        $response->assertStatus(200);
        $response->assertSee('Customer One');
    }
}
