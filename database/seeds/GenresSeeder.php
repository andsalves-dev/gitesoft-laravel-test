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
        /** @var \Illuminate\Database\Eloquent\Builder $builder */
        $builder = DB::table('genres');

        $builder->whereBetween('id', [0, 16])->delete();

        DB::table('genres')->insert(['id' => 1, 'name' => 'Action', 'slug' => 'action']);
        DB::table('genres')->insert(['id' => 2, 'name' => 'Adventure', 'slug' => 'adventure']);
        DB::table('genres')->insert(['id' => 3, 'name' => 'Animation', 'slug' => 'animation']);
        DB::table('genres')->insert(['id' => 4, 'name' => 'Comedy', 'slug' => 'comedy']);
        DB::table('genres')->insert(['id' => 5, 'name' => 'Crime', 'slug' => 'crime']);
        DB::table('genres')->insert(['id' => 6, 'name' => 'Drama', 'slug' => 'drama']);
        DB::table('genres')->insert(['id' => 7, 'name' => 'Epics/Historical', 'slug' => 'epics-historical']);
        DB::table('genres')->insert(['id' => 8, 'name' => 'Fantasy', 'slug' => 'fantasy']);
        DB::table('genres')->insert(['id' => 9, 'name' => 'Horror', 'slug' => 'horror']);
        DB::table('genres')->insert(['id' => 10, 'name' => 'Musical/Dance', 'slug' => 'musical-dance']);
        DB::table('genres')->insert(['id' => 11, 'name' => 'Romance', 'slug' => 'romance']);
        DB::table('genres')->insert(['id' => 12, 'name' => 'Science Fiction', 'slug' => 'science-fiction']);
        DB::table('genres')->insert(['id' => 13, 'name' => 'Thriller', 'slug' => 'thriller']);
        DB::table('genres')->insert(['id' => 14, 'name' => 'War', 'slug' => 'war']);
        DB::table('genres')->insert(['id' => 15, 'name' => 'Western', 'slug' => 'western']);
    }
}
