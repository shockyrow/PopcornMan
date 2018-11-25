<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_popcorn = Role::where('name', 'popcorn')->first();
        $role_corn = Role::where('name', 'corn')->first();

        $popcorn = User::create([
            'name' => 'PopcornMan',
            'email' => 'popcorn@example.com',
            'password' => bcrypt('secret')
        ]);
        $popcorn->roles()->attach($role_popcorn);

        $corn = User::create([
            'name' => 'Emily Carter',
            'email' => 'emily@example.com',
            'password' => bcrypt('secret')
        ]);
        $corn->roles()->attach($role_corn);

        factory(User::class, 100)->create()->each(function(User $user) use ($role_corn) {
            $user->roles()->attach($role_corn);
        });
    }
}
