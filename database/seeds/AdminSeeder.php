<?php
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'password' => bcrypt('pass'),
            'email' => 'admin@admin.com',
            'phone' => 'admin@admin.com',
            'photo' => 'admin@admin.com',
            'language' => 'admin@admin.com',
            'location' => 'admin@admin.com',
            'find_out' => 'newsletter',
            'role' => 'admin',
        ]);


        // $this->call("OthersTableSeeder");
    }

}