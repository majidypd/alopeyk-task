<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->insert(['id' => 1, 'title' => 'admin']);
        DB::table('roles')->insert(['id' => 2, 'title' => 'seller']);
        DB::table('roles')->insert(['id' => 3, 'title' => 'customer']);
        DB::table('users')->insert([
            'name' => 'administartor',
            'email' => 'admin@test',
            'password' => bcrypt('secret'),
            'lat' => '35.69979600',
            'lng' => '51.34114200',
            'address' => ''
        ]);
         DB::table('role_user')->insert(['user_id' => 1, 'role_id' => 1]);
    }

}
