<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author Andsalves
 */
class UsersSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'andsalves@alu.ufc.br',
            'username' => 'admin',
            'password' => hash('sha256', md5('admin')),
            'type' => 'admin',
            'status' => 'active'
        ]);
    }
}
