<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'popcorn',
            'description' => 'The super corn.'
        ]);

        Role::create([
            'name' => 'corn',
            'description' => 'A simple corn.'
        ]);
    }
}
