<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Movie::class, 20)->create();
        foreach (Movie::all() as $key => $value) {
            $value->imgUrl = $key.'.jpg';
            $value->save();
        }
    }
}
