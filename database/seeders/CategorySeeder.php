<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Category::factory(5)
//            ->has(Category::factory(3)
//                ->has(Category::factory(6))
//            )
//            ->create();
        $data = [
            'Electronics' => ['Laptops', 'Mobiles', 'Tablets'],
            'Furniture' => ['Sofa', 'Household', 'Items'],
            'Fashion & Beauty' => ['Man', 'Woman', 'Kids'],
            'Two wheelers' => ['Scooters', 'Cycle', 'Bike'],
            'Services' => ['Plimbing', 'Electrician', 'Carpenter'],
            'Pets' => ['Buy pets', 'Pet supplies' ],
            'Property' => ['House & Apartment', 'Shop & office'],
            'Car' => ['Lambortini', 'Toyota', 'Honda', 'Suzuki']
        ];
        foreach ($data as $rootCategory => $subCategories) {
            $rootCategory = Category::create(['name' => $rootCategory]);
            $subData = collect();
            foreach ($subCategories as $subCategory) {
                $subData->push(Category::factory()->make(['name' => $subCategory]));
            }
            $rootCategory->categories()->saveMany($subData);
        }
    }
}
