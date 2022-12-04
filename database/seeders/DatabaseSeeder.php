<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\TargetAudience;
use App\Models\Copyright;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TargetAudience::truncate();
        Copyright::truncate();
        Rating::truncate();
        Book::truncate();

        Book::factory(10)->create();

        TargetAudience::create([
            'audience' => 'Middle Grade (7 - 13 years of age)',
            'min_age'  => 7,
            'max_age'  => 13,
        ]);

        TargetAudience::create([
            'audience' => 'Young Adult (13 - 18 years of age)',
            'min_age'  => 13,
            'max_age'  => 18,
        ]);

        TargetAudience::create([
            'audience' => 'New Adult (18 - 25 years of age)',
            'min_age'  => 18,
            'max_age'  => 25,
        ]);

        TargetAudience::create([
            'audience' => 'Adult (25+ years of age)',
            'min_age'  => 25,
            'max_age'  => 1000,
        ]);

        Copyright::create([
            'name' => 'All Rights Reserved'
        ]);

        Copyright::create([
            'name' => 'Public Domain'
        ]);

        Copyright::create([
            'name' => 'Creative Commons (CC) Attribution'
        ]);

        Copyright::create([
            'name' => '(CC) Attribution NonCommercial'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. NonComm. NoDerivs'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. NonComm. ShareAlike'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. NoDerivs'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. ShareAlike'
        ]);

        Rating::create([
            'name' => 'Mature'
        ]);

        Rating::create([
            'name' => 'General'
        ]);
    }
}
