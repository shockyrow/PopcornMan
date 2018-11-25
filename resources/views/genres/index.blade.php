@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="col" action="{{ Request::url() }}" method="GET">
                <div class="input-group input-group-lg mb-2">
                    <input class="form-control" name="q" placeholder="Search..." autocomplete="off" list="genreNames"
                           value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}"/>

                    <datalist id="genreNames" class="w-100">
                        @foreach(\App\Genre::all()->pluck('name') as $genreName)
                            <option class="w-100" value="{{ $genreName }}"/>
                        @endforeach
                    </datalist>

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            @forelse ($genres as $genre)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">
                    <a href="{{ url(route('genres.show', $genre->id)) }}" class="btn btn-lg bg-white btn-block border shadow-sm">
                        {{ $genre->name }}
                        <span class="badge badge-primary">
                            {{ $genre->movies()->count() }}
                        </span>
                    </a>
                </div>
            @empty
                <div class="col">
                    <h3 class="text-center bg-white border rounded shadow p-3">
                        No genres found!
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
@endsection
