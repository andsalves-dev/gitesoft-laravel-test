<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(GenresSeeder::class);
        $this->call(FilmsSeeder::class);
        $this->call(UsersSeed::class);
        $this->call(CommentsSeeder::class);
    }
}
