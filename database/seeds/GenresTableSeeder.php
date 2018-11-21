<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = ["Action","Adventure","Animation","Biblical Movies","Biography","Comedy","Courtroom","Crime","Disaster Movies","Documentary","Drama","Epics","Experimental Film","Exploitation Film","Family Movie","Fantasy","Film Noir","Gangster","History","Horror","Martial Arts Movies","Musical","Mystery","Neo Noir","Romance","Rom-Com","Science Fiction","Slasher","Spaghetti Western","Sport","Spy Movies","Superhero Movies","Tech Noir","Thriller","War","Western"];

        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre,
                'about' => ''
            ]);
        }
    }
}
