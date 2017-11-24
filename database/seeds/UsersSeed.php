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
        /** @var \Illuminate\Database\Eloquent\Builder $builder */
        $builder = DB::table('users');

        if ($existent = $builder->where('id', '=', 1)) {
            $existent->delete();
        }

        $builder->insert([
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'andsalves@alu.ufc.br',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'type' => 'admin',
            'status' => 'active'
        ]);
    }
}
