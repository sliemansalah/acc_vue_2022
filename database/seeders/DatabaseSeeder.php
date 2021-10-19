<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Seller\Categories\Models\Category;
use Rfof\Domain\Seller\Rating\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        $this->runSeeders();

    }

    public function runSeeders()
    {

        $this->call(CategoriesSeeder::class);
        $this->call(ItemTypeSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(CouponsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ContactUS::class);
    }
}
