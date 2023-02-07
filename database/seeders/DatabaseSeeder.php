<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Images;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('pass#word')
        ]);

        News::factory(8)->create();
        for ($i = 1; $i < 8; $i++) {

            Images::create([
                'name' => "https://via.placeholder.com/600x200/000000/FFFFFF/?text=news" . $i,
                'news_id' => $i

            ]);
        }
    }
}
