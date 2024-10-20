<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin ',
            'email' => 'admin@example.com',
            'password' => 'test1234',
            'phone' => '589648',
            'role' => 'admin',
            'remember_token' => now(),
        ]);
        Category::create(['name' => 'صندل ',  'image' => 'img2.jpg', 'type' => "Men"]);
        Category::create(['name' => 'ثياب مطرزه ',  'image' => 'img3.jpg', 'type' => "Women"]);
        Category::create(['name' => 'عسيب ',  'image' => 'img4.jpg', 'type' => "Accessory"]);
        Category::create(['name' => 'كوفيه ',  'image' => 'img5.jpg', 'type' => "Accessory"]);


        Product::create(['name' => 'Abaya 1', 'description' => 'Abaya 1 New Models',  'price' => '15', 'size' => 'S', 'category_id' => 1]);
        Product::create(['name' => 'Abaya 2', 'description' => 'Abaya 2 New Models',  'price' => '8', 'size' => 'M',  'category_id' => 2]);
        Product::create(['name' => 'Abaya 3', 'description' => 'Abaya 3 New Models',  'price' => '8', 'size' => 'L', 'category_id' => 3]);
        Product::create(['name' => 'Abaya 4', 'description' => 'Abaya 5 New Models',  'price' => '8', 'size' => 'L', 'category_id' => 4]);

        Image::create(['product_id'=>1,'image' => 'img5.jpg']);
        Image::create(['product_id'=>1,'image' => 'img4.jpg']);
        Image::create(['product_id'=>2,'image' => 'img3.jpg']);
        Image::create(['product_id'=>2,'image' => 'img1.jpg']);
        Image::create(['product_id'=>3,'image' => 'img5.jpg']);
        Image::create(['product_id'=>3,'image' => 'img4.jpg']);
        Image::create(['product_id'=>4,'image' => 'img3.jpg']);
        Image::create(['product_id'=>4,'image' => 'img1.jpg']);


    }

}
