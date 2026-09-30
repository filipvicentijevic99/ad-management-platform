<?php

namespace Tests\Unit;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase; 

class AdTest extends TestCase
{
    // Oglas pripada korisniku
    public function test_ad_belongs_to_user()
    {
        $user = new User([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $ad = new Ad([
            'id' => 10,
            'title' => 'Prodajem bicikl',
            'description' => 'Polovan bicikl u dobrom stanju',
            'user_id' => $user->id,
        ]);

        $ad->setRelation('user', $user);

        $this->assertInstanceOf(User::class, $ad->user);
        $this->assertEquals('Test User', $ad->user->name);
    }

    // Oglas pripada kategoriji
    public function test_ad_belongs_to_category()
    {
        $category = new Category([
            'id' => 2,
            'name' => 'Automobili',
        ]);

        $ad = new Ad([
            'id' => 11,
            'title' => 'Golf 5 na prodaju',
            'description' => '2008. godište, odlično stanje',
            'category_id' => $category->id,
        ]);

        $ad->setRelation('category', $category);

        $this->assertInstanceOf(Category::class, $ad->category);
        $this->assertEquals('Automobili', $ad->category->name);
    }

    // Korisnik može da ima više oglasa
    public function test_user_has_many_ads()
    {
        $user = new User([
            'id' => 3,
            'name' => 'Marko Marković',
            'email' => 'marko@example.com',
            'password' => bcrypt('password'),
        ]);

        $ad1 = new Ad(['id' => 21, 'title' => 'Prodajem stan', 'user_id' => $user->id]);
        $ad2 = new Ad(['id' => 22, 'title' => 'Izdajem garažu', 'user_id' => $user->id]);
        $ad3 = new Ad(['id' => 23, 'title' => 'Laptop na prodaju', 'user_id' => $user->id]);

        $user->setRelation('ads', collect([$ad1, $ad2, $ad3]));

        $this->assertCount(3, $user->ads);
        $this->assertTrue($user->ads->contains($ad1));
    }

    // Kategorija može da ima više oglasa
    public function test_category_has_many_ads()
    {
        $category = new Category([
            'id' => 4,
            'name' => 'Nekretnine',
        ]);

        $ad1 = new Ad(['id' => 31, 'title' => 'Kuća na prodaju', 'category_id' => $category->id]);
        $ad2 = new Ad(['id' => 32, 'title' => 'Izdavanje stana', 'category_id' => $category->id]);

        $category->setRelation('ads', collect([$ad1, $ad2]));

        $this->assertCount(2, $category->ads);
        $this->assertTrue($category->ads->contains($ad1));
    }
}
