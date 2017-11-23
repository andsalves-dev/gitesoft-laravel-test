<?php

use Illuminate\Database\Seeder;

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
    }
}
