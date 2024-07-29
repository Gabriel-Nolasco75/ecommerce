<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Seeders\FamilySeeder;
use Database\Seeders\OptionSeeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Gabriel Nolasco',
            'email' => 'gabriel.govinda.GG@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(150)->create();
    }
}
