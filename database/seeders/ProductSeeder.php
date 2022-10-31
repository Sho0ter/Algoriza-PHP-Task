<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           //Create Categories with  parent
           Product::factory()->count(6)->create([
            'name' => $this->faker->text(20),
            'description' => $this->faker->text,
            'tags' => $this->faker->text(5).','.$this->faker->text(5),
            'picture' => 'images/1.png',
            'category_id' => Category::inRandomOrder()->first()->id,
        ]);
        
    }
}
