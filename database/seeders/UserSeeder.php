<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin sabeeli',
            'email' => 'admin@sabeeli.org',
            'phone' => '0597235300',
            'password' => Hash::make('sabeeli@0597235300')
        ]);
    }
}
