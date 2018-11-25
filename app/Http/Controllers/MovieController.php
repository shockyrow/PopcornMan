<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $movies = Movie::all();
        if ($request->input('q')) {
            $movies = Movie::where('title', 'LIKE', '%' . $request->input('q') . '%')->get();
        }
        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Display a listing of the favorite resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favorites(Request $request)
    {
        $movies = Movie::whereLikedBy()->get();
        if ($request->input('q')) {
            $movies = Movie::whereLikedBy(Auth::user()->id)->where('title', 'LIKE', '%' . $request->input('q') . '%')->get();
        }
        return view('movies.favorites', ['movies' => $movies]);
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
}
