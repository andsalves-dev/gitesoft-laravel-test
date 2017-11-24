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
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'type' => 'admin',
            'status' => 'active'
        ]);
    }
}
