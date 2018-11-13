<?php

use Illuminate\Database\Seeder;

class UsersTabaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

                'name' => 'salman iqbal',
                'phone_no' => '03239047937',
                'email' => 'salman@yahoo.com',
                'deactive_users' => 1,
                'password' => bcrypt(12345),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

        ]);
    }
}
