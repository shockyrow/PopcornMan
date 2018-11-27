@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-5 col-md-4 col-lg-3 my-2">
                <div class="card shadow position-relative">
                    <img src="{{ asset('img/posters/'.$movie->imgUrl) }}" class="rounded-top" width="100%"/>

                    @auth
                        <form method="POST">
                            @csrf

                            <button type="submit" formaction="{{ route('movies.toggleDislike', $movie->id) }}"
                                    class="bg-transparent border-0 p-0 position-absolute" style="top: 16px; left: 16px;">
                                <i class="fa-thumbs-down fa-2x text-white {{ $movie->isDislikedBy() ? 'fas text-danger' : 'far' }}" style="text-shadow: 0 0 8px gray;">
                                </i>
                            </button>

                            <button type="submit" formaction="{{ route('movies.toggleLike', $movie->id) }}"
                                    class="bg-transparent border-0 p-0 position-absolute" style="top: 16px; right: 16px;">
                                <i class="fa-heart fa-2x text-white {{ $movie->isLikedBy() ? 'fas text-danger' : 'far' }}" style="text-shadow: 0 0 8px gray;">
                                </i>
                            </button>
                        </form>
                    @endauth

                    <div class="card-footer shadow-sm">
                        <div>
                            <span class="small">Title:</span>

                            <span class="font-weight-bold float-right">{{ $movie->title }}</span>
                        </div>

                        <div>
                            <span class="small">Year:</span>

                            <span class="font-weight-bold float-right">{{ $movie->year }}</span>
                        </div>

                        <div>
                            <span class="small">Points:</span>

                            <span class="font-weight-bold float-right">
                                @if($movie->likesAndDislikes()->count()!==0)
                                    {{ round($movie->likesCount/$movie->likesAndDislikes()->count()*10, 1).'/10' }}
                                @else
                                    {{ 'Unavailable' }}
                                @endif
                            </span>
                        </div>

                        <div>
                            <span class="small">Genres:</span>

                            <span class="font-weight-bold float-right">
                                @forelse($movie->genres as $genre)
                                    <a href="{{ route('genres.show', $genre->id) }}"
                                       class="badge badge-info text-white py-1">
                                        {{ $genre->name }}
                                    </a>
                                @empty
                                    No genres found!
                                @endforelse
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col my-2">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <video width="100%" class="rounded-top" controls>
                                <source src="{{ asset('video/1.mp4') }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>

                            <div class="card-footer text-justify">
                                {{ $movie->about }}
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <hr/>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <form action="{{ route('comments.store') }}" method="POST">
                                    <div class="card-body">
                                        @csrf
                                        <input type="hidden" name="movie_id" value="{{ $movie->id }}"/>

                                        <div class="form-group my-0">
                                            <textarea name="text" class="form-control" placeholder="Comment...">
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group text-right mb-0">
                                            <button type="reset" class="btn btn-light">
                                                Reset
                                            </button>

                                            <button type="submit" class="btn btn-primary">
                                                Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
                <hr/>
                @forelse($movie->comments->reverse() as $comment)
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-sm my-2">
                                <div class="card-body">
                                    <div class="text-justify" style="text-overflow: ellipsis;">
                                        {{ $comment->text }}
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{ $comment->user->name }}
                                    <span class="small text-muted">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}
                                    </span>
                                    @auth
                                        <form class="float-right" method="POST">
                                            @csrf

                                            <div class="btn-group btn-group-sm border rounded shadow-sm">
                                                <button type="submit"
                                                        formaction="{{ route('comments.toggleDislike', $comment->id) }}"
                                                        class="btn py-0 {{ $comment->isDislikedBy() ? 'btn-danger' : 'btn-light' }}">
                                                    <i class="fas fa-times">
                                                    </i>
                                                </button>
                                                <span class="btn btn-light py-0">
                                                    {{ $comment->likesDiffDislikesCount }}
                                                </span>
                                                <button type="submit"
                                                        formaction="{{ route('comments.toggleLike', $comment->id) }}"
                                                        class="btn py-0 {{ $comment->isLikedBy() ? 'btn-success' : 'btn-light' }}">
                                                    <i class="fas fa-check">
                                                    </i>
                                                </button>
                                            </div>

                                            <div class="btn-group btn-group-sm border rounded shadow-sm">
                                                <button type="submit" form="deleteForm" class="btn btn-danger py-0">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </button>
                                            </div>
                                        </form>
                                        @if(Auth::user()->id == $comment->user->id || Auth::user()->isAdmin())
                                            <form class="float-right"
                                                  name="deleteForm"
                                                  action="{{ route('comments.destroy', $comment->id) }}"
                                                  method="POST">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col">
                            <h3 class="text-center bg-white border rounded shadow p-3">
                                No comments found!
                            </h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
