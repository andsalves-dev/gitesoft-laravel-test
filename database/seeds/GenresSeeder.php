<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder for film genres
 *
 * @author Andsalves
 */
class GenresSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('genres')->insert(['name' => 'Action', 'slug' => 'action']);
        DB::table('genres')->insert(['name' => 'Adventure', 'slug' => 'adventure']);
        DB::table('genres')->insert(['name' => 'Animation', 'slug' => 'animation']);
        DB::table('genres')->insert(['name' => 'Comedy', 'slug' => 'comedy']);
        DB::table('genres')->insert(['name' => 'Crime', 'slug' => 'crime']);
        DB::table('genres')->insert(['name' => 'Drama', 'slug' => 'drama']);
        DB::table('genres')->insert(['name' => 'Epics/Historical', 'slug' => 'epics-historical']);
        DB::table('genres')->insert(['name' => 'Fantasy', 'slug' => 'fantasy']);
        DB::table('genres')->insert(['name' => 'Horror', 'slug' => 'horror']);
        DB::table('genres')->insert(['name' => 'Musical/Dance', 'slug' => 'musical-dance']);
        DB::table('genres')->insert(['name' => 'Romance', 'slug' => 'romance']);
        DB::table('genres')->insert(['name' => 'Science Fiction', 'slug' => 'science-fiction']);
        DB::table('genres')->insert(['name' => 'Thriller', 'slug' => 'thriller']);
        DB::table('genres')->insert(['name' => 'War', 'slug' => 'war']);
        DB::table('genres')->insert(['name' => 'Western', 'slug' => 'western']);
    }
}
