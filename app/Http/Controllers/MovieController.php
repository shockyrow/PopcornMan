<?php

namespace App\Http\Controllers;

use App\User;
use App\Genre;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $movies = Movie::where('title', '!=', '');
        if ($request->input('q')) {
            $movies = Movie::where('title', 'LIKE', '%' . $request->input('q') . '%');
        }

        return view('movies.list', [
            'list' => $movies->pluck('title'),
            'movies' => $movies->paginate(env('PEGINATION_SIZE', 4)),
        ]);
    }

    /**
     * Display a listing of the favorite resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loved(Request $request)
    {
        $movies = Movie::whereLikedBy();
        if ($request->input('q')) {
            $movies = Movie::whereLikedBy()->where('title', 'LIKE', '%' . $request->input('q') . '%');
        }

        return view('movies.list', [
            'list' => $movies->pluck('title'),
            'movies' => $movies->paginate(env('PEGINATION_SIZE', 4)),
        ]);
    }

    /**
     * Display a listing of the hated resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function hated(Request $request)
    {
        $movies = Movie::whereDislikedBy();
        if ($request->input('q')) {
            $movies = Movie::whereDislikedBy()->where('title', 'LIKE', '%' . $request->input('q') . '%');
        }

        return view('movies.list', [
            'list' => $movies->pluck('title'),
            'movies' => $movies->paginate(env('PEGINATION_SIZE', 4)),
        ]);
    }

    public function recommended(Request $request)
    {
        $movies = Movie::inRandomOrder()->take(7)->get()->shuffle();

        return view('movies.list', [
            'list' => $movies->pluck('title'),
            'movies' => new Paginator($movies, env('PEGINATION_SIZE', 4)),
        ]);
    }

    public function getCorrelation(User $u, User $v)
    {
        $movies = Movie::whereLikedBy($u)->join(Movie::whereLikedBy($v));

        $sum1 = 0;

        foreach ($movies as $i) {
            $sum += ($this->r($u, $i) - $this->i($u)) * ($this->r($v, $i) - $this->i($v));
        }

        $sum2 = 0;

        foreach ($movies as $i) {
            $sum2 += pow($this->r($u, $i) - $this->i($u), 2);
        }

        $sum3 = 0;

        foreach ($movies as $i) {
            $sum3 += pow($this->r($v, $i) - $this->i($v), 2);
        }

        return $sum1 / sqrt($sum2 * $sum3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie $movie
     * @return Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie $movie
     * @return Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Movie $movie
     * @return Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie $movie
     * @return Response
     */
    public function destroy(Movie $movie)
    {
        //
    }

    public function toggleLike(Movie $movie)
    {
        $movie->toggleLikeBy();

        return redirect()->back();
    }

    public function toggleDislike(Movie $movie)
    {
        $movie->toggleDislikeBy();

        return redirect()->back();
    }

    public function r(User $user, Movie $movie)
    {
        return 0;
    }

    public function i(User $user)
    {
        return 0;
    }
}
