<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name'=>'Alex Hurtado',
            'email'=> 'alex@email.com',
            'password' => Hash::make('Admin911$01'),
        ]);

       $this->call( GeneralSeed::class );

    }
}
