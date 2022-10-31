<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class CategorySeeder extends Seeder
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
        //Create Categories with no parent
        Category::factory()->count(3)->create([
            'name' => $this->faker->text(20),
            'is_active' => rand(0,1),
        ]);

         //Create Categories with  parent
        Category::factory()->count(2)->create([
            'name' => $this->faker->text(20),
            'category_id' => Category::inRandomOrder()->first()->id,
            'is_active' => rand(0,1),
        ]);

         //Create Categories with  parent
         Category::factory()->count(2)->create([
            'name' => $this->faker->text(10),
            'category_id' => Category::inRandomOrder()->first()->id,
            'is_active' => rand(0,1),
        ]);
    
    }
}
