<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Uuid;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Admin 1', 'Admin 2', 'Admin 3', 'Admin 4'];

        $username = ['admin', 'admin_2', 'admin_3', 'admin_4'];

        $profile_pic = ['Picture 1', 'Picture 2', 'Picture 3', 'Picture 4'];

        $phone_number = ['0823487581', '0823487582', '0823487583', '0823487584'];

        for ($i = 0; $i < 3; $i++) {
          DB::table('admins')->insert([
                  'name' => $name[$i],
                  'username' => $username[$i],
                  'profile_image' => $profile_pic[$i],
                  'phone' => $phone_number[$i],
                  'password' => Hash::make('pass'),
                  'remember_token' => '12345',
          ]);
        }
    }
}
