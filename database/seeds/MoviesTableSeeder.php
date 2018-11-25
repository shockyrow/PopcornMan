<?php

use App\Genre;
use App\Movie;
use App\User;
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
            $value->imgUrl = $key . '.jpg';
            $value->genres()->attach(Genre::find(rand(0, Genre::count() - 1)));
            $value->save();
            for ($i = 1; $i <= 100; $i++) {
                $rnd = rand(1, 3);
                if ($rnd == 3) {
                    $value->likeBy($i);
                } else if ($rnd == 1) {
                    $value->dislikeBy($i);
                }
            }
        }
    }
}
