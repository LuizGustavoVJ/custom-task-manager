<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Finotello',
            'email' => 'finotello22@hotmail.com',
            'password' => Hash::make('101221@Lgf'),
        ]);

        User::factory(10)->create();
    }
}


