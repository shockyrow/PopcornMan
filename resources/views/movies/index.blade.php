@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="col" action="{{ Request::url() }}" method="GET">
                <div class="input-group input-group-lg mb-2">
                    <input class="form-control" name="q" placeholder="Search..." autocomplete="off" list="movieNames"
                           value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}"/>

                    <datalist id="movieNames" class="w-100">
                        @foreach(\App\Movie::all()->pluck('title') as $movieTitle)
                            <option class="w-100" value="{{ $movieTitle }}"/>
                        @endforeach
                    </datalist>

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            @forelse ($movies as $movie)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">
                    <a href="{{ url(route('movies.show', $movie->id)) }}" class="btn btn-block p-0">
                        <div class="card shadow">
                            <img src="{{ asset('img/posters/'.$movie->imgUrl) }}" class="rounded-top" width="100%"/>

                            <div class="card-footer shadow-sm text-center">
                                <div class="small">{{ $movie->year }}</div>

                                <h5 class="m-0">{{ $movie->title }}</h5>

                                <div class="small">
                                    @forelse($movie->genres()->pluck("name") as $key => $genre)
                                        @if($key!==0)
                                            {{ ', ' }}
                                        @endif
                                        {{ $genre }}
                                    @empty
                                        No genres found!
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col">
                    <h3 class="text-center bg-white border rounded shadow p-3">
                        No movies found!
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
@endsection
