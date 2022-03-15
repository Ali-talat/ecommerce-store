<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class adminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'  => 'Ali talaat',
            'email'  => 'ali@gmail.com',
            'password'  => 12345678,

       ]);
    }
}
